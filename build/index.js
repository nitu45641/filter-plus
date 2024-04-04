/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/WooFilter.js":
/*!**************************!*\
  !*** ./src/WooFilter.js ***!
  \**************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/blocks */ "@wordpress/blocks");
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_blocks__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__);




const {
  __
} = wp.i18n;
(0,_wordpress_blocks__WEBPACK_IMPORTED_MODULE_1__.registerBlockType)('filter-plus/woo-filter', {
  title: __('WooCommerce Product Filter', 'filter-plus'),
  icon: 'image-filter',
  category: 'text',
  attributes: {
    category_label: {
      type: 'string'
    },
    color_label: {
      type: 'string'
    },
    size_label: {
      type: 'string'
    },
    tag_label: {
      type: 'string'
    },
    review_label: {
      type: 'string'
    },
    price_range_label: {
      type: 'string'
    },
    attribute_label: {
      type: 'string'
    },
    on_sale_label: {
      type: 'string'
    },
    stock_label: {
      type: 'string'
    },
    colors: {
      type: 'boolean'
    },
    size: {
      type: 'boolean'
    },
    template: {
      type: 'string',
      default: '1'
    },
    categories: {
      type: 'array',
      default: []
    },
    show_tags: {
      type: 'boolean'
    },
    stock: {
      type: 'boolean'
    },
    on_sale: {
      type: 'boolean'
    },
    tags: {
      type: 'array',
      default: []
    },
    show_attributes: {
      type: 'boolean'
    },
    attribute_list: {
      type: 'array',
      default: []
    },
    show_reviews: {
      type: 'boolean'
    },
    show_price_range: {
      type: 'boolean'
    },
    sorting: {
      type: 'boolean'
    },
    product_tags: {
      type: 'boolean'
    },
    product_categories: {
      type: 'boolean'
    }
  },
  edit({
    attributes,
    setAttributes
  }) {
    const blockProps = (0,_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__.useBlockProps)();
    const {
      category_label,
      color_label,
      size_label,
      tag_label,
      review_label,
      price_range_label,
      attribute_label,
      on_sale_label,
      stock_label,
      colors,
      size,
      template,
      categories,
      show_tags,
      tags,
      show_attributes,
      attribute_list,
      show_reviews,
      show_price_range,
      on_sale,
      stock,
      sorting,
      product_tags,
      product_categories
    } = attributes;
    function onChangeCategoryLabel(newValue) {
      setAttributes({
        category_label: newValue
      });
    }
    function onChangeColorLabel(newValue) {
      setAttributes({
        color_label: newValue
      });
    }
    function onChangeSizeLabel(newValue) {
      setAttributes({
        size_label: newValue
      });
    }
    function onChangeTagLabel(newValue) {
      setAttributes({
        tag_label: newValue
      });
    }
    function onChangeReviewLabel(newValue) {
      setAttributes({
        review_label: newValue
      });
    }
    function onChangePriceRangeLabel(newValue) {
      setAttributes({
        price_range_label: newValue
      });
    }
    function onChangeAttributeLabel(newValue) {
      setAttributes({
        attribute_label: newValue
      });
    }
    function onChangeOnSaleLabel(newValue) {
      setAttributes({
        on_sale_label: newValue
      });
    }
    function onChangeStockLabel(newValue) {
      setAttributes({
        stock_label: newValue
      });
    }
    function onChangeDisplayColor(newValue) {
      setAttributes({
        colors: newValue
      });
    }
    function onChangeDisplaySize(newValue) {
      setAttributes({
        size: newValue
      });
    }
    function onChangeCatList(newValue) {
      setAttributes({
        categories: newValue
      });
    }
    function onChangeTemplate(newValue) {
      setAttributes({
        template: newValue
      });
    }
    function onChangeDisplayTags(newValue) {
      setAttributes({
        show_tags: newValue
      });
    }
    function onChangeTagist(newValue) {
      setAttributes({
        tags: newValue
      });
    }
    function onChangeDisplayAttr(newValue) {
      setAttributes({
        show_attributes: newValue
      });
    }
    function onChangeAttr(newValue) {
      setAttributes({
        attribute_list: newValue
      });
    }
    function onChangePriceRangse(newValue) {
      setAttributes({
        show_price_range: newValue
      });
    }
    function onChangeStockStatus(newValue) {
      setAttributes({
        stock: newValue
      });
    }
    function onChangeSales(newValue) {
      setAttributes({
        on_sale: newValue
      });
    }
    function onChangeShowReviews(newValue) {
      setAttributes({
        show_reviews: newValue
      });
    }
    function onChangeSorting(newValue) {
      setAttributes({
        sorting: newValue
      });
    }
    function onChangeProductTag(newValue) {
      setAttributes({
        product_tags: newValue
      });
    }
    function onChangeProductCat(newValue) {
      setAttributes({
        product_categories: newValue
      });
    }
    function pro_text() {
      return filterPlus.is_pro_active == 1 ? __('(Pro)', 'filter-plus') : '';
    }
    function getTemplates() {
      let is_pro_active = filterPlus.is_pro_active == 0 ? 0 : 1;
      let templates = [{
        value: 1,
        label: __('Template-1', 'filter-plus') + ' ' + pro_text(),
        disabled: is_pro_active
      }];
      templates.push({
        value: 2,
        label: __('Template-2', 'filter-plus') + ' ' + pro_text(),
        disabled: is_pro_active
      });
      templates.push({
        value: 3,
        label: __('Template-3', 'filter-plus') + ' ' + pro_text(),
        disabled: is_pro_active
      });
      templates.push({
        value: 4,
        label: __('Template-4', 'filter-plus') + ' ' + pro_text(),
        disabled: is_pro_active
      });
      return templates;
    }
    return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__.InspectorControls, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.PanelBody, {
      title: __('Settings', 'filter-plus')
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.SelectControl, {
      label: __('Select Template', 'filter-plus'),
      value: template,
      options: getTemplates(),
      onChange: onChangeTemplate
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.TextControl, {
      multiple: true,
      label: __('Category Label', 'filter-plus'),
      help: __('Place Category Label', 'filter-plus'),
      value: category_label,
      onChange: onChangeCategoryLabel
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.SelectControl, {
      multiple: true,
      label: __('Category List', 'filter-plus'),
      value: categories,
      options: filterPlus?.woo_categories,
      onChange: onChangeCatList
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
      label: __('Display Colors', 'filter-plus'),
      checked: colors,
      onChange: onChangeDisplayColor
    }), colors && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.TextControl, {
      multiple: true,
      label: __('Color Label', 'filter-plus'),
      value: color_label,
      onChange: onChangeColorLabel
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
      label: __('Display Size', 'filter-plus'),
      checked: size,
      onChange: onChangeDisplaySize
    }), size && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.TextControl, {
      multiple: true,
      label: __('Size Label', 'filter-plus'),
      value: size_label,
      onChange: onChangeSizeLabel
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
      label: __('Display Tags', 'filter-plus'),
      checked: show_tags,
      onChange: onChangeDisplayTags
    }), show_tags && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.TextControl, {
      multiple: true,
      label: __('Tag Label', 'filter-plus'),
      value: tag_label,
      onChange: onChangeTagLabel
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.SelectControl, {
      multiple: true,
      label: __('Tags', 'filter-plus'),
      value: tags,
      options: filterPlus?.tags,
      onChange: onChangeTagist
    })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
      label: __('Display Attributes', 'filter-plus'),
      checked: show_attributes,
      onChange: onChangeDisplayAttr
    }), show_attributes && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.TextControl, {
      multiple: true,
      label: __('Attribute Label', 'filter-plus'),
      value: attribute_label,
      onChange: onChangeAttributeLabel
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.SelectControl, {
      multiple: true,
      label: __('Attributes', 'filter-plus'),
      value: attribute_list,
      options: filterPlus?.attributes,
      onChange: onChangeAttr
    })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
      label: __('Display Reviews', 'filter-plus'),
      checked: show_reviews,
      onChange: onChangeShowReviews
    }), show_reviews && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.TextControl, {
      multiple: true,
      label: __('Review Label', 'filter-plus'),
      value: review_label,
      onChange: onChangeReviewLabel
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
      label: __('Display Price Range', 'filter-plus'),
      checked: show_price_range,
      onChange: onChangePriceRangse
    }), show_price_range && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.TextControl, {
      multiple: true,
      label: __('Price Range Label', 'filter-plus'),
      value: price_range_label,
      onChange: onChangePriceRangeLabel
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
      label: __('Filter By Stock', 'filter-plus'),
      checked: stock,
      onChange: onChangeStockStatus
    }), stock && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.TextControl, {
      multiple: true,
      label: __('Stock Label', 'filter-plus'),
      value: stock_label,
      onChange: onChangeStockLabel
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
      label: __('Sales', 'filter-plus'),
      checked: on_sale,
      onChange: onChangeSales
    }), on_sale && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.TextControl, {
      multiple: true,
      label: __('Sale Label', 'filter-plus'),
      value: on_sale_label,
      onChange: onChangeOnSaleLabel
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
      label: __('Display Sorting', 'filter-plus'),
      checked: sorting,
      onChange: onChangeSorting
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
      label: __('Display Tags in Filter Result', 'filter-plus'),
      checked: product_tags,
      onChange: onChangeProductTag
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
      label: __('Display Categories in Filter Result', 'filter-plus'),
      checked: product_categories,
      onChange: onChangeProductCat
    }))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      ...blockProps
    }, __('Customize the Woocommerce filtering options from the block settings', 'filter-plus')));
  },
  save({
    attributes
  }) {
    const {
      category_label,
      color_label,
      size_label,
      tag_label,
      review_label,
      price_range_label,
      attribute_label,
      on_sale_label,
      stock_label,
      colors,
      size,
      template,
      categories,
      show_tags,
      tags,
      show_attributes,
      attribute_list,
      show_reviews,
      show_price_range,
      stock,
      on_sale,
      sorting,
      product_tags,
      product_categories
    } = attributes;
    const blockProps = _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__.useBlockProps.save();
    return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      ...blockProps
    });
  }
});

/***/ }),

/***/ "./src/WpFilter.js":
/*!*************************!*\
  !*** ./src/WpFilter.js ***!
  \*************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/blocks */ "@wordpress/blocks");
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_blocks__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_server_side_render__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/server-side-render */ "@wordpress/server-side-render");
/* harmony import */ var _wordpress_server_side_render__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_server_side_render__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__);





const {
  __
} = wp.i18n;
(0,_wordpress_blocks__WEBPACK_IMPORTED_MODULE_1__.registerBlockType)('filter-plus/wp-filter', {
  title: __('Wordpress Filter', 'filter-plus'),
  icon: 'image-filter',
  category: 'text',
  attributes: {
    filter_type: {
      type: 'string',
      default: 'post'
    },
    custom_post: {
      type: 'string'
    },
    template: {
      type: 'string',
      default: '1'
    },
    show_categories: {
      type: 'string'
    },
    category_label: {
      type: 'string'
    },
    categories: {
      type: 'array',
      default: []
    },
    show_tags: {
      type: 'boolean'
    },
    tag_label: {
      type: 'string'
    },
    tags: {
      type: 'array',
      default: []
    },
    author: {
      type: 'boolean'
    },
    author_label: {
      type: 'string'
    },
    author_list: {
      type: 'array',
      default: []
    },
    custom_field: {
      type: 'boolean'
    },
    custom_field_label: {
      type: 'string'
    },
    meta_condition: {
      type: 'string',
      default: 'OR'
    },
    custom_field_list: {
      type: 'string'
    },
    post_tags: {
      type: 'boolean'
    },
    post_categories: {
      type: 'boolean'
    },
    post_author: {
      type: 'boolean'
    }
  },
  edit({
    attributes,
    setAttributes
  }) {
    const blockProps = (0,_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__.useBlockProps)();
    const {
      filter_type,
      custom_post,
      template,
      show_categories,
      category_label,
      categories,
      show_tags,
      tag_label,
      tags,
      author,
      author_label,
      author_list,
      custom_field,
      custom_field_label,
      meta_condition,
      custom_field_list,
      post_categories,
      post_tags,
      post_author
    } = attributes;
    function onChangeFilterType(newValue) {
      setAttributes({
        filter_type: newValue
      });
    }
    function onChangeCustomPost(newValue) {
      setAttributes({
        custom_post: newValue
      });
    }
    function onChangeTemplate(newValue) {
      setAttributes({
        template: newValue
      });
    }
    function onChangeShowCategory(newValue) {
      setAttributes({
        show_categories: newValue
      });
    }
    function onChangeCategoryLabel(newValue) {
      setAttributes({
        category_label: newValue
      });
    }
    function onChangeCatList(newValue) {
      setAttributes({
        categories: newValue
      });
    }
    function onChangeDisplayTags(newValue) {
      setAttributes({
        show_tags: newValue
      });
    }
    function onChangeTagLabel(newValue) {
      setAttributes({
        tag_label: newValue
      });
    }
    function onChangeTagist(newValue) {
      setAttributes({
        tags: newValue
      });
    }
    function onChangeShowAuthor(newValue) {
      setAttributes({
        author: newValue
      });
    }
    function onChangeAuthorLabel(newValue) {
      setAttributes({
        author_label: newValue
      });
    }
    function onChangeAuthorList(newValue) {
      setAttributes({
        author_list: newValue
      });
    }
    function onChangeCustomField(newValue) {
      setAttributes({
        custom_field: newValue
      });
    }
    function onChangeCustomFieldLabel(newValue) {
      setAttributes({
        custom_field_label: newValue
      });
    }
    function onChangeMetaCondition(newValue) {
      setAttributes({
        meta_condition: newValue
      });
    }
    function onChangeCustomFieldList(newValue) {
      setAttributes({
        custom_field_list: newValue
      });
    }
    function onChangePostCat(newValue) {
      setAttributes({
        post_categories: newValue
      });
    }
    function onChangePostTag(newValue) {
      setAttributes({
        post_tags: newValue
      });
    }
    function onChangePostAuthor(newValue) {
      setAttributes({
        post_author: newValue
      });
    }
    function pro_text() {
      return filterPlus.is_pro_active == 1 ? __('(Pro)', 'filter-plus') : '';
    }
    function is_pro_active() {
      return filterPlus.is_pro_active == 0 ? 0 : 1;
    }
    function getTemplates() {
      let templates = [{
        value: 1,
        label: __('Template-1', 'filter-plus') + ' ' + pro_text(),
        disabled: is_pro_active
      }];
      templates.push({
        value: 2,
        label: __('Template-2', 'filter-plus') + ' ' + pro_text(),
        disabled: is_pro_active
      });
      templates.push({
        value: 3,
        label: __('Template-3', 'filter-plus') + ' ' + pro_text(),
        disabled: is_pro_active
      });
      templates.push({
        value: 4,
        label: __('Template-4', 'filter-plus') + ' ' + pro_text(),
        disabled: is_pro_active
      });
      return templates;
    }
    return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__.InspectorControls, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.PanelBody, {
      title: __('Settings', 'filter-plus')
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.SelectControl, {
      label: __('Select Template', 'filter-plus'),
      value: template,
      options: getTemplates(),
      onChange: onChangeTemplate
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.SelectControl, {
      label: __('Select Filter Type', 'filter-plus'),
      value: filter_type,
      options: [{
        value: 'post',
        label: __('Post', 'filter-plus'),
        disabled: is_pro_active
      }, {
        value: 'custom_post',
        label: __('Custom Post', 'filter-plus'),
        disabled: is_pro_active
      }],
      onChange: onChangeFilterType
    }), filter_type == "custom_post" && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.SelectControl, {
      label: __('Select Custom Post Type', 'filter-plus'),
      value: custom_post,
      options: filterPlus?.custom_post_type,
      onChange: onChangeCustomPost
    })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.ToggleControl, {
      label: __('Display Categories', 'filter-plus'),
      checked: show_categories,
      onChange: onChangeShowCategory
    }), show_categories && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.TextControl, {
      multiple: true,
      label: __('Category Label', 'filter-plus'),
      help: __('Place Category Label', 'filter-plus'),
      value: category_label,
      onChange: onChangeCategoryLabel
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.SelectControl, {
      multiple: true,
      label: __('Category List', 'filter-plus'),
      value: categories,
      options: filterPlus?.wp_cats,
      onChange: onChangeCatList
    })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.ToggleControl, {
      label: __('Display Tags', 'filter-plus'),
      checked: show_tags,
      onChange: onChangeDisplayTags
    }), show_tags && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.TextControl, {
      multiple: true,
      label: __('Tag Label', 'filter-plus'),
      value: tag_label,
      onChange: onChangeTagLabel
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.SelectControl, {
      multiple: true,
      label: __('Tags', 'filter-plus'),
      value: tags,
      options: filterPlus?.post_tag,
      onChange: onChangeTagist
    })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.ToggleControl, {
      label: __('Display Authors', 'filter-plus'),
      checked: author,
      onChange: onChangeShowAuthor
    }), author && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.TextControl, {
      multiple: true,
      label: __('Author Label', 'filter-plus'),
      help: __('Place Author Label', 'filter-plus'),
      value: author_label,
      onChange: onChangeAuthorLabel
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.SelectControl, {
      multiple: true,
      label: __('Author List', 'filter-plus'),
      value: author_list,
      options: filterPlus?.author_list,
      onChange: onChangeAuthorList
    })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.ToggleControl, {
      label: __('Display Custom Field', 'filter-plus'),
      checked: custom_field,
      onChange: onChangeCustomField
    }), custom_field && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.TextControl, {
      multiple: true,
      label: __('Custom Field Label', 'filter-plus'),
      help: __('Custom Field Label', 'filter-plus'),
      value: custom_field_label,
      onChange: onChangeCustomFieldLabel
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.TextControl, {
      multiple: true,
      label: __('Custom Field Name', 'filter-plus'),
      help: __('Enter Exact Custom Field Name', 'filter-plus'),
      value: custom_field_list,
      onChange: onChangeCustomFieldList
    })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.ToggleControl, {
      label: __('Display Categories in Filter Result', 'filter-plus'),
      checked: post_categories,
      onChange: onChangePostCat
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.ToggleControl, {
      label: __('Display Tags in Filter Result', 'filter-plus'),
      checked: post_tags,
      onChange: onChangePostTag
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.ToggleControl, {
      label: __('Display Author in Filter Result', 'filter-plus'),
      checked: post_author,
      onChange: onChangePostAuthor
    }))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      ...blockProps
    }, __('Customize the Wordpress filtering options from the block settings', 'filter-plus')));
  },
  save({
    attributes
  }) {
    const {
      filter_type,
      custom_post,
      template,
      show_categories,
      category_label,
      categories,
      show_tags,
      tag_label,
      tags,
      author,
      author_label,
      author_list,
      custom_field,
      custom_field_label,
      meta_condition,
      custom_field_list,
      post_categories,
      post_tags,
      post_author
    } = attributes;
    const blockProps = _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__.useBlockProps.save();
    return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      ...blockProps
    });
  }
});

/***/ }),

/***/ "react":
/*!************************!*\
  !*** external "React" ***!
  \************************/
/***/ ((module) => {

module.exports = window["React"];

/***/ }),

/***/ "@wordpress/block-editor":
/*!*************************************!*\
  !*** external ["wp","blockEditor"] ***!
  \*************************************/
/***/ ((module) => {

module.exports = window["wp"]["blockEditor"];

/***/ }),

/***/ "@wordpress/blocks":
/*!********************************!*\
  !*** external ["wp","blocks"] ***!
  \********************************/
/***/ ((module) => {

module.exports = window["wp"]["blocks"];

/***/ }),

/***/ "@wordpress/components":
/*!************************************!*\
  !*** external ["wp","components"] ***!
  \************************************/
/***/ ((module) => {

module.exports = window["wp"]["components"];

/***/ }),

/***/ "@wordpress/server-side-render":
/*!******************************************!*\
  !*** external ["wp","serverSideRender"] ***!
  \******************************************/
/***/ ((module) => {

module.exports = window["wp"]["serverSideRender"];

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _WooFilter__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./WooFilter */ "./src/WooFilter.js");
/* harmony import */ var _WpFilter__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./WpFilter */ "./src/WpFilter.js");


})();

/******/ })()
;
//# sourceMappingURL=index.js.map