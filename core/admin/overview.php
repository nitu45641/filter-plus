<?php
defined( 'ABSPATH' ) || exit;
?>

<!-- Hero -->
<div class="flp-hero">
	<div class="flp-hero-left">
		<div class="flp-hero-badge">
			<span class="dashicons dashicons-filter"></span>
			<?php esc_html_e( 'Free WordPress Filter Plugin', 'filter-plus' ); ?>
		</div>
		<h1 class="flp-hero-title"><?php esc_html_e( 'Powerful Product & Content Filtering for WordPress and WooCommerce', 'filter-plus' ); ?></h1>
		<p class="flp-hero-desc"><?php esc_html_e( 'Create beautiful filter widgets for WooCommerce products, custom post types, and blog posts — by price, category, tags, rating, custom fields, and more. No coding required.', 'filter-plus' ); ?></p>
		<div class="flp-hero-stats">
			<div class="flp-hero-stat">
				<strong>4.8 &#9733;</strong>
				<span><?php esc_html_e( 'Plugin Rating', 'filter-plus' ); ?></span>
			</div>
			<div class="flp-hero-stat-sep"></div>
			<div class="flp-hero-stat">
				<strong>100%</strong>
				<span><?php esc_html_e( 'Free to Use', 'filter-plus' ); ?></span>
			</div>
		</div>
		<div class="flp-hero-actions">
			<a href="<?php echo esc_url( admin_url( 'admin.php?page=filter-sets' ) ); ?>" class="flp-btn-hero-primary">
				<span class="dashicons dashicons-plus-alt2"></span>
				<?php esc_html_e( 'Create Filter', 'filter-plus' ); ?>
			</a>
			<a href="https://www.wpbens.com/plugins/filter-plus/" target="_blank" class="flp-btn-hero-secondary">
				<?php esc_html_e( 'Explore Pro', 'filter-plus' ); ?>
				<span class="dashicons dashicons-arrow-right-alt"></span>
			</a>
		</div>
	</div>
	<div class="flp-hero-right">
		<div class="flp-discount-pill flp-pill-1">
			<span class="dashicons dashicons-category"></span>
			<?php esc_html_e( 'By Category', 'filter-plus' ); ?>
		</div>
		<div class="flp-discount-pill flp-pill-2">
			<span class="dashicons dashicons-star-filled"></span>
			<?php esc_html_e( 'By Rating', 'filter-plus' ); ?>
		</div>
		<div class="flp-discount-pill flp-pill-3">
			<span class="dashicons dashicons-tag"></span>
			<?php esc_html_e( 'By Price', 'filter-plus' ); ?>
		</div>
		<svg viewBox="0 0 480 330" fill="none" xmlns="http://www.w3.org/2000/svg" class="flp-hero-svg" aria-hidden="true">

			<!-- Single unified card -->
			<rect x="6" y="6" width="468" height="318" rx="18" fill="white" fill-opacity="0.97"/>

			<!-- ===== LEFT: Filter Panel ===== -->

			<!-- Header -->
			<rect x="22" y="22" width="138" height="32" rx="10" fill="#EEF2FF"/>
			<rect x="22" y="38" width="138" height="16" fill="#EEF2FF"/>
			<text x="36" y="43" font-family="Arial,sans-serif" font-size="10" font-weight="700" fill="#3b6ef8">Filters</text>
			<text x="150" y="43" text-anchor="end" font-family="Arial,sans-serif" font-size="7" fill="#9ca3af">Reset all</text>

			<!-- Search box -->
			<rect x="30" y="60" width="122" height="18" rx="9" fill="#f8faff" stroke="#e5e7eb" stroke-width="0.8"/>
			<circle cx="41" cy="69" r="4" fill="none" stroke="#9ca3af" stroke-width="1.2"/>
			<line x1="44" y1="72" x2="47" y2="75" stroke="#9ca3af" stroke-width="1.2" stroke-linecap="round"/>
			<text x="52" y="73" font-family="Arial,sans-serif" font-size="6.5" fill="#d1d5db">Search filters...</text>

			<!-- Separator -->
			<line x1="30" y1="84" x2="152" y2="84" stroke="#f3f4f6" stroke-width="1"/>

			<!-- Category label -->
			<text x="30" y="96" font-family="Arial,sans-serif" font-size="7.5" font-weight="700" fill="#374151">Category</text>

			<!-- Electronics (checked) -->
			<rect x="30" y="101" width="7" height="7" rx="1.5" fill="#3b6ef8"/>
			<polyline points="31.5,104.5 33.5,106.5 36.5,102" stroke="white" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
			<text x="41" y="107" font-family="Arial,sans-serif" font-size="6.5" fill="#374151">Electronics</text>
			<text x="152" y="107" text-anchor="end" font-family="Arial,sans-serif" font-size="5.5" fill="#9ca3af">12</text>

			<!-- Clothing (checked) -->
			<rect x="30" y="113" width="7" height="7" rx="1.5" fill="#3b6ef8"/>
			<polyline points="31.5,116.5 33.5,118.5 36.5,114" stroke="white" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
			<text x="41" y="119" font-family="Arial,sans-serif" font-size="6.5" fill="#374151">Clothing</text>
			<text x="152" y="119" text-anchor="end" font-family="Arial,sans-serif" font-size="5.5" fill="#9ca3af">8</text>

			<!-- Books (unchecked) -->
			<rect x="30" y="125" width="7" height="7" rx="1.5" fill="white" stroke="#d1d5db" stroke-width="1"/>
			<text x="41" y="131" font-family="Arial,sans-serif" font-size="6.5" fill="#9ca3af">Books</text>
			<text x="152" y="131" text-anchor="end" font-family="Arial,sans-serif" font-size="5.5" fill="#d1d5db">5</text>

			<!-- Sports (unchecked) -->
			<rect x="30" y="137" width="7" height="7" rx="1.5" fill="white" stroke="#d1d5db" stroke-width="1"/>
			<text x="41" y="143" font-family="Arial,sans-serif" font-size="6.5" fill="#9ca3af">Sports</text>
			<text x="152" y="143" text-anchor="end" font-family="Arial,sans-serif" font-size="5.5" fill="#d1d5db">9</text>

			<!-- Separator -->
			<line x1="30" y1="151" x2="152" y2="151" stroke="#f3f4f6" stroke-width="1"/>

			<!-- Price Range -->
			<text x="30" y="162" font-family="Arial,sans-serif" font-size="7.5" font-weight="700" fill="#374151">Price Range</text>
			<text x="30" y="172" font-family="Arial,sans-serif" font-size="6" font-weight="600" fill="#3b6ef8">$50</text>
			<text x="152" y="172" text-anchor="end" font-family="Arial,sans-serif" font-size="6" font-weight="600" fill="#3b6ef8">$350</text>
			<!-- Track -->
			<rect x="30" y="176" width="122" height="3" rx="1.5" fill="#e5e7eb"/>
			<!-- Active range -->
			<rect x="46" y="176" width="82" height="3" rx="1.5" fill="#3b6ef8"/>
			<!-- Left thumb -->
			<circle cx="46" cy="177.5" r="5.5" fill="white" stroke="#3b6ef8" stroke-width="1.5"/>
			<!-- Right thumb -->
			<circle cx="128" cy="177.5" r="5.5" fill="#3b6ef8"/>
			<circle cx="128" cy="177.5" r="2.5" fill="white" fill-opacity="0.6"/>

			<!-- Separator -->
			<line x1="30" y1="190" x2="152" y2="190" stroke="#f3f4f6" stroke-width="1"/>

			<!-- Rating -->
			<text x="30" y="201" font-family="Arial,sans-serif" font-size="7.5" font-weight="700" fill="#374151">Rating</text>
			<!-- 5 stars -->
			<text x="30" y="212" font-family="Arial,sans-serif" font-size="9" fill="#f59e0b">&#9733;&#9733;&#9733;&#9733;&#9733;</text>
			<text x="82" y="211" font-family="Arial,sans-serif" font-size="5.5" fill="#9ca3af">(24)</text>
			<!-- 4 stars -->
			<text x="30" y="223" font-family="Arial,sans-serif" font-size="9" fill="#f59e0b">&#9733;&#9733;&#9733;&#9733;</text>
			<text x="68" y="223" font-family="Arial,sans-serif" font-size="9" fill="#e5e7eb">&#9733;</text>
			<text x="78" y="222" font-family="Arial,sans-serif" font-size="5.5" fill="#9ca3af">(18)</text>
			<!-- 3 stars -->
			<text x="30" y="234" font-family="Arial,sans-serif" font-size="9" fill="#f59e0b">&#9733;&#9733;&#9733;</text>
			<text x="55" y="234" font-family="Arial,sans-serif" font-size="9" fill="#e5e7eb">&#9733;&#9733;</text>
			<text x="72" y="233" font-family="Arial,sans-serif" font-size="5.5" fill="#9ca3af">(7)</text>

			<!-- Separator -->
			<line x1="30" y1="241" x2="152" y2="241" stroke="#f3f4f6" stroke-width="1"/>

			<!-- Color swatches -->
			<text x="30" y="252" font-family="Arial,sans-serif" font-size="7.5" font-weight="700" fill="#374151">Color</text>
			<!-- Red (selected) -->
			<circle cx="38" cy="264" r="8.5" fill="none" stroke="#ef4444" stroke-width="1.5"/>
			<circle cx="38" cy="264" r="6" fill="#ef4444"/>
			<!-- Blue -->
			<circle cx="54" cy="264" r="6" fill="#3b82f6"/>
			<!-- Green -->
			<circle cx="70" cy="264" r="6" fill="#22c55e"/>
			<!-- Yellow -->
			<circle cx="86" cy="264" r="6" fill="#f59e0b"/>
			<!-- Black -->
			<circle cx="102" cy="264" r="6" fill="#1f2937"/>
			<!-- White -->
			<circle cx="118" cy="264" r="6" fill="white" stroke="#d1d5db" stroke-width="1"/>

			<!-- Separator -->
			<line x1="30" y1="276" x2="152" y2="276" stroke="#f3f4f6" stroke-width="1"/>

			<!-- In Stock toggle -->
			<text x="30" y="291" font-family="Arial,sans-serif" font-size="7" fill="#374151">In Stock Only</text>
			<rect x="128" y="283" width="22" height="12" rx="6" fill="#3b6ef8"/>
			<circle cx="145" cy="289" r="4.5" fill="white"/>

			<!-- Results count -->
			<text x="30" y="304" font-family="Arial,sans-serif" font-size="5.5" fill="#9ca3af">24 results found</text>

			<!-- Vertical divider -->
			<line x1="160" y1="6" x2="160" y2="324" stroke="#e8ecf4" stroke-width="1"/>

			<!-- ===== RIGHT: Product Grid ===== -->

			<!-- Top bar -->
			<rect x="172" y="22" width="298" height="28" rx="10" fill="#f8faff"/>
			<rect x="172" y="36" width="298" height="14" fill="#f8faff"/>
			<text x="186" y="40" font-family="Arial,sans-serif" font-size="8" font-weight="700" fill="#374151">24 Products</text>
			<!-- Sort dropdown -->
			<rect x="376" y="27" width="82" height="16" rx="8" fill="white" stroke="#e5e7eb" stroke-width="1"/>
			<text x="381" y="38" font-family="Arial,sans-serif" font-size="6" fill="#6b7280">Sort: Popular</text>
			<text x="452" y="38" font-family="Arial,sans-serif" font-size="7" fill="#9ca3af">&#9660;</text>

			<!-- Divider -->
			<line x1="172" y1="50" x2="470" y2="50" stroke="#f0f4ff" stroke-width="1"/>

			<!-- ======= Product Card 1: Blue / Electronics ======= -->
			<rect x="180" y="56" width="136" height="118" rx="10" fill="white" stroke="#EEF2FF" stroke-width="1"/>
			<!-- image area -->
			<rect x="180" y="56" width="136" height="64" rx="10" fill="#EFF6FF"/>
			<rect x="180" y="66" width="136" height="54" fill="#EFF6FF"/>
			<!-- product shape: phone -->
			<rect x="217" y="62" width="28" height="46" rx="6" fill="#bfdbfe"/>
			<rect x="220" y="67" width="22" height="30" rx="3" fill="#dbeafe"/>
			<circle cx="231" cy="102" r="2.5" fill="#93c5fd"/>
			<rect x="226" y="64" width="10" height="2" rx="1" fill="#93c5fd"/>
			<!-- screen content lines -->
			<rect x="222" y="71" width="16" height="2" rx="1" fill="#3b82f6" fill-opacity="0.4"/>
			<rect x="222" y="75" width="12" height="2" rx="1" fill="#3b82f6" fill-opacity="0.25"/>
			<rect x="222" y="79" width="14" height="2" rx="1" fill="#3b82f6" fill-opacity="0.25"/>
			<!-- discount badge -->
			<rect x="284" y="60" width="28" height="12" rx="6" fill="#ef4444"/>
			<text x="298" y="69" text-anchor="middle" font-family="Arial,sans-serif" font-size="5.5" font-weight="700" fill="white">20% OFF</text>
			<!-- info -->
			<rect x="188" y="129" width="84" height="5" rx="2.5" fill="#c7d7fe"/>
			<rect x="188" y="137" width="58" height="4" rx="2" fill="#e0e7ff"/>
			<text x="188" y="150" font-family="Arial,sans-serif" font-size="8.5" fill="#f59e0b">&#9733;&#9733;&#9733;&#9733;</text>
			<text x="223" y="150" font-family="Arial,sans-serif" font-size="8.5" fill="#e5e7eb">&#9733;</text>
			<text x="188" y="161" font-family="Arial,sans-serif" font-size="6" fill="#9ca3af" text-decoration="line-through">$45.00</text>
			<text x="216" y="161" font-family="Arial,sans-serif" font-size="7" font-weight="700" fill="#16a34a">$36</text>
			<rect x="188" y="165" width="120" height="9" rx="4.5" fill="#3b6ef8"/>
			<text x="248" y="172" text-anchor="middle" font-family="Arial,sans-serif" font-size="5.5" font-weight="700" fill="white">Add to Cart</text>

			<!-- ======= Product Card 2: Orange / Fashion ======= -->
			<rect x="326" y="56" width="136" height="118" rx="10" fill="white" stroke="#FFF7ED" stroke-width="1"/>
			<rect x="326" y="56" width="136" height="64" rx="10" fill="#FFF7ED"/>
			<rect x="326" y="66" width="136" height="54" fill="#FFF7ED"/>
			<!-- product shape: bag -->
			<rect x="356" y="70" width="36" height="40" rx="6" fill="#fed7aa"/>
			<path d="M362 70 Q362 62 374 62 Q386 62 386 70" stroke="#fb923c" stroke-width="2" fill="none" stroke-linecap="round"/>
			<line x1="356" y1="80" x2="392" y2="80" stroke="#fb923c" stroke-width="1" stroke-opacity="0.5"/>
			<rect x="368" y="84" width="12" height="16" rx="3" fill="#fb923c" fill-opacity="0.3"/>
			<!-- NEW badge -->
			<rect x="332" y="60" width="24" height="12" rx="6" fill="#22c55e"/>
			<text x="344" y="69" text-anchor="middle" font-family="Arial,sans-serif" font-size="6" font-weight="700" fill="white">NEW</text>
			<!-- info -->
			<rect x="334" y="129" width="84" height="5" rx="2.5" fill="#fed7aa"/>
			<rect x="334" y="137" width="58" height="4" rx="2" fill="#ffedd5"/>
			<text x="334" y="150" font-family="Arial,sans-serif" font-size="8.5" fill="#f59e0b">&#9733;&#9733;&#9733;&#9733;&#9733;</text>
			<text x="334" y="161" font-family="Arial,sans-serif" font-size="6" fill="#9ca3af" text-decoration="line-through">$28.00</text>
			<text x="362" y="161" font-family="Arial,sans-serif" font-size="7" font-weight="700" fill="#16a34a">$22</text>
			<rect x="334" y="165" width="120" height="9" rx="4.5" fill="#3b6ef8"/>
			<text x="394" y="172" text-anchor="middle" font-family="Arial,sans-serif" font-size="5.5" font-weight="700" fill="white">Add to Cart</text>

			<!-- ======= Product Card 3: Green / Books ======= -->
			<rect x="180" y="184" width="136" height="118" rx="10" fill="white" stroke="#ECFDF5" stroke-width="1"/>
			<rect x="180" y="184" width="136" height="64" rx="10" fill="#ECFDF5"/>
			<rect x="180" y="194" width="136" height="54" fill="#ECFDF5"/>
			<!-- product shape: book -->
			<rect x="214" y="191" width="10" height="46" rx="2" fill="#6ee7b7"/>
			<rect x="224" y="191" width="34" height="46" rx="4" fill="#a7f3d0"/>
			<rect x="228" y="197" width="24" height="3" rx="1.5" fill="#34d399"/>
			<rect x="228" y="203" width="18" height="2.5" rx="1" fill="#34d399" fill-opacity="0.7"/>
			<rect x="228" y="208" width="20" height="2.5" rx="1" fill="#34d399" fill-opacity="0.5"/>
			<rect x="228" y="213" width="14" height="2.5" rx="1" fill="#34d399" fill-opacity="0.4"/>
			<!-- 15% OFF badge -->
			<rect x="284" y="188" width="28" height="12" rx="6" fill="#f97316"/>
			<text x="298" y="197" text-anchor="middle" font-family="Arial,sans-serif" font-size="5.5" font-weight="700" fill="white">15% OFF</text>
			<!-- info -->
			<rect x="188" y="257" width="84" height="5" rx="2.5" fill="#a7f3d0"/>
			<rect x="188" y="265" width="58" height="4" rx="2" fill="#d1fae5"/>
			<text x="188" y="278" font-family="Arial,sans-serif" font-size="8.5" fill="#f59e0b">&#9733;&#9733;&#9733;&#9733;</text>
			<text x="223" y="278" font-family="Arial,sans-serif" font-size="8.5" fill="#e5e7eb">&#9733;</text>
			<text x="188" y="289" font-family="Arial,sans-serif" font-size="6" fill="#9ca3af" text-decoration="line-through">$18.00</text>
			<text x="214" y="289" font-family="Arial,sans-serif" font-size="7" font-weight="700" fill="#16a34a">$15</text>
			<rect x="188" y="293" width="120" height="9" rx="4.5" fill="#3b6ef8"/>
			<text x="248" y="300" text-anchor="middle" font-family="Arial,sans-serif" font-size="5.5" font-weight="700" fill="white">Add to Cart</text>

			<!-- ======= Product Card 4: Purple / Audio ======= -->
			<rect x="326" y="184" width="136" height="118" rx="10" fill="white" stroke="#F5F3FF" stroke-width="1"/>
			<rect x="326" y="184" width="136" height="64" rx="10" fill="#F5F3FF"/>
			<rect x="326" y="194" width="136" height="54" fill="#F5F3FF"/>
			<!-- product shape: headphones -->
			<path d="M364 222 Q364 200 394 200 Q424 200 424 222" stroke="#c4b5fd" stroke-width="5" fill="none" stroke-linecap="round"/>
			<rect x="356" y="218" width="14" height="20" rx="7" fill="#c4b5fd"/>
			<rect x="418" y="218" width="14" height="20" rx="7" fill="#c4b5fd"/>
			<rect x="359" y="221" width="8" height="14" rx="4" fill="#a78bfa"/>
			<rect x="421" y="221" width="8" height="14" rx="4" fill="#a78bfa"/>
			<!-- HOT badge -->
			<rect x="332" y="188" width="22" height="12" rx="6" fill="#ec4899"/>
			<text x="343" y="197" text-anchor="middle" font-family="Arial,sans-serif" font-size="6.5" font-weight="700" fill="white">HOT</text>
			<!-- info -->
			<rect x="334" y="257" width="84" height="5" rx="2.5" fill="#ddd6fe"/>
			<rect x="334" y="265" width="58" height="4" rx="2" fill="#ede9fe"/>
			<text x="334" y="278" font-family="Arial,sans-serif" font-size="8.5" fill="#f59e0b">&#9733;&#9733;&#9733;&#9733;&#9733;</text>
			<text x="334" y="289" font-family="Arial,sans-serif" font-size="6" fill="#9ca3af" text-decoration="line-through">$89.00</text>
			<text x="362" y="289" font-family="Arial,sans-serif" font-size="7" font-weight="700" fill="#16a34a">$72</text>
			<rect x="334" y="293" width="120" height="9" rx="4.5" fill="#3b6ef8"/>
			<text x="394" y="300" text-anchor="middle" font-family="Arial,sans-serif" font-size="5.5" font-weight="700" fill="white">Add to Cart</text>

		</svg>
	</div>
</div>

<div class="flp-overview-body">

	<!-- WooCommerce Product Filter Section -->
	<div class="flp-features">
		<div class="flp-section-label"><?php esc_html_e( 'WOOCOMMERCE', 'filter-plus' ); ?></div>
		<h2 class="flp-section-title"><?php esc_html_e( 'WooCommerce Product Filter', 'filter-plus' ); ?></h2>
		<p class="flp-section-subtitle"><?php esc_html_e( 'Real-time product filtering that helps shoppers find exactly what they need and boosts your store conversions.', 'filter-plus' ); ?></p>

		<div class="flp-features-grid">
			<div class="flp-feature-card">
				<span class="flp-feat-icon dashicons dashicons-category" style="background:#EFF6FF;color:#3b82f6"></span>
				<h3><?php esc_html_e( 'Filter by Category', 'filter-plus' ); ?></h3>
				<p><?php esc_html_e( 'Let shoppers narrow products by category and subcategory with checkbox, radio, or dropdown displays.', 'filter-plus' ); ?></p>
			</div>
			<div class="flp-feature-card">
				<span class="flp-feat-icon dashicons dashicons-money-alt" style="background:#ECFDF5;color:#10b981"></span>
				<h3><?php esc_html_e( 'Price Range Slider', 'filter-plus' ); ?></h3>
				<p><?php esc_html_e( 'Drag-to-filter price slider that updates results instantly — min, max, or dual-handle range.', 'filter-plus' ); ?></p>
			</div>
			<div class="flp-feature-card">
				<span class="flp-feat-icon dashicons dashicons-star-filled" style="background:#FFFBEB;color:#f59e0b"></span>
				<h3><?php esc_html_e( 'Filter by Rating', 'filter-plus' ); ?></h3>
				<p><?php esc_html_e( 'Customers can filter by star rating to surface only the best-reviewed products in your store.', 'filter-plus' ); ?></p>
			</div>
			<div class="flp-feature-card">
				<span class="flp-feat-icon dashicons dashicons-tag" style="background:#F5F3FF;color:#8b5cf6"></span>
				<h3><?php esc_html_e( 'Tags & Attributes', 'filter-plus' ); ?></h3>
				<p><?php esc_html_e( 'Filter by WooCommerce tags, custom attributes, and variation options with a single widget.', 'filter-plus' ); ?></p>
			</div>
			<div class="flp-feature-card">
				<span class="flp-feat-icon dashicons dashicons-art" style="background:#FDF2F8;color:#ec4899"></span>
				<h3><?php esc_html_e( 'Color Swatch Filter', 'filter-plus' ); ?></h3>
				<p><?php esc_html_e( 'Visual color picker lets shoppers filter by product color or variation with a single click.', 'filter-plus' ); ?></p>
			</div>
			<div class="flp-feature-card">
				<span class="flp-feat-icon dashicons dashicons-cart" style="background:#FFF7ED;color:#f97316"></span>
				<h3><?php esc_html_e( 'WooCommerce Order Filter', 'filter-plus' ); ?></h3>
				<p><?php esc_html_e( 'Filter admin orders by any custom criteria to speed up order management workflows.', 'filter-plus' ); ?></p>
			</div>
			<div class="flp-feature-card">
				<span class="flp-feat-icon dashicons dashicons-update" style="background:#F0FDFA;color:#0d9488"></span>
				<h3><?php esc_html_e( 'AJAX Live Filtering', 'filter-plus' ); ?></h3>
				<p><?php esc_html_e( 'Results refresh instantly without page reload, giving shoppers a smooth, app-like experience.', 'filter-plus' ); ?></p>
			</div>
			<div class="flp-feature-card">
				<span class="flp-feat-icon dashicons dashicons-sort" style="background:#F0F9FF;color:#0ea5e9"></span>
				<h3><?php esc_html_e( 'Sort & Order Control', 'filter-plus' ); ?></h3>
				<p><?php esc_html_e( 'Let shoppers sort results by price, popularity, rating, or newness — integrated with the filter widget.', 'filter-plus' ); ?></p>
			</div>
		</div>
	</div>

	<!-- WordPress Content Filter Section -->
	<div class="flp-features">
		<div class="flp-section-label"><?php esc_html_e( 'WORDPRESS', 'filter-plus' ); ?></div>
		<h2 class="flp-section-title"><?php esc_html_e( 'WordPress Content Filter', 'filter-plus' ); ?></h2>
		<p class="flp-section-subtitle"><?php esc_html_e( 'Filter posts, CPTs, portfolios, and more with flexible, SEO-friendly filter widgets built for any WordPress site.', 'filter-plus' ); ?></p>

		<div class="flp-features-grid">
			<div class="flp-feature-card">
				<span class="flp-feat-icon dashicons dashicons-image-filter" style="background:#EEF2FF;color:#6366f1"></span>
				<h3><?php esc_html_e( 'Custom Post Type Filter', 'filter-plus' ); ?></h3>
				<p><?php esc_html_e( 'Filter any WordPress CPT — portfolio, listings, events, and more — with fully configurable filter sets.', 'filter-plus' ); ?></p>
			</div>
			<div class="flp-feature-card">
				<span class="flp-feat-icon dashicons dashicons-screenoptions" style="background:#FFF1F2;color:#f43f5e"></span>
				<h3><?php esc_html_e( 'Multiple Blog Templates', 'filter-plus' ); ?></h3>
				<p><?php esc_html_e( 'Apply filters to blog archives with dedicated templates designed for content-heavy sites.', 'filter-plus' ); ?></p>
			</div>
			<div class="flp-feature-card">
				<span class="flp-feat-icon dashicons dashicons-menu-alt3" style="background:#F0F9FF;color:#0ea5e9"></span>
				<h3><?php esc_html_e( 'Shortcode & Page Builder', 'filter-plus' ); ?></h3>
				<p><?php esc_html_e( 'Place filter widgets anywhere via shortcodes, Elementor, Gutenberg, or Bricks Builder.', 'filter-plus' ); ?></p>
			</div>
			<div class="flp-feature-card">
				<span class="flp-feat-icon dashicons dashicons-admin-page" style="background:#F0FDF4;color:#16a34a"></span>
				<h3><?php esc_html_e( 'SEO Optimized URLs', 'filter-plus' ); ?></h3>
				<p><?php esc_html_e( 'Clean, indexable URLs for every filter combination so filtered pages rank in search engines.', 'filter-plus' ); ?></p>
			</div>
			<div class="flp-feature-card">
				<span class="flp-feat-icon dashicons dashicons-filter" style="background:#FDF4FF;color:#c026d3"></span>
				<h3><?php esc_html_e( 'Multiple Custom Fields', 'filter-plus' ); ?></h3>
				<p><?php esc_html_e( 'Filter by ACF fields, meta fields, or any custom data for ultimate post-type flexibility.', 'filter-plus' ); ?></p>
			</div>
			<div class="flp-feature-card">
				<span class="flp-feat-icon dashicons dashicons-star-half" style="background:#FFFBEB;color:#d97706"></span>
				<h3><?php esc_html_e( '10+ Filter Templates', 'filter-plus' ); ?></h3>
				<p><?php esc_html_e( 'Pick from a library of pre-built filter templates and launch a polished widget in minutes.', 'filter-plus' ); ?></p>
			</div>
			<div class="flp-feature-card">
				<span class="flp-feat-icon dashicons dashicons-networking" style="background:#F5F3FF;color:#7c3aed"></span>
				<h3><?php esc_html_e( 'Taxonomy Filter', 'filter-plus' ); ?></h3>
				<p><?php esc_html_e( 'Filter by any registered taxonomy — tags, genres, locations, and more — on any post type.', 'filter-plus' ); ?></p>
			</div>
			<div class="flp-feature-card">
				<span class="flp-feat-icon dashicons dashicons-calendar-alt" style="background:#ECFEFF;color:#0891b2"></span>
				<h3><?php esc_html_e( 'Date Range Filter', 'filter-plus' ); ?></h3>
				<p><?php esc_html_e( 'Filter posts and CPTs by publish date, year, or custom date range using an intuitive date picker.', 'filter-plus' ); ?></p>
			</div>
		</div>
	</div>

	<!-- CTA Banner -->
	<div class="flp-cta-banner">
		<div class="flp-cta-content">
			<div class="flp-cta-badge"><?php esc_html_e( 'UPGRADE TODAY', 'filter-plus' ); ?></div>
			<h2><?php esc_html_e( 'Ready to unlock advanced filtering for your store?', 'filter-plus' ); ?></h2>
			<p><?php esc_html_e( 'Join thousands of store owners who use Filter Plus Pro to deliver faster product discovery and higher conversion rates.', 'filter-plus' ); ?></p>
			<a href="https://www.wpbens.com/plugins/filter-plus/" target="_blank" class="flp-cta-btn">
				<?php esc_html_e( 'Get Filter Plus Pro', 'filter-plus' ); ?>
				<span class="dashicons dashicons-arrow-right-alt"></span>
			</a>
		</div>
	</div>

	<!-- More Plugins -->
	<div class="flp-more-plugins">
		<div class="flp-section-label"><?php esc_html_e( 'BY THE SAME TEAM', 'filter-plus' ); ?></div>
		<h2 class="flp-section-title"><?php esc_html_e( 'More Plugins to Grow Your Store', 'filter-plus' ); ?></h2>
		<p class="flp-section-subtitle"><?php esc_html_e( 'Powerful WooCommerce and WordPress solutions built by the same team.', 'filter-plus' ); ?></p>

		<div class="flp-plugin-cards">

			<div class="flp-plugin-card">
				<div class="flp-plugin-img">
					<img src="<?php echo esc_url( FilterPlus::assets_url() . 'images/plugin-logo-memberhub.gif' ); ?>"
						alt="<?php esc_attr_e( 'MemberHub', 'filter-plus' ); ?>"/>
				</div>
				<div class="flp-plugin-info">
					<h3><a href="https://wpbens.com/plugins/memberhub/" target="_blank"><?php esc_html_e( 'MemberHub', 'filter-plus' ); ?></a></h3>
					<p><?php esc_html_e( 'Transform your site into a membership platform — restrict content, manage subscriptions, and offer member-exclusive pricing.', 'filter-plus' ); ?></p>
					<div class="flp-plugin-btns">
						<a class="flp-btn-outline" href="https://wordpress.org/plugins/memberhub/" target="_blank"><?php esc_html_e( 'Free', 'filter-plus' ); ?></a>
						<a class="flp-btn-filled" href="https://wpbens.com/plugins/memberhub/" target="_blank"><?php esc_html_e( 'Premium', 'filter-plus' ); ?></a>
					</div>
				</div>
			</div>

			<div class="flp-plugin-card">
				<div class="flp-plugin-img">
					<img src="<?php echo esc_url( FilterPlus::assets_url() . 'images/plugin-logo-mailerhub.png' ); ?>"
						alt="<?php esc_attr_e( 'MailerHub', 'filter-plus' ); ?>"/>
				</div>
				<div class="flp-plugin-info">
					<h3><a href="https://wpbens.com/plugins/mailerhub/" target="_blank"><?php esc_html_e( 'MailerHub', 'filter-plus' ); ?></a></h3>
					<p><?php esc_html_e( 'All-in-one Email Marketing & CRM — send campaigns, automate sequences, manage contacts, and grow your list.', 'filter-plus' ); ?></p>
					<div class="flp-plugin-btns">
						<a class="flp-btn-outline" href="https://wordpress.org/plugins/bens-email-marketing-automation/" target="_blank"><?php esc_html_e( 'Free', 'filter-plus' ); ?></a>
						<a class="flp-btn-filled" href="https://wpbens.com/plugins/mailerhub/" target="_blank"><?php esc_html_e( 'Premium', 'filter-plus' ); ?></a>
					</div>
				</div>
			</div>

			<div class="flp-plugin-card">
				<div class="flp-plugin-img">
					<img src="<?php echo esc_url( FilterPlus::assets_url() . 'images/plugin-logo-discountify.gif' ); ?>"
						alt="<?php esc_attr_e( 'Discountify', 'filter-plus' ); ?>"/>
				</div>
				<div class="flp-plugin-info">
					<h3><a href="https://wpbens.com/plugins/discountify/" target="_blank"><?php esc_html_e( 'Discountify', 'filter-plus' ); ?></a></h3>
					<p><?php esc_html_e( 'Dynamic pricing and discount rules for WooCommerce — percentage, fixed, BOGO, tiered, and conditional discounts.', 'filter-plus' ); ?></p>
					<div class="flp-plugin-btns">
						<a class="flp-btn-outline" href="https://wordpress.org/plugins/discountify/" target="_blank"><?php esc_html_e( 'Free', 'filter-plus' ); ?></a>
						<a class="flp-btn-filled" href="https://wpbens.com/plugins/discountify/" target="_blank"><?php esc_html_e( 'Premium', 'filter-plus' ); ?></a>
					</div>
				</div>
			</div>

			<div class="flp-plugin-card">
				<div class="flp-plugin-img">
					<img src="<?php echo esc_url( FilterPlus::assets_url() . 'images/plugin-logo-quicker.gif' ); ?>"
						alt="<?php esc_attr_e( 'Quicker', 'filter-plus' ); ?>"/>
				</div>
				<div class="flp-plugin-info">
					<h3><a href="https://wpbens.com/plugins/quicker/" target="_blank"><?php esc_html_e( 'Quicker', 'filter-plus' ); ?></a></h3>
					<p><?php esc_html_e( 'Speed up conversions and reduce cart abandonment with fast checkout, order bumps, upsells, and custom fees.', 'filter-plus' ); ?></p>
					<div class="flp-plugin-btns">
						<a class="flp-btn-outline" href="https://wordpress.org/plugins/quicker/" target="_blank"><?php esc_html_e( 'Free', 'filter-plus' ); ?></a>
						<a class="flp-btn-filled" href="https://wpbens.com/plugins/quicker/" target="_blank"><?php esc_html_e( 'Premium', 'filter-plus' ); ?></a>
					</div>
				</div>
			</div>

		</div>
	</div>

</div>
