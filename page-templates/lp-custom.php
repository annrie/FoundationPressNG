<?php
/*
Template Name: LP CUSTOM
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage FoundationPressNG
 * @since FoundationPressNG 1.0
*/

get_header(); ?>

<?php do_action( 'foundationpress_before_content' ); ?>

		<main class="main-content-full-width mymain" tabindex="-1">
    <header role="banner">
        <section class="myhero" style="background-image:
                                        linear-gradient(
                                            rgba(0,0,0,0.3),
                                            rgba(0,0,0,0.3)
                                            ),
                                        url( <?php echo get_field('hero_img')['url']; ?> );">
                <h1 class="cell"><?php the_field( 'hero_main' ); ?></h1>
                <p class="cell"><?php the_field( 'hero_sub' ); ?></p>
                <p><a class="button warning" href="#"><?php the_field( 'hero_button' ); ?></a></p>
        </section>
    </header>
    <section class="mycon">
            <h2 class="cell sec-title">CONCEPTS</h2>
            <p class="cell">すべてが揃う。そんな場所を目指しています。</p>

        <div class="grid-x grid-padding-x small-up-1 medium-up-2 tablet-up-4 text-center">
            <div class="cell">
                <img src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/lp-custom/con1.png" alt="">
                <h3>かんたん設定</h3>
                <p>面倒な受付手続きはスキップ。オンラインで簡単スピーディに設定できます。</p>
            </div>

            <div class="cell">
                <img src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/lp-custom/con2.png" alt="">
                <h3>全天候型</h3>
                <p>天気に左右されない全天候型の施設を完備。明日の天気の心配はありません。</p>
            </div>

            <div class="cell">
                <img src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/lp-custom/con3.png" alt="">
                <h3>飲食フリー</h3>
                <p>あちこちに飲食スペースが設けてあって一息つけます。持ち込みフードもOKです。</p>
            </div>

            <div class="cell">
                <img src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/lp-custom/con4.png" alt="">
                <h3>いつでも睡眠</h3>
                <p>滞在型だからこそできるのが、いつでもベッドルームに戻って寝ることです。</p>
            </div>
        </div>
    </section>

<section class="mypoint1">
    <div class="grid-x text-center">
        <p class="cell">集中的に仕事を進めることができる、<br>
        そんな環境が整っています。</p>
    </div>
</section>

<section class="mynews">
	<h2 class="cell sec-title">LATEST NEWS</h2>
	<p class="cell">最新情報です</p>
    <div class="grid-x grid-padding-x small-up-1 medium-up-2 tablet-up-3">

    <?php
    $myposts = get_posts(
    array(
		'post_type'      => 'post',
		'posts_per_page' => '6',
    )
    );
    ?>
    <?php
    if ( $myposts ) :
    foreach ( $myposts as $post ) :
    setup_postdata( $post );
    ?>

	<article <?php post_class('cell'); ?>>
	<a href="<?php the_permalink(); ?>">

    <?php
    if ( has_post_thumbnail() ) :
    ?>
	<figure>
<?php
    the_post_thumbnail(
    'small',
        array(
            'class' => 'thumbnail',
            'alt'   => the_title_attribute( 'echo=0' ),
            'title' => the_title_attribute( 'echo=0' ),
        )
    );
?>
	</figure>
	<?php endif; ?>

	<h3><?php the_title(); ?></h3>

	</a>
	</article>

    <?php
    endforeach;
	wp_reset_postdata();
    endif;
    ?>
    </div>
</section>

<section class="mypoint2" style="background-color: <?php echo the_field('point2_bkcolor'); ?>;">
    <div class="grid-x grid-padding-x">
        <div class="cell small-12 medium-7">
            <figure>
                <?php echo wp_get_attachment_image( get_field('point2_img')['ID'], 'full'); ?>
            </figure>
        </div>
        <div class="cell small-12 medium-5 align-self-middle">
            <p><?php the_field('point2_big'); ?></p>
            <p><?php the_field('point2_small'); ?></p>
        </div>
    </div>
</section>

<section class="mytest">
	<h2 class="cell sec-title">TESTIMONIALS</h2>
	<p class="cell">たくさんの方にご利用いただいています</p>

    <div class="grid-x grid-margin-x">
        <div class="mytest1 cell small-12 medium-6">
            <div class="grid-x grid-margin-x">
                <div class="cell small-3 medium-5 align-self-middle">
                    <figure>
                        <img src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/lp-custom/test1.jpg" alt="">
                    </figure>
                </div>
                <div class="cell small-9 medium-7 align-self-middle">
                    <p>その日の気分に合わせてワークスペースを選ぶことができたのでとても便利でした。</p>
                    <p><strong>TANAKA HANAKO</strong>
                    <br>Designer</p>
                </div>
            </div>
        </div>

        <div class="mytest2 cell small-12 medium-6">
            <div class="grid-x grid-margin-x">
                    <div class="cell small-3 medium-5 align-self-middle">
                        <figure>
                            <img src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/lp-custom/test2.jpg" alt="">
                        </figure>
                    </div>
                    <div class="cell small-9 medium-7 align-self-middle">
                            <p>わからないことがあっても、テクニカルアドバイザーに質問できるので安心です。</p>
                            <p><strong>SUZUKI TARO</strong>
                            <br>Front-end Engineer</p>
                    </div>
            </div>
        </div>
    </div>
</section>

<section class="myaction" style="background-image:
                                        linear-gradient(
                                            rgba(018, 101, 156, 0.7),
                                            rgba(18, 101, 156, 0.7)
                                            ),
                                        url( <?php echo get_field('action_img')['url']; ?> );">

                <p class="cell"><?php the_field( 'action_main' ); ?></p>
                <p class="cell"><?php the_field( 'action_sub' ); ?></p>
                <p><a class="button warning" href="#"><?php the_field( 'action_button' ); ?></a></p>
	<!-- <p class="cell">日常のその先へ</p>
	<p class="cell">いつでも、お越しをお待ちしております。</p>
	<a href="#">ワークスペースを申し込む</a> -->
</section>


    </main>
    <!-- </div>
</div> -->
<?php do_action( 'foundationpress_after_content' ); ?>
		<?php get_template_part( 'back_to_top' ); ?>
<?php
get_footer();
