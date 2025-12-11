<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<div class="sidebar-row radio-wrap">
	<h4 class="sidebar-label"><?php echo esc_html($title); ?></h4>
	<div class="param-box">
		<?php foreach($authors as $key => $author) :
			if (empty($author)) {
				return;
			}
		?>
        <label class="checkbox-item checkbox-item-<?php echo esc_html($template);?> author">
            <input type="checkbox" data-author_text="<?php echo esc_html($author);?>"
            value="<?php echo esc_attr($key);?>"/>
            <?php echo esc_html($author);?>
        </label>
		<?php endforeach; ?>
	</div>
	<span class="reset d-none reset-<?php echo esc_attr($template);?>"><?php esc_html_e('Reset','filter-plus');?></span>	
</div>
