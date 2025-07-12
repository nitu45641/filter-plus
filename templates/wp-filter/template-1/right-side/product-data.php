<?php

if ( ! defined( 'ABSPATH' ) ) exit;
?>

<script id="search_products_grid" type="text/x-handlebars-template">
<div class="horizontal-wp-card product-style product-style-<?php echo esc_attr($template);?>">
		<div class="hpcc-image">
			<a href="{{post_permalink}}" target="_blank" class="hpcc-name">
				{{{ post_image }}}
			</a>
			<div class="filter-meta-wrapper">
				{{#each tags }}
					<a href="{{link}}" target="_blank" class="">{{ name }}</a>
				{{/each}}
			</div>
		</div>
		<div class="hpcc-content">
			<?php if( $hide_wp_title == 'yes' ): ?>
			<div class="filter-wp-title">
				<a href="{{post_permalink}}" target="_blank" class="hpcc-name"><h2>{{{ post_title }}}</h2></a>
			</div>
			<?php endif; ?>

			{{#if author}}
			<div class="meta-section">
				<span><?php echo esc_html__('By','filter-plus')?></span>
				<a href="{{posts_author_link}}" target="_blank" class="author">{{author}}</a>
			</div>
			{{/if}}
			<?php if( $hide_wp_desc == 'yes' ): ?>
				<div class="hpcc-description">
					{{{ post_description }}}
				</div>
			<?php endif; ?>

		</div>
	</div>	
</script>

