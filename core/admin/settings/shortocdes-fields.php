<?php

if ( ! defined( 'ABSPATH' ) ) exit;

if ( !function_exists('pro_tag_markup') ) {
	function pro_tag_markup($disable,$class="") {
		$pro_only     = !empty($disable) ? "pro-fr" : "";
		$pro		  = "";
		if ( $pro_only !== "" ) {
			$pro .= '<a href="'.esc_url('https://woooplugin.com/filter-plus/').'" class="pr-tag"><span class="'.esc_attr($pro_only." ".$class).'">'. esc_html__( 'Pro', 'filter-plus' ) .'</span></a>';

		}

		return $pro;
	}
}
if ( !function_exists('pro_link_markup') ) {
	function pro_link_markup($disable,$class="") {
		$pro_link_start	= '';
		$pro_link_end	= '';
		if (!empty($disable)) {
			$pro_link_start	= '<a class="pro-link" target="_blank" href="'.esc_url('https://woooplugin.com/filter-plus/').'">';
			$pro_link_end	= '</a>';
		}

		return array('pro_link_start' => $pro_link_start , 'pro_link_end'=>$pro_link_end);
	}
}
if ( !function_exists('filter_plus_checkbox_field') ) {

	function filter_plus_checkbox_field($args){
		$disable    	= !empty($args['disable']) ? 'disable' : '';
		$checked      = ( !empty($args['checked']) && $args['checked'] == "yes") ? "checked" : "";
		extract(pro_link_markup($disable));
		$html = '
			<div class="single-block">
				<div class="form-label">'.$args['label'].'</div>
				'.$pro_link_start.'
				<label class="input-section custom-switcher '.$disable.'">
				<input type="checkbox" class="switcher-ui-toggle" id="'.$args['id'].'"
					name="'.$args['id'].'" value="yes"  '.$checked.'
					data-label="'.$args['data_label'].'"
					/>
					<span class="slider round"></span>
				</label>
				'.pro_tag_markup($disable).$pro_link_end.'
			</div>
		';

		echo FilterPlus\Utils\Helper::kses($html);
	}
}

if ( !function_exists('filter_plus_select_field') ) {
	function filter_plus_select_field($args){
		$count_option = is_array($args['options']) ? count($args['options']) : 0 ;
		$options_html = "";
		$disable      = !empty($args['disable']) ? 'disable' : '';
		$template_disable 	= !empty($args['template_disable']) && is_array($args['options']) ? $args['template_disable'] : $count_option + 1;
		$select_type  		= !empty($args['select_type']) ? $args['select_type'] : '';
		extract(pro_link_markup($disable));
		if (!empty($args['type']) && "attributes" == $args['type'] ) {
			if ( !empty( $args['options'] ) ) :
				foreach($args['options'] as $item): 
					$options_html .= '<option value="'.$item->attribute_id.'">'.$item->attribute_label.'</option>';
				endforeach; 
			endif;
		}
		else if (!empty($args['type']) && ( "template" == $args['type'] ) ) {
			$select_type = "";
			if ( !empty( $args['options'] ) ) :
				foreach($args['options'] as $item):
					$disabled = (int) $item > $template_disable ? 'disabled' : '';
					$pro_text = !empty($disabled) ? ' ('.esc_html__('Pro','filter-plus').')' : '';
					$options_html .= '<option '.$disabled.' value="'.$item.'">'.esc_html__('Template','filter-plus')."-". $item . $pro_text.'</option>';
				endforeach; 
			endif;
		}
		else if (!empty($args['type']) && ( "random" == $args['type']) ) {
			if ( !empty( $args['options'] ) ) :
				foreach($args['options'] as $item):
					$disabled = !empty($disabled) ? 'disabled' : '';
					$options_html .= '<option '.$disabled.' value="'.$item.'">'. $item .'</option>';
				endforeach; 
			endif;
		}
		else{
			if( !class_exists('WooCommerce')){
				return;
			}
			if ( !empty( $args['options'] ) ) :
				foreach($args['options'] as $item): 
					$options_html .= '<option value="'.$item->term_id.'">'.$item->name.'</option>';
				endforeach; 
			endif;
		}
	
	
		$condition_class = !empty($args['condition_class']) ? $args['condition_class'] : "";
		$html = '
			<div class="single-block '.$condition_class.'">
				<div class="form-label">'.$args['label'].'</div>
				<div class="input-section">
					'.$pro_link_start.'
					<select id="'.$args['id'].'" data-option="'.$args['data_label'].'" '. $select_type .'>'.$options_html.'</select>
					'.pro_tag_markup($disable,"ml-15").'
					'.$pro_link_end.'
				</div>
			</div>
		';
		
		$docs ="";
		if ( !empty( $args['docs'] ) ) {
			$docs = doc_html( $args['docs'] );
		}
		echo FilterPlus\Utils\Helper::kses($html . $docs );
	}
}

if ( !function_exists('doc_html') ) {
	function doc_html($text){
		$html = '
			<div class="single-block">
				'.$text.'
			</div>
		';

		echo $html;
	}
}
