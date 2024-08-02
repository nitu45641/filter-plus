<?php

if ( ! defined( 'ABSPATH' ) ) exit;
?>
<div class="title-and-clean-area">
	<?php if($title !== ''): ?>
	<h2 class="m-0"><?php echo esc_html($title);?></h2>
	<?php endif; ?>

	<p class="clear_all"><?php echo esc_html__("Clean All","filter-plus");?></p>
</div>