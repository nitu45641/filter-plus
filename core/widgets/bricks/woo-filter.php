<?php 

namespace FilterPlus\Core\Widgets\Bricks;

if ( ! defined( 'ABSPATH' ) ) exit;

class Woo_Filter extends \Bricks\Element {
  // Element properties
  public $category     = 'filter-plus'; // Use predefined element category 'general'
  public $name         = 'fplus-woo'; // Make sure to prefix your elements
  public $icon         = 'ti-bolt-alt'; // Themify icon font class
  public $css_selector = '.fplus-woo-wrapper'; // Default CSS selector
//   public $scripts      = ['prefixElementTest']; // Script(s) run when element is rendered on frontend or updated in builder

  // Return localised element label
  public function get_label() {
    return esc_html__( 'WooCommerce Product Filter', 'filter-plus' );
  }

  // Set builder control groups
  public function set_control_groups() {
    // Example content 
    $this->controls['exampleSelectTitleTag'] = [
        'tab' => 'content',
        'label' => esc_html__( 'Title tag', 'bricks' ),
        'type' => 'select',
        'options' => \FilterPlus\Utils\Helper::get_categories( '', 'assoc' ),
        'inline' => true,
        'placeholder' => esc_html__( 'Select tag', 'bricks' ),
        'multiple' => true, 
        'searchable' => true,
        'clearable' => true,
        'default' => '',
    ];

    $this->control_groups['filter_options'] = [ 
      'title' => esc_html__( 'Filter Options', 'filter-plus' ), 
      'tab' => 'content', 
    ];

  }
 
  // Set builder controls
  public function set_controls() {
    // templates
    $this->controls['template'] = [
        'tab' => 'content',
        'group' => 'filter_options',
        'label' => esc_html__( 'Style', 'filter-plus' ),
        'type' => 'select',
        'options' => \FilterPlus\Utils\Helper::widgets_templates(),
        'inline' => true,
        'placeholder' => esc_html__( 'Select Style', 'filter-plus' ),
        'multiple' => true, 
        'searchable' => true,
        'clearable' => true,
        'default' => '1',
    ];
    // Category
    $this->controls['category_label'] = [ 
      'tab' => 'content', 
      'group' => 'filter_options',
      'label' => esc_html__( 'Category Label', 'filter-plus' ),
      'type' => 'text',
      'default' => esc_html__( 'Place Category Label Here', 'filter-plus' ),
    ];

    $this->controls['categories'] = [
        'tab' => 'content',
        'group' => 'filter_options',
        'label' => esc_html__( 'Categories', 'filter-plus' ),
        'type' => 'select',
        'options' => \FilterPlus\Utils\Helper::get_categories( '', 'assoc' ),
        'inline' => true,
        'placeholder' => esc_html__( 'Select Categories', 'filter-plus' ),
        'multiple' => true, 
        'searchable' => true,
        'clearable' => true,
        'default' => '',
    ];

    // colors
    $this->controls['colors'] = [
        'tab' => 'content',
        'group' => 'filter_options',
        'label' => esc_html__( 'Show Color', 'filter-plus' ),
        'type' => 'checkbox',
        'inline' => true,
        'small' => true,
        'default' => true,
    ];

    $this->controls['color_label'] = [ 
        'tab' => 'content', 
        'group' => 'filter_options',
        'label' => esc_html__( 'Color Label', 'filter-plus' ),
        'type' => 'text',
        'default' => esc_html__( 'Place Color Label Here', 'filter-plus' ),
        'required' => ['colors', '=', true ],
    ];

    // Size
    $this->controls['size'] = [
        'tab' => 'content',
        'group' => 'filter_options',
        'label' => esc_html__( 'Show Size', 'filter-plus' ),
        'type' => 'checkbox',
        'inline' => true,
        'small' => true,
        'default' => true,
    ];

    $this->controls['size_label'] = [ 
        'tab' => 'content', 
        'group' => 'filter_options',
        'label' => esc_html__( 'Size Label', 'filter-plus' ),
        'type' => 'text',
        'default' => esc_html__( 'Place Size Label Here', 'filter-plus' ),
        'required' => ['size', '=', true ],
    ];

    // Tags
    $this->controls['show_tags'] = [
        'tab' => 'content',
        'group' => 'filter_options',
        'label' => esc_html__( 'Show Tags', 'filter-plus' ),
        'type' => 'checkbox',
        'inline' => true,
        'small' => true,
        'default' => true,
    ];

    $this->controls['tag_label'] = [ 
        'tab' => 'content', 
        'group' => 'filter_options',
        'label' => esc_html__( 'Tag Label', 'filter-plus' ),
        'type' => 'text',
        'default' => esc_html__( 'Place Tag Label Here', 'filter-plus' ),
        'required' => ['show_tags', '=', true ],
    ];

    $this->controls['tags'] = [
        'tab' => 'content',
        'group' => 'filter_options',
        'label' => esc_html__( 'Tags', 'filter-plus' ),
        'type' => 'select',
        'options' => \FilterPlus\Utils\Helper::get_product_tags( 'product_tag', 'assoc' ),
        'inline' => true,
        'placeholder' => esc_html__( 'Select Tag', 'filter-plus' ),
        'multiple' => true, 
        'searchable' => true,
        'clearable' => true,
        'default' => '',
        'required' => ['show_tags', '=', true ],
    ];
          
    // Attributes
    $this->controls['show_attributes'] = [
        'tab' => 'content',
        'group' => 'filter_options',
        'label' => esc_html__( 'Show Attributes', 'filter-plus' ),
        'type' => 'checkbox',
        'inline' => true,
        'small' => true,
        'default' => true,
    ];

    $this->controls['attribute_label'] = [ 
        'tab' => 'content', 
        'group' => 'filter_options',
        'label' => esc_html__( 'Attribute Label', 'filter-plus' ),
        'type' => 'text',
        'default' => esc_html__( 'Place Attribute Label Here', 'filter-plus' ),
        'required' => ['show_attributes', '=', true ],
    ];

    $this->controls['attributes'] = [
        'tab' => 'content',
        'group' => 'filter_options',
        'label' => esc_html__( 'Attributes', 'filter-plus' ),
        'type' => 'select',
        'options' => \FilterPlus\Utils\Helper::woo_attribute_list( 'assoc' ),
        'inline' => true,
        'placeholder' => esc_html__( 'Select Attributes', 'filter-plus' ),
        'multiple' => true, 
        'searchable' => true,
        'clearable' => true,
        'default' => '',
        'required' => ['show_attributes', '=', true ],
    ];

    // price range
    
  }

  // Enqueue element styles and scripts
  public function enqueue_scripts() {
    wp_enqueue_script( 'fplus-woo-script' );
  }

  // Render element HTML
  public function render() {
    // Set element attributes
    $root_classes[] = 'fplus-woo-wrapper';

    if ( ! empty( $this->settings['type'] ) ) {
      $root_classes[] = "color-{$this->settings['type']}";
    }

    // Add 'class' attribute to element root tag
    $this->set_attribute( '_root', 'class', $root_classes );

    echo "<div {$this->render_attributes( '_root' )}>"; 
    //   if ( ! empty( $this->settings['category_label'] ) ) {
    //     echo "<div>{$this->settings['category_label']}</div>";
    //   }
        echo do_shortcode("[filter_products]");

    echo '</div>';
  }
}