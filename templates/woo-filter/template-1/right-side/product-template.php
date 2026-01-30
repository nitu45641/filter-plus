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
				<div class="vpcc-image" style="width: 220px; height: 220px; margin: 0 auto;">
					<?php
					$grid_image = wp_get_attachment_image(get_post_thumbnail_id($product['id']), array(220, 220), false, array('style' => 'width: 100%; height: 100%; object-fit: cover;'));
					if (empty($grid_image)) {
						echo wp_kses_post( preg_replace('/<img/', '<img style="width: 100%; height: 100%; object-fit: cover;"', $product['post_image']) );
					} else {
						echo wp_kses_post( $grid_image );
					}
					?>
					<?php if (!empty($product['on_sale'])): ?>
						<div class="badge on-sale-badge-<?php echo esc_attr($product['template']); ?>"><?php echo esc_html($product['on_sale_text']); ?></div>
					<?php endif; ?>
				</div>
			</a>
			<?php if( $hide_prod_add_cart == 'yes' ): ?>
			<div class="card-action-btn-container">
				<?php echo Helper::kses($product['cart_btn']); ?>
			</div>
			<?php endif; ?>
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
			<?php if( $hide_prod_price == 'yes' ): ?>
			<div class="product-price">
				<?php echo wp_kses_post( $product['post_price'] ); ?>
			</div>
			<?php endif; ?>
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