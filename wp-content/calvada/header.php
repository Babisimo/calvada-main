<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'twentyseventeen' ); ?></a>

	<?php include get_stylesheet_directory().'/includes/custom-header.php'; ?>
	
	<header style="display:none;">
        <div class="row container">
      <div class="three columns middleVert"><a href="https://www.calvada.com/"><img src="https://www.calvada.com/images/logos/logo.png" alt="Logo of Calvada" class="logo"></a></div>
      <div class="nine columns middleVert">
        
  <div class="navContainer">
<nav>
<input type="checkbox" id="show-menu" role="button">
  <label for="show-menu" class="show-menu"></label>
    <ul id="menu" class="navigation">
      <li><a href="https://www.calvada.com/about.html" id="firstLink" >About</a> <ul class="hidden">
         <li><a href="https://www.calvada.com/our-team.html">Our Team</a></li>
		  </ul></li>
     
      <li><a href="https://www.calvada.com/services.html">Services</a></li>
		<li><a href="https://www.calvada.com/locations.html">Locations</a></li>
    <li><a href="https://www.calvada.com/careers.html" >Careers</a></li>
		<li><a href="https://www.calvada.com/contact.html" id="lastLink">Contact</a></li>
    <!--<li><a href="#" id="lastLink">Gallery</a></li>-->
  </ul>
  </nav>
  </div>
  </header>
<div class="supportHeader"><img src="https://www.calvada.com/images/header-support.jpg"></div>
	<?php

	/*
	 * If a regular post or page, and not the front page, show the featured image.
	 * Using get_queried_object_id() here since the $post global may not be set before a call to the_post().
	 */
	if ( ( is_single() || ( is_page() && ! twentyseventeen_is_frontpage() ) ) && has_post_thumbnail( get_queried_object_id() ) ) :
		echo '<div class="single-featured-image-header">';
		echo get_the_post_thumbnail( get_queried_object_id(), 'twentyseventeen-featured-image' );
		echo '</div><!-- .single-featured-image-header -->';
	endif;
	?>

	<div class="site-content-contain">
		<div id="content" class="site-content">
