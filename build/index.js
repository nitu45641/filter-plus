/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

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
  title: 'WooCommerce Product Filter',
  icon: 'image-filter',
  category: 'text',
  attributes: {
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
      sorting,
      product_tags,
      product_categories
    } = attributes;
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
    function getTemplates() {
      let templates = [{
        value: 1,
        label: __('Template-1', 'filter-plus')
      }];
      if (filterPlus?.is_pro_active == true) {
        templates.push({
          value: 2,
          label: __('Template-2', 'filter-plus')
        });
      }
      return templates;
    }
    console.log(attributes);
    return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__.InspectorControls, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.PanelBody, {
      title: __('Settings', 'filter-plus')
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.SelectControl, {
      label: __('Select Template:', 'filter-plus'),
      value: template,
      options: getTemplates(),
      onChange: onChangeTemplate
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.SelectControl, {
      multiple: true,
      label: __('Category List:', 'filter-plus'),
      value: categories,
      options: filterPlus?.woo_categories,
      onChange: onChangeCatList
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
      label: __('Display Colors:', 'filter-plus'),
      checked: colors,
      onChange: onChangeDisplayColor
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
      label: __('Display Size:', 'filter-plus'),
      checked: size,
      onChange: onChangeDisplaySize
    }), filterPlus?.is_pro_active == true && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
      label: __('Display Tags:', 'filter-plus'),
      checked: show_tags,
      onChange: onChangeDisplayTags
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.SelectControl, {
      multiple: true,
      label: __('Tags:', 'filter-plus'),
      value: tags,
      options: filterPlus?.tags,
      onChange: onChangeTagist
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
      label: __('Display Attributes:', 'filter-plus'),
      checked: show_attributes,
      onChange: onChangeDisplayAttr
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.SelectControl, {
      multiple: true,
      label: __('Attributes:', 'filter-plus'),
      value: attribute_list,
      options: filterPlus?.attributes,
      onChange: onChangeAttr
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
      label: __('Display Reviews:', 'filter-plus'),
      checked: show_reviews,
      onChange: onChangeShowReviews
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
      label: __('Display Sorting:', 'filter-plus'),
      checked: sorting,
      onChange: onChangeSorting
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
      label: __('Display Tags in Filter Result:', 'filter-plus'),
      checked: product_tags,
      onChange: onChangeProductTag
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
      label: __('Display Categories in Filter Result:', 'filter-plus'),
      checked: product_categories,
      onChange: onChangeProductCat
    })))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      ...blockProps
    }, "This is the editor text!"));
  },
  save({
    attributes
  }) {
    const {
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
})();

/******/ })()
;
//# sourceMappingURL=index.js.map