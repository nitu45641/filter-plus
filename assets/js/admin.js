(function($) {
	'use strict';

	$(document).ready(function(){
		// load select 2
		var ids = ["#woo_pro_categories","#woo_pro_tags","#woo_pro_attributes"];
		$.each(ids,function(index,value){
			$(value).select2( { width: '100%'} );
		});

		// shortcode generator
		generateShortCode();
		function generateShortCode(){
			var results = $("#result_shortcode");
			$(".generate-block").each(function(index,value){
				let _this = $(this);
				_this.on('click',function(e){
					e.preventDefault();
					let parent_block = _this.parents(".shortcode-block");
					var shortcode_name = parent_block.data("name");
					let input_value = findInputValue(parent_block.find(".input-section"));

					let shortcode = `[${shortcode_name} ${input_value}]`; 
					results.val("").val(shortcode);
					copyTextData(results);
				})
			})
		}
		// copy text
		function copyTextData( fieldId ){
			if( fieldId.length > 0 ){
				fieldId.select();
				document.execCommand("copy"); 
				alert("Copied On clipboard");
			}
		}
		// find input value
		function findInputValue( _this ){
			let result          = "";
			var checkbox        = _this.find('input:checkbox');
			var select_box      = _this.find('select');
			
			// select box
			if ( select_box.length > 0 ) {
				select_box.each(function() {
					let $this = $(this);
					// select option
					if ( $.isArray( $this.val() )) {
						result += ` ${$this.data('option')}="${$this.val().toString()}"`;
					}else{
						result += ` ${$this.data('option')}="${$this.val()}"`;
					}
				});
			}
			// check box
			if ( checkbox.length > 0 ) {
				checkbox.each(function() {
					let $this = $(this);
					let value = $this.is(':checked') ? "yes" : "no";
					result += ` ${$this.data('label')}="${ value }"`;
				});
			}


			return result;
		}

		/**
		 * Toggle Show/Hide
		 *  
		 * */
		 var ids = ["show_tags","show_attributes"];
		 $.each(ids,function(index,data){
			let value = $("#"+data);
			value.on('change',function(){
				if (value.is(":checked")) {
					$("."+data).fadeIn();
				}else{
				   $("."+data).fadeOut();
				}
			 })

		 });
	});

})(jQuery);
