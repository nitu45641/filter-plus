<?php

if ( ! defined( 'ABSPATH' ) ) exit;
?>
<script id="search_products_grid" type="text/x-handlebars-template">
	<div class="vartical-prod-card-container">
		<div class="vpcc-image">
			{{{ post_image }}}
			<div class="card-action-btn-container">
				<div class="vpcc-btns btn-1">{{{ cart_btn }}}</div>
			</div>
		</div>
		<div class="vpcc-name"> <a href="{{post_permalink}}">{{{ post_title }}}</a></div>
		<p>{{ post_description }}</p>
		{{{ rating }}}
		<div class="vpcc-footer">
			<div class="vpcc-price">{{{ post_price }}}</div>
		</div>
	</div>
</script>

<script id="search_products_list" type="text/x-handlebars-template">
	<div class="horizontal-prod-card-container horizontal-prod-card">
		<div class="hpcc-image">
			{{{ post_image }}}
		</div>
		<div class="hpcc-content">
			<div class="hpcc-name">
			{{{ post_title }}}
			</div>
			
			{{{ post_price }}}
			{{{ rating }}}
			<div class="hpcc-description">{{ post_description }}</div>
		</div>
		<div class="hpcc-btns">
			<span class="vpcc-btns">{{{ cart_btn }}}</span>
		</div>
	</div>
</script>

