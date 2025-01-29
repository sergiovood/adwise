<?php
/**
 * Hero Section Block Template.
 */

// Utworzenie zmiennych z ACF
$heading = get_field('heading');
$subheading = get_field('subheading');
$cta_text = get_field('cta_text');
$cta_link = get_field('cta_link');
?>

<section class="hero-section">
    <div class="container">
        <h1 class="hero-heading"><?php echo esc_html($heading); ?></h1>
        <p class="hero-subheading"><?php echo esc_html($subheading); ?></p>
        <?php if ($cta_link && $cta_text) : ?>
            <a href="<?php echo esc_url($cta_link); ?>" class="hero-cta">
                <?php echo esc_html($cta_text); ?>
            </a>
        <?php endif; ?>
    </div>
</section>