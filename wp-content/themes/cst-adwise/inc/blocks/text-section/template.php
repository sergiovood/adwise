<?php
/**
 * Text Section Block Template.
 */

$text_before = get_field('text_before');
$highlighted_text = get_field('highlighted_text');
$text_after = get_field('text_after');
?>

<section class="text-section">
    <div class="container">
        <h2 class="text-section__content">
            <?php if ($text_before) : ?>
                <span class="text-section__text"><?php echo esc_html($text_before); ?></span>
            <?php endif; ?>
            
            <?php if ($highlighted_text) : ?>
                <span class="text-section__highlighted"><?php echo esc_html($highlighted_text); ?></span>
            <?php endif; ?>
            
            <?php if ($text_after) : ?>
                <span class="text-section__text"><?php echo esc_html($text_after); ?></span>
            <?php endif; ?>
        </h2>
    </div>
</section>