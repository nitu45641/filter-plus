
<script id="search_products_grid" type="text/x-handlebars-template">
	<div class="prods-grid-view product-style-two">
		<div class="vartical-prod-card-container">
			<div class="product-thumbnail">
				<div class="vpcc-image">
					{{{ post_image }}}
				</div>
				<div class="product-meta">
					{{#each tags}}
						{{#each this}}
						<div class="offer"><span>{{{ name }}}</span></div>
						{{/each}}
					{{/each}}
					<div class="quickview-and-wishlist">
						<ul>
							<li>
								<a href="#">
									<i class="far fa-eye"></i>
								</a>
							</li>
							<li>
								<a href="#">
									<i class="far fa-heart"></i>
								</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="card-action-btn-container">
					{{{ cart_btn }}}
				</div>
			</div>
			<div class="product-content">
				{{#each categories }}
					{{#each this}}
						<div class="cat">
							<a href="#">{{{ name }}}</a>
						</div>	
					{{/each}}
				{{/each}}
				<div class="product-name">
					<a href="#">{{{ post_title }}}</a>
				</div>
				<div class="product-price">
					{{{ post_price }}}
				</div>
				{{{ rating }}}
			</div>
		</div>
	</div>
</script>