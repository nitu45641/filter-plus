<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<div class="sidebar-row radio-wrap">
	<h4 class="sidebar-label"><?php echo esc_html($title); ?></h4>
	<div class="param-box">
		<?php foreach($filterplus_authors as $filterplus_key => $filterplus_author) :
			if (empty($filterplus_author)) {
				return;
			}
		?>
        <label class="checkbox-item checkbox-item-<?php echo esc_html($template);?> author">
            <input type="checkbox" data-author_text="<?php echo esc_html($filterplus_author);?>"
            value="<?php echo esc_attr($filterplus_key);?>"/>
            <?php echo esc_html($filterplus_author);?>
        </label>
		<?php endforeach; ?>
	</div>
	<span class="reset d-none reset-<?php echo esc_attr($template);?>"><?php esc_html_e('Reset','filter-plus');?></span>	
</div>
