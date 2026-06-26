<?php

use FilterPlus\Utils\Helper;

 if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Grid template for products
 */
function filterplus_render_grid_product($product, $hide_prod_add_cart, $hide_prod_title, $hide_prod_desc, $hide_prod_rating, $hide_prod_price) {
	?>
	<div class="product-style product-style-<?php echo intval($product['template']); ?>">
		<div class="vartical-prod-card-container">
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
						if (!empty($n)) { $fp_first_tag_name = $n; $fp_first_tag_link = is_object($fp_t) ? (isset($fp_t->link) ? $fp_t->link : '#') : (isset($fp_t['link']) ? $fp_t['link'] : '#'); break; }
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
				<div class="product-meta">
					<div class="offer"></div>
					<?php if (!empty($product['wish_quick'])): ?>
						<div class="quickview-and-wishlist">
							<ul>
								<li>
									<a href="#">
									<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><path d="M288 144a110.94 110.94 0 0 0-31.24 5 55.4 55.4 0 0 1 7.24 27 56 56 0 0 1-56 56 55.4 55.4 0 0 1-27-7.24A111.71 111.71 0 1 0 288 144zm284.52 97.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400c-98.65 0-189.09-55-237.93-144C98.91 167 189.34 112 288 112s189.09 55 237.93 144C477.1 345 386.66 400 288 400z"/></svg>
									</a>
								</li>
								<li>
									<a href="#">
									<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M458.4 64.3C400.6 15.7 311.3 23 256 79.3 200.7 23 111.4 15.6 53.6 64.3-21.6 127.6-10.6 230.8 43 285.5l175.4 178.7c10 10.2 23.4 15.9 37.6 15.9 14.3 0 27.6-5.6 37.6-15.8L469 285.6c53.5-54.7 64.7-157.9-10.6-221.3zm-23.6 187.5L259.4 430.5c-2.4 2.4-4.4 2.4-6.8 0L77.2 251.8c-36.5-37.2-43.9-107.6 7.3-150.7 38.9-32.7 98.9-27.8 136.5 10.5l35 35.7 35-35.7c37.8-38.5 97.8-43.2 136.5-10.6 51.1 43.1 43.5 113.9 7.3 150.8z"/></svg>
									</a>
								</li>
							</ul>
						</div>
					<?php endif; ?>
				</div>
				<?php if( $hide_prod_add_cart == 'yes' ): ?>
					<div class="card-action-btn-container">
						<?php echo Helper::kses($product['cart_btn']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
				<?php endif; ?>

			</div>
			<div class="product-content">
				<?php if( $hide_prod_title == 'yes' ): ?>
				<div class="product-name">
					<a href="<?php echo esc_url($product['post_permalink']); ?>"><?php echo esc_html( $product['post_title'] ); ?></a>
				</div>
				<?php endif; ?>

				<?php if( $hide_prod_price == 'yes' ): ?>
				<div class="product-price"><?php echo wp_kses_post( $product['post_price'] ); ?></div>
				<?php endif; ?>
				<?php if( $hide_prod_rating == 'yes' ): ?> <?php echo wp_kses_post( $product['rating'] ); ?> <?php endif; ?>
			</div>
		</div>
	</div>
	<?php
}

/**
 * List template for products
 */
function filterplus_render_list_product($product, $hide_prod_add_cart, $hide_prod_title, $hide_prod_desc, $hide_prod_rating, $hide_prod_price) {
	?>
	<div class="horizontal-prod-card">
		<div class="hpcc-image" style="width: 220px; min-width: 220px; height: 220px;">
			<a href="<?php echo esc_url($product['post_permalink']); ?>" target="_blank" style="display: block; width: 100%; height: 100%;">
				<?php
				$list_image = wp_get_attachment_image(get_post_thumbnail_id($product['id']), array(220, 220), false, array('style' => 'width: 100%; height: 100%; object-fit: cover;'));
				if (empty($list_image)) {
					echo wp_kses_post( preg_replace('/<img/', '<img style="width: 100%; height: 100%; object-fit: cover;"', $product['post_image']) );
				} else {
					echo wp_kses_post( $list_image );
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
					if (!empty($n)) { $fp_first_tag_name = $n; $fp_first_tag_link = is_object($fp_t) ? (isset($fp_t->link) ? $fp_t->link : '#') : (isset($fp_t['link']) ? $fp_t['link'] : '#'); break; }
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
