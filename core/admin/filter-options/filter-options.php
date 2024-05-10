
<?php 

    if ( ! defined( 'ABSPATH' ) ) exit; 

    if ( file_exists( \FilterPlus::core_dir().'admin/settings/settings-fields.php' ) ) {
        include_once \FilterPlus::core_dir().'admin/settings/settings-fields.php'; 
    }
?>
<div class="mt-2">
	<button class="button button-primary add-new-options"><?php esc_html_e('Add Filter Options', 'filter-plus' );?></button>
	<button class="button button-primary view-options d-none"><?php esc_html_e('View Filter Options', 'filter-plus' );?></button>
</div>
<?php
    if ( file_exists(\FilterPlus::core_dir().'admin/filter-options/add-options.php') ) {
        include_once \FilterPlus::core_dir().'admin/filter-options/add-options.php'; 
    }
?>
<div class="filter-options">
<?php
	/**
	 * Shows Rules
	 */
    $columns = array(
        'type'      => esc_html__( 'Filter Type', 'filter-plus' ),
        'style'     => esc_html__( 'Style', 'filter-plus' ),
        'label'     => esc_html__( 'Label', 'filter-plus' )
    );

    $rules_list = array(
        'singular_name' => esc_html__( 'All Filter Options', 'filter-plus' ),
        'plural_name'   => esc_html__( 'All Filter Options', 'filter-plus' ),
        'columns'       => $columns,
    );

    ?>
    <div class="filter-options-list">
        <form method="POST">
            <?php
                $table = new \FilterPlus\Core\Admin\FilterOptions\Table( $rules_list );
                $table->preparing_items();
                $table->display();
            ?>
        </form>
    </div>

</div>
