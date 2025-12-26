<?php

    if ( file_exists( \FilterPlus::base_dir().'input-fields.php' ) ) {
        include_once \FilterPlus::base_dir().'input-fields.php';
    }
  	$filterplus_disable    = class_exists('FilterPlusPro') ? '' : 'disable';
	$filterplus_settings 	= \FilterPlus\Utils\Helper::get_settings();
    extract($filterplus_settings);

    $filterplus_tabs = array(
		'settings'      => esc_html__( 'General Settings', 'filter-plus' ),
		'woo-order'     => esc_html__( 'Woo Order', 'filter-plus' ),
		'seo'           => esc_html__( 'SEO', 'filter-plus' ),
	);
	$filterplus_tab_content = array('settings','woo-order','seo');
?>
<div class="settings_message d-none"></div>
<form id="filter-settings">
    <div class="content-header">
        <div class="title-wrap"><?php esc_html_e('Settings','filter-plus');?></div>
    </div>
    <div class="content-wrapper">
        <div class="settings_tab">
            <ul class="settings_tab_pan">
                <?php foreach ($filterplus_tabs as $filterplus_key => $filterplus_value) {
                    $filterplus_active = $filterplus_key == "settings" ? "active" : "";
                ?>
                    <li class="<?php echo esc_attr( $filterplus_active )?>" data-item="<?php echo esc_attr( $filterplus_key );?>"><?php echo esc_html( $filterplus_value ); ?></li>
                <?php } ?>
            </ul>
            <div class="tab-content">
                <?php foreach ($filterplus_tab_content as $filterplus_key => $filterplus_value) {
                    $filterplus_active = $filterplus_value == "settings" ? "active tab-wrapper" : "tab-wrapper"; ?>
                <div id="<?php echo esc_attr( $filterplus_value )?>" class="<?php echo esc_attr( $filterplus_active )?>">
                    <?php
                        if (file_exists( \FilterPlus::core_dir()."admin/settings/tab-content/".$filterplus_value.".php") ) {
                            include_once \FilterPlus::core_dir()."admin/settings/tab-content/".$filterplus_value.".php";
                        }
                    ?>
                </div>
                <?php } ?>
            </div>
        </div>
        <button class="button button-primary admin-button"><?php esc_html_e( 'Save Changes','filter-plus' )?></button>
	</div>
</form>
