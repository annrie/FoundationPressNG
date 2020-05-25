<?php
/**
 * Uses WP image & file attachments to quickly output the correct code
 * 11/16/2018
 * @author Jonathan Brockett
 *
 * Requires: WordPress @link https://codex.wordpress.org/
 */

/**
 * Check if a WP attachment MIME type is image/svg+xml
* @return boolean
 */
function is_svg($attachment_id) {
 $mime_type = get_post_mime_type($attachment_id);

 if($mime_type == 'image/svg+xml') {
   return true;
 } else {
   return false;
 }
}

/**
 * Get the SVG as code
 * @return string the raw SVG code
 */
function get_svg($attachment_id,$size = 'thumbnail', $icon = false) {
  $attachment_url = get_the_image_url($attachment_id,$size,$icon);
  // Get relative URL so the server finds it by file path instead of URL path
  // Really helpful when moving a site and editing your HOSTS file
  $path_to_file = substr(ABSPATH, 0, -1) . wp_make_link_relative( $attachment_url );
  return file_get_contents($path_to_file);
}

/**
 * Output SVG as code
 * @return string the raw SVG code
 */
function the_svg($attachment_id) {
  echo get_svg($attachment_id);
}

/**
 * Get the image attachment or SVG as code
 * @return string the image or raw SVG code
 */
function get_the_image($attachment_id,$size = 'thumbnail', $icon = false, $attr = '') {
  if(is_svg($attachment_id)) {
    $svg = get_svg($attachment_id);
    //$svg_tag_str = get_data_between($svg, '<svg', '>');
    preg_match('/<svg(.*?)>/',$svg,$svg_tag);
    $svg_tag_str = $svg_tag[0];
    $svg_tag_sized = $svg_tag_str;

    // Use WP media manager 'alt' for '<title>'
    $svg_alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
    if(strpos($svg, '<title>') !== false) {
      // Replace with WP alt
      $svg = preg_replace('/<title>(.*?)<\/title>/', '<title>' . $svg_alt . '</title>', $svg);
    } else {
      // Add title with WP alt after <svg> tag
      $svg = str_replace($svg_tag_str, $svg_tag_str . '<title>' . $svg_alt . '</title>', $svg);
    }

    // Add role="img"
    if(strpos($svg_tag_sized, 'role="img"') !== false) {
      // Already formatted correctly
    } else {
      if(strpos($svg_tag_sized, 'role=') !== false) {
        // Has role= but not 'img'
        $svg_tag_sized = preg_replace('/role="(.*?)"/', 'role="img"', $svg_tag_sized);
      } else {
        // Add role="img"
        $svg_tag_sized = str_replace('<svg', '<svg role="img"', $svg_tag_sized);
      }
    }

    // Get dimensions from viewBox
    preg_match('/viewBox="(.*?)"/', $svg_tag_sized, $viewbox);
    $viewbox_values = explode(" ", $viewbox[1]);
    $old_width = $viewbox_values[2];
    $old_height = $viewbox_values[3];

    // Control image dimensions
    if(is_array($size)) {

      // Width not height
      if ($size[0] != '' && $size[1] == '') {
        $size = generate_ratio(array($size[0],''),array($old_width,$old_height));
      }

      // Height not width
      if ($size[1] != '' && $size[0] == '') {
        $size = generate_ratio(array('',$size[1]),array($old_width,$old_height));
      }

      // Add custom dimensions
      if (strpos($svg_tag_sized, 'height=') !== false) {
        $svg_tag_sized = preg_replace('/height="(.*?)"/', 'height="' . $size[1] . '"', $svg_tag_sized);
      } else {
        $svg_tag_sized = str_replace('<svg', '<svg height="' . $size[1] . '"', $svg_tag_sized);
      }

      if (strpos($svg_tag_sized, 'width=') !== false) {
        $svg_tag_sized = preg_replace('/width="(.*?)"/', 'width="' . $size[0] . '"', $svg_tag_sized);
      } else {
        $svg_tag_sized = str_replace('<svg', '<svg width="' . $size[0] . '"', $svg_tag_sized);
      }

    } else {  // Add named image sizes

      // Named image size dimensions
      $new_width = get_the_image_width($size);
      $calc_height = generate_ratio(array($new_width,''),array($old_width,$old_height));
      $new_height = $calc_height[1];

      // Add custom dimensions
      if (strpos($svg_tag_sized, 'height=') !== false) {
        $svg_tag_sized = preg_replace('/height="(.*?)"/', 'height="' . $new_height . '"', $svg_tag_sized);
      } else {
        $svg_tag_sized = str_replace('<svg', '<svg height="' . $new_height . '"', $svg_tag_sized);
      }

      if (strpos($svg_tag_sized, 'width=') !== false) {
        $svg_tag_sized = preg_replace('/width="(.*?)"/', 'width="' . $new_width . '"', $svg_tag_sized);
      } else {
        $svg_tag_sized = str_replace('<svg', '<svg width="' . $new_width . '"', $svg_tag_sized);
      }

    }

    // Add back <svg> tag
    $svg = str_replace($svg_tag_str, $svg_tag_sized, $svg);

    /* Remove <?xml version="1.0" encoding="UTF-8"?> */
    if(strpos($svg, '<?xml') === false) {
      // Already formatted correctly
    } else {
      // Remove string
      $svg = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $svg);
    }

    return $svg;

  } else {
    return wp_get_attachment_image($attachment_id,$size,$icon,$attr);
  }
}

/**
 * Output the image attachment or SVG as code
 * @return string out image attachment or raw SVG as code
 */
function the_image($attachment_id,$size = 'thumbnail', $icon = false, $attr = '') {
  echo get_the_image($attachment_id,$size,$icon,$attr);
}

/**
 * Get the image url
 * @return string the image url
 */
function get_the_image_url($attachment_id,$size = 'thumbnail', $icon = false) {
  return wp_get_attachment_image_url($attachment_id,$size,$icon);
}

/**
 * Output the image url
 * @return string output the image url
 */
function the_image_url($attachment_id) {
  echo get_the_image_url($attachment_id);
}

/**
 * Get the file url
 * @return string the image url
 */
function get_the_file_url($attachment_id) {
  return wp_get_attachment_url($attachment_id);
}

/**
 * Output the file url
 * @return string output the image url
 */
function the_file_url($attachment_id) {
  echo get_the_file_url($attachment_id);
}

/**
 * Generate custom dimensions
 */
function generate_ratio($new_size = array(), $old_size = array()) {

  $new_width = $new_size[0];
  $new_height = $new_size[1];
  $old_width = $old_size[0];
  $old_height = $old_size[1];

  // Both declared
  if(isset($new_width) && $new_width != '' && isset($new_height) && $new_height != '') {
    // Do nothing, values already set
  }

  // Height declared
  elseif (isset($new_height) && $new_height != '' && $new_width == '' || !isset($new_width)) {
    if($old_height == $old_width) {
      $new_width = $new_height;
    }
    elseif($old_width > $old_height) {
      $new_width = ($old_width / $old_height) * $new_height;
    }
    elseif($old_height > $old_width) {
      $new_width = ($old_width / $old_height) * $new_height;
    }
  }

  // Width declared
  elseif (isset($new_width) && $new_width != '' && $new_height == '' || !isset($new_height)) {
    if($old_height == $old_width) {
      $new_height = $new_width;
    }
    elseif($old_width > $old_height) {
      $new_height = ($old_height / $old_width) * $new_width;
    }
    elseif($old_height > $old_width) {
      $new_height = ($old_height / $old_width) * $new_width;
    }
  }

  else {
    // None declared
  }

  return array($new_width,$new_height);
}

/**
 * Get size information for all currently-registered image sizes.
 *
 * @global $_wp_additional_image_sizes
 * @uses   get_intermediate_image_sizes()
 * @return array $sizes Data for all currently-registered image sizes.
 */
function get_the_image_sizes() {
	global $_wp_additional_image_sizes;

	$sizes = array();

	foreach ( get_intermediate_image_sizes() as $_size ) {
		if ( in_array( $_size, array('thumbnail', 'medium', 'medium_large', 'large') ) ) {
			$sizes[ $_size ]['width']  = get_option( "{$_size}_size_w" );
			$sizes[ $_size ]['height'] = get_option( "{$_size}_size_h" );
			$sizes[ $_size ]['crop']   = (bool) get_option( "{$_size}_crop" );
		} elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
			$sizes[ $_size ] = array(
				'width'  => $_wp_additional_image_sizes[ $_size ]['width'],
				'height' => $_wp_additional_image_sizes[ $_size ]['height'],
				'crop'   => $_wp_additional_image_sizes[ $_size ]['crop'],
			);
		}
	}

	return $sizes;
}

/**
 * Get size information for a specific image size.
 *
 * @uses   get_the_image_sizes()
 * @param  string $size The image size for which to retrieve data.
 * @return bool|array $size Size data about an image size or false if the size doesn't exist.
 */
function get_the_image_size( $size ) {
	$sizes = get_the_image_sizes();

	if ( isset( $sizes[ $size ] ) ) {
		return $sizes[ $size ];
	}

	return false;
}

/**
 * Get the width of a specific image size.
 *
 * @uses   get_the_image_size()
 * @param  string $size The image size for which to retrieve data.
 * @return bool|string $size Width of an image size or false if the size doesn't exist.
 */
function get_the_image_width( $size ) {
	if ( ! $size = get_the_image_size( $size ) ) {
		return false;
	}

	if ( isset( $size['width'] ) ) {
		return $size['width'];
	}

	return false;
}

/**
 * Get the height of a specific image size.
 *
 * @uses   get_the_image_size()
 * @param  string $size The image size for which to retrieve data.
 * @return bool|string $size Height of an image size or false if the size doesn't exist.
 */
function get_the_image_height( $size ) {
	if ( ! $size = get_the_image_size( $size ) ) {
		return false;
	}

	if ( isset( $size['height'] ) ) {
		return $size['height'];
	}

	return false;
}

/**
 * Get the image as a background
 * This will return svgs formatted as CSS and anything else as a URL
 */
 function get_the_image_bg($attachment_id,$size = 'thumbnail', $icon = false, $attr = '') {
   if(is_svg($attachment_id)) {
    $svg = get_the_image($attachment_id,$size, $icon, $attr);
    // Used individual str_replace instead of url_encode to minimize character length
    // Browsers tolerate some characters used as URL string
    //$svg = str_replace('%','%25',$svg);
    //$svg = str_replace('&','%26',$svg);
    //$svg = str_replace('"','%27',$svg);
    //$svg = str_replace("'",'%27',$svg);
    //$svg = str_replace('<','%3C',$svg);
    //$svg = str_replace('>','%3E',$svg);
    //$svg = str_replace('#','%23',$svg);

    // Add preserve aspect ratio to svg
    preg_match('/<svg(.*?)>/',$svg,$svg_tag);
    $svg_tag_str = $svg_tag[0];
    $svg_tag_sized = $svg_tag_str;

    // Add preserveAspectRatio="xMidYMid meet"
    if(strpos($svg_tag_sized, 'preserveAspectRatio="xMidYMid meet"') !== false) {
      // Already formatted correctly
    } else {
      if(strpos($svg_tag_sized, 'preserveAspectRatio=') !== false) {
        // Has preserveAspectRatio= but not 'xMidYMid meet'
        $svg_tag_sized = preg_replace('/preserveAspectRatio="(.*?)"/', 'preserveAspectRatio="xMidYMid meet"', $svg_tag_sized);
      } else {
        // Add preserveAspectRatio="xMidYMid meet"
        $svg_tag_sized = str_replace('<svg', '<svg preserveAspectRatio="xMidYMid meet"', $svg_tag_sized);
      }
    }

    // Change width to 100%
    if(strpos($svg_tag_sized, 'width="100%"') !== false) {
      // Already formatted correctly
    } else {
      if(strpos($svg_tag_sized, 'width=') !== false) {
        // Has width= but not '100%'
        $svg_tag_sized = preg_replace('/width="(.*?)"/', 'width="100%"', $svg_tag_sized);
      } else {
        // Add width="100%"
        $svg_tag_sized = str_replace('<svg', '<svg width="100%"', $svg_tag_sized);
      }
    }

    // Change height to 100%
    if(strpos($svg_tag_sized, 'height="100%"') !== false) {
      // Already formatted correctly
    } else {
      if(strpos($svg_tag_sized, 'height=') !== false) {
        // Has height= but not '100%'
        $svg_tag_sized = preg_replace('/height="(.*?)"/', 'height="100%"', $svg_tag_sized);
      } else {
        // Add height="100%"
        $svg_tag_sized = str_replace('<svg', '<svg height="100%"', $svg_tag_sized);
      }
    }

    // Replace with new svg
    $svg = str_replace($svg_tag_str, $svg_tag_sized, $svg);

    // Convert to base64
    $svg = base64_encode($svg);
    $svg = "data:image/svg+xml;base64," . $svg;
    return $svg;

   } else {
     return wp_get_attachment_image_url($attachment_id,$size, $icon, $attr);
   }
 }

/**
 * Output the image as a background
 * @return string SVGs converted to inline CSS everything else output URL
 */
function the_image_bg($attachment_id,$size = 'thumbnail', $icon = false, $attr = '') {
  echo get_the_image_bg($attachment_id,$size, $icon, $attr);
}


/**
 * Get the thumbnail as a background
 * This will return svgs formatted as CSS and anything else as a URL
 */
function get_the_thumbnail_bg($post = null, $size = 'post-thumbnail') {
  $post_thumbnail_id = get_post_thumbnail_id( $post );
  if ( ! $post_thumbnail_id ) {
    return false;
  } else {
    if(is_svg( $post_thumbnail_id )) {
      $url = get_the_image_bg( $post_thumbnail_id , $size);
    } else {
      $url = get_the_post_thumbnail_url( $post , $size );
    }

    return $url;
  }

}

/**
 * Output the thumbnail as a background
 * @return string SVGs converted to inline CSS everything else output URL
 */
function the_thumbnail_bg($size = 'post-thumbnail') {
  $url = get_the_thumbnail_bg( null , $size );
  if ( $url ) {
    echo esc_url( $url );
  }
}
