<?php
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- pagination -->
<div class="pagination-footer">
    <?php
        if (
            $pagination_style !== 'loadmore' &&
            in_array( $template, array( 6, 7 ), true ) &&
            file_exists( FilterPlusPro::template_dir() . 'woo-filter/parts/filter-result-count.php' ) ) {
            include FilterPlusPro::template_dir() . 'woo-filter/parts/filter-result-count.php';
        }
    ?>
    <div class="naviation pagination-<?php echo esc_attr($template)?>"></div>
</div>