<?php

if ( ! defined( 'ABSPATH' ) ) exit;
?>

<script id="search_products_list" type="text/x-handlebars-template">
	<div class="horizontal-prod-card-container horizontal-wp-card">
		<div class="hpcc-image">
			{{{ post_image }}}
		</div>
		<div class="hpcc-content">
			<div class="filter-wp-title">
				<a href="{{post_permalink}}" target="_blank" class="hpcc-name"><h2>{{{ post_title }}}</h2></a>
			</div>
			{{#if author}}
			<a href="{{posts_author_link}}" target="_blank" class="author">{{author}}</a>
			{{/if}}
			<div class="hpcc-description">
				{{{ post_description }}}
			</div>
			<div>
				<div class="cats mt-1">
					{{#each categories }}
						<a href="{{link}}" target="_blank" class="filter-tag">{{ name }}</a>
					{{/each}}
				</div>
				<div class="tags mt-1">
					{{#each tags }}
						<a href="{{link}}" target="_blank" class="filter-tag">{{ name }}</a>
					{{/each}}
				</div>
			</div>
		</div>
	</div>
</script>

