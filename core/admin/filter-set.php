<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<div id="filter-set-list-wrap">
  <div class="mt-2 content-header">
    <div class="title mr-1"><?php esc_html_e( 'Filter Sets', 'filter-plus' ); ?></div>
    <button type="button" class="button add-filter-set"><?php esc_html_e( 'Add New Filter Set', 'filter-plus' ); ?></button>
  </div>

  <section class="filter-sets-saved mt-2">
    <div class="filter-options-list">
      <form method="POST">
        <?php
          $filterplus_set_columns = array(
            'cb'        => '<input name="bulk-delete[]" type="checkbox" />',
            'name'      => esc_html__( 'Name', 'filter-plus' ),
            'shortcode' => esc_html__( 'Shortcode', 'filter-plus' ),
          );

          $filterplus_set_list = array(
            'singular_name' => esc_html__( 'Filter Set', 'filter-plus' ),
            'plural_name'   => esc_html__( 'Filter Sets', 'filter-plus' ),
            'columns'       => $filterplus_set_columns,
          );

          $filterplus_set_table = new \FilterPlus\Core\Admin\FilterSets\Table( $filterplus_set_list );
          $filterplus_set_table->preparing_items();
          $filterplus_set_table->display();
        ?>
      </form>
    </div>
  </section>
</div>

<div id="filter-set-form-wrap" class="d-none mt-2">
  <div class="content-header mb-2">
    <div class="title mr-1"><?php esc_html_e( 'Add New Filter Set', 'filter-plus' ); ?></div>
    <button type="button" class="button close-filter-set-form"><?php esc_html_e( '← Back', 'filter-plus' ); ?></button>
  </div>
  <div class="single-block save-filter-set-block">
    <input type="text" class="full_input filter-set-name-input" placeholder="<?php esc_attr_e( 'Enter Filter Set Name', 'filter-plus' ); ?>">
    <button type="button" class="button save-filter-set"><?php esc_html_e( 'Save As Filter Set', 'filter-plus' ); ?></button>
  </div>
  <section class="accordion">
    <div class="accordion-list">
      <?php

        if ( file_exists( \FilterPlus::base_dir().'input-fields.php' ) ) {
          include_once \FilterPlus::base_dir().'input-fields.php';
        }
        $filterplus_disable      = class_exists('FilterPlusPro') ? false : true;
        $filterplus_settings 		= \FilterPlus\Utils\Helper::get_settings();
        extract($filterplus_settings);

      $filterplus_tabs = array(
          array(
            'name'  => 'filter_products',
            'label' => esc_html__("WooCommerce Filter","filter-plus"),
            'path' => \FilterPlus::core_dir()."admin/settings/tab-content/short-codes.php"
          ),
          array(
            'name'  => 'wp_filter_plus',
            'label' => esc_html__("Wordpress Filter","filter-plus"),
            'path' => \FilterPlus::core_dir()."admin/wp-filter.php"
          )
      );

      foreach ($filterplus_tabs as $filterplus_key => $filterplus_value) {
        $filterplus_active_class = $filterplus_key == 0 ? 'active' : '';
        ?>
          <div class="accordion-item <?php echo esc_attr($filterplus_active_class);?>" data-name="<?php echo esc_attr($filterplus_value['name']);?>">
              <div class="title"><?php echo esc_html($filterplus_value['label']);?></div>
            </label>
          </div>
      <?php
      }
      ?>
    </div>
    <?php foreach ($filterplus_tabs as $filterplus_key => $filterplus_value) {
      $filterplus_active_class = $filterplus_key == 0 ? 'active' : '';
    ?>
        <section class="filter-set-content <?php echo esc_attr($filterplus_active_class);?>" data-name="<?php echo esc_attr($filterplus_value['name']);?>">
            <?php
            if ( file_exists($filterplus_value['path'])) {
                include_once $filterplus_value['path'];
            }
            ?>
        </section>
    <?php } ?>
  </section>
</div>
