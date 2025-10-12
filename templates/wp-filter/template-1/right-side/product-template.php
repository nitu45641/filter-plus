<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Grid template for wp posts
 */
function render_grid_product($product, $hide_wp_title, $hide_wp_desc) {
	?>
	<div class="horizontal-wp-card product-style product-style-<?php echo esc_attr($product['template']); ?>">
		<div class="hpcc-image">
			<a href="<?php echo esc_url($product['post_permalink']); ?>" target="_blank" class="hpcc-name">
				<?php echo $product['post_image']; ?>
			</a>
			<div class="filter-meta-wrapper">
				<?php if (!empty($product['categories'])): ?>
					<?php foreach ($product['categories'] as $category): ?>
						<?php $link = is_object($category) ? (isset($category->link) ? $category->link : '#') : (isset($category['link']) ? $category['link'] : '#'); ?>
						<a href="<?php echo esc_url($link); ?>" target="_blank" class=""><?php echo esc_html(is_object($category) ? $category->name : $category['name']); ?></a>
					<?php endforeach; ?>
				<?php endif; ?>
				<?php if (!empty($product['tags'])): ?>
					<?php foreach ($product['tags'] as $tag): ?>
						<?php $link = is_object($tag) ? (isset($tag->link) ? $tag->link : '#') : (isset($tag['link']) ? $tag['link'] : '#'); ?>
						<a href="<?php echo esc_url($link); ?>" target="_blank" class=""><?php echo esc_html(is_object($tag) ? $tag->name : $tag['name']); ?></a>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
		<div class="hpcc-content">
			<?php if( $hide_wp_title == 'yes' ): ?>
			<div class="filter-wp-title">
				<a href="<?php echo esc_url($product['post_permalink']); ?>" target="_blank" class="hpcc-name"><h2><?php echo $product['post_title']; ?></h2></a>
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
					<?php echo $product['post_description']; ?>
				</div>
			<?php endif; ?>

		</div>
	</div>
	<?php
}

/**
 * List template for wp posts
 */
function render_list_product($product, $hide_wp_title, $hide_wp_desc) {
	// No list template for wp-filter template-1
}