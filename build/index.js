(()=>{"use strict";const e=window.React,t=window.wp.blocks,l=window.wp.blockEditor,a=window.wp.components,{__}=wp.i18n;(0,t.registerBlockType)("filter-plus/woo-filter",{title:__("WooCommerce Product Filter","filter-plus"),icon:"image-filter",category:"text",attributes:{category_label:{type:"string"},color_label:{type:"string"},size_label:{type:"string"},tag_label:{type:"string"},review_label:{type:"string"},price_range_label:{type:"string"},attribute_label:{type:"string"},on_sale_label:{type:"string"},stock_label:{type:"string"},sub_categories:{type:"boolean"},colors:{type:"boolean"},size:{type:"boolean"},template:{type:"string",default:"1"},categories:{type:"array",default:[]},show_tags:{type:"boolean"},stock:{type:"boolean"},on_sale:{type:"boolean"},tags:{type:"array",default:[]},show_attributes:{type:"boolean"},attribute_list:{type:"array",default:[]},show_reviews:{type:"boolean"},show_price_range:{type:"boolean"},sorting:{type:"boolean"},product_tags:{type:"boolean"},product_categories:{type:"boolean"}},edit({attributes:t,setAttributes:o}){const r=(0,l.useBlockProps)(),{category_label:n,sub_categories:s,color_label:i,size_label:u,tag_label:c,review_label:p,price_range_label:g,attribute_label:b,on_sale_label:_,stock_label:f,colors:m,size:h,template:C,categories:d,show_tags:y,tags:E,show_attributes:v,attribute_list:T,show_reviews:w,show_price_range:k,on_sale:P,stock:S,sorting:F,product_tags:L,product_categories:D}=t;function x(){return 1==filterPlus.is_pro_active?__("(Pro)","filter-plus"):""}return(0,e.createElement)(e.Fragment,null,(0,e.createElement)(l.InspectorControls,null,(0,e.createElement)(a.PanelBody,{title:__("Settings","filter-plus")},(0,e.createElement)(a.SelectControl,{label:__("Select Template","filter-plus"),value:C,options:function(){let e=0==filterPlus.is_pro_active?0:1,t=[{value:1,label:__("Template-1","filter-plus")+" "+x(),disabled:e}];return t.push({value:2,label:__("Template-2","filter-plus")+" "+x(),disabled:e}),t.push({value:3,label:__("Template-3","filter-plus")+" "+x(),disabled:e}),t.push({value:4,label:__("Template-4","filter-plus")+" "+x(),disabled:e}),t.push({value:5,label:__("Template-5","filter-plus")+" "+x(),disabled:e}),t}(),onChange:function(e){o({template:e})}}),(0,e.createElement)(a.TextControl,{multiple:!0,label:__("Category Label","filter-plus"),help:__("Place Category Label","filter-plus"),value:n,onChange:function(e){o({category_label:e})}}),(0,e.createElement)(a.SelectControl,{multiple:!0,label:__("Category List","filter-plus"),value:d,options:filterPlus?.woo_categories,onChange:function(e){o({categories:e})}}),(0,e.createElement)(a.ToggleControl,{label:__("Display Sub Categories","filter-plus"),checked:s,onChange:function(e){o({sub_categories:e})}}),(0,e.createElement)(a.ToggleControl,{label:__("Display Colors","filter-plus"),checked:m,onChange:function(e){o({colors:e})}}),m&&(0,e.createElement)(a.TextControl,{multiple:!0,label:__("Color Label","filter-plus"),value:i,onChange:function(e){o({color_label:e})}}),(0,e.createElement)(a.ToggleControl,{label:__("Display Size","filter-plus"),checked:h,onChange:function(e){o({size:e})}}),h&&(0,e.createElement)(a.TextControl,{multiple:!0,label:__("Size Label","filter-plus"),value:u,onChange:function(e){o({size_label:e})}}),(0,e.createElement)(a.ToggleControl,{label:__("Display Tags","filter-plus"),checked:y,onChange:function(e){o({show_tags:e})}}),y&&(0,e.createElement)(e.Fragment,null,(0,e.createElement)(a.TextControl,{multiple:!0,label:__("Tag Label","filter-plus"),value:c,onChange:function(e){o({tag_label:e})}}),(0,e.createElement)(a.SelectControl,{multiple:!0,label:__("Tags","filter-plus"),value:E,options:filterPlus?.tags,onChange:function(e){o({tags:e})}})),(0,e.createElement)(a.ToggleControl,{label:__("Display Attributes","filter-plus"),checked:v,onChange:function(e){o({show_attributes:e})}}),v&&(0,e.createElement)(e.Fragment,null,(0,e.createElement)(a.TextControl,{multiple:!0,label:__("Attribute Label","filter-plus"),value:b,onChange:function(e){o({attribute_label:e})}}),(0,e.createElement)(a.SelectControl,{multiple:!0,label:__("Attributes","filter-plus"),value:T,options:filterPlus?.attributes,onChange:function(e){o({attribute_list:e})}})),(0,e.createElement)(a.ToggleControl,{label:__("Display Reviews","filter-plus"),checked:w,onChange:function(e){o({show_reviews:e})}}),w&&(0,e.createElement)(a.TextControl,{multiple:!0,label:__("Review Label","filter-plus"),value:p,onChange:function(e){o({review_label:e})}}),(0,e.createElement)(a.ToggleControl,{label:__("Display Price Range","filter-plus"),checked:k,onChange:function(e){o({show_price_range:e})}}),k&&(0,e.createElement)(a.TextControl,{multiple:!0,label:__("Price Range Label","filter-plus"),value:g,onChange:function(e){o({price_range_label:e})}}),(0,e.createElement)(a.ToggleControl,{label:__("Filter By Stock","filter-plus"),checked:S,onChange:function(e){o({stock:e})}}),S&&(0,e.createElement)(a.TextControl,{multiple:!0,label:__("Stock Label","filter-plus"),value:f,onChange:function(e){o({stock_label:e})}}),(0,e.createElement)(a.ToggleControl,{label:__("Sales","filter-plus"),checked:P,onChange:function(e){o({on_sale:e})}}),P&&(0,e.createElement)(a.TextControl,{multiple:!0,label:__("Sale Label","filter-plus"),value:_,onChange:function(e){o({on_sale_label:e})}}),(0,e.createElement)(a.ToggleControl,{label:__("Display Sorting","filter-plus"),checked:F,onChange:function(e){o({sorting:e})}}),(0,e.createElement)(a.ToggleControl,{label:__("Display Tags in Filter Result","filter-plus"),checked:L,onChange:function(e){o({product_tags:e})}}),(0,e.createElement)(a.ToggleControl,{label:__("Display Categories in Filter Result","filter-plus"),checked:D,onChange:function(e){o({product_categories:e})}}))),(0,e.createElement)("div",{...r},__("Customize the Woocommerce filtering options from the block settings","filter-plus")))},save({attributes:t}){const{category_label:a,sub_categories:o,color_label:r,size_label:n,tag_label:s,review_label:i,price_range_label:u,attribute_label:c,on_sale_label:p,stock_label:g,colors:b,size:_,template:f,categories:m,show_tags:h,tags:C,show_attributes:d,attribute_list:y,show_reviews:E,show_price_range:v,stock:T,on_sale:w,sorting:k,product_tags:P,product_categories:S}=t,F=l.useBlockProps.save();return(0,e.createElement)("div",{...F})}}),window.wp.serverSideRender;const{__:o}=wp.i18n;(0,t.registerBlockType)("filter-plus/wp-filter",{title:o("Wordpress Filter","filter-plus"),icon:"image-filter",category:"text",attributes:{filter_type:{type:"string",default:"post"},custom_post:{type:"string"},template:{type:"string",default:"1"},show_categories:{type:"string"},category_label:{type:"string"},categories:{type:"array",default:[]},sub_categories:{type:"boolean"},show_tags:{type:"boolean"},tag_label:{type:"string"},tags:{type:"array",default:[]},author:{type:"boolean"},author_label:{type:"string"},author_list:{type:"array",default:[]},custom_field:{type:"boolean"},custom_field_label:{type:"string"},meta_condition:{type:"string",default:"OR"},custom_field_list:{type:"string"},post_tags:{type:"boolean"},post_categories:{type:"boolean"},post_author:{type:"boolean"}},edit({attributes:t,setAttributes:r}){const n=(0,l.useBlockProps)(),{filter_type:s,custom_post:i,template:u,show_categories:c,category_label:p,categories:g,sub_categories:b,show_tags:_,tag_label:f,tags:m,author:h,author_label:C,author_list:d,custom_field:y,custom_field_label:E,meta_condition:v,custom_field_list:T,post_categories:w,post_tags:k,post_author:P}=t;function S(){return 1==filterPlus.is_pro_active?o("(Pro)","filter-plus"):""}function F(){return 0==filterPlus.is_pro_active?0:1}return(0,e.createElement)(e.Fragment,null,(0,e.createElement)(l.InspectorControls,null,(0,e.createElement)(a.PanelBody,{title:o("Settings","filter-plus")},(0,e.createElement)(a.SelectControl,{label:o("Select Template","filter-plus"),value:u,options:function(){let e=[{value:1,label:o("Template-1","filter-plus")+" "+S(),disabled:F}];return e.push({value:2,label:o("Template-2","filter-plus")+" "+S(),disabled:F}),e.push({value:3,label:o("Template-3","filter-plus")+" "+S(),disabled:F}),e}(),onChange:function(e){r({template:e})}}),(0,e.createElement)(a.SelectControl,{label:o("Select Filter Type","filter-plus"),value:s,options:[{value:"post",label:o("Post","filter-plus"),disabled:F},{value:"custom_post",label:o("Custom Post","filter-plus"),disabled:F}],onChange:function(e){r({filter_type:e})}}),"custom_post"==s&&(0,e.createElement)(e.Fragment,null,(0,e.createElement)(a.SelectControl,{label:o("Select Custom Post Type","filter-plus"),value:i,options:filterPlus?.custom_post_type,onChange:function(e){r({custom_post:e})}})),(0,e.createElement)(a.ToggleControl,{label:o("Display Categories","filter-plus"),checked:c,onChange:function(e){r({show_categories:e})}}),c&&(0,e.createElement)(e.Fragment,null,(0,e.createElement)(a.TextControl,{multiple:!0,label:o("Category Label","filter-plus"),help:o("Place Category Label","filter-plus"),value:p,onChange:function(e){r({category_label:e})}}),(0,e.createElement)(a.SelectControl,{multiple:!0,label:o("Category List","filter-plus"),value:g,options:filterPlus?.wp_cats,onChange:function(e){r({categories:e})}}),(0,e.createElement)(a.ToggleControl,{label:o("Display Sub Categories","filter-plus"),checked:b,onChange:function(e){r({sub_categories:e})}})),(0,e.createElement)(a.ToggleControl,{label:o("Display Tags","filter-plus"),checked:_,onChange:function(e){r({show_tags:e})}}),_&&(0,e.createElement)(e.Fragment,null,(0,e.createElement)(a.TextControl,{multiple:!0,label:o("Tag Label","filter-plus"),value:f,onChange:function(e){r({tag_label:e})}}),(0,e.createElement)(a.SelectControl,{multiple:!0,label:o("Tags","filter-plus"),value:m,options:filterPlus?.post_tag,onChange:function(e){r({tags:e})}})),(0,e.createElement)(a.ToggleControl,{label:o("Display Authors","filter-plus"),checked:h,onChange:function(e){r({author:e})}}),h&&(0,e.createElement)(e.Fragment,null,(0,e.createElement)(a.TextControl,{multiple:!0,label:o("Author Label","filter-plus"),help:o("Place Author Label","filter-plus"),value:C,onChange:function(e){r({author_label:e})}}),(0,e.createElement)(a.SelectControl,{multiple:!0,label:o("Author List","filter-plus"),value:d,options:filterPlus?.author_list,onChange:function(e){r({author_list:e})}})),(0,e.createElement)(a.ToggleControl,{label:o("Display Custom Field","filter-plus"),checked:y,onChange:function(e){r({custom_field:e})}}),y&&(0,e.createElement)(e.Fragment,null,(0,e.createElement)(a.TextControl,{multiple:!0,label:o("Custom Field Label","filter-plus"),help:o("Custom Field Label","filter-plus"),value:E,onChange:function(e){r({custom_field_label:e})}}),(0,e.createElement)(a.TextControl,{label:o("Custom Field Name","filter-plus"),help:o("Enter Exact Custom Field Name","filter-plus"),value:T,onChange:function(e){r({custom_field_list:e})}})),(0,e.createElement)(a.ToggleControl,{label:o("Display Categories in Filter Result","filter-plus"),checked:w,onChange:function(e){r({post_categories:e})}}),(0,e.createElement)(a.ToggleControl,{label:o("Display Tags in Filter Result","filter-plus"),checked:k,onChange:function(e){r({post_tags:e})}}),(0,e.createElement)(a.ToggleControl,{label:o("Display Author in Filter Result","filter-plus"),checked:P,onChange:function(e){r({post_author:e})}}))),(0,e.createElement)("div",{...n},o("Customize the Wordpress filtering options from the block settings","filter-plus")))},save({attributes:t}){const{filter_type:a,sub_categories:o,custom_post:r,template:n,show_categories:s,category_label:i,categories:u,show_tags:c,tag_label:p,tags:g,author:b,author_label:_,author_list:f,custom_field:m,custom_field_label:h,meta_condition:C,custom_field_list:d,post_categories:y,post_tags:E,post_author:v}=t,T=l.useBlockProps.save();return(0,e.createElement)("div",{...T})}})})();