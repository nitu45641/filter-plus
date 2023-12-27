
<h2 class="content-header"><?php esc_html_e("Filter Sets","filter-plus");?></h2>
<section class="accordion">
  <ul class="accordion-list">
    <?php 
    include_once \FilterPlus::core_dir() . "admin/settings/shortocdes-fields.php"; 
    $disable      = class_exists('FilterPlusPro') ? false : true;
    $settings 		= \FilterPlus\Utils\Helper::get_settings();
    extract($settings);
  
    $tabs = array(
        array(
          'label' => esc_html__("Wordpress Filter","filter-plus"),
          'path' => \FilterPlus::core_dir()."admin/wp-filter.php"
        ),
        array(
          'label' => esc_html__("WooCommerce Filter","filter-plus"),
          'path' => \FilterPlus::core_dir()."admin/settings/tab-content/short-codes.php"
        )
      );
    foreach ($tabs as $key => $value) { 
      ?>
        <li class="accordion-item">
          <input type="checkbox" id="collapse-<?php echo esc_attr($key);?>" class="accordion-button">
          <label for="collapse-<?php echo esc_attr($key);?>" class="accordion-header">
            <p class="font_bold"><?php echo esc_html($value['label']);?></p>
            <p class="closed">+</p>
            <p class="opened">-</p>
          </label>

          <section class="content">
            <?php include_once $value['path']; ?>
          </section>
        </li>
    <?php } ?>
  </ul>
</section>