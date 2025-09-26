<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Grid template for products
 */
function render_grid_product($product, $hide_prod_add_cart, $hide_prod_title, $hide_prod_desc, $hide_prod_rating, $hide_prod_price) {
	?>
	<div class="product-style product-style-<?php echo esc_attr($product['template']); ?> vartical-prod-card-container">
		<div class="vpcc-image">
			<a href="<?php echo esc_url($product['post_permalink']); ?>" target="_blank"><?php echo $product['post_image']; ?></a>
			<?php if( $hide_prod_add_cart == 'yes' ): ?>
				<div class="card-action-btn-container">
					<div class="vpcc-btns btn-1"><?php echo $product['cart_btn']; ?></div>
				</div>
			<?php endif; ?>
		</div>
		<?php if( $hide_prod_title == 'yes' ): ?>
			<div class="vpcc-name"><a href="<?php echo esc_url($product['post_permalink']); ?>"><?php echo $product['post_title']; ?></a></div>
		<?php endif; ?>
		<?php if( $hide_prod_desc == 'yes' ): ?>
			<p><?php echo esc_html($product['post_description']); ?></p>
		<?php endif; ?>
		<?php if( $hide_prod_rating == 'yes' ): ?>
			<?php echo $product['rating']; ?>
		<?php endif; ?>

		<?php if( $hide_prod_price == 'yes' ): ?>
			<div class="vpcc-footer">
				<div class="vpcc-price"><?php echo $product['post_price']; ?></div>
			</div>
		<?php endif; ?>
	</div>
	<?php
}

/**
 * List template for products
 */
function render_list_product($product, $hide_prod_add_cart, $hide_prod_title, $hide_prod_desc, $hide_prod_rating, $hide_prod_price) {
	?>
	<div class="horizontal-prod-card-container horizontal-prod-card">
		<a href="<?php echo esc_url($product['post_permalink']); ?>" target="_blank">
			<div class="hpcc-image">
				<?php echo $product['post_image']; ?>
			</div>
		</a>
		<div class="hpcc-content">
			<?php if( $hide_prod_title == 'yes' ): ?>
				<div class="hpcc-name"><a href="<?php echo esc_url($product['post_permalink']); ?>"><?php echo $product['post_title']; ?></a></div>
			<?php endif; ?>

			<?php if( $hide_prod_price == 'yes' ): ?>
				<?php echo $product['post_price']; ?>
			<?php endif; ?>

			<?php if( $hide_prod_rating == 'yes' ): ?>
				<?php echo $product['rating']; ?>
			<?php endif; ?>

			<?php if( $hide_prod_desc == 'yes' ): ?>
				<div class="hpcc-description"><?php echo esc_html($product['post_description']); ?></div>
			<?php endif; ?>
		</div>
		<?php if( $hide_prod_add_cart == 'yes' ): ?>
			<div class="hpcc-btns">
				<span class="vpcc-btns"><?php echo $product['cart_btn']; ?></span>
			</div>
		<?php endif; ?>
	</div>
	<?php
}