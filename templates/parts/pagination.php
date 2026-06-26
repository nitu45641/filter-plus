<?php
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals -- template file included in function scope
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- pagination -->
<div class="pagination-footer">
    <?php
        if (
            $pagination_style !== 'loadmore' &&
            in_array( $template, array( 6, 7 ), true ) &&
            ( $_fp_tpl = \FilterPlusPro::locate_template( 'woo-filter/parts/filter-result-count.php' ) ) && file_exists( $_fp_tpl ) ) {
            include $_fp_tpl;
        }
    ?>
    <div class="naviation pagination-<?php echo esc_attr($template)?>"></div>
</div>