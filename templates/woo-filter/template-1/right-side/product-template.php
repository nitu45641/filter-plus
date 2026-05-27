<?php

use FilterPlus\Utils\Helper;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Grid template for products
 */
if (!function_exists('filterplus_render_grid_product')) {
function filterplus_render_grid_product($product, $hide_prod_add_cart, $hide_prod_title, $hide_prod_desc, $hide_prod_rating, $hide_prod_price) {
	?>
	<div class="product-style product-style-<?php echo esc_attr($product['template']); ?>">
		<div class="product-thumbnail">
			<a href="<?php echo esc_url($product['post_permalink']); ?>" target="_blank">
				<div class="vpcc-image">
					<?php
					$grid_image = wp_get_attachment_image(get_post_thumbnail_id($product['id']), 'large', false, array('style' => 'width:100%;height:100%;object-fit:cover;display:block;'));
					if (empty($grid_image)) {
						echo wp_kses_post( preg_replace('/<img/', '<img style="width:100%;height:100%;object-fit:cover;display:block;"', $product['post_image']) );
					} else {
						echo wp_kses_post( $grid_image );
					}
					?>
					<?php
					$fp_cats = (array) $product['categories'];
					$fp_first_cat = !empty($fp_cats) ? $fp_cats[0] : null;
					$fp_tags = !empty($product['tags']) ? array_values($product['tags']) : array();
					$fp_first_tag_name = '';
					$fp_first_tag_link = '#';
					foreach ($fp_tags as $fp_t) {
						$n = is_object($fp_t) ? $fp_t->name : (isset($fp_t['name']) ? $fp_t['name'] : '');
						if (!empty($n)) {
							$fp_first_tag_name = $n;
							$fp_first_tag_link = is_object($fp_t) ? (isset($fp_t->link) ? $fp_t->link : '#') : (isset($fp_t['link']) ? $fp_t['link'] : '#');
							break;
						}
					}
					?>
					<?php if (!empty($product['on_sale']) || $fp_first_cat || !empty($fp_first_tag_name)): ?>
						<div class="filter-cat-badge">
							<?php if (!empty($product['on_sale'])): ?>
								<span class="fp-sale-badge"><?php echo esc_html($product['on_sale_text']); ?></span>
							<?php endif; ?>
							<?php if ($fp_first_cat): ?>
								<span><?php echo esc_html(is_object($fp_first_cat) ? $fp_first_cat->name : $fp_first_cat['name']); ?></span>
							<?php endif; ?>
							<?php if (!empty($fp_first_tag_name)): ?>
								<a href="<?php echo esc_url($fp_first_tag_link); ?>" target="_blank"><span><?php echo esc_html($fp_first_tag_name); ?></span></a>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</div>
			</a>
		</div>
		<div class="product-content">
			<?php if( $hide_prod_title == 'yes' ): ?>
			<div class="product-name">
				<a href="<?php echo esc_url($product['post_permalink']); ?>" target="_blank"><?php echo esc_html( $product['post_title'] ); ?></a>
			</div>
			<?php endif; ?>
			<?php if( $hide_prod_rating == 'yes' ): ?>
				<?php echo wp_kses_post( $product['rating'] ); ?>
			<?php endif; ?>
			<div class="product-price-row">
				<?php if( $hide_prod_price == 'yes' ): ?>
				<div class="product-price">
					<?php echo wp_kses_post( $product['post_price'] ); ?>
				</div>
				<?php endif; ?>
				<?php if( $hide_prod_add_cart == 'yes' ): ?>
				<div class="inline-cart-btn">
					<?php echo Helper::kses($product['cart_btn']); ?>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php
}
}

/**
 * List template for products
 */
if (!function_exists('filterplus_render_list_product')) {
function filterplus_render_list_product($product, $hide_prod_add_cart, $hide_prod_title, $hide_prod_desc, $hide_prod_rating, $hide_prod_price) {
	?>
	<div class="horizontal-prod-card">
		<div class="hpcc-image" style="width: 220px; min-width: 220px; height: 220px;">
			<a href="<?php echo esc_url($product['post_permalink']); ?>" target="_blank" style="display: block; width: 100%; height: 100%;">
				<?php
				// Get product thumbnail with appropriate size for list view
				$list_image = wp_get_attachment_image(get_post_thumbnail_id($product['id']), array(220, 220), false, array('style' => 'width: 100%; height: 100%; object-fit: cover;'));
				if (empty($list_image)) {
					// Fallback: modify existing image to fit
					echo wp_kses_post( preg_replace('/<img/', '<img style="width: 100%; height: 100%; object-fit: cover;"', $product['post_image']) );
				} else {
					echo wp_kses_post( $list_image );
				}
				?>
				<?php if (!empty($product['on_sale'])): ?>
					<div class="badge on-sale-badge-<?php echo esc_attr($product['template']); ?>"><?php echo esc_html($product['on_sale_text']); ?></div>
				<?php endif; ?>
			</a>
		</div>
		<div class="hpcc-content">
			<?php if( $hide_prod_title == 'yes' ): ?>
			<div class="hpcc-name">
				<a href="<?php echo esc_url($product['post_permalink']); ?>" target="_blank"><?php echo esc_html($product['post_title']); ?></a>
			</div>
			<?php endif; ?>
			<?php if( $hide_prod_rating == 'yes' && !empty($product['rating']) ): ?>
			<div class="hpcc-rating">
				<?php echo wp_kses_post( $product['rating'] ); ?>
			</div>
			<?php endif; ?>
			<?php if( $hide_prod_price == 'yes' ): ?>
			<div class="hpcc-price">
				<?php echo wp_kses_post( $product['post_price'] ); ?>
			</div>
			<?php endif; ?>
			<?php if( $hide_prod_desc == 'yes' && !empty($product['post_description']) ): ?>
			<div class="hpcc-description">
				<?php echo wp_kses_post($product['post_description']); ?>
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
		<?php if( $hide_prod_add_cart == 'yes' ): ?>
		<div class="hpcc-actions">
			<div class="hpcc-btns">
				<?php echo wp_kses_post( $product['cart_btn'] ); ?>
			</div>
		</div>
		<?php endif; ?>
	</div>
	<?php
}
}