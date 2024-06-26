
<h2 class="content-header"><?php esc_html_e("Filter Sets","filter-plus");?></h2>
<section class="accordion">
  <div class="accordion-list">
    <?php 
    
      if ( file_exists( \FilterPlus::base_dir().'input-fields.php' ) ) {
        include_once \FilterPlus::base_dir().'input-fields.php'; 
      }
      $disable      = class_exists('FilterPlusPro') ? false : true;
      $settings 		= \FilterPlus\Utils\Helper::get_settings();
      extract($settings);
  
    $tabs = array(
        array(
          'label' => esc_html__("WooCommerce Filter","filter-plus"),
          'path' => \FilterPlus::core_dir()."admin/settings/tab-content/short-codes.php"
        ),
        array(
          'label' => esc_html__("Wordpress Filter","filter-plus"),
          'path' => \FilterPlus::core_dir()."admin/wp-filter.php"
        )
    );

    foreach ($tabs as $key => $value) { 
      $active_class = $key == 0 ? 'active' : '';
      ?>
        <div class="accordion-item <?php echo esc_attr($active_class);?>">
            <div class="title"><?php echo esc_html($value['label']);?></div>
          </label>
        </div>
    <?php 
    }  
    ?>
  </div>
  <?php foreach ($tabs as $key => $value) { 
    $active_class = $key == 0 ? 'active' : '';
  ?>
      <section class="filter-set-content <?php echo esc_attr($active_class);?>" >
          <?php 
          if ( file_exists($value['path'])) {
              include_once $value['path']; 
          }
          ?>
      </section>
  <?php } ?>
</section>