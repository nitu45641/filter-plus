<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<?php if( get_the_title() !=='' ) : ?>
<span class="fplus-title" data-page_title="<?php echo esc_attr( get_the_title() ); ?>"></span>
<?php endif;?>

<?php
$filterplus_not_in = array('5','2','6','7');
if( !in_array($template,$filterplus_not_in)  ) : ?>
<div class="filter-mb filter-mb-search"></div>
<?php endif; ?>
<div class="filter-top">
    <?php
    $filterplus_templates = array('1','5');
    ?>
    <?php if( in_array( $template , $filterplus_templates) ) : ?>
    <div class="selected-filter"></div>
    <?php endif; ?>
    <div class="showing">
        <p>
            <?php esc_html_e('Showing','filter-plus')?>
            <span class="pages">1</span><span><?php esc_html_e(' of','filter-plus')?></span>
            <span class="total"></span>
            <?php esc_html_e('Items','filter-plus')?>
        </p>
    </div>
    <?php if( !in_array( $template , $filterplus_templates) ) : ?>
    <div class="selected-filter"></div>
    <?php endif; ?>
</div>