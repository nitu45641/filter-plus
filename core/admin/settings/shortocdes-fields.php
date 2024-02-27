<?php

if ( ! defined( 'ABSPATH' ) ) exit;

if ( !function_exists('pro_tag_markup') ) {
	function pro_tag_markup($disable,$class="") {
		$pro_only     = !empty($disable) ? "pro-fr" : "";
		$pro		  = "";
		if ( $pro_only !== "" ) {
			$pro .= '<span class="'.esc_attr($pro_only." ".$class).'">'. esc_html__( 'Pro', 'filter-plus' ) .'</span>';

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
		$condition_class= !empty($args['condition_class']) ? $args['condition_class'] : '';
		$disable    	= !empty($args['disable']) ? 'disable' : '';
		$checkbox_label = !empty($args['checkbox_label']) ? $args['checkbox_label'] : '';
		$checked      	= ( !empty($args['checked']) && $args['checked'] == "yes") ? "checked" : "";
		extract(pro_link_markup($disable));
		$html = '
			<div class="single-block '.$condition_class.'">
				<div class="form-label">'.$args['label'].'</div>
				'.$pro_link_start.'
				<div class="check-wrap">
					<label class="input-section custom-switcher '.$disable.'">
					<input type="checkbox" class="switcher-ui-toggle" id="'.$args['id'].'"
						name="'.$args['id'].'" value="yes"  '.$checked.'
						data-label="'.$args['data_label'].'"
						/>
						<span class="slider round"></span>
					</label>
					<span class="ml-1">'.$checkbox_label.'</span>
				</div>
				'.pro_tag_markup($disable).'
				'.$pro_link_end.'
			</div>
		';

		echo FilterPlus\Utils\Helper::kses($html);
	}
}

/**
 * Number/Text/Hidden
 */
if ( !function_exists('filter_plus_number_input_field') ) {
	function filter_plus_number_input_field( $args ) {
		$id           = !empty($args['id']) ? $args['id'] : '';
		$wrapper_class= !empty($args['wrapper_class']) ? $args['wrapper_class'] : 'single-block';
		$label_class= !empty($args['label_class']) ? $args['label_class'] : 'form-label';
		$value        = !empty($args['value']) ? $args['value'] : '';
		$label        = !empty($args['label']) ? $args['label'] : '';
		$field_type   = !empty($args['field_type']) ? $args['field_type'] : 'text';
		$condition_class   	= !empty($args['condition_class']) ? $args['condition_class'] : '';
		$disable   	  		= !empty($args['disable']) ? $args['disable'] : '';
		$extra_label   	  	= !empty($args['extra_label']) ? $args['extra_label'] : '';
		$placeholder   	  	= !empty($args['placeholder']) ? $args['placeholder'] : '';
		$extra_label_class 	= !empty($args['extra_label_class']) ? $args['extra_label_class'] : '';
		$hidden_class		= $field_type == 'hidden' ? 'd-none' : '';
		$html = '
		<div class="'.$wrapper_class.' '.$condition_class.' '.$hidden_class.'">
			<div class="'.$label_class.'">'.$label.'</div>
			<div class="input-section '.$disable.'">
				<input type="'.$field_type.'" name="'.$id.'" id="'.$id.'" value="'.$value.'"  
					data-option="'.$args['data_label'].'" 
					placeholder="'.$placeholder.'"
				/>
				<span class="extra-label '.$extra_label_class.'">'.$extra_label.'</span>
			</div>
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
		$selected	  = !empty($args['selected']) ? $args['selected'] : '';

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
				foreach($args['options'] as $key => $item):
					$disabled = !empty($disable) ? 'disabled' : '';
					if (is_array($selected)) {
						$select_opt = in_array($key,$selected)  ? 'selected' : '';
					}else{
						$select_opt = $key == $selected ? 'selected' : '';
					}
					$pro_text = !empty($disabled) ? ' ('.esc_html__('Pro','filter-plus').')' : '';
					$options_html .= '<option '.$disabled.' '. $select_opt .' '. $disabled.' value="'.$key.'">'. $item  . $pro_text .'</option>';
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
		$condition_class = !empty($args['condition_class']) ? $args['condition_class'] : '';
		$html = '
			<div class="single-block '.$condition_class.'">
				<div class="form-label">'.$args['label'].'</div>
				<div class="input-section">
					<select class="pro-'.$disable.'" name="'.$args['id'].'" id="'.$args['id'].'" data-option="'.$args['data_label'].'" '. $select_type .'>'.$options_html.'</select>
					'.pro_tag_markup($disable,'select-pro-fr').'
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
