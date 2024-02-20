(function($) {
	'use strict';

	$(document).ready(function(){
		// load select 2
		var ids = ["#woo_pro_categories","#wp_categories","#woo_pro_tags","#woo_pro_attributes",
		"#seo_elements","#post_tags","#author_list","#custom_field_list"];
		$.each(ids,function(index,value){
			$(value).select2( { width: '100%'} );
		});

		/**
		 * Tab functions
		 */
		let $settings_tab_li = $(".settings_tab_pan li");
		let active_tab 		 = window.location?.hash.slice(1) == "" ? "settings" : window.location?.hash.slice(1);

		$settings_tab_li.removeClass('active');
		$(".tab-content div").removeClass('active');
		$(`li[data-item="${active_tab}"]`).addClass('active');
		$(`#${active_tab}`).addClass('active');
		$settings_tab_li.on('click',function(){
			let $this = $(this);
			$settings_tab_li.removeClass();
			$('.tab-content > div').hide();
			$this.addClass('active');
			var index = $settings_tab_li.index(this);
			$('.tab-content > div:eq('+index+')').show();
			window.history.replaceState(null, null, `#${$this.data('item')}`);
		});

		/**
		 * ShortCode generator
		 */
		generateShortCode();
		function generateShortCode(){
			$(".generate-block").each(function(index,value){
				let _this = $(this);
				_this.on('click',function(e){
					e.preventDefault();
					if (_this.hasClass('disable')) {
						return;
					}
					let results = _this.siblings(".full_input");
					let parent_block = _this.parents(".shortcode-block");
					let shortcode_name = parent_block.data("name");
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
			var input_text      = _this.find('input:text');
			var select_box      = _this.find('select');

			// select box
			if ( select_box.length > 0 ) {
				select_box.each(function() {
					let $this = $(this);
					let is_true = shortcode_input_disable( $this );
					if (is_true) {
						return;
					}
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
					let is_true = shortcode_input_disable( $this );
					if (is_true) {
						return;
					}
					let value = $this.is(':checked') ? "yes" : "no";

					result += ` ${$this.data('label')}="${ value }"`;
				});
			}

			// input text
			result = shortcode_input_value(input_text,result)

			return result;
		}

		function shortcode_input_value(input_data,result) {
			if ( input_data.length > 0 ) {
				input_data.each(function() {
					let $this = $(this);
					let is_true = shortcode_input_disable( $this );
					if (is_true ) {
						return;
					}
					// input value
					if ( $.isArray( $this.val() )) {
						result += ` ${$this.data('option')}="${$this.val().toString()}"`;
					}
					else{
						result += ` ${$this.data('option')}="${$this.val()}"`;
					}
				});
			}

			return result;
		}

		function shortcode_input_disable( $this ) {
			let disable = $this.parent().hasClass('disable');
			let disable_pro = $this.parent().hasClass('pro-disable');
			let d_none = $this.parents('.d-none');
			if (disable_pro || disable || d_none.length > 0 ) {
				return true;
			}else{
				return false;
			}
		}

		/**
		 * Toggle Show/Hide
		 *  
		 * */
		var ids = ["show_tags","show_attributes","show_wp_tags","filter_type","author","custom_field"];
		$.each(ids,function(index,data){
			let value = $("#"+data);
			value.on('change',function(){
				if ( data == "filter_type" ) {
					if ( value.val() == "custom_post" ) {
						$("."+data).removeClass("d-none");
					} else {
						$("."+data).addClass("d-none");
					}
				}else{
					if (value.is(":checked") ) {
						$("."+data).removeClass("d-none");
					}else{
						$("."+data).addClass("d-none");
					}
				}
			});
		});

		/**
		 * Get settings options
		 * @param {*} main_div 
		 * @returns 
		 */
		function getAllValues(main_div) {
			let obj = {};
			$(main_div).map(function(x,item) {
				let $this = $(this);
				if ( typeof $this.attr('name') === "undefined" ) {
					return;
				}

				let type = $this.prop("type");

				if ((type == "checkbox" || type == "radio") ) { 
					if (this.checked) {
						obj[$this.attr('name')] = $this.val();
					} else {
						obj[$this.attr('name')] = 'no';
					}
					return obj;
				}
				if ( type == "select-multiple" || type == "select-one" ) {
					obj[$this.attr('name')] = $this.val();
					return obj;
				}
				
				if ( type == "text" || type == "hidden" ) {
					obj[$this.attr('name')] = $this.val();
					return obj;
				}

			});

			return obj;
		}

		/**
		 * Get tab data
		 * @returns 
		 */
		function getTabData() {
			let tabs 		= ['#settings :input','#seo :input'];
			let form_data 	= {};	
			tabs.forEach(element => {
				let input_data 		= getAllValues( element );
				$.each(input_data, function ( i , value ) {
					form_data[i] = value;
				}); 
			});
	
			return form_data;
		}

		/**
		 * Save admin settings
		 */
		let $admin_button = $('.admin-button');
		$('#filter-settings').on('submit',function(e){
			e.preventDefault();
			let $message	= $(".settings_message");
			let form_data 	= getTabData();

			let data =
			{
				action: 'filter_save_settings',
				nonce: filter_admin.nonce,
				params: form_data
			};
			$.ajax({
				url: filter_admin.ajax_url,
				method: 'POST',
				data: data,
				beforeSend: function () {
					$admin_button.addClass("loading");
				},
				success: function (response) {
					$admin_button.removeClass("loading");
					$message.removeClass('d-none').html("").html(response?.data?.message)
					.fadeIn().delay(2000).fadeOut();
				}
			});
		})
	
		/**
		 * Accordion
		 */
		$(".accordion-button").on("change", function () {
			$(".accordion-button").not(this).prop("checked", false);
			const isChecked = $(this).prop("checked");
			const content = $(this).closest(".accordion-item").find(".content");
		
			$(".content").removeClass("show");
			if (isChecked) {
			content.addClass("show");
			} else {
			content.removeClass("show");
			}
		});

	});
	  

})(jQuery);
