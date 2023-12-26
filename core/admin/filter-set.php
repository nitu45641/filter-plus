<?php
	include_once \FilterPlus::core_dir() . "admin/settings/shortocdes-fields.php"; 
	$disable = class_exists('FilterPlusPro') ? false : true;

	$settings 		= \FilterPlus\Utils\Helper::get_settings();
    extract($settings);
?>
<h2 class="content-header"><?php esc_html_e("Filter Sets","filter-plus");?></h2>
<section class="accordion">
  <ul class="accordion-list">
    <li class="accordion-item">
      <input type="checkbox" id="collapse-1" class="accordion-button">
      <label for="collapse-1" class="accordion-header">
        <p class="font_bold"><?php esc_html_e("Wordpress Filter","filter-plus");?></p>
        <p class="closed">+</p>
        <p class="opened">-</p>
      </label>

      <section class="content">
        <?php echo "wordpress filter"; ?>
      </section>
    </li>
    <li class="accordion-item">
      <input type="checkbox" id="collapse-2" class="accordion-button">
      <label for="collapse-2" class="accordion-header">
        <p class="font_bold"><?php esc_html_e("WooCommerce Filter","filter-plus");?></p>
        <p class="closed">+</p>
        <p class="opened">-</p>
      </label>

      <section class="content">
        <?php include_once \FilterPlus::core_dir()."admin/settings/tab-content/short-codes.php"; ?>
      </section>
    </li>
  </ul>
</section>