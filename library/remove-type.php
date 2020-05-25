<?php
/**
 * Remove type= from <script> and <style>
 */

add_action( 'template_redirect', function(){
    ob_start( function( $tag ){
        $tag = str_replace( array( 'type="text/javascript"', "type='text/javascript'" ), '', $tag );

        return preg_replace("/type=['\"]text\/(javascript|css)['\"]/", '', $tag);
    });
});
