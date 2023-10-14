<?php

if ( ! defined( 'ABSPATH' ) ) exit;

if ( !function_exists('filter_plus_checkbox_field') ) {

	function filter_plus_checkbox_field($args){
		$disable      = !empty($args['disable']) ? "disable" : "";
		$html = '
			<div class="single-block">
				<div class="shortcode-label">'.$args['label'].'</div>
				<div class="shortcode-section '.$disable.'">
					<input type="checkbox" class="filter-ui-toggle" id="'.$args['id'].'" data-label="'.$args['data_label'].'"
					name="'.esc_attr($args['id']).'" value="" '.esc_attr('checked').' sdfsdf/>
				</div>
			</div>
		';

		echo FilterPlus\Utils\Helper::filter_plus_kses($html);
	}
}

if ( !function_exists('filter_plus_select_field') ) {
	function filter_plus_select_field($args){
		$count_option = is_array($args['options']) ? count($args['options']) : 0 ;
		$options_html = "";
		$disable      = !empty($args['disable']) ? 'disable' : '';
		$template_disable = !empty($args['template_disable']) && is_array($args['options']) ? $args['template_disable'] : $count_option + 1;
		$select_type  = "multiple";
	
		if (!empty($args['type']) && "attributes" == $args['type'] ) {
			if ( !empty( $args['options'] ) ) :
				foreach($args['options'] as $item): 
					$options_html .= '<option value="'.$item->attribute_id.'">'.$item->attribute_label.'</option>';
				endforeach; 
			endif;
		}
		else if (!empty($args['type']) && "template" == $args['type'] ) {
			$select_type = "";
			if ( !empty( $args['options'] ) ) :
				foreach($args['options'] as $item):
					$disabled = (int) $item > $template_disable ? 'disabled' : '';
					$options_html .= '<option '.$disabled.' value="'.$item.'">'.esc_html__('Template','filter-plus')."-".$item.'</option>';
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
				<div class="shortcode-label">'.$args['label'].'</div>
				<div class="shortcode-section '.$disable.'">
					<select id="'.$args['id'].'" data-option="'.$args['data_label'].'" '. $select_type .'>'.$options_html.'</select>
				</div>
			</div>
		';

		echo FilterPlus\Utils\Helper::filter_plus_kses($html);
	}
}
