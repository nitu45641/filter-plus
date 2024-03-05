(()=>{"use strict";const e=window.React,t=window.wp.blocks,l=window.wp.blockEditor,a=window.wp.components,{__}=wp.i18n;(0,t.registerBlockType)("filter-plus/woo-filter",{title:__("WooCommerce Product Filter","filter-plus"),icon:"image-filter",category:"text",attributes:{category_label:{type:"string"},color_label:{type:"string"},size_label:{type:"string"},tag_label:{type:"string"},review_label:{type:"string"},price_range_label:{type:"string"},attribute_label:{type:"string"},on_sale_label:{type:"string"},stock_label:{type:"string"},colors:{type:"boolean"},size:{type:"boolean"},template:{type:"string",default:"1"},categories:{type:"array",default:[]},show_tags:{type:"boolean"},stock:{type:"boolean"},on_sale:{type:"boolean"},tags:{type:"array",default:[]},show_attributes:{type:"boolean"},attribute_list:{type:"array",default:[]},show_reviews:{type:"boolean"},show_price_range:{type:"boolean"},sorting:{type:"boolean"},product_tags:{type:"boolean"},product_categories:{type:"boolean"}},edit({attributes:t,setAttributes:o}){const r=(0,l.useBlockProps)(),{category_label:n,color_label:s,size_label:i,tag_label:u,review_label:c,price_range_label:p,attribute_label:g,on_sale_label:b,stock_label:_,colors:f,size:m,template:h,categories:C,show_tags:d,tags:y,show_attributes:E,attribute_list:v,show_reviews:T,show_price_range:w,on_sale:k,stock:P,sorting:S,product_tags:F,product_categories:L}=t;function x(){return 1==filterPlus.is_pro_active?__("(Pro)","filter-plus"):""}return(0,e.createElement)(e.Fragment,null,(0,e.createElement)(l.InspectorControls,null,(0,e.createElement)(a.PanelBody,{title:__("Settings","filter-plus")},(0,e.createElement)(a.SelectControl,{label:__("Select Template","filter-plus"),value:h,options:function(){let e=0==filterPlus.is_pro_active?0:1,t=[{value:2,label:__("Template-1","filter-plus")+" "+x(),disabled:e}];return t.push({value:2,label:__("Template-2","filter-plus")+" "+x(),disabled:e}),t.push({value:3,label:__("Template-3","filter-plus")+" "+x(),disabled:e}),t.push({value:4,label:__("Template-4","filter-plus")+" "+x(),disabled:e}),t}(),onChange:function(e){o({template:e})}}),(0,e.createElement)(a.TextControl,{multiple:!0,label:__("Category Label","filter-plus"),help:__("Place Category Label","filter-plus"),value:n,onChange:function(e){o({category_label:e})}}),(0,e.createElement)(a.SelectControl,{multiple:!0,label:__("Category List","filter-plus"),value:C,options:filterPlus?.woo_categories,onChange:function(e){o({categories:e})}}),(0,e.createElement)(a.ToggleControl,{label:__("Display Colors","filter-plus"),checked:f,onChange:function(e){o({colors:e})}}),f&&(0,e.createElement)(a.TextControl,{multiple:!0,label:__("Color Label","filter-plus"),value:s,onChange:function(e){o({color_label:e})}}),(0,e.createElement)(a.ToggleControl,{label:__("Display Size","filter-plus"),checked:m,onChange:function(e){o({size:e})}}),m&&(0,e.createElement)(a.TextControl,{multiple:!0,label:__("Size Label","filter-plus"),value:i,onChange:function(e){o({size_label:e})}}),(0,e.createElement)(a.ToggleControl,{label:__("Display Tags","filter-plus"),checked:d,onChange:function(e){o({show_tags:e})}}),d&&(0,e.createElement)(e.Fragment,null,(0,e.createElement)(a.TextControl,{multiple:!0,label:__("Tag Label","filter-plus"),value:u,onChange:function(e){o({tag_label:e})}}),(0,e.createElement)(a.SelectControl,{multiple:!0,label:__("Tags","filter-plus"),value:y,options:filterPlus?.tags,onChange:function(e){o({tags:e})}})),(0,e.createElement)(a.ToggleControl,{label:__("Display Attributes","filter-plus"),checked:E,onChange:function(e){o({show_attributes:e})}}),E&&(0,e.createElement)(e.Fragment,null,(0,e.createElement)(a.TextControl,{multiple:!0,label:__("Attribute Label","filter-plus"),value:g,onChange:function(e){o({attribute_label:e})}}),(0,e.createElement)(a.SelectControl,{multiple:!0,label:__("Attributes","filter-plus"),value:v,options:filterPlus?.attributes,onChange:function(e){o({attribute_list:e})}})),(0,e.createElement)(a.ToggleControl,{label:__("Display Reviews","filter-plus"),checked:T,onChange:function(e){o({show_reviews:e})}}),T&&(0,e.createElement)(a.TextControl,{multiple:!0,label:__("Review Label","filter-plus"),value:c,onChange:function(e){o({review_label:e})}}),(0,e.createElement)(a.ToggleControl,{label:__("Display Price Range","filter-plus"),checked:w,onChange:function(e){o({show_price_range:e})}}),w&&(0,e.createElement)(a.TextControl,{multiple:!0,label:__("Price Range Label","filter-plus"),value:p,onChange:function(e){o({price_range_label:e})}}),(0,e.createElement)(a.ToggleControl,{label:__("Filter By Stock","filter-plus"),checked:P,onChange:function(e){o({stock:e})}}),P&&(0,e.createElement)(a.TextControl,{multiple:!0,label:__("Stock Label","filter-plus"),value:_,onChange:function(e){o({stock_label:e})}}),(0,e.createElement)(a.ToggleControl,{label:__("Sales","filter-plus"),checked:k,onChange:function(e){o({on_sale:e})}}),k&&(0,e.createElement)(a.TextControl,{multiple:!0,label:__("Sale Label","filter-plus"),value:b,onChange:function(e){o({on_sale_label:e})}}),(0,e.createElement)(a.ToggleControl,{label:__("Display Sorting","filter-plus"),checked:S,onChange:function(e){o({sorting:e})}}),(0,e.createElement)(a.ToggleControl,{label:__("Display Tags in Filter Result","filter-plus"),checked:F,onChange:function(e){o({product_tags:e})}}),(0,e.createElement)(a.ToggleControl,{label:__("Display Categories in Filter Result","filter-plus"),checked:L,onChange:function(e){o({product_categories:e})}}))),(0,e.createElement)("div",{...r},"This is the editor text!"))},save({attributes:t}){const{category_label:a,color_label:o,size_label:r,tag_label:n,review_label:s,price_range_label:i,attribute_label:u,on_sale_label:c,stock_label:p,colors:g,size:b,template:_,categories:f,show_tags:m,tags:h,show_attributes:C,attribute_list:d,show_reviews:y,show_price_range:E,stock:v,on_sale:T,sorting:w,product_tags:k,product_categories:P}=t,S=l.useBlockProps.save();return(0,e.createElement)("div",{...S})}}),window.wp.serverSideRender;const{__:o}=wp.i18n;(0,t.registerBlockType)("filter-plus/wp-filter",{title:o("Worpdress Filter","filter-plus"),icon:"image-filter",category:"text",attributes:{filter_type:{type:"string",default:"post"},custom_post:{type:"string"},template:{type:"string",default:"1"},show_categories:{type:"string"},category_label:{type:"string"},categories:{type:"array",default:[]},show_tags:{type:"boolean"},tag_label:{type:"string"},tags:{type:"array",default:[]},author:{type:"boolean"},author_label:{type:"string"},author_list:{type:"array",default:[]},custom_field:{type:"boolean"},custom_field_label:{type:"string"},meta_condition:{type:"string",default:"OR"},custom_field_list:{type:"string"},post_tags:{type:"boolean"},post_categories:{type:"boolean"},post_author:{type:"boolean"}},edit({attributes:t,setAttributes:r}){const n=(0,l.useBlockProps)(),{filter_type:s,custom_post:i,template:u,show_categories:c,category_label:p,categories:g,show_tags:b,tag_label:_,tags:f,author:m,author_label:h,author_list:C,custom_field:d,custom_field_label:y,meta_condition:E,custom_field_list:v,post_categories:T,post_tags:w,post_author:k}=t;function P(){return 1==filterPlus.is_pro_active?o("(Pro)","filter-plus"):""}function S(){return 0==filterPlus.is_pro_active?0:1}return(0,e.createElement)(e.Fragment,null,(0,e.createElement)(l.InspectorControls,null,(0,e.createElement)(a.PanelBody,{title:o("Settings","filter-plus")},(0,e.createElement)(a.SelectControl,{label:o("Select Template","filter-plus"),value:u,options:function(){let e=[{value:1,label:o("Template-1","filter-plus")+" "+P(),disabled:S}];return e.push({value:2,label:o("Template-2","filter-plus")+" "+P(),disabled:S}),e.push({value:3,label:o("Template-3","filter-plus")+" "+P(),disabled:S}),e.push({value:4,label:o("Template-4","filter-plus")+" "+P(),disabled:S}),e}(),onChange:function(e){r({template:e})}}),(0,e.createElement)(a.SelectControl,{label:o("Select Filter Type","filter-plus"),value:s,options:[{value:"post",label:o("Post","filter-plus"),disabled:S},{value:"custom_post",label:o("Custom Post","filter-plus"),disabled:S}],onChange:function(e){r({filter_type:e})}}),"custom_post"==s&&(0,e.createElement)(e.Fragment,null,(0,e.createElement)(a.SelectControl,{label:o("Select Custom Post Type","filter-plus"),value:i,options:filterPlus?.custom_post_type,onChange:function(e){r({custom_post:e})}})),(0,e.createElement)(a.ToggleControl,{label:o("Display Categories","filter-plus"),checked:c,onChange:function(e){r({show_categories:e})}}),c&&(0,e.createElement)(e.Fragment,null,(0,e.createElement)(a.TextControl,{multiple:!0,label:o("Category Label","filter-plus"),help:o("Place Category Label","filter-plus"),value:p,onChange:function(e){r({category_label:e})}}),(0,e.createElement)(a.SelectControl,{multiple:!0,label:o("Category List","filter-plus"),value:g,options:filterPlus?.wp_cats,onChange:function(e){r({categories:e})}})),(0,e.createElement)(a.ToggleControl,{label:o("Display Tags","filter-plus"),checked:b,onChange:function(e){r({show_tags:e})}}),b&&(0,e.createElement)(e.Fragment,null,(0,e.createElement)(a.TextControl,{multiple:!0,label:o("Tag Label","filter-plus"),value:_,onChange:function(e){r({tag_label:e})}}),(0,e.createElement)(a.SelectControl,{multiple:!0,label:o("Tags","filter-plus"),value:f,options:filterPlus?.post_tag,onChange:function(e){r({tags:e})}})),(0,e.createElement)(a.ToggleControl,{label:o("Display Authors","filter-plus"),checked:m,onChange:function(e){r({author:e})}}),m&&(0,e.createElement)(e.Fragment,null,(0,e.createElement)(a.TextControl,{multiple:!0,label:o("Author Label","filter-plus"),help:o("Place Author Label","filter-plus"),value:h,onChange:function(e){r({author_label:e})}}),(0,e.createElement)(a.SelectControl,{multiple:!0,label:o("Author List","filter-plus"),value:C,options:filterPlus?.author_list,onChange:function(e){r({author_list:e})}})),(0,e.createElement)(a.ToggleControl,{label:o("Display Custom Field","filter-plus"),checked:d,onChange:function(e){r({custom_field:e})}}),d&&(0,e.createElement)(e.Fragment,null,(0,e.createElement)(a.TextControl,{multiple:!0,label:o("Custom Field Label","filter-plus"),help:o("Custom Field Label","filter-plus"),value:y,onChange:function(e){r({custom_field_label:e})}}),(0,e.createElement)(a.TextControl,{multiple:!0,label:o("Custom Field Name","filter-plus"),help:o("Enter Exact Custom Field Name ","filter-plus"),value:v,onChange:function(e){r({custom_field_list:e})}})),(0,e.createElement)(a.ToggleControl,{label:o("Display Tags in Filter Result","filter-plus"),checked:w,onChange:function(e){r({post_tags:e})}}),(0,e.createElement)(a.ToggleControl,{label:o("Display Categories in Filter Result","filter-plus"),checked:T,onChange:function(e){r({post_categories:e})}}),(0,e.createElement)(a.ToggleControl,{label:o("Display Author in Filter Result","filter-plus"),checked:k,onChange:function(e){r({post_author:e})}}))),(0,e.createElement)("div",{...n},"This is the editor text!"))},save({attributes:t}){const{filter_type:a,custom_post:o,template:r,show_categories:n,category_label:s,categories:i,show_tags:u,tag_label:c,tags:p,author:g,author_label:b,author_list:_,custom_field:f,custom_field_label:m,meta_condition:h,custom_field_list:C,post_categories:d,post_tags:y,post_author:E}=t,v=l.useBlockProps.save();return(0,e.createElement)("div",{...v})}})})();