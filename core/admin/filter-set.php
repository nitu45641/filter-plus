<h2 class="content-header"><?php esc_html_e("Filter Sets","filter-plus");?></h2>
<?php
	/**
	 * Shows Rules
	 *
	 * @return void
	 */
    all_rules();
    function all_rules() {
        $columns = [
			'title'         => esc_html__( 'Title', 'filter-plus' ),
            'type'          => esc_html__( 'Type', 'filter-plus' ),
            'shortcode'     => esc_html__( 'Shortcode', 'filter-plus' ),
            'actions'     	=> esc_html__( 'Actions', 'filter-plus' ),
        ];

        $filter_sets = [
            'singular_name' => esc_html__( 'All Filter Set', 'filter-plus' ),
            'plural_name'   => esc_html__( 'All Filter Sets', 'filter-plus' ),
            'columns'       => $columns,
        ];

        ?>
        <button class="mt-3"><?php esc_html_e('Add Filter Set', 'filter-plus');?></button>
        <form method="POST">
            <?php
                $table = new \FilterPlus\Core\Admin\FilterSetTable( $filter_sets );
                $table->preparing_items();
                $table->display();
            ?>
        </form>
		<?php
	}
?>