<div class="price-range-input price-input-<?php echo esc_attr($template);?>">
    <div class="field">
        <span><?php esc_html_e('Min','filter-plus-pro');?></span>
        <input type="number" class="input-min" value="<?php echo absint($min)?>">
    </div>
    <div class="separator">-</div>
    <div class="field">
        <span><?php esc_html_e('Max','filter-plus-pro');?></span>
        <input type="number" class="input-max" value="<?php echo absint($max)?>">
    </div>
</div>