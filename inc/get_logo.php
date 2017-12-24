<?php 

function tg_get_logo(){
    $logo = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ) , 'full' );
	return $logo;
}