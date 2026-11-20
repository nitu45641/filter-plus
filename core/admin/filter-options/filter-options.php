<?php

    if ( ! defined( 'ABSPATH' ) ) exit;

    if ( file_exists( \FilterPlus::base_dir().'input-fields.php' ) ) {
        include_once \FilterPlus::base_dir().'input-fields.php';
    }
?>
<div id="filter-options-list-wrap">
    <div class="filter-set-page-head">
        <div class="filter-set-page-copy">
            <div class="filter-set-title-row">
                <h1><?php esc_html_e( 'Filter Options', 'filter-plus' ); ?></h1>
                <button type="button" class="button button-primary add-filter-opt">
                    <span class="filter-set-add-icon" aria-hidden="true">+</span>
                    <?php esc_html_e( 'Add New Filter Option', 'filter-plus' ); ?>
                </button>
            </div>
            <p><?php esc_html_e( 'Create custom field filters to use in your filter sets.', 'filter-plus' ); ?></p>
        </div>
    </div>

    <section class="filter-options-saved">
    <?php
        $filterplus_columns = array(
            'cb'        => '<input name="bulk-delete[]" type="checkbox" />',
            'type'      => esc_html__( 'Filter Type', 'filter-plus' ),
            'style'     => esc_html__( 'Style', 'filter-plus' ),
            'label'     => esc_html__( 'Label', 'filter-plus' ),
            'actions'   => esc_html__( 'Action', 'filter-plus' )
        );

        $filterplus_rules_list = array(
            'singular_name' => esc_html__( 'All Filter Options', 'filter-plus' ),
            'plural_name'   => esc_html__( 'All Filter Options', 'filter-plus' ),
            'columns'       => $filterplus_columns,
        );
    ?>
        <div class="filter-options-list">
            <form method="POST">
                <?php
                    $filterplus_table = new \FilterPlus\Core\Admin\FilterOptions\Table( $filterplus_rules_list );
                    $filterplus_table->preparing_items();
                    $filterplus_table->display();
                ?>
            </form>
        </div>
    </section>
</div>

<?php
    if ( file_exists(\FilterPlus::core_dir().'admin/filter-options/add-options.php') ) {
        include_once \FilterPlus::core_dir().'admin/filter-options/add-options.php';
    }
?>
