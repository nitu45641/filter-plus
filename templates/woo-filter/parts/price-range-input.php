<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<div class="price-range-input price-input-<?php echo esc_attr($template);?>">
    <div class="price-input-wrapper">
        <div class="field field-min">
            <label for="price-min-<?php echo esc_attr($template);?>" class="field-label">
                <?php esc_html_e('Min','filter-plus-pro');?>
            </label>
            <div class="input-container">
                <span class="currency-symbol"><?php echo get_woocommerce_currency_symbol(); ?></span>
                <input
                    type="number"
                    id="price-min-<?php echo esc_attr($template);?>"
                    class="input-min price-input"
                    value="<?php echo absint($min)?>"
                    min="1"
                    max="<?php echo absint($max)?>"
                    step="1"
                    placeholder="<?php echo absint($min)?>"
                    aria-label="<?php esc_attr_e('Minimum price','filter-plus-pro');?>"
                >
            </div>
            <span class="input-error" id="min-error-<?php echo esc_attr($template);?>"></span>
        </div>

        <div class="separator-wrapper">
            <span class="separator" aria-hidden="true">-</span>
        </div>

        <div class="field field-max">
            <label for="price-max-<?php echo esc_attr($template);?>" class="field-label">
                <?php esc_html_e('Max','filter-plus-pro');?>
            </label>
            <div class="input-container">
                <span class="currency-symbol"><?php echo get_woocommerce_currency_symbol(); ?></span>
                <input
                    type="number"
                    id="price-max-<?php echo esc_attr($template);?>"
                    class="input-max price-input"
                    value="<?php echo absint($max)?>"
                    min="<?php echo absint($min)?>"
                    step="1"
                    placeholder="<?php echo absint($max)?>"
                    aria-label="<?php esc_attr_e('Maximum price','filter-plus-pro');?>"
                >
            </div>
            <span class="input-error" id="max-error-<?php echo esc_attr($template);?>"></span>
        </div>
    </div>

</div>