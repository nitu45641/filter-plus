/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/blocks/woo-filter/index.js":
/*!****************************************!*\
  !*** ./src/blocks/woo-filter/index.js ***!
  \****************************************/
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
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__);





(0,_wordpress_blocks__WEBPACK_IMPORTED_MODULE_1__.registerBlockType)('filter-plus/woo-filter', {
  title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('WooCommerce Product Filter', 'filter-plus'),
  icon: 'image-filter',
  category: 'filter-plus-blocks',
  attributes: {
    template: {
      type: 'string',
      default: '1'
    },
    title: {
      type: 'string',
      default: ''
    },
    no_of_items: {
      type: 'number',
      default: 9
    },
    filter_position: {
      type: 'string',
      default: 'left'
    },
    pagination_style: {
      type: 'string',
      default: 'numbers'
    },
    category_template: {
      type: 'string',
      default: '1'
    },
    category_label: {
      type: 'string',
      default: ''
    },
    categories: {
      type: 'array',
      default: []
    },
    hide_empty_cat: {
      type: 'boolean',
      default: true
    },
    sub_categories: {
      type: 'boolean',
      default: true
    },
    product_count: {
      type: 'boolean',
      default: true
    },
    colors: {
      type: 'boolean',
      default: true
    },
    color_template: {
      type: 'string',
      default: '1'
    },
    color_label: {
      type: 'string',
      default: ''
    },
    size: {
      type: 'boolean',
      default: true
    },
    size_label: {
      type: 'string',
      default: ''
    },
    show_tags: {
      type: 'boolean',
      default: true
    },
    tag_label: {
      type: 'string',
      default: ''
    },
    tags: {
      type: 'array',
      default: []
    },
    show_attributes: {
      type: 'boolean',
      default: true
    },
    attribute_label: {
      type: 'string',
      default: ''
    },
    attributes: {
      type: 'array',
      default: []
    },
    show_price_range: {
      type: 'boolean',
      default: true
    },
    price_range_label: {
      type: 'string',
      default: ''
    },
    show_reviews: {
      type: 'boolean',
      default: true
    },
    review_template: {
      type: 'string',
      default: '1'
    },
    review_label: {
      type: 'string',
      default: ''
    },
    stock: {
      type: 'boolean',
      default: true
    },
    stock_label: {
      type: 'string',
      default: ''
    },
    on_sale: {
      type: 'boolean',
      default: true
    },
    on_sale_label: {
      type: 'string',
      default: ''
    },
    hide_prod_title: {
      type: 'boolean',
      default: true
    },
    hide_prod_desc: {
      type: 'boolean',
      default: true
    },
    hide_prod_price: {
      type: 'boolean',
      default: true
    },
    hide_prod_add_cart: {
      type: 'boolean',
      default: true
    },
    hide_prod_rating: {
      type: 'boolean',
      default: true
    },
    sorting: {
      type: 'boolean',
      default: true
    },
    product_categories: {
      type: 'boolean',
      default: true
    },
    product_tags: {
      type: 'boolean',
      default: true
    },
    masonry_style: {
      type: 'boolean',
      default: true
    }
  },
  edit({
    attributes,
    setAttributes
  }) {
    const blockProps = (0,_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__.useBlockProps)();

    // Debug: Log attributes whenever they change
    console.log('WooCommerce Filter Block Attributes:', attributes);
    const isPro = () => {
      return window.filterPlus?.is_pro_active == 1 ? (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('(Pro)', 'filter-plus') : '';
    };
    const isDisabled = () => {
      return window.filterPlus?.is_pro_active == 0 ? false : true;
    };
    const getTemplateOptions = () => {
      const disabled = isDisabled();
      let options = [{
        value: '1',
        label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Template-1', 'filter-plus') + ' ' + isPro(),
        disabled
      }];
      for (let i = 2; i <= 7; i++) {
        options.push({
          value: i.toString(),
          label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Template-' + i, 'filter-plus') + ' ' + isPro(),
          disabled
        });
      }
      return options;
    };
    return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__.InspectorControls, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.PanelBody, {
      title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Filter Options', 'filter-plus')
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Masonry Style', 'filter-plus'),
      checked: attributes.masonry_style,
      onChange: value => setAttributes({
        masonry_style: value
      })
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.SelectControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Select Style', 'filter-plus'),
      value: attributes.template,
      options: getTemplateOptions(),
      onChange: value => setAttributes({
        template: value
      })
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.TextControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Title', 'filter-plus'),
      value: attributes.title,
      onChange: value => setAttributes({
        title: value
      }),
      placeholder: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Place Title', 'filter-plus')
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.TextControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('No of Items Per Page', 'filter-plus'),
      type: "number",
      value: attributes.no_of_items,
      onChange: value => setAttributes({
        no_of_items: parseInt(value)
      }),
      placeholder: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Place No of Items Per Page', 'filter-plus')
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.SelectControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Filter Position', 'filter-plus'),
      value: attributes.filter_position,
      options: [{
        value: 'left',
        label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Left', 'filter-plus')
      }, {
        value: 'right',
        label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Right', 'filter-plus')
      }, {
        value: 'top',
        label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Top', 'filter-plus')
      }],
      onChange: value => setAttributes({
        filter_position: value
      })
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.SelectControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Pagination Style', 'filter-plus'),
      value: attributes.pagination_style,
      options: [{
        value: 'numbers',
        label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Numbers', 'filter-plus')
      }, {
        value: 'load_more',
        label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Load More', 'filter-plus')
      }, {
        value: 'infinite',
        label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Infinite Scroll', 'filter-plus')
      }],
      onChange: value => setAttributes({
        pagination_style: value
      })
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.SelectControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Select Category Filter Template', 'filter-plus'),
      value: attributes.category_template,
      options: [{
        value: '1',
        label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Template 1', 'filter-plus')
      }, {
        value: '2',
        label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Template 2', 'filter-plus')
      }, {
        value: '3',
        label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Template 3', 'filter-plus')
      }],
      onChange: value => setAttributes({
        category_template: value
      })
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.TextControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Category Label', 'filter-plus'),
      value: attributes.category_label,
      onChange: value => setAttributes({
        category_label: value
      }),
      placeholder: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Place Category Label Here', 'filter-plus')
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      style: {
        marginBottom: '16px'
      }
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      style: {
        display: 'flex',
        justifyContent: 'space-between',
        alignItems: 'center',
        marginBottom: '8px'
      }
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
      style: {
        fontWeight: '500',
        margin: 0
      }
    }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Categories', 'filter-plus')), attributes.categories.length > 0 && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
      type: "button",
      className: "button button-small",
      onClick: () => setAttributes({
        categories: []
      }),
      style: {
        fontSize: '11px',
        padding: '2px 8px',
        height: 'auto'
      }
    }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Clear All', 'filter-plus'))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      style: {
        maxHeight: '200px',
        overflowY: 'auto',
        border: '1px solid #ddd',
        padding: '8px',
        borderRadius: '4px',
        backgroundColor: '#fff'
      }
    }, (window.filterPlus?.woo_categories || []).map(cat => {
      // Normalize: ensure we're always working with strings
      const catValue = String(cat.value);
      const normalizedCategories = attributes.categories.map(c => String(c));
      const isChecked = normalizedCategories.includes(catValue);
      return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.CheckboxControl, {
        key: cat.value,
        label: cat.label,
        checked: isChecked,
        onChange: checked => {
          // Normalize all existing categories to strings
          let normalizedCurrent = attributes.categories.map(c => String(c));
          let newCategories;
          if (checked) {
            // Add category if not already present
            if (!normalizedCurrent.includes(catValue)) {
              newCategories = [...normalizedCurrent, catValue];
            } else {
              newCategories = normalizedCurrent;
            }
          } else {
            // Remove category
            newCategories = normalizedCurrent.filter(c => c !== catValue);
          }
          console.log('Category toggled:', cat.label, 'Checked:', checked, 'New categories:', newCategories);
          setAttributes({
            categories: newCategories
          });
        }
      });
    })), attributes.categories.length > 0 && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      style: {
        marginTop: '8px',
        fontSize: '12px',
        color: '#666'
      }
    }, "Selected: ", attributes.categories.length, " categor", attributes.categories.length === 1 ? 'y' : 'ies', (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      style: {
        fontSize: '11px',
        color: '#999',
        marginTop: '4px'
      }
    }, "IDs: ", attributes.categories.map(c => String(c)).join(', ')))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Hide Empty Category', 'filter-plus'),
      checked: attributes.hide_empty_cat,
      onChange: value => setAttributes({
        hide_empty_cat: value
      })
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Show Sub Categories', 'filter-plus'),
      checked: attributes.sub_categories,
      onChange: value => setAttributes({
        sub_categories: value
      })
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Show Product Count', 'filter-plus'),
      checked: attributes.product_count,
      onChange: value => setAttributes({
        product_count: value
      })
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Show Color', 'filter-plus'),
      checked: attributes.colors,
      onChange: value => setAttributes({
        colors: value
      })
    }), attributes.colors && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.SelectControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Select Color Filter Template', 'filter-plus'),
      value: attributes.color_template,
      options: [{
        value: '1',
        label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Template 1', 'filter-plus')
      }, {
        value: '2',
        label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Template 2', 'filter-plus')
      }],
      onChange: value => setAttributes({
        color_template: value
      })
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.TextControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Color Label', 'filter-plus'),
      value: attributes.color_label,
      onChange: value => setAttributes({
        color_label: value
      }),
      placeholder: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Place Color Label Here', 'filter-plus')
    })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Show Size', 'filter-plus'),
      checked: attributes.size,
      onChange: value => setAttributes({
        size: value
      })
    }), attributes.size && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.TextControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Size Label', 'filter-plus'),
      value: attributes.size_label,
      onChange: value => setAttributes({
        size_label: value
      }),
      placeholder: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Place Size Label Here', 'filter-plus')
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Show Tags', 'filter-plus'),
      checked: attributes.show_tags,
      onChange: value => setAttributes({
        show_tags: value
      })
    }), attributes.show_tags && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.TextControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Tag Label', 'filter-plus'),
      value: attributes.tag_label,
      onChange: value => setAttributes({
        tag_label: value
      }),
      placeholder: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Place Tag Label Here', 'filter-plus')
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.SelectControl, {
      multiple: true,
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Tags', 'filter-plus'),
      value: attributes.tags,
      options: window.filterPlus?.tags || [],
      onChange: value => setAttributes({
        tags: value
      })
    })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Show Attributes', 'filter-plus'),
      checked: attributes.show_attributes,
      onChange: value => setAttributes({
        show_attributes: value
      })
    }), attributes.show_attributes && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.TextControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Attribute Label', 'filter-plus'),
      value: attributes.attribute_label,
      onChange: value => setAttributes({
        attribute_label: value
      }),
      placeholder: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Place Attribute Label Here', 'filter-plus')
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.SelectControl, {
      multiple: true,
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Attributes', 'filter-plus'),
      value: attributes.attributes,
      options: window.filterPlus?.attributes || [],
      onChange: value => setAttributes({
        attributes: value
      })
    })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Show Price Range', 'filter-plus'),
      checked: attributes.show_price_range,
      onChange: value => setAttributes({
        show_price_range: value
      })
    }), attributes.show_price_range && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.TextControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Price Range Label', 'filter-plus'),
      value: attributes.price_range_label,
      onChange: value => setAttributes({
        price_range_label: value
      }),
      placeholder: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Place Price Range Label Here', 'filter-plus')
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Show Reviews', 'filter-plus'),
      checked: attributes.show_reviews,
      onChange: value => setAttributes({
        show_reviews: value
      })
    }), attributes.show_reviews && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.SelectControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Select Review Filter Template', 'filter-plus'),
      value: attributes.review_template,
      options: [{
        value: '1',
        label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Template 1', 'filter-plus')
      }, {
        value: '2',
        label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Template 2', 'filter-plus')
      }],
      onChange: value => setAttributes({
        review_template: value
      })
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.TextControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Review Label', 'filter-plus'),
      value: attributes.review_label,
      onChange: value => setAttributes({
        review_label: value
      }),
      placeholder: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Place Review Label Here', 'filter-plus')
    })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Filter By Stock', 'filter-plus'),
      checked: attributes.stock,
      onChange: value => setAttributes({
        stock: value
      })
    }), attributes.stock && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.TextControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Stock Label', 'filter-plus'),
      value: attributes.stock_label,
      onChange: value => setAttributes({
        stock_label: value
      }),
      placeholder: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Place Stock Label Here', 'filter-plus')
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Sales', 'filter-plus'),
      checked: attributes.on_sale,
      onChange: value => setAttributes({
        on_sale: value
      })
    }), attributes.on_sale && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.TextControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('On Sale Label', 'filter-plus'),
      value: attributes.on_sale_label,
      onChange: value => setAttributes({
        on_sale_label: value
      }),
      placeholder: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Place On Sale Label Here', 'filter-plus')
    })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.PanelBody, {
      title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Filter Result Options', 'filter-plus')
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Display Title', 'filter-plus'),
      checked: attributes.hide_prod_title,
      onChange: value => setAttributes({
        hide_prod_title: value
      })
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Display Description', 'filter-plus'),
      checked: attributes.hide_prod_desc,
      onChange: value => setAttributes({
        hide_prod_desc: value
      })
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Display Price', 'filter-plus'),
      checked: attributes.hide_prod_price,
      onChange: value => setAttributes({
        hide_prod_price: value
      })
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Display Add to Cart', 'filter-plus'),
      checked: attributes.hide_prod_add_cart,
      onChange: value => setAttributes({
        hide_prod_add_cart: value
      })
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Display Rating', 'filter-plus'),
      checked: attributes.hide_prod_rating,
      onChange: value => setAttributes({
        hide_prod_rating: value
      })
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Display Sorting', 'filter-plus'),
      checked: attributes.sorting,
      onChange: value => setAttributes({
        sorting: value
      })
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Display Categories', 'filter-plus'),
      checked: attributes.product_categories,
      onChange: value => setAttributes({
        product_categories: value
      })
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Display Tags', 'filter-plus'),
      checked: attributes.product_tags,
      onChange: value => setAttributes({
        product_tags: value
      })
    }))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      ...blockProps
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      style: {
        border: '2px dashed #ddd',
        borderRadius: '8px',
        padding: '40px 20px',
        textAlign: 'center',
        backgroundColor: '#f9f9f9',
        minHeight: '300px',
        display: 'flex',
        alignItems: 'center',
        justifyContent: 'center'
      }
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      style: {
        fontSize: '48px',
        marginBottom: '16px',
        opacity: '0.5'
      }
    }, "\uD83D\uDECD\uFE0F"), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("h3", {
      style: {
        margin: '0 0 12px 0',
        fontSize: '20px',
        fontWeight: '600',
        color: '#1e1e1e'
      }
    }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('WooCommerce Product Filter', 'filter-plus')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", {
      style: {
        margin: '0 0 8px 0',
        color: '#757575',
        fontSize: '14px'
      }
    }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Template:', 'filter-plus'), " ", (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("strong", null, attributes.template)), attributes.title && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", {
      style: {
        margin: '0 0 8px 0',
        color: '#757575',
        fontSize: '14px'
      }
    }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Title:', 'filter-plus'), " ", (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("strong", null, attributes.title)), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", {
      style: {
        margin: '8px 0 0 0',
        color: '#999',
        fontSize: '12px',
        fontStyle: 'italic'
      }
    }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Use the block settings panel to configure filter options →', 'filter-plus'))))));
  },
  save() {
    return null; // Server-side rendering
  }
});

/***/ }),

/***/ "./src/blocks/wp-filter/index.js":
/*!***************************************!*\
  !*** ./src/blocks/wp-filter/index.js ***!
  \***************************************/
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
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__);





(0,_wordpress_blocks__WEBPACK_IMPORTED_MODULE_1__.registerBlockType)('filter-plus/wp-filter', {
  title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Filter Plus - WP Content Filter', 'filter-plus'),
  icon: 'filter',
  category: 'filter-plus-blocks',
  attributes: {
    filter_type: {
      type: 'string',
      default: 'post'
    },
    custom_post: {
      type: 'string',
      default: ''
    },
    template: {
      type: 'string',
      default: '1'
    },
    title: {
      type: 'string',
      default: ''
    },
    no_of_items: {
      type: 'number',
      default: 9
    },
    show_categories: {
      type: 'boolean',
      default: true
    },
    category_label: {
      type: 'string',
      default: ''
    },
    categories: {
      type: 'array',
      default: []
    },
    sub_categories: {
      type: 'boolean',
      default: true
    },
    show_tags: {
      type: 'boolean',
      default: true
    },
    tag_label: {
      type: 'string',
      default: ''
    },
    tags: {
      type: 'array',
      default: []
    },
    author: {
      type: 'boolean',
      default: false
    },
    author_label: {
      type: 'string',
      default: ''
    },
    author_list: {
      type: 'array',
      default: []
    },
    custom_field: {
      type: 'boolean',
      default: false
    },
    custom_field_label: {
      type: 'string',
      default: ''
    },
    meta_condition: {
      type: 'string',
      default: 'OR'
    },
    custom_field_list: {
      type: 'string',
      default: ''
    },
    post_categories: {
      type: 'boolean',
      default: true
    },
    post_tags: {
      type: 'boolean',
      default: true
    },
    post_author: {
      type: 'boolean',
      default: true
    },
    hide_wp_title: {
      type: 'boolean',
      default: true
    },
    hide_wp_desc: {
      type: 'boolean',
      default: true
    }
  },
  edit({
    attributes,
    setAttributes
  }) {
    const blockProps = (0,_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__.useBlockProps)();
    const isPro = () => {
      return window.filterPlus?.is_pro_active == 1 ? (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('(Pro)', 'filter-plus') : '';
    };
    const isDisabled = () => {
      return window.filterPlus?.is_pro_active == 0 ? false : true;
    };
    const getTemplateOptions = () => {
      const disabled = isDisabled();
      let options = [];
      for (let i = 1; i <= 3; i++) {
        options.push({
          value: i.toString(),
          label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Template-' + i, 'filter-plus') + ' ' + isPro(),
          disabled
        });
      }
      return options;
    };
    return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__.InspectorControls, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.PanelBody, {
      title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Filter Options', 'filter-plus')
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.SelectControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Select Template', 'filter-plus'),
      value: attributes.template,
      options: getTemplateOptions(),
      onChange: value => setAttributes({
        template: value
      })
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.SelectControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Select Filter Type', 'filter-plus'),
      value: attributes.filter_type,
      options: [{
        value: 'post',
        label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Post', 'filter-plus'),
        disabled: isDisabled()
      }, {
        value: 'custom_post',
        label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Custom Post', 'filter-plus'),
        disabled: isDisabled()
      }],
      onChange: value => setAttributes({
        filter_type: value
      })
    }), attributes.filter_type === 'custom_post' && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.SelectControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Select Custom Post Type', 'filter-plus'),
      value: attributes.custom_post,
      options: window.filterPlus?.custom_post_type || [],
      onChange: value => setAttributes({
        custom_post: value
      })
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.TextControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Title', 'filter-plus'),
      value: attributes.title,
      onChange: value => setAttributes({
        title: value
      }),
      placeholder: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Place Title', 'filter-plus')
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.TextControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('No of Items Per Page', 'filter-plus'),
      type: "number",
      value: attributes.no_of_items,
      onChange: value => setAttributes({
        no_of_items: parseInt(value)
      }),
      placeholder: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Place No of Items Per Page', 'filter-plus')
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Display Categories', 'filter-plus'),
      checked: attributes.show_categories,
      onChange: value => setAttributes({
        show_categories: value
      })
    }), attributes.show_categories && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.TextControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Category Label', 'filter-plus'),
      value: attributes.category_label,
      onChange: value => setAttributes({
        category_label: value
      }),
      placeholder: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Place Category Label', 'filter-plus')
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      style: {
        marginBottom: '12px'
      }
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
      style: {
        display: 'block',
        marginBottom: '8px',
        fontWeight: '500'
      }
    }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Category List', 'filter-plus')), (window.filterPlus?.wp_cats || []).map(option => (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.CheckboxControl, {
      key: option.value,
      label: option.label,
      checked: attributes.categories.includes(option.value),
      onChange: checked => {
        const newCategories = checked ? [...attributes.categories, option.value] : attributes.categories.filter(v => v !== option.value);
        setAttributes({
          categories: newCategories
        });
      }
    }))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Display Sub Categories', 'filter-plus'),
      checked: attributes.sub_categories,
      onChange: value => setAttributes({
        sub_categories: value
      })
    })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Display Tags', 'filter-plus'),
      checked: attributes.show_tags,
      onChange: value => setAttributes({
        show_tags: value
      })
    }), attributes.show_tags && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.TextControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Tag Label', 'filter-plus'),
      value: attributes.tag_label,
      onChange: value => setAttributes({
        tag_label: value
      })
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      style: {
        marginBottom: '12px'
      }
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
      style: {
        display: 'block',
        marginBottom: '8px',
        fontWeight: '500'
      }
    }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Tags', 'filter-plus')), (window.filterPlus?.post_tag || []).map(option => (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.CheckboxControl, {
      key: option.value,
      label: option.label,
      checked: attributes.tags.includes(option.value),
      onChange: checked => {
        const newTags = checked ? [...attributes.tags, option.value] : attributes.tags.filter(v => v !== option.value);
        setAttributes({
          tags: newTags
        });
      }
    })))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Display Authors', 'filter-plus'),
      checked: attributes.author,
      onChange: value => setAttributes({
        author: value
      })
    }), attributes.author && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.TextControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Author Label', 'filter-plus'),
      value: attributes.author_label,
      onChange: value => setAttributes({
        author_label: value
      }),
      placeholder: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Place Author Label', 'filter-plus')
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      style: {
        marginBottom: '12px'
      }
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
      style: {
        display: 'block',
        marginBottom: '8px',
        fontWeight: '500'
      }
    }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Author List', 'filter-plus')), (window.filterPlus?.author_list || []).map(option => (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.CheckboxControl, {
      key: option.value,
      label: option.label,
      checked: attributes.author_list.includes(option.value),
      onChange: checked => {
        const newAuthors = checked ? [...attributes.author_list, option.value] : attributes.author_list.filter(v => v !== option.value);
        setAttributes({
          author_list: newAuthors
        });
      }
    })))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Display Custom Field', 'filter-plus'),
      checked: attributes.custom_field,
      onChange: value => setAttributes({
        custom_field: value
      })
    }), attributes.custom_field && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.TextControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Custom Field Label', 'filter-plus'),
      value: attributes.custom_field_label,
      onChange: value => setAttributes({
        custom_field_label: value
      }),
      placeholder: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Custom Field Label', 'filter-plus')
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.TextControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Custom Field Name', 'filter-plus'),
      value: attributes.custom_field_list,
      onChange: value => setAttributes({
        custom_field_list: value
      }),
      help: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Enter Exact Custom Field Name', 'filter-plus')
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.SelectControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Meta Condition', 'filter-plus'),
      value: attributes.meta_condition,
      options: [{
        value: 'OR',
        label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('OR', 'filter-plus')
      }, {
        value: 'AND',
        label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('AND', 'filter-plus')
      }],
      onChange: value => setAttributes({
        meta_condition: value
      })
    }))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.PanelBody, {
      title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Filter Result Options', 'filter-plus')
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Hide Title', 'filter-plus'),
      checked: attributes.hide_wp_title,
      onChange: value => setAttributes({
        hide_wp_title: value
      })
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Hide Description', 'filter-plus'),
      checked: attributes.hide_wp_desc,
      onChange: value => setAttributes({
        hide_wp_desc: value
      })
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Display Categories in Filter Result', 'filter-plus'),
      checked: attributes.post_categories,
      onChange: value => setAttributes({
        post_categories: value
      })
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Display Tags in Filter Result', 'filter-plus'),
      checked: attributes.post_tags,
      onChange: value => setAttributes({
        post_tags: value
      })
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Display Author in Filter Result', 'filter-plus'),
      checked: attributes.post_author,
      onChange: value => setAttributes({
        post_author: value
      })
    }))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      ...blockProps
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "filter-plus-block-placeholder",
      style: {
        border: '1px solid #e0e0e0',
        borderRadius: '4px',
        padding: '20px',
        backgroundColor: '#fff',
        minHeight: '400px'
      }
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      style: {
        display: 'flex',
        gap: '20px',
        flexDirection: attributes.filter_position === 'top' ? 'column' : 'row'
      }
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      style: {
        width: attributes.filter_position === 'top' ? '100%' : '250px',
        backgroundColor: '#f9f9f9',
        padding: '15px',
        borderRadius: '4px',
        border: '1px solid #e0e0e0'
      }
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      style: {
        marginBottom: '20px',
        textAlign: 'center',
        color: '#666',
        fontSize: '12px'
      }
    }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Filter Section', 'filter-plus')), attributes.show_categories && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      style: {
        marginBottom: '15px'
      }
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      style: {
        fontWeight: '600',
        fontSize: '14px',
        marginBottom: '8px',
        color: '#333'
      }
    }, attributes.category_label || (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Categories', 'filter-plus')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      style: {
        fontSize: '12px',
        color: '#666',
        paddingLeft: '10px'
      }
    }, ['□ Category 1', '□ Category 2', '□ Category 3'].map((item, i) => (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      key: i,
      style: {
        padding: '4px 0'
      }
    }, item)))), attributes.show_tags && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      style: {
        marginBottom: '15px'
      }
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      style: {
        fontWeight: '600',
        fontSize: '14px',
        marginBottom: '8px',
        color: '#333'
      }
    }, attributes.tag_label || (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Tags', 'filter-plus')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      style: {
        fontSize: '12px',
        color: '#666',
        paddingLeft: '10px'
      }
    }, ['□ Tag 1', '□ Tag 2', '□ Tag 3'].map((item, i) => (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      key: i,
      style: {
        padding: '4px 0'
      }
    }, item)))), attributes.author && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      style: {
        marginBottom: '15px'
      }
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      style: {
        fontWeight: '600',
        fontSize: '14px',
        marginBottom: '8px',
        color: '#333'
      }
    }, attributes.author_label || (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Authors', 'filter-plus')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      style: {
        fontSize: '12px',
        color: '#666',
        paddingLeft: '10px'
      }
    }, ['□ Author 1', '□ Author 2'].map((item, i) => (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      key: i,
      style: {
        padding: '4px 0'
      }
    }, item)))), attributes.custom_field && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      style: {
        marginBottom: '15px'
      }
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      style: {
        fontWeight: '600',
        fontSize: '14px',
        marginBottom: '8px',
        color: '#333'
      }
    }, attributes.custom_field_label || (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Custom Field', 'filter-plus')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      style: {
        fontSize: '12px',
        color: '#666',
        paddingLeft: '10px'
      }
    }, ['□ Option 1', '□ Option 2'].map((item, i) => (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      key: i,
      style: {
        padding: '4px 0'
      }
    }, item))))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      style: {
        flex: 1
      }
    }, attributes.title && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("h2", {
      style: {
        fontSize: '24px',
        fontWeight: '600',
        marginBottom: '20px',
        color: '#1e1e1e'
      }
    }, attributes.title), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      style: {
        display: 'grid',
        gridTemplateColumns: attributes.template === '1' ? 'repeat(auto-fill, minmax(280px, 1fr))' : attributes.template === '2' ? 'repeat(auto-fill, minmax(250px, 1fr))' : 'repeat(auto-fill, minmax(300px, 1fr))',
        gap: attributes.template === '1' ? '20px' : attributes.template === '2' ? '15px' : '25px'
      }
    }, [{
      title: 'Getting Started with WordPress',
      cat: 'Tutorial',
      tag: 'Beginner',
      author: 'John Doe',
      date: 'March 15, 2024'
    }, {
      title: 'Advanced Filter Techniques',
      cat: 'Guide',
      tag: 'Advanced',
      author: 'Jane Smith',
      date: 'March 14, 2024'
    }, {
      title: 'Building Custom Post Types',
      cat: 'Development',
      tag: 'Developer',
      author: 'Mike Johnson',
      date: 'March 13, 2024'
    }, {
      title: 'Content Strategy Tips',
      cat: 'Marketing',
      tag: 'Content',
      author: 'Sarah Lee',
      date: 'March 12, 2024'
    }, {
      title: 'SEO Best Practices',
      cat: 'SEO',
      tag: 'Optimization',
      author: 'Tom Wilson',
      date: 'March 11, 2024'
    }, {
      title: 'Plugin Development Guide',
      cat: 'Development',
      tag: 'Plugin',
      author: 'John Doe',
      date: 'March 10, 2024'
    }].slice(0, parseInt(attributes.no_of_items) || 6).map((item, index) => {
      // Template 1 - Card Style
      if (attributes.template === '1') {
        return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
          key: index,
          style: {
            border: '1px solid #e5e7eb',
            borderRadius: '8px',
            overflow: 'hidden',
            backgroundColor: '#fff',
            boxShadow: '0 1px 3px rgba(0,0,0,0.1)',
            transition: 'transform 0.2s'
          }
        }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
          style: {
            height: '160px',
            backgroundColor: '#f0f0f1',
            display: 'flex',
            alignItems: 'center',
            justifyContent: 'center',
            position: 'relative'
          }
        }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("svg", {
          width: "60",
          height: "60",
          viewBox: "0 0 60 60",
          fill: "none",
          xmlns: "http://www.w3.org/2000/svg"
        }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("rect", {
          width: "60",
          height: "60",
          fill: "#a7aaad"
        }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
          d: "M36.5 32.5L30 25L20 37.5H40L36.5 32.5Z",
          fill: "#f0f0f1"
        }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("circle", {
          cx: "25",
          cy: "22.5",
          r: "3.5",
          fill: "#f0f0f1"
        }))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
          style: {
            padding: '16px'
          }
        }, attributes.post_categories && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
          style: {
            display: 'inline-block',
            padding: '4px 10px',
            backgroundColor: '#e0e7ff',
            color: '#4338ca',
            borderRadius: '12px',
            fontSize: '11px',
            fontWeight: '600',
            marginBottom: '8px'
          }
        }, item.cat), attributes.hide_wp_title && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("h3", {
          style: {
            fontSize: '16px',
            fontWeight: '600',
            color: '#1e1e1e',
            marginBottom: '8px',
            lineHeight: '1.4'
          }
        }, item.title), attributes.hide_wp_desc && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", {
          style: {
            fontSize: '13px',
            color: '#6b7280',
            lineHeight: '1.6',
            marginBottom: '12px'
          }
        }, "Lorem ipsum dolor sit amet, consectetur adipiscing elit..."), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
          style: {
            display: 'flex',
            justifyContent: 'space-between',
            alignItems: 'center',
            fontSize: '12px',
            color: '#9ca3af',
            borderTop: '1px solid #f3f4f6',
            paddingTop: '12px'
          }
        }, attributes.post_author && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", null, "\uD83D\uDC64 ", item.author), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", null, "\uD83D\uDCC5 ", item.date)), attributes.post_tags && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
          style: {
            marginTop: '8px'
          }
        }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
          style: {
            display: 'inline-block',
            padding: '2px 8px',
            backgroundColor: '#f3f4f6',
            color: '#6b7280',
            borderRadius: '4px',
            fontSize: '10px'
          }
        }, item.tag))));
      }

      // Template 2 - Minimal Style
      if (attributes.template === '2') {
        return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
          key: index,
          style: {
            border: '1px solid #e5e7eb',
            borderRadius: '4px',
            overflow: 'hidden',
            backgroundColor: '#fff',
            padding: '16px'
          }
        }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
          style: {
            width: '100%',
            height: '140px',
            backgroundColor: '#f0f0f1',
            borderRadius: '4px',
            marginBottom: '12px',
            display: 'flex',
            alignItems: 'center',
            justifyContent: 'center'
          }
        }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("svg", {
          width: "50",
          height: "50",
          viewBox: "0 0 60 60",
          fill: "none",
          xmlns: "http://www.w3.org/2000/svg"
        }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("rect", {
          width: "60",
          height: "60",
          fill: "#a7aaad"
        }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
          d: "M36.5 32.5L30 25L20 37.5H40L36.5 32.5Z",
          fill: "#f0f0f1"
        }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("circle", {
          cx: "25",
          cy: "22.5",
          r: "3.5",
          fill: "#f0f0f1"
        }))), attributes.hide_wp_title && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("h3", {
          style: {
            fontSize: '15px',
            fontWeight: '600',
            color: '#111827',
            marginBottom: '6px'
          }
        }, item.title), attributes.hide_wp_desc && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", {
          style: {
            fontSize: '12px',
            color: '#6b7280',
            lineHeight: '1.5',
            marginBottom: '10px'
          }
        }, "Brief description of the content goes here..."), attributes.post_categories && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
          style: {
            fontSize: '11px',
            color: '#3b82f6',
            fontWeight: '500',
            marginBottom: '6px'
          }
        }, "\uD83D\uDCC1 ", item.cat), attributes.post_author && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
          style: {
            fontSize: '11px',
            color: '#9ca3af'
          }
        }, "By ", item.author));
      }

      // Template 3 - Modern Style
      return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
        key: index,
        style: {
          borderRadius: '12px',
          overflow: 'hidden',
          backgroundColor: '#fff',
          boxShadow: '0 4px 6px rgba(0,0,0,0.07)',
          transition: 'all 0.3s'
        }
      }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
        style: {
          height: '180px',
          backgroundColor: '#f0f0f1',
          display: 'flex',
          alignItems: 'center',
          justifyContent: 'center',
          position: 'relative'
        }
      }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("svg", {
        width: "70",
        height: "70",
        viewBox: "0 0 60 60",
        fill: "none",
        xmlns: "http://www.w3.org/2000/svg"
      }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("rect", {
        width: "60",
        height: "60",
        fill: "#a7aaad"
      }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
        d: "M36.5 32.5L30 25L20 37.5H40L36.5 32.5Z",
        fill: "#f0f0f1"
      }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("circle", {
        cx: "25",
        cy: "22.5",
        r: "3.5",
        fill: "#f0f0f1"
      })), attributes.post_categories && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
        style: {
          position: 'absolute',
          top: '12px',
          right: '12px',
          backgroundColor: 'rgba(255,255,255,0.9)',
          color: '#1e1e1e',
          padding: '6px 12px',
          borderRadius: '20px',
          fontSize: '11px',
          fontWeight: '600'
        }
      }, item.cat)), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
        style: {
          padding: '20px'
        }
      }, attributes.hide_wp_title && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("h3", {
        style: {
          fontSize: '17px',
          fontWeight: '700',
          color: '#1e1e1e',
          marginBottom: '10px',
          lineHeight: '1.4'
        }
      }, item.title), attributes.hide_wp_desc && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", {
        style: {
          fontSize: '13px',
          color: '#6b7280',
          lineHeight: '1.6',
          marginBottom: '14px'
        }
      }, "Discover amazing content and learn new techniques..."), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
        style: {
          display: 'flex',
          justifyContent: 'space-between',
          alignItems: 'center',
          paddingTop: '12px',
          borderTop: '1px solid #f3f4f6'
        }
      }, attributes.post_author && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
        style: {
          fontSize: '12px',
          color: '#6b7280',
          fontWeight: '500'
        }
      }, item.author), attributes.post_tags && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
        style: {
          fontSize: '10px',
          backgroundColor: '#f3f4f6',
          color: '#4b5563',
          padding: '4px 10px',
          borderRadius: '12px',
          fontWeight: '600'
        }
      }, item.tag))));
    })))))));
  },
  save() {
    return null; // Server-side rendering
  }
});

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

/***/ "@wordpress/i18n":
/*!******************************!*\
  !*** external ["wp","i18n"] ***!
  \******************************/
/***/ ((module) => {

module.exports = window["wp"]["i18n"];

/***/ }),

/***/ "react":
/*!************************!*\
  !*** external "React" ***!
  \************************/
/***/ ((module) => {

module.exports = window["React"];

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
// This entry needs to be wrapped in an IIFE because it needs to be isolated against other modules in the chunk.
(() => {
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _blocks_woo_filter__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./blocks/woo-filter */ "./src/blocks/woo-filter/index.js");
/* harmony import */ var _blocks_wp_filter__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./blocks/wp-filter */ "./src/blocks/wp-filter/index.js");
/**
 * Filter Plus Gutenberg Blocks
 * Entry point for all blocks
 */

// Import blocks


})();

/******/ })()
;
//# sourceMappingURL=index.js.map