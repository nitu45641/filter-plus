<header class="menu">
    <a href='https://woooplugin.com/filter-plus/' target="_blank">
        <div class="logo">
            <img src = "<?php echo FilterPlus::assets_url().'images/filter-plus-logo.png' ?>"
                alt="filter-plus-banner" 
                width="50px"
                height="50px"
            />
            <h1><?php esc_html_e('Filter Plus','filter-plus');?></h1>
            <span class='version'><?php echo esc_html('v ').FilterPlus::get_version();?></span>
        </div>
    </a>
    <?php
        $menus = array( 
            array(
                'name' => 'Filter Sets',
                'url' => admin_url().'admin.php?page=filter-sets',
                'slug'=>'filter-sets',
                'target'=>'_self'
            ),
            array(
                'name' => 'Settings',
                'url' => admin_url().'admin.php?page=filter-plus-settings',
                'slug'=>'filter-plus-settings',
                'target'=>'_self'
            ),
            array(
                'name' => 'Support',
                'url' => 'https://woooplugin.com/support/',
                'target'=>'_blank'
            ),
            array(
                'name' => esc_html__('Feature Request','filter-plus'),
                'url' => 'https://woooplugin.com/ideas/',
                'target'=>'_blank'
            ),
            array(
                'name' => esc_html__('Upgrade to Pro','filter-plus'),
                'url' => 'https://woooplugin.com/filter-plus/',
                'target'=>'_blank'
            )
        );
    ?>
    <div class="navigation">
        <?php
            $filter_menus= ['filter-sets','filter-plus-settings'];
            $current_page = !empty($_GET['page']) ? $_GET['page'] : '';
            foreach ($menus as $key => $value) {
                $active = (!empty($value['slug']) && $value['slug'] == $current_page ) ? 'active' : '';
                $class= $value === end( $menus ) ? 'upgrade_pro':'';
                ?>
                <li>
                    <a class="<?php echo esc_attr($class).' '.esc_attr($active);?>" href="<?php echo esc_url($value['url'])?>"
                     target="<?php echo esc_attr($value['target']); ?>">
                    <?php echo __( $value['name'] , 'filter-plus') ?>
                    </a>
                </li>
                <?php
            }
        ?>
    </div>
</header>