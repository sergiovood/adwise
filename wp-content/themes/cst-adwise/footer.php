<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CustomThemeAdwise
 */

?>

<footer class="site-footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-logo">
                <?php 
                $custom_logo_id = get_theme_mod('custom_logo');
                $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                if ($logo) : 
                ?>
                    <img src="<?php echo esc_url($logo[0]); ?>" alt="<?php echo get_bloginfo('name'); ?>" class="footer-logo-img">
                <?php endif; ?>
            </div>
            <nav class="footer-navigation">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer-menu',
                    'menu_class'     => 'footer-menu',
                    'container'      => false,
                ));
                ?>
            </nav>
            <div class="footer-policy">
                <a href="/polityka-prywatnosci" class="footer-policy-link">Polityka prywatności</a>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
