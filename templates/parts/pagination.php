<?php
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- pagination -->
<div class="pagination-footer">
    <?php
        $count_template = array(6,7);
        if (
            $pagination_style !=='loadmore' && 
            in_array( $template, $count_template ) &&
            file_exists( FilterPlusPro::template_dir(). 'woo-filter/parts/filter-result-count.php' ) ) {
            include FilterPlusPro::template_dir(). 'woo-filter/parts/filter-result-count.php';
        }
    ?>
    <div class="naviation pagination-<?php echo esc_attr($template)?>"></div>
</div>