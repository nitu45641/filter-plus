<?php 

	include_once \FilterPlus::core_dir() . "admin/settings/shortocdes-fields.php"; 
	$disable    = class_exists('FilterPlusPro') ? false : true;
	$settings 	= \FilterPlus\Utils\Helper::get_settings();
    extract($settings);

    $tabs = array(
		'settings'      => esc_html__( 'General Settings', 'filter-plus' ),
		'woo-order'     => esc_html__( 'Woo Order', 'filter-plus' ),
		'seo'           => esc_html__( 'SEO', 'filter-plus' ),
	);
	$tab_content = array('settings','woo-order','seo');
?>
<div class="settings_message d-none"></div>
<form id="filter-settings">
    <h2 class="content-header"><?php esc_html_e("Settings","filter-plus");?></h2>
    <div class="content-wrapper">
        <div class="settings_tab">
            <ul class="settings_tab_pan">
                <?php foreach ($tabs as $key => $value) { 
                    $active = $key == "settings" ? "active" : "";
                ?>
                    <li class="<?php echo esc_attr( $active )?>" data-item="<?php echo esc_attr( $key );?>"><?php echo($value) ?></li>
                <?php } ?>
            </ul>
            <div class="tab-content">
                <?php foreach ($tab_content as $key => $value) { 
                    $active = $value == "settings" ? "active tab-wrapper" : "tab-wrapper"; ?>
                <div id="<?php echo esc_attr( $value )?>" class="<?php echo esc_attr( $active )?>">
                    <?php 
                        if (file_exists( \FilterPlus::core_dir()."admin/settings/tab-content/".$value.".php") ) {
                            include_once \FilterPlus::core_dir()."admin/settings/tab-content/".$value.".php"; 
                        }
                    ?>
                </div>
                <?php } ?>
            </div>	
        </div>
        <button class="button button-primary admin-button mt-3">Save Changes</button>
	</div>
</form>