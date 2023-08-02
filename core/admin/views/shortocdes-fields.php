<?php

function checkbox_field($args){
	$disable      = !empty($args['disable']) ? "disable" : "";
	$html = '
		<div class="single-block">
			<div class="shortcode-label">'.$args['label'].'</div>
			<div class="shortcode-section '.$disable.'">
				<input type="checkbox" class="filter-ui-toggle" id="'.$args['id'].'" data-label="'.$args['data_label'].'"
				name="'.$args['id'].'" value="" '.esc_attr('checked').' >
			</div>
		</div>
	';

	echo ($html);
}

function select_field($args){
	$options_html = "";
	$disable      = !empty($args['disable']) ? 'disable' : '';
	$template_disable = !empty($args['template_disable']) ? $args['template_disable'] : count($args['options']) + 1;
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
				error_log($disabled );
				$options_html .= '<option '.$disabled.' value="'.$item.'">'.esc_html__('Template','filter-plus')."-".$item.'</option>';
			endforeach; 
		endif;
	}
	else{
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

	echo ($html);
}