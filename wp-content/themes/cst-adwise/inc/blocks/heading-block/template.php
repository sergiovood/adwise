<?php
/**
 * Heading Block Template.
 */

$opening_text = get_field('opening_text');
$highlight_text = get_field('highlight_text');
$closing_text = get_field('closing_text');
?>

<section class="heading-block">
    <div class="container">
        <h2 class="heading-block__content">
            <?php if ($opening_text) : ?>
                <span class="heading-block__text"><?php echo esc_html($opening_text); ?></span>
            <?php endif; ?>
            
            <?php if ($highlight_text) : ?>
                <span class="heading-block__highlight"><?php echo esc_html($highlight_text); ?></span>
            <?php endif; ?>
            
            <?php if ($closing_text) : ?>
                <span class="heading-block__text"><?php echo esc_html($closing_text); ?></span>
            <?php endif; ?>
        </h2>
    </div>
</section>