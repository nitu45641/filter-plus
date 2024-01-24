<header class="menu">
    <div class="logo">
        <img src = "<?php echo FilterPlus::assets_url().'images/filter-plus-logo.png' ?>"
            alt="filter-plus-banner" 
            width="50px"
            height="50px"
        />
        <h1><?php esc_html_e('Filter Plus','filter-plus');?></h1>
    </div>
</header>

<?php
    $features = array(
        array(
            'icon' =>'<span class="fr-icon dashicons dashicons-format-aside"></span>',
            'title' =>esc_html__('Filter WP Post','filter-plus')
        ),
        array(
            'icon' => '<span class="fr-icon dashicons dashicons-image-filter"></span>',
            'title' =>'Filter WP Custom Post'
        ),
        array(
            'icon' =>'<span class="fr-icon dashicons dashicons-buddicons-groups"></span>',
            'title' =>'Filter Woo Admin Order'
        ),
        array(
            'icon' => '<span class="fr-icon dashicons dashicons-admin-page"></span>',
            'title' =>'SEO Optimized Url'
        ),
        array(
            'icon' =>'<span class="fr-icon dashicons dashicons-category"></span>',
            'title' =>'Filter by Categories'
        ),
        array(
            'icon' =>'<span class="fr-icon dashicons dashicons-filter"></span>',
            'title' =>'Filter by Price Range'
        ),
        array(
            'icon' =>'<span class="fr-icon dashicons dashicons-star-filled"></span>',
            'title' =>esc_html__('Filter by Ratings','filter-plus')
        ),
        array(
            'icon' =>'<span class="fr-icon dashicons dashicons-menu-alt3"></span>',
            'title' =>esc_html__('Filter by Attributes','filter-plus')
        ),
        array(
            'icon' =>'<span class="fr-icon dashicons dashicons-screenoptions"></span>',
            'title' =>esc_html__('Filter by Tags','filter-plus')
        ),
        array(
            'icon' =>'<span class="fr-icon dashicons dashicons-grid-view"></span>',
            'title' =>esc_html__('Filter by Stock','filter-plus')
        ),
        array(
            'icon' =>'<span class="fr-icon dashicons dashicons-align-wide"></span>',
            'title' =>esc_html__('Gutenburg Block','filter-plus')
        ),
        array(
            'icon' =>'<span class="fr-icon dashicons dashicons-controls-repeat"></span>',
            'title' =>esc_html__('+16 More Features','filter-plus')
        ),
    );
    $more_products = array(
        array(
            'icon'  =>'<span class="fr-icon dashicons dashicons-controls-repeat"></span>',
            'url'   => 'https://woooplugin.com/discountify/',
            'title' =>esc_html__('Discount and Coupon Plugin','filter-plus'),
            'logo'   => 'discountify-logo.png',
            'cta'   =>esc_html__('Explore The Plugin','filter-plus')
        ),
        array(
            'icon' =>'<span class="fr-icon dashicons dashicons-controls-repeat"></span>',
            'url' => 'https://woooplugin.com/quicker/',
            'title' =>esc_html__('Quick Checkout Plugin','filter-plus'),
            'logo'   => 'quicker-logo.png',
            'cta' =>esc_html__('Explore The Plugin','filter-plus')
        ),
    );
?>

<div class="over-view-wrapper">
    <div class="block first-block">
        <div class="left-block mb-5">
            <h1 class="first-header"><?php esc_html_e('Powerful Filtering Features for WordPress and WooCommerce','filter-plus');?></h1>
            <p><?php esc_html_e('Filter Plus is the WordPress and WooCommerce Product Filter Plugin. Allow users to filter and shortlist the products in the store easily and effortlessly. The plugin comes with WordPress filter anything functionality that increases the user experience.','filter-plus');?></p>
            <div class="cta">
            <a target="_blank" href="https://www.woooplugin.com/filter-plus/">
                <button class="btn ctn-button"><?php esc_html_e('Explore Filter Plus Pro','filter-plus');?></button>
            </a>
        </div>
        </div>
        <div class="right-block p-2">
            <img src = "<?php echo FilterPlus::assets_url().'images/filter-plus-banner.png' ?>"
                alt="filter-plus-banner" 
                width="500px"
            />
        </div>
    </div>
    <div class="features-section mt-5">
        <div class="text-center pt-5 pb-2">
            <h1 class="block-header"><?php esc_html_e('Advanced Filtering Features','filter-plus');?></h1>
            <p><?php esc_html_e('Available at Filter Plus Pro','filter-plus');?></p>
        </div>
        <div class="block-wrapper mb-5">
            <?php foreach ($features as $key => $value) { ?>
                <div class="single-item">
                        <?php echo FilterPlus\Utils\Helper::kses($value['icon']); ?>  
                        <h3><?php esc_html_e($value['title'],'filter-plus'); ?></h3>   
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="block cta-block p-7 mb-5">
        <div class="left-block">
            <h1 class="block-header"><?php esc_html_e('Explore the premium version to experience our countless advanced features.','filter-plus');?></h1>
        </div>
        <div class="right-block">
            <a target="_blank" href="https://www.woooplugin.com/filter-plus/">
                <button class="btn feature-cta ctn-button"><?php esc_html_e('Look Into Pro','filter-plus');?></button>
            </a>
        </div>
    </div>
    <div class="more-products-section">
        <div class="text-center pt-5 pb-2">
            <h1 class="block-header"><?php esc_html_e('More Plugins By The Same Team','filter-plus');?></h1>
            <p><?php esc_html_e('We also have other solutions for growing your store conversion.','filter-plus');?></p>
        </div>
        <div class="card-wrapper mb-5">
            <?php foreach ($more_products as $key => $value) { ?>
                <div class="card-block">
                        <img src="<?php echo esc_url(FilterPlus::assets_url().'images/'.$value['logo']); ?> " 
                        alt="<?php echo esc_html($value['title']);?>"
                        width="50px"
                        height="50px"
                        />
                        <div class="description">
                            <a href="<?php echo esc_url($value['url']); ?>"><h3><?php esc_html_e($value['title'],'filter-plus'); ?></h3> </a>  
                            <button class="btn bg-color ctn-button"><?php esc_html_e($value['cta'],'filter-plus'); ?></button>  
                        </div>

                </div>
            <?php } ?>
        </div>
    </div>
</div>