<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<script id="search_products_grid" type="text/x-handlebars-template">
	<div class="product-style product-style-<?php echo intval( $template );?>">
		<div class="vartical-prod-card-container">
			<div class="product-thumbnail">
				<a href="{{post_permalink}}" target="_blank">
					<div class="vpcc-image">
						{{{ post_image }}}
					</div>
				</a>
				<div class="product-meta">
					<div class="offer">
						{{#each tags}}
							<span>{{ name }}</span>
						{{/each}}
					</div>
					{{#if wish_quick }}
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
					{{/if}}
				</div>
				<?php if( $hide_prod_add_cart == 'yes' ): ?>
					<div class="card-action-btn-container">
						{{{ cart_btn }}}
					</div>
				<?php endif; ?>

			</div>
			<div class="product-content">
				<div class="cat">
					{{#each categories }}
						<a href="#">{{ name }}</a>
					{{/each}}
				</div>	
				<?php if( $hide_prod_title == 'yes' ): ?>
				<div class="product-name">
					<a href="{{post_permalink}}">{{{ post_title }}}</a>
				</div>
				<?php endif; ?>

				<?php if( $hide_prod_price == 'yes' ): ?>
				<div class="product-price">{{{ post_price }}}</div>
				<?php endif; ?>
				<?php if( $hide_prod_rating == 'yes' ): ?> {{{ rating }}} <?php endif; ?>
			</div>
		</div>
	</div>
</script>