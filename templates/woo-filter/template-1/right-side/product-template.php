<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Grid template for products
 */
if (!function_exists('render_grid_product')) {
function render_grid_product($product, $hide_prod_add_cart, $hide_prod_title, $hide_prod_desc, $hide_prod_rating, $hide_prod_price) {
	?>
	<div class="product-style product-style-<?php echo esc_attr($product['template']); ?>">
		<div class="product-thumbnail">
			<a href="<?php echo esc_url($product['post_permalink']); ?>" target="_blank">
				<div class="vpcc-image">
					<?php echo $product['post_image']; ?>
					<?php if (!empty($product['on_sale'])): ?>
						<div class="badge on-sale-badge-<?php echo esc_attr($product['template']); ?>"><?php echo esc_html($product['on_sale_text']); ?></div>
					<?php endif; ?>
				</div>
			</a>
			<?php if( $hide_prod_add_cart == 'yes' ): ?>
			<div class="card-action-btn-container">
				<?php echo $product['cart_btn']; ?>
			</div>
			<?php endif; ?>
		</div>
		<div class="product-content">
			<?php if( $hide_prod_title == 'yes' ): ?>
			<div class="product-name">
				<a href="<?php echo esc_url($product['post_permalink']); ?>" target="_blank"><?php echo $product['post_title']; ?></a>
			</div>
			<?php endif; ?>
			<?php if( $hide_prod_rating == 'yes' ): ?>
				<?php echo $product['rating']; ?>
			<?php endif; ?>
			<?php if( $hide_prod_price == 'yes' ): ?>
			<div class="product-price">
				<?php echo $product['post_price']; ?>
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
if (!function_exists('render_list_product')) {
function render_list_product($product, $hide_prod_add_cart, $hide_prod_title, $hide_prod_desc, $hide_prod_rating, $hide_prod_price) {
	// No list template for template-1
}
}