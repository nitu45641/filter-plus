
<?php

$features = array(
    array(
        'icon' =>'<span class="fr-icon dashicons dashicons-category"></span>',
        'title' =>esc_html__('Filter WooCommerce Product','filter-plus'),
        'desc' =>esc_html__('Unlock Powerful Filtering Options for Your Store.Easily Manage and Sort Products and Boost Sales','filter-plus')
    ),
    array(
        'icon' => '<span class="fr-icon dashicons dashicons-image-filter"></span>',
        'title' =>esc_html__('Filter WP Custom Post','filter-plus'),
        'desc' =>esc_html__('Simplify Content Management with the WordPress Custom Post Filters.Enhance User Experience by Filtering','filter-plus')
    ),
    array(
        'icon' =>'<span class="fr-icon dashicons dashicons-buddicons-groups"></span>',
        'title' =>esc_html__('Filter Woo Admin Order','filter-plus'),
        'desc' =>esc_html__('Improve Your WooCommerce Workflow with Order Filtering Master Order Management','filter-plus')
    ),
    array(
        'icon' => '<span class="fr-icon dashicons dashicons-admin-page"></span>',
        'title' =>esc_html__('SEO Optimized Url','filter-plus'),
        'desc' =>esc_html__('Boost Your Search Engine Rankings with Effective URL Optimization','filter-plus')
    ),
    array(
        'icon' =>'<span class="fr-icon dashicons dashicons-filter"></span>',
        'title' =>esc_html__('Filter by Multiple Custom Field','filter-plus'),
        'desc' =>esc_html__('Find the Best Deals with Multiple Custom Field.Easily Sort Products to Fit Your Budget.','filter-plus')
    ),
    array(
        'icon' =>'<span class="fr-icon dashicons dashicons-star-filled"></span>',
        'title' =>esc_html__('Multiple Product Filter Templates','filter-plus'),
        'desc' =>esc_html__('Quickly Find What You Need by Using More Effective product search templates','filter-plus')
    ),
    array(
        'icon' =>'<span class="fr-icon dashicons dashicons-menu-alt3"></span>',
        'title' =>esc_html__('Support Multiple Builder','filter-plus'),
        'desc' =>esc_html__('Support ShortCode,Elementor,BricksBuilder to setup best searching widgets,','filter-plus')
    ),
    array(
        'icon' =>'<span class="fr-icon dashicons dashicons-screenoptions"></span>',
        'title' =>esc_html__('Multiple Blog Filter Templates','filter-plus'),
        'desc' =>esc_html__('Enhance User experience with best Searching options.Easily Manage and Sort Your Content','filter-plus')
    ),
    array(
        'icon' =>'<span class="fr-icon dashicons dashicons-controls-repeat"></span>',
        'title' =>esc_html__('Many More Features','filter-plus'),
        'desc' =>esc_html__('Find the Best Deals with Our Price Range, Attributes, Tag, Taxonomies.Easily Sort Products to Fit Your Budget.','filter-plus')
    ),
);

$more_products = array(
    array(
        'icon' =>'<span class="fr-icon dashicons dashicons-controls-repeat"></span>',
        'url_demo' => 'https://woooplugin.com/ultimate-membership/',
        'url_free' => 'https://downloads.wordpress.org/plugin/create-members.latest-stable.zip',
        'title' =>esc_html__('Ultimate Membership','filter-plus'),
        'logo'   => 'quicker.png',
        'desc'   => esc_html__('Restrict content, manage member subscriptions','filter-plus'),
        'cta_free' =>esc_html__('Free Version','filter-plus'),
        'cta_demo' =>esc_html__('Premium Version','filter-plus')
    ),
    array(
        'icon'          =>'<span class="fr-icon dashicons dashicons-controls-repeat"></span>',
        'url_demo'      => 'https://woooplugin.com/discountify/',
        'url_free'      => 'https://downloads.wordpress.org/plugin/discountify.latest-stable.zip',
        'title'         =>esc_html__('Discount and Coupon Plugin','filter-plus'),
        'logo'          => 'discountify.png',
        'desc'   => esc_html__('Transform Discounts into Profits','filter-plus'),
        'cta_free'      =>esc_html__('Free Version','filter-plus'),
        'cta_demo'      =>esc_html__('Premium Version','filter-plus')
    ),
    array(
        'icon' =>'<span class="fr-icon dashicons dashicons-controls-repeat"></span>',
        'url_demo' => 'https://woooplugin.com/quicker/',
        'url_free' => 'https://downloads.wordpress.org/plugin/quicker.latest-stable.zip',
        'title' =>esc_html__('Quick Checkout Plugin','filter-plus'),
        'logo'   => 'quicker.png',
        'desc'   => esc_html__('Checkout in Seconds, Save Precious Time','filter-plus'),
        'cta_free' =>esc_html__('Free Version','filter-plus'),
        'cta_demo' =>esc_html__('Premium Version','filter-plus')
    ),
);

?>

<div class="over-view-wrapper">
    <div class="block first-block">
        <div class="left-block mb-5">
            <h1 class="first-header"><?php esc_html_e('Powerful Filtering Features for WordPress and WooCommerce','filter-plus');?></h1>
            <p><?php esc_html_e('Filter Plus is the WordPress and WooCommerce Product Filter Plugin. Allow users to filter and shortlist the products in the store easily and effortlessly. The plugin comes with WordPress post and custom post type filter anything functionality that increases the user experience.It also allows to filter WooCommerce admin order filter by product and order status.','filter-plus');?></p>
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
            <div class="block-header"><?php esc_html_e('Advanced Filtering Features','filter-plus');?></div>
            <p><?php esc_html_e('Available at Filter Plus Pro','filter-plus');?></p>
        </div>
        <div class="block-wrapper mb-5">
            <?php foreach ($features as $key => $value) { ?>
                <div class="single-item">
                        <?php echo FilterPlus\Utils\Helper::kses($value['icon']); ?>  
                        <h3><?php echo esc_html($value['title']); ?></h3>   
                        <p><?php echo esc_html($value['desc']); ?></p>   
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="block cta-block p-7 mb-5">
        <div class="heading-block">
            <h1 class="cta-block-header"><?php esc_html_e('Explore the premium version to experience our countless advanced features.','filter-plus');?></h1>
        </div>
        <div class="cta-action">
            <a target="_blank" href="https://www.woooplugin.com/filter-plus/">
                <button class="btn feature-cta"><?php esc_html_e('Look Into Pro','filter-plus');?></button>
            </a>
        </div>
    </div>
    <div class="more-products-section">
        <div class="more-product-header text-center pt-5 pb-2">
            <div class="block-header"><?php esc_html_e('More Plugins By The Same Team','filter-plus');?></div>
            <p><?php esc_html_e('We also have other solutions for growing your store conversion.','filter-plus');?></p>
        </div>
        <div class="card-wrapper mb-5">
            <?php foreach ($more_products as $key => $value) { ?>
                <div class="card-block">
                        <img src="<?php echo esc_url(FilterPlus::assets_url().'images/'.$value['logo']); ?> " 
                        alt="<?php echo esc_html($value['title']);?>"/>
                        <div class="description">
                            <div class="desc">
                                <a href="<?php echo esc_url($value['url_demo']); ?>" target="_blank"><h3><?php esc_html_e($value['title'],'filter-plus'); ?></h3></a>
                                <p><?php echo esc_html($value['desc']); ?></p>  
                            </div>
                            <div class="explore-plugin">
                                <a class="btn free-button" href="<?php echo esc_url($value['url_free']); ?>"  target="_blank"><?php esc_html_e($value['cta_free'],'filter-plus'); ?></a>  
                                <a class="btn pro-button" href="<?php echo esc_url($value['url_demo']); ?>"  target="_blank"><?php esc_html_e($value['cta_demo'],'filter-plus'); ?></a>  
                            </div>
                        </div>

                </div>
            <?php } ?>
        </div>
    </div>
</div>