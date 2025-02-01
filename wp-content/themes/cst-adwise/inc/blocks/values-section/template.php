<?php
$pattern_image = get_field('pattern_image');
$values_list = get_field('values_list');
?>

<section class="values-section">
    <div class="container">
        <div class="values-section__content">
            <div class="values-section__image">
                <?php if ($pattern_image) : ?>
                    <img src="<?php echo esc_url($pattern_image); ?>" alt="Values pattern" class="values-pattern">
                <?php endif; ?>
            </div>
            <div class="values-section__list">
                <?php
                if ($values_list) :
                    foreach ($values_list as $value) :
                ?>
                    <div class="value-item">
                        <span class="value-item__number"><?php echo esc_html($value['number']); ?></span>
                        <h3 class="value-item__title"><?php echo esc_html($value['title']); ?></h3>
                        <p class="value-item__description"><?php echo esc_html($value['description']); ?></p>
                    </div>
                <?php
                    endforeach;
                endif;
                ?>
            </div>
        </div>
    </div>
</section>