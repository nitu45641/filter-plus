<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<div class="sidebar-row categories-wrap">
	<h4 class="sidebar-label"><?php echo !empty( $category_label ) ? esc_html( $category_label ) : esc_html__('Categories','filter-plus');?></h4>
	<ul class="category-list categories-image-grid">
		<?php
			$filterplus_get_categories = \FilterPlus\Utils\Helper::get_categories($categories, false,
				array( 'hide_empty' => $hide_empty_cat, 'taxonomy' => $taxonomy ) );

			$filterplus_placeholder = function_exists('wc_placeholder_img_src') ? wc_placeholder_img_src('medium') : '';

			if ( !empty( $filterplus_get_categories ) ) :
				foreach ( $filterplus_get_categories as $filterplus_item ) :
					$filterplus_thumb_id = get_term_meta( $filterplus_item['term_id'], 'thumbnail_id', true );
					$filterplus_img_src  = $filterplus_thumb_id
						? wp_get_attachment_image_url( $filterplus_thumb_id, 'medium' )
						: $filterplus_placeholder;
				?>
				<li class="cat-group fp-img-card parent"
					data-name="<?php echo esc_attr( $filterplus_item['name'] ); ?>"
					data-cat_id="<?php echo esc_attr( $filterplus_item['term_id'] ); ?>"
					data-slug="<?php echo esc_attr( $filterplus_item['slug'] ); ?>"
					data-parent="<?php echo esc_attr( $filterplus_item['term_id'] ); ?>"
				>
					<input type="checkbox"
						class="regular-checkbox fp-img-card-check"
						value="<?php echo esc_attr( $filterplus_item['term_id'] ); ?>"
						id="<?php echo esc_attr( 'cat_li_parent_' . $filterplus_item['term_id'] ); ?>"
					/>
					<label for="<?php echo esc_attr( 'cat_li_parent_' . $filterplus_item['term_id'] ); ?>" class="fp-img-card-label">
						<span class="fp-img-card-thumb">
							<img src="<?php echo esc_url( $filterplus_img_src ); ?>" alt="<?php echo esc_attr( $filterplus_item['name'] ); ?>" />
							<span class="fp-img-card-overlay">
								<span class="fp-img-card-name"><?php echo esc_html( $filterplus_item['name'] ); ?></span>
								<?php if ( $product_count == 'yes' ) : ?>
									<span class="fp-img-card-count">(<?php echo esc_html( $filterplus_item['count'] ); ?>)</span>
								<?php endif; ?>
							</span>
						</span>
					</label>
				</li>
				<?php if ( $sub_categories == 'yes' && !empty( $filterplus_item['sub_categories'] ) ) : ?>
					<?php foreach ( $filterplus_item['sub_categories'] as $filterplus_sub ) :
						$filterplus_sub_thumb_id = get_term_meta( $filterplus_sub['term_id'], 'thumbnail_id', true );
						$filterplus_sub_img_src  = $filterplus_sub_thumb_id
							? wp_get_attachment_image_url( $filterplus_sub_thumb_id, 'medium' )
							: $filterplus_placeholder;
					?>
					<li class="cat-group fp-img-card sub_categories"
						data-parent="<?php echo esc_attr( $filterplus_item['term_id'] ); ?>"
						data-name="<?php echo esc_attr( $filterplus_sub['name'] ); ?>"
						data-cat_id="<?php echo esc_attr( $filterplus_sub['term_id'] ); ?>"
						data-slug="<?php echo esc_attr( $filterplus_sub['slug'] ); ?>"
					>
						<input type="checkbox"
							class="regular-checkbox fp-img-card-check"
							value="<?php echo esc_attr( $filterplus_sub['term_id'] ); ?>"
							id="<?php echo esc_attr( 'cat_li_child_' . $filterplus_sub['term_id'] ); ?>"
						/>
						<label for="<?php echo esc_attr( 'cat_li_child_' . $filterplus_sub['term_id'] ); ?>" class="fp-img-card-label">
							<span class="fp-img-card-thumb">
								<img src="<?php echo esc_url( $filterplus_sub_img_src ); ?>" alt="<?php echo esc_attr( $filterplus_sub['name'] ); ?>" />
								<span class="fp-img-card-overlay">
									<span class="fp-img-card-name"><?php echo esc_html( $filterplus_sub['name'] ); ?></span>
									<?php if ( $product_count == 'yes' ) : ?>
										<span class="fp-img-card-count">(<?php echo esc_html( $filterplus_sub['count'] ); ?>)</span>
									<?php endif; ?>
								</span>
							</span>
						</label>
					</li>
					<?php endforeach; ?>
				<?php endif; ?>
			<?php
			endforeach;
			endif;
		?>
	</ul>
	<span class="reset d-none reset-<?php echo esc_attr($template);?>"><?php esc_html_e('Reset','filter-plus');?></span>
</div>
