<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<h1 class="font_bold font_18"><?php esc_html_e('SEO Rules','filter-plus'); ?></h1>
<?php
$doc_url 	= '<a target="_blank" href="https://wpbens.com/docs/filter-plus/seo-rules/overview/"> [' . esc_html__( 'Documentation Link', 'filter-plus' ) . '] </a>';
$docs 		= '<div class="documentation mb-1"><i class="doc">' . esc_html__( 'SEO Rules', 'filter-plus' ) . $doc_url . '</i></div>';
echo wp_kses_post( $docs );

// SEO global settings
if (!function_exists('filter_seo_doc')) {
    function filter_seo_doc()  {
        $seo_docs  = '';
        $seo_docs .= '<div>'. esc_html__('Title :','filter-plus') .' '. htmlspecialchars('<title>' . esc_html__( 'This is an example SEO title', 'filter-plus' ) . '</title>').'</div>';
        $seo_docs .= '<div>'. esc_html__('Description :','filter-plus') .' '.htmlspecialchars('<meta name="description" content="'.esc_html__('Meta Description!','filter-plus').'"/>' ).'</div>';
        $seo_docs .= '<div>'. esc_html__('Header : H1 title can be generated automatically','filter-plus').'</div>';

        return $seo_docs;
    }
}


$hide_block = $refresh_url == 'no' ? 'd-none' : '';
$args = array(
	'label' => esc_html__( 'Refresh URL when Filtering', 'filter-plus' ),
	'id' => 'refresh_url',
	'data_label' => 'refresh-url',
	'checked' => $refresh_url,
	'checkbox_label' => __( 'URL will be updated when filter option is selected/changed', 'filter-plus' ),
	'disable' => $disable,
);

filter_plus_checkbox_field( $args );

$args = array(
	'label' => esc_html__( 'SEO elements:', 'filter-plus' ),
	'id' => 'seo_elements',
	'data_label' => 'seo-elements',
	'type' => 'random',
	'select_type' => 'multiple',
	'condition_class' => 'refresh_url ' . $hide_block . '',
	'options' => array(
		'title'         => __( 'Title', 'filter-plus' ),
		'header'        => __( 'Header', 'filter-plus' ),
		'description'   => __( 'Description', 'filter-plus' ),
	),
	'selected' => $seo_elements,
	'disable' => $disable,
	'docs' => filter_seo_doc(),
);

filter_plus_select_field( $args );

$args = array(
	'label' => esc_html__( 'SEO elements Format:', 'filter-plus' ),
	'id' => 'seo_elements_format',
	'data_label' => 'seo-elements-format',
	'condition_class' => 'refresh_url ' . $hide_block . '',
	'type' => 'random',
	'options' => array(
		__( 'Select Option', 'filter-plus' ),
		__( '{title} with [attribute] [values] and [attribute] [values]', 'filter-plus' ),
		__( '{title} - [values] / [values]', 'filter-plus' ),
		__( '[attribute]:[values];[attribute]:[values] - {title}', 'filter-plus' ),
		__( '{title} [attribute]:[values];[attribute]:[values]', 'filter-plus' )
	),
	'selected' => $seo_elements_format,
	'disable' => $disable,
);

filter_plus_select_field( $args );

$args = array(
	'label' => esc_html__( 'Use slug in URL', 'filter-plus' ),
	'condition_class' => 'refresh_url ' . $hide_block . '',
	'id' => 'seo_slug_url',
	'data_label' => 'seo-slug-url',
	'checked' => $seo_slug_url,
	'checkbox_label' => __( 'Use Slug in URL', 'filter-plus' ),
	'disable' => $disable,
);
filter_plus_checkbox_field( $args );

$nice_url_desc = '';
if ( class_exists( 'FilterPlusPro' ) ) {
	$nice_url_desc = __( 'SEO friendly URL. Wordpress permalink must be set to post name from (Settings=>Permalink)', 'filter-plus' );
}
$args = array(
	'label' => esc_html__( 'Nice Url', 'filter-plus' ),
	'id' => 'nice_url',
	'data_label' => 'nice-url',
	'checked' => $nice_url,
	'checkbox_label' => $nice_url_desc,
	'disable' => $disable,
);

filter_plus_checkbox_field( $args );
