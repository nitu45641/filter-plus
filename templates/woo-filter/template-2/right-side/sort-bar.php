<?php

if ( ! defined( 'ABSPATH' ) ) exit;

?>
<div class="sorting">
	<?php if( 'yes' == $sorting ): ?>
		<?php include_once \FilterPlus::locate_template( "woo-filter/sort-option.php" ); ?>
	<?php endif; ?>
</div>
