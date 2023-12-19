(function($) {
	'use strict';

	$(document).ready(function(){
		// load select 2
		var ids = ["#woo_pro_categories","#woo_pro_tags","#woo_pro_attributes"];
		$.each(ids,function(index,value){
			$(value).select2( { width: '100%'} );
		});

		/**
		 * Tab functions
		 */
		let $settings_tab_li = $(".settings_tab_pan li");
		let active_tab 		 = window.location?.hash.slice(1) == "" ? "short-codes" : window.location?.hash.slice(1);

		$settings_tab_li.removeClass('active');
		$(".tab-content div").removeClass('active');
		$(`li[data-item="${active_tab}"]`).addClass('active');
		$(`#${active_tab}`).addClass('active');
		hide_submit($(`li[data-item="${active_tab}"]`).index(this));

		$settings_tab_li.on('click',function(){
			let $this = $(this);
			$settings_tab_li.removeClass();
			$('.tab-content > div').hide();
			$this.addClass('active');
			var index = $settings_tab_li.index(this);
			$('.tab-content > div:eq('+index+')').show();
			hide_submit(index);
			window.history.replaceState(null, null, `#${$this.data('item')}`);
		});

		//Settings Tab	
		function hide_submit(index=0) {
			let $admin_button  = $(".admin-button");
			if ( index == 0 ) {
				$admin_button.fadeOut();
			}else{
				$admin_button.fadeIn();
			}
		}

		/**
		 * Shortcode generator
		 */
		generateShortCode();
		function generateShortCode(){
			var results = $("#result_shortcode");
			$(".generate-block").each(function(index,value){
				let _this = $(this);
				_this.on('click',function(e){
					e.preventDefault();
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
			var select_box      = _this.find('select');
			// select box
			if ( select_box.length > 0 ) {
				select_box.each(function() {
					let $this = $(this);
					let disable = $this.parent().hasClass('disable');
					if (disable) {
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
					let disable = $this.parent().hasClass('disable');
					if (disable) {
						return;
					}
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
				$("."+data).removeClass("d-none");
			}else{
				$("."+data).addClass("d-none");
			}
			})

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
			let tabs 		= ['#settings :input'];
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
					$admin_button.addClass("loader");
				},
				success: function (response) {
					$admin_button.removeClass("loader");
					$message.removeClass('d-none').html("").html(response?.data?.message)
					.fadeIn().delay(2000).fadeOut();
				}
			})
		})
	});

})(jQuery);
