<?php

if ( ! defined( 'ABSPATH' ) ) exit;
?>
<script id="search_products_grid" type="text/x-handlebars-template">
	<div class="product-style product-style-{{template}} vartical-prod-card-container">
		<div class="vpcc-image">
			<a href="{{post_permalink}}" target="_blank">{{{ post_image }}}</a>
			<?php if( $hide_prod_add_cart == 'yes' ): ?>
				<div class="card-action-btn-container">
					<div class="vpcc-btns btn-1">{{{ cart_btn }}}</div>
				</div>
			<?php endif; ?>
		</div>
		<?php if( $hide_prod_title == 'yes' ): ?>
			<div class="vpcc-name"><a href="{{post_permalink}}">{{{ post_title }}}</a></div>
		<?php endif; ?>
		<?php if( $hide_prod_desc == 'yes' ): ?>
			<p>{{ post_description }}</p>
		<?php endif; ?>
		<?php if( $hide_prod_rating == 'yes' ): ?>
			{{{ rating }}}
		<?php endif; ?>

		<?php if( $hide_prod_price == 'yes' ): ?>
			<div class="vpcc-footer">
				<div class="vpcc-price">{{{ post_price }}}</div>
			</div>
		<?php endif; ?>
	</div>
</script>

<script id="search_products_list" type="text/x-handlebars-template">
	<div class="horizontal-prod-card-container horizontal-prod-card">
		<a href="{{post_permalink}}" target="_blank">
			<div class="hpcc-image">
				{{{ post_image }}}
			</div>
		</a>
		<div class="hpcc-content">
			<?php if( $hide_prod_title == 'yes' ): ?>
				<div class="hpcc-name"><a href="{{post_permalink}}">{{{ post_title }}}</a></div>
			<?php endif; ?>

			<?php if( $hide_prod_price == 'yes' ): ?>
				{{{ post_price }}}
			<?php endif; ?>

			<?php if( $hide_prod_rating == 'yes' ): ?>
				{{{ rating }}}
			<?php endif; ?>

			<?php if( $hide_prod_desc == 'yes' ): ?>
				<div class="hpcc-description">{{ post_description }}</div>
			<?php endif; ?>
		</div>
		<?php if( $hide_prod_add_cart == 'yes' ): ?>
			<div class="hpcc-btns">
				<span class="vpcc-btns">{{{ cart_btn }}}</span>
			</div>
		<?php endif; ?>
	</div>
</script>

