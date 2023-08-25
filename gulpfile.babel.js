// 参照 https://qiita.com/manabuyasuda/items/0971dbd3729cf68f87fb
//         https://zumilog.org/howto-gulpimagemin/

import gulpLoadPlugins from 'gulp-load-plugins'
import gulp from 'gulp'
import yargs from 'yargs'
// import rev from 'gulp-rev'
// import {hideBin} from 'yargs/helpers'
// const argv = yargs( hideBin( process.argv ) ).argv
// const production = argv.prod || argv.production
import browser from 'browser-sync'
import lastRun from 'gulp'
import phpCs from 'gulp-phpcs'
import phpCbf from 'gulp-phpcbf'
import rimraf from 'rimraf'
import yaml from 'js-yaml'
import fs from 'fs'
import imagemin from 'gulp-imagemin'
import imageminPngquant from 'imagemin-pngquant'
// import imageminMozjpeg from 'imagemin-mozjpeg'
import webpackStream from 'webpack-stream'
import webpack2 from 'webpack'
import named from 'vinyl-named'
import log from 'fancy-log'
import colors from 'ansi-colors'
import zip from 'gulp-zip'
// import dartSass from  'sass';
// import gulpSass from  'gulp-sass';
// import gulpSass from  'gulp-dart-sass';
// import autoprefixer from 'gulp-autoprefixer'; // ベンダープレフィックス付与
import sourcemaps from 'gulp-sourcemaps' // ソースマップ出力
import date from 'date-and-time'
// import dateFormat from 'dateformat';

// const sass = gulpSass(dartSass)
// import packages from './package.json'

const sass = require('gulp-sass')(require('sass'))
// Load all Gulp plugins into one variable
// https://github.com/jackfranklin/gulp-load-plugins/releases v2.0.8
const $ = gulpLoadPlugins({
  config: process.env.npm_package_json,
})
// https://github.com/jackfranklin/gulp-load-plugins/issues/141

// Check for --production flag
const PRODUCTION = !!yargs.argv.production
// const PRODUCTION = argv.prod || argv.production
// Check for --development flag unminified with sourcemaps
const DEV = !!yargs.argv.dev
// const DEV = argv.prod || argv.dev
// Load settings from settings.yml
const {BROWSERSYNC, COMPATIBILITY, REVISIONING, PATHS} = loadConfig()

const imageminOption = [
  imageminPngquant([ 0.65, 0.8 ]),
//   imageminMozjpeg(({
//             progressive: true,
//           }),
  imagemin.gifsicle({
            interlaced: true,
          }),
//   imagemin.jpegtran(),
  imagemin.optipng({
            optimizationLevel: 5,
          }),
  imagemin.svgo({
            plugins: [{ cleanupAttrs: true }, { removeComments: true }],
          })
  ]
// Check if file exists synchronously
function checkFileExists(filepath) {
  let flag = true
  try {
    fs.accessSync(filepath, fs.F_OK)
  } catch (e) {
    flag = false
  }
  return flag
}

// Load default or custom YML config file
function loadConfig() {
  log('Loading config file...')

  if (checkFileExists('config.yml')) {
    // config.yml exists, load it
    log(
      colors.bold(colors.cyan('config.yml')),
      'exists, loading',
      colors.bold(colors.cyan('config.yml'))
    )
    const ymlFile = fs.readFileSync('config.yml', 'utf8')
    return yaml.load(ymlFile)
  } else if (checkFileExists('config-default.yml')) {
    // config-default.yml exists, load it
    log(
      colors.bold(colors.cyan('config.yml')),
      'does not exist, loading',
      colors.bold(colors.cyan('config-default.yml'))
    )
    const ymlFile = fs.readFileSync('config-default.yml', 'utf8')
    return yaml.load(ymlFile)
  }
  // Exit if config.yml & config-default.yml do not exist
  log('Exiting process, no config file exists.')
  // log( 'Error Code:', err.code )
  process.exit(1)
}

// Delete the "dist" folder
// This happens every time a build starts
// gulp.task('clean', function(done) {
//   rimraf('_build', done);
// });
function clean(done) {
  rimraf(PATHS.dist, done)
}
exports.clean = clean

// Copy files out of the assets folder
// This task skips over the "images", "js", and "scss" folders, which are parsed separately
function copy() {
  return gulp.src(PATHS.assets).pipe(gulp.dest(PATHS.dist + '/assets'))
}
exports.copy = copy

// Compile Sass into CSS
// In production, the CSS is compressed
function styles() {
  // const styles = () => {
  return (
    gulp
      .src([
        'src/assets/scss/app.scss',
        'src/assets/scss/editor.scss',
        'src/assets/scss/templates/front.scss',
        'src/assets/scss/templates/kitchen-sink.scss',
        'src/assets/scss/templates/style-both.scss',
        'src/assets/scss/templates/lp-custom.scss',
        'src/assets/scss/templates/lp-guten-both.scss',
        'src/assets/scss/templates/lp-guten-front.scss',
      ])
      .pipe($.sourcemaps.init())
      // .pipe(
      //   //エラーが出ても処理を止めない
      //   plumber({
      //     errorHandler: notify.onError('Error:<%= error.message %>'),
      //   })
      // )
      .pipe(
        sass({
          includePaths: PATHS.sass,
        }).on('error', sass.logError)
      )
      .pipe($.autoprefixer({}))

//       .pipe($.if(PRODUCTION, $.cleanCss({compatibility: 'ie11'})))
      .pipe($.if(!PRODUCTION, sourcemaps.write()))
//       .pipe($.if((REVISIONING && PRODUCTION) || (REVISIONING && DEV),$.rev()))
//        .pipe($.if((REVISIONING && PRODUCTION) || (REVISIONING && DEV)))
       .pipe(gulp.dest(PATHS.dist + '/assets/css'))
//       .pipe($.if((REVISIONING && PRODUCTION) || (REVISIONING && DEV),$.rev.manifest()))
//       .pipe($.if((REVISIONING && PRODUCTION) || (REVISIONING && DEV)))
//      .pipe(gulp.dest(PATHS.dist + '/assets/css'))
      .pipe(browser.reload({stream: true}))
  )
  // .pipe(
  //   notify({
  //     message: 'Sassをコンパイルしました！',
  //     onLast: true,
  //   })
  // )
}
exports.styles = styles

// Combine JavaScript into one file
// In production, the file is minified
const webpack = {
  config: {
    mode: 'development',
    module: {
      rules: [
        {
          test: /.js$/,
          loader: 'babel-loader',
          exclude: /node_modules(?![\\\/]foundation-sites)/,
        },
      ],
    },
     externals: {
      jquery: 'jQuery',
    },
  },

  changeHandler(err, stats) {
    log(
      '[webpack]',
      stats.toString({
        colors: true,
      })
    )

    browser.reload()
  },

  build() {
    return (
      gulp
        .src(PATHS.entries)
        .pipe(named())
        .pipe(webpackStream(webpack.config, webpack2))
//         .pipe
//         $.if(
//           PRODUCTION,
//         $.uglify().on( 'error', ( e ) => {
//           console.log( e )
//         } )
//         )
//      }
//         .pipe($.if((REVISIONING && PRODUCTION) || (REVISIONING && DEV), $.rev()))
//         .pipe($.if((REVISIONING && PRODUCTION) || (REVISIONING && DEV)))
        .pipe(gulp.dest(PATHS.dist + '/assets/js'))
//         .pipe($.if((REVISIONING && PRODUCTION) || (REVISIONING && DEV), $.rev.manifest()))
//         .pipe($.if((REVISIONING && PRODUCTION) || (REVISIONING && DEV)))
//       .pipe(gulp.dest(PATHS.dist + '/assets/js'))
    )
  },
  watch() {
    const watchConfig = Object.assign(webpack.config, {
      watch: true,
      devtool: 'inline-source-map',
    })

    return gulp
      .src(PATHS.entries)
      .pipe(named())
      .pipe(
        webpackStream(watchConfig, webpack2, webpack.changeHandler).on('error', (err) => {
          log(
            '[webpack:error]',
            err.toString({
              colors: true,
            })
          )
        })
      )
      .pipe(gulp.dest(PATHS.dist + '/assets/js'))
  },
}

gulp.task('webpack:build', webpack.build)
gulp.task('webpack:watch', webpack.watch)

// Copy images to the "dist" folder
// In production, the images are compressed
function images() {
  return gulp
// gulp.task('images', () => {
//   return gulp
//     .src('src/assets/images/**/*', {
//       since: lastRun(images),
//     })
     .src('src/assets/images/**/*')
   .pipe(
      $.if(
        PRODUCTION,
        $.imagemin(imageminOption)
//         $.imagemin([
//           $.imagemin.mozjpeg({
//             progressive: true,
//           }),
//           $.imagemin.optipng({
//             progressive: true,
//           }),
//           $.imagemin.gifsicle({
//             interlaced: true,
//           }),
//           $.imagemin.svgo({
//             plugins: [{cleanupAttrs: true}, {removeComments: true}],
//           }),
//         ])
      )
    )
    .pipe(gulp.dest(PATHS.dist + '/assets/images'))
}
exports.images = images

// Create a .zip archive of the theme
// https://stackoverflow.com/questions/57979847/gulp4-migration-invalid-glob-argument
function archive() {
  const now = new Date()
  const time = date.format(now, 'YYYY-MM-DD_HH:mm:ss')
  const pkg = JSON.parse(fs.readFileSync('./package.json'))
  const title = pkg.name + '_' + time + '.zip'

  return gulp.src(PATHS.package, {allowEmpty: false}).pipe($.zip(title)).pipe(gulp.dest('packaged'))
}
// PHP Code Sniffer task
// function phpcs() {
gulp.task('phpcs', function () {
  return (
    gulp
      .src(PATHS.phpcs)
      // .src(PATHS.phpcs)
      .pipe(
        phpCs({
          // bin: '~/.composer/vendor/bin/phpcs',
          bin: 'vendor/bin/phpcs',
          // standard: 'WordPress',
          standard: './phpcs.xml',
          showSniffCode: true,
        })
      )
      .pipe(phpCs.reporter('log'))
  )
})
// PHP Code Beautifier task
// function phpcbf() {
gulp.task('phpcbf', function () {
  return (
    gulp
      .src(PATHS.phpcs)
      .pipe(
        phpCbf({
          // bin: '~/.composer/vendor/bin/phpcbf',
          bin: 'vendor/bin/phpcs',
          standard: './phpcs.xml',
          warningSeverity: 0,
          showSniffCode: true,
        })
      )
      // .on('error', gutil.log)
      .on('error', log)
      .pipe(gulp.dest('.'))
  )
})

// Start BrowserSync to preview the site in
function server(done) {
  browser.init({
    proxy: BROWSERSYNC.url,

    ui: {
      port: 8080,
    },
  })
  done();
}

// Reload the browser with BrowserSync
function reload(done) {
  browser.reload()
  done();
}

// Watch for changes to static assets, pages, Sass, and JavaScript
function watchAll() {
  gulp.watch(PATHS.assets, copy);
  gulp
    .watch('src/assets/scss/**/*.scss', styles)
    .on('change', (path) => log('File ' + colors.bold(colors.magenta(path)) + ' changed.'))
    .on('unlink', (path) => log('File ' + colors.bold(colors.magenta(path)) + ' was removed.'))
  gulp
    .watch('**/*.php', reload)
    .on('change', (path) => log('File ' + colors.bold(colors.magenta(path)) + ' changed.'))
    .on('unlink', (path) => log('File ' + colors.bold(colors.magenta(path)) + ' was removed.'))
  gulp.watch('src/assets/images/**/*', gulp.series(browser.reload))
  gulp.watch('src/assets/images/**/*.svg', gulp.series(copy, browser.reload));
}

// Build the "dist" folder by running all of the below tasks
gulp.task('build', gulp.series(clean, gulp.parallel(styles,'webpack:build', images, copy)));

exports.default = gulp.series('build', server, gulp.parallel('webpack:watch', watchAll));

// Package task
gulp.task('package', gulp.series('build', archive));
