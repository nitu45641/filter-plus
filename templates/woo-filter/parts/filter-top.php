
<h1 class="fplus-title" data-page_title="<?php echo get_the_title(); ?>"></h1>

<?php if( $template !== '5' ) : ?>
<div class="filter-mb-search"></div>
<?php endif; ?>
<div class="filter-top">
    <?php
    $templates = array('1','5');
    ?>
    <?php if( in_array( $template , $templates) ) : ?>
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
    <?php if( !in_array( $template , $templates) ) : ?>
    <div class="selected-filter"></div>
    <?php endif; ?>
</div>