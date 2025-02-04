<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CustomThemeAdwise
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php 
$background_video = get_field('background_video', 'option');
if ($background_video): ?>
    <div class="background-video-wrapper">
        <video class="background-video" playsinline autoplay muted loop>
            <source src="<?php echo esc_url($background_video); ?>" type="video/webm">
        </video>
    </div>
<?php endif; ?>
<div id="page" class="site">
    <header class="site-header">
        <div class="header-content">
            <a href="<?php echo home_url(); ?>" class="logo">
                <?php
                $custom_logo_id = get_theme_mod('custom_logo');
                $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                if ($logo) :
                ?>
                    <img src="<?php echo esc_url($logo[0]); ?>" alt="<?php echo get_bloginfo('name'); ?>" class="logo-img">
                <?php endif; ?>
            </a>

            <nav id="site-navigation" class="main-navigation">
                <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    <svg width="32" height="25" viewBox="0 0 32 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <line y1="0.5" x2="32" y2="0.5" stroke="white"/>
                        <line y1="12.5" x2="32" y2="12.5" stroke="white"/>
                        <line y1="24.5" x2="32" y2="24.5" stroke="white"/>
                    </svg>
                    <span class="screen-reader-text"><?php esc_html_e('Menu', 'cst-adwise'); ?></span>
                </button>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'menu-1',
                    'menu_id'        => 'primary-menu',
                    'fallback_cb'    => false,
                ));
                ?>
             </nav>

            <div class="header-buttons">
				<a href="<?php echo esc_url(get_theme_mod('header_community_link', '#')); ?>" class="header-link">
					<?php echo esc_html(get_theme_mod('header_community_text', 'Dołącz do społeczności')); ?>
				</a>
				<a href="<?php echo esc_url(get_theme_mod('header_apply_link', '#')); ?>" class="header-button">
					<?php echo esc_html(get_theme_mod('header_apply_text', 'Aplikuj')); ?>
				</a>
			</div>
		</div>
    </header><!-- #masthead -->
