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

	<header>
        <div class="row container">
      <div class="three columns middleVert"><a href="https://www.calvada.com/"><img src="https://www.calvada.com/images/logo.png" alt="Logo of Calvada" class="logo"></a></div>
      <div class="nine columns middleVert">
        <p class="contactInfo"><span class="contactNumber"><a href="tel:800-225-8232">(800) Calvada</a></span><br/>
          225-8232
          </p>
  <div class="navContainer">
<nav>
<input type="checkbox" id="show-menu" role="button">
  <label for="show-menu" class="show-menu"></label>
    <ul id="menu" class="navigation">
      <li><a href="#" id="firstLink" >About</a> <ul class="hidden">
          <li><a href="https://www.calvada.com/about.html">About Calvada</a></li>
		  <li><a href="https://www.calvada.com/our-team.html">Our Team</a></li>
		  <li><a href="https://www.calvada.com/events.html">Events</a></li>
		  </ul></li>
      <li><a href="#" onclick="return false">Services</a>
        <ul class="hidden">
			<li><a href="https://www.calvada.com/land-surveying-services.html">Land Surveying Services</a></li>
			<li><a href="https://www.calvada.com/land-title-surveys.html">ALTA/NSPS Land Title Surveys</a></li>
			<li><a href="https://www.calvada.com/topographic-survey.html">Topographic Surveys</a></li>
			<li><a href="https://www.calvada.com/boundary-surveys.html">Boundary Surveys</a></li>
			<li><a href="https://www.calvada.com/mapping.html">Mapping</a></li>
			<li><a href="https://www.calvada.com/telecommunication-surveys.html">Telecommunication Surveys</a></li>
			<li><a href="https://www.calvada.com/environmental-land-surveys.html">Environmental Surveys</a></li>
			<li><a href="https://www.calvada.com/high-definition-survey.html">LiDAR Mapping/High Definition Survey</a></li>
        </ul></li>
      <li><a href="https://www.calvada.com/testimonials.html">Testimonials</a></li>
    <li><a href="/" onclick="return false">Locations</a>
      <ul class="hidden">
          <li><a href="https://www.calvada.com/las-vegas-land-surveyor.html">Las Vegas</a></li>
<li><a href="https://www.calvada.com/sacramento-land-surveyor.html">Sacramento</a></li>
<li><a href="https://www.calvada.com/san-diego-land-surveyor.html">San Diego</a></li>
<li><a href="https://www.calvada.com/san-francisco-land-surveyor.html">San Francisco</a></li>
<li><a href="https://www.calvada.com/los-angeles-land-surveyor.html">Los Angeles</a></li>
<li><a href="https://www.calvada.com/california-surveyor.html">California</a></li>
<li><a href="https://www.calvada.com/colorado-land-surveyor.html">Colorado</a></li>
<li><a href="https://www.calvada.com/washington-surveyor.html">Washington</a></li>
<li><a href="https://www.calvada.com/arizona-land-surveyor.html">Arizona</a></li>
<li><a href="https://www.calvada.com/nevada-surveyor.html">Nevada</a></li>
<li><a href="https://www.calvada.com/oregon-land-surveyors.html">Oregon</a></li>
</ul>
    </li>
    <li><a href="https://www.calvada.com/land-surveying/">News</a></li>
    <li><a href="https://www.calvada.com/contact.html">Contact</a></li>
    <li><a href="https://www.calvada.com/careers.html" id="lastLink">Careers</a></li>
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
