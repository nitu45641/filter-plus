<header class="menu">
	<a href="<?php echo esc_url( 'https://woooplugin.com/filter-plus/' ); ?>" target="_blank">
		<div class="logo">
			<img src = "<?php echo esc_url( FilterPlus::assets_url() . 'images/filter-plus-logo.png' ); ?>"
				alt="filter-plus-banner" 
				width="70px"
			/>
			<span class='version'><?php echo esc_html( 'v ' . FilterPlus::get_version() ); ?></span>
		</div>
	</a>
	<?php
		$menus = array(
			array(
				'name' => esc_html__('Filter Options','filter-plus'),
				'url' => admin_url() . 'admin.php?page=filter-options',
				'slug' => 'filter-options',
				'target' => '_self',
			),
			array(
				'name' => esc_html__('Filter Sets','filter-plus'),
				'url' => admin_url() . 'admin.php?page=filter-sets',
				'slug' => 'filter-sets',
				'target' => '_self',
			),
			array(
				'name' => esc_html__('Settings','filter-plus' ),
				'url' => admin_url() . 'admin.php?page=filter-plus-settings',
				'slug' => 'filter-plus-settings',
				'target' => '_self',
			),
			array(
				'name' => esc_html__('Support', 'filter-plus' ),
				'url' => 'https://woooplugin.com/support/',
				'target' => '_blank',
			),
			array(
				'name' => esc_html__( 'Feature Request', 'filter-plus' ),
				'url' => 'https://app.loopedin.io/filter-plus#/roadmap',
				'target' => '_blank',
			),

		);

		if ( ! class_exists( 'FilterPlusPro' ) ) {
			$menus[] = array(
				'name' => esc_html__( 'Upgrade to Pro','filter-plus' ),
				'url' => 'https://woooplugin.com/filter-plus/',
				'target' => '_blank',
			);
		}
		?>
	<div class="navigation">
		<?php
			$filter_menus = array( 'filter-sets', 'filter-plus-settings' );
			$current_page = ! empty( $_GET['page'] ) ? $_GET['page'] : '';
		foreach ( $menus as $key => $value ) {
			$active = ( ! empty( $value['slug'] ) && $value['slug'] == $current_page ) ? 'active' : '';
			$class = $value === end( $menus ) ? 'upgrade_pro' : '';
			?>
				<li>
					<a class="<?php echo esc_attr( $class ) . ' ' . esc_attr( $active ); ?>" href="<?php echo esc_url( $value['url'] ); ?>"
					 target="<?php echo esc_attr( $value['target'] ); ?>">
						<?php echo esc_html($value['name']);?>
					</a>
				</li>
				<?php
		}
		?>
	</div>
</header>