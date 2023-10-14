<?php

if ( ! defined( 'ABSPATH' ) ) exit;

?>
<div class="sorting">
	<div class="showing">
		<p><?php esc_html_e('Showing','filter-plus')?> <span class="pages">1</span><span><?php esc_html_e(' of','filter-plus')?> </span><span class="total"></span> <?php esc_html_e('Products','filter-plus')?></p>
	</div>
	<?php if( 'yes' == $sorting ): ?>
		<?php include_once \FilterPlus::plugin_dir() . "templates/search-filter/sort-option.php"; ?>
	<?php endif; ?>
</div>
