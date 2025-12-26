<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<header class="menu">
	<a href="<?php echo esc_url( 'https://wpbens.com/filter-plus/' ); ?>" target="_blank">
		<div class="logo">
			<img src = "<?php echo esc_url( FilterPlus::assets_url() . 'images/filter-plus-logo.svg' ); ?>"
				alt="filter-plus-logo" 
                width="45px"
			/>
			<span class='version'><?php echo esc_html( 'v ' . FilterPlus::get_version() ); ?></span>
		</div>
	</a>
	<?php
		$filterplus_menus = array(
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
				'name' => esc_html__('Documentation','filter-plus' ),
				'url' => 'https://wpbens.com/docs/filter-plus/',
				'target' => '_blank',
			),
			array(
				'name' => esc_html__('Support', 'filter-plus' ),
				'url' => 'https://wpbens.com/support/',
				'target' => '_blank',
			),
			array(
				'name' => esc_html__( 'Feature Request', 'filter-plus' ),
				'url' => 'https://app.loopedin.io/filter-plus#/roadmap',
				'target' => '_blank',
			),

		);

		if ( ! class_exists( 'FilterPlusPro' ) ) {
			$filterplus_menus[] = array(
				'name' => esc_html__( 'Upgrade to Pro','filter-plus' ),
				'url' => 'https://wpbens.com/filter-plus/',
				'target' => '_blank',
			);
		}
		?>
	<div class="navigation">
		<?php
			$filterplus_filter_menus = array( 'filter-sets', 'filter-plus-settings' );
			// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Menu highlighting doesn't require nonce verification
			$filterplus_current_page = ! empty( $_GET['page'] ) ? sanitize_text_field( wp_unslash( $_GET['page'] ) ) : '';
		foreach ( $filterplus_menus as $filterplus_key => $filterplus_value ) {
			$filterplus_active = ( ! empty( $filterplus_value['slug'] ) && $filterplus_value['slug'] == $filterplus_current_page ) ? 'active' : '';
			$filterplus_class = $filterplus_value === end( $filterplus_menus ) ? 'upgrade_pro' : '';
			?>
				<li>
					<a class="<?php echo esc_attr( $filterplus_class ) . ' ' . esc_attr( $filterplus_active ); ?>" href="<?php echo esc_url( $filterplus_value['url'] ); ?>"
					 target="<?php echo esc_attr( $filterplus_value['target'] ); ?>">
						<?php echo esc_html($filterplus_value['name']);?>
					</a>
				</li>
				<?php
		}
		?>
	</div>
</header>