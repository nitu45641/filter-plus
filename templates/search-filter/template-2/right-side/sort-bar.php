<?php

if ( ! defined( 'ABSPATH' ) ) exit;

?>
<div class="sorting">
	<?php if( 'yes' == $sorting ): ?>
		<?php include_once \FilterPlus::plugin_dir() . "templates/search-filter/sort-option.php"; ?>
	<?php endif; ?>
</div>
