<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<div class="price-range-input price-input-<?php echo esc_attr($template);?>">
    <div class="price-input-wrapper">
        <div class="field field-min">
            <label for="price-min-<?php echo esc_attr($template);?>" class="field-label">
                <?php esc_html_e('Min','filter-plus');?>
            </label>
            <div class="input-container">
                <span class="currency-symbol"><?php echo get_woocommerce_currency_symbol(); ?></span>
                <input
                    type="number"
                    id="price-min-<?php echo esc_attr($template);?>"
                    class="input-min price-input"
                    value="<?php echo floatval($min)?>"
                    min="0"
                    max="<?php echo floatval($max)?>"
                    step="0.01"
                    placeholder="<?php echo floatval($min)?>"
                    aria-label="<?php esc_attr_e('Minimum price','filter-plus');?>"
                >
            </div>
            <span class="input-error" id="min-error-<?php echo esc_attr($template);?>"></span>
        </div>

        <div class="separator-wrapper">
            <span class="separator" aria-hidden="true">-</span>
        </div>

        <div class="field field-max">
            <label for="price-max-<?php echo esc_attr($template);?>" class="field-label">
                <?php esc_html_e('Max','filter-plus');?>
            </label>
            <div class="input-container">
                <span class="currency-symbol"><?php echo get_woocommerce_currency_symbol(); ?></span>
                <input
                    type="number"
                    id="price-max-<?php echo esc_attr($template);?>"
                    class="input-max price-input"
                    value="<?php echo floatval($max)?>"
                    min="<?php echo floatval($min)?>"
                    step="0.01"
                    placeholder="<?php echo floatval($max)?>"
                    aria-label="<?php esc_attr_e('Maximum price','filter-plus');?>"
                >
            </div>
            <span class="input-error" id="max-error-<?php echo esc_attr($template);?>"></span>
        </div>
    </div>

</div>