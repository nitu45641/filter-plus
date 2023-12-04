<?php 
	include_once \FilterPlus::core_dir() . "admin/settings/shortocdes-fields.php"; 
	$disable = class_exists('FilterPlusPro') ? false : true;

	$settings 		= \FilterPlus\Utils\Helper::get_settings();

	$tabs = array(
		'short_codes' => esc_html__( 'Shortcodes', 'filter-plus' ),
    );
?>
<div class="settings_message"></div>
<form id="save_settings">
    <h2 class="content-header"><?php esc_html_e("Settings","filter-plus");?></h2>
    <div class="content-wrapper">
        <div class="settings_tab">
            <ul class="settings_tab_pan">
                <?php foreach ($tabs as $key => $value) { 
                    $active = $key == "short_codes" ? "active" : "";
                ?>
                    <li class="<?php echo esc_attr( $active )?>" data-item="<?php echo esc_attr( $key );?>"><?php echo($value) ?></li>
                <?php } ?>
            </ul>
            <div class="tab-content">
                <div id="short_codes" class="active">
                    <?php 
                        include_once \FilterPlus::core_dir()."admin/settings/tab-content/shortcodes.php"; 
                    ?>
                </div>	
            </div>
        </div>
	</div>
</form>