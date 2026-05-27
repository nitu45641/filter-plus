<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Grid template for wp posts
 */
function filterplus_render_grid_product($product, $hide_wp_title, $hide_wp_desc) {
	?>
	<div class="horizontal-wp-card product-style product-style-<?php echo esc_attr($product['template']); ?>">
		<div class="hpcc-image">
			<a href="<?php echo esc_url($product['post_permalink']); ?>" target="_blank" class="hpcc-name">
				<?php echo wp_kses_post( $product['post_image'] ); ?>
			</a>
			<div class="filter-meta-wrapper">
				<?php
				$fp_cats = !empty($product['categories']) ? array_values((array)$product['categories']) : array();
				$fp_first_cat = !empty($fp_cats) ? $fp_cats[0] : null;
				$fp_tags = !empty($product['tags']) ? array_values($product['tags']) : array();
				$fp_first_tag_name = '';
				$fp_first_tag_link = '#';
				foreach ($fp_tags as $fp_t) {
					$n = is_object($fp_t) ? $fp_t->name : (isset($fp_t['name']) ? $fp_t['name'] : '');
					if (!empty($n)) { $fp_first_tag_name = $n; $fp_first_tag_link = is_object($fp_t) ? (isset($fp_t->link) ? $fp_t->link : '#') : (isset($fp_t['link']) ? $fp_t['link'] : '#'); break; }
				}
				?>
				<?php if ($fp_first_cat || !empty($fp_first_tag_name)): ?>
					<div class="filter-cat-links">
						<?php if ($fp_first_cat): ?>
							<?php $fp_cat_link = is_object($fp_first_cat) ? (isset($fp_first_cat->link) ? $fp_first_cat->link : '#') : (isset($fp_first_cat['link']) ? $fp_first_cat['link'] : '#'); ?>
							<a href="<?php echo esc_url($fp_cat_link); ?>" target="_blank" class="fp-cat-link"><?php echo esc_html(is_object($fp_first_cat) ? $fp_first_cat->name : $fp_first_cat['name']); ?></a>
						<?php endif; ?>
						<?php if (!empty($fp_first_tag_name)): ?>
							<a href="<?php echo esc_url($fp_first_tag_link); ?>" target="_blank"><span><?php echo esc_html($fp_first_tag_name); ?></span></a>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<div class="hpcc-content">
			<?php if( $hide_wp_title == 'yes' ): ?>
			<div class="filter-wp-title">
				<a href="<?php echo esc_url($product['post_permalink']); ?>" target="_blank" class="hpcc-name"><h2><?php echo esc_html( $product['post_title'] ); ?></h2></a>
			</div>
			<?php endif; ?>

			<?php if (!empty($product['author'])): ?>
			<div class="meta-section">
				<span><?php echo esc_html__('By','filter-plus'); ?></span>
				<a href="<?php echo esc_url($product['posts_author_link']); ?>" target="_blank" class="author"><?php echo esc_html($product['author']); ?></a>
			</div>
			<?php endif; ?>
			<?php if( $hide_wp_desc == 'yes' ): ?>
				<div class="hpcc-description">
					<?php echo wp_kses_post( $product['post_description'] ); ?>
				</div>
			<?php endif; ?>

		</div>
	</div>
	<?php
}

/**
 * List template for wp posts
 */
function filterplus_render_list_product($product, $hide_wp_title, $hide_wp_desc) {
	// No list template for wp-filter template-1
}