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
				<?php if (!empty($product['categories'])): ?>
					<div class="filter-cat-links">
						<?php foreach ($product['categories'] as $category): ?>
							<?php $link = is_object($category) ? (isset($category->link) ? $category->link : '#') : (isset($category['link']) ? $category['link'] : '#'); ?>
							<a href="<?php echo esc_url($link); ?>" target="_blank" class="fp-cat-link"><?php echo esc_html(is_object($category) ? $category->name : $category['name']); ?></a>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
				<?php if (!empty($product['tags'])): ?>
					<div class="fp-product-tags">
						<?php foreach ($product['tags'] as $tag):
							$tag_name = is_object($tag) ? $tag->name : (isset($tag['name']) ? $tag['name'] : '');
							$tag_link = is_object($tag) ? (isset($tag->link) ? $tag->link : '#') : (isset($tag['link']) ? $tag['link'] : '#');
							if (empty($tag_name)) continue;
						?>
							<a href="<?php echo esc_url($tag_link); ?>" class="fp-tag-chip" target="_blank"><?php echo esc_html($tag_name); ?></a>
						<?php endforeach; ?>
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