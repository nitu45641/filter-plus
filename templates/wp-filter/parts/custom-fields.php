<?php

    if ( ! defined( 'ABSPATH' ) ) exit; 

    use FilterPlus\Core\Admin\FilterOptions\Helper as OptionHelper;
    if ($custom_field_list == '') {
        return;
    }
    $filterplus_lists = array();
    if ( !class_exists('FilterPlusPro') ) {
        // Comma separated meta keys -> one section per key. Labels may be comma separated in the same order.
        $filterplus_keys   = array_values( array_filter( array_map( 'trim', explode( ',', (string) $custom_field_list ) ), 'strlen' ) );
        $filterplus_labels = array_map( 'trim', explode( ',', (string) $custom_field_label ) );

        foreach ( $filterplus_keys as $filterplus_i => $filterplus_meta_key ) {
            if ( ! empty( $filterplus_labels[ $filterplus_i ] ) ) {
                $filterplus_label = $filterplus_labels[ $filterplus_i ];
            } elseif ( 1 === count( $filterplus_keys ) && '' !== trim( (string) $custom_field_label ) ) {
                $filterplus_label = $custom_field_label;
            } else {
                $filterplus_label = ucwords( str_replace( array( '_', '-' ), ' ', ltrim( $filterplus_meta_key, '_' ) ) );
            }
            $filterplus_lists[] = array( 'label' => $filterplus_label, 'style' => 'checkbox', 'custom_field_list' => $filterplus_meta_key );
        }
    }
    else{
        $filterplus_lists	= OptionHelper::instance()->get_filter_option_list($custom_field_list);
    }
    if (empty($filterplus_lists)) {
        return;
    }

    foreach( $filterplus_lists as $filterplus_item ):

        // Date Range style: From / To date pickers instead of one input per stored value.
        if ( isset( $filterplus_item['style'] ) && 'date_range' === $filterplus_item['style'] ) {
            $filterplus_bounds = OptionHelper::instance()->get_date_bounds( $filterplus_item['custom_field_list'] );
            $filterplus_dr_id  = wp_unique_id( 'fp-date-range-' );
            ?>
            <div class="sidebar-row fp-date-range-row">
                <h4 class="sidebar-label" id="<?php echo esc_attr( $filterplus_dr_id ); ?>-label"><?php echo esc_html( $filterplus_item['label'] ); ?></h4>
                <div class="fp-date-range" role="group" aria-labelledby="<?php echo esc_attr( $filterplus_dr_id ); ?>-label"
                    data-meta_key="<?php echo esc_attr( $filterplus_item['custom_field_list'] ); ?>"
                    data-label="<?php echo esc_attr( $filterplus_item['label'] ); ?>">
                    <label class="fp-date-range__field">
                        <span><?php esc_html_e( 'From', 'filter-plus' ); ?></span>
                        <input type="date" class="fp-date-from" min="<?php echo esc_attr( $filterplus_bounds['min'] ); ?>" max="<?php echo esc_attr( $filterplus_bounds['max'] ); ?>" />
                    </label>
                    <label class="fp-date-range__field">
                        <span><?php esc_html_e( 'To', 'filter-plus' ); ?></span>
                        <input type="date" class="fp-date-to" min="<?php echo esc_attr( $filterplus_bounds['min'] ); ?>" max="<?php echo esc_attr( $filterplus_bounds['max'] ); ?>" />
                    </label>
                </div>
                <button type="button" class="fp-date-clear" hidden><?php esc_html_e( 'Clear dates', 'filter-plus' ); ?></button>
            </div>
            <?php
            continue;
        }

        // Price Range style: histogram + two-handle slider + Min / Max boxes.
        if ( isset( $filterplus_item['style'] ) && 'price_range' === $filterplus_item['style'] ) {
            $filterplus_stats = OptionHelper::instance()->get_number_stats( $filterplus_item['custom_field_list'] );
            if ( $filterplus_stats['max'] <= $filterplus_stats['min'] ) {
                continue; // no numeric values to filter by
            }
            $filterplus_peak = max( 1, max( $filterplus_stats['bars'] ) );
            $filterplus_nr_id = wp_unique_id( 'fp-num-range-' );
            $filterplus_tpl   = isset( $filterplus_item['style_template'] ) && '2' === (string) $filterplus_item['style_template'] ? '2' : '1';
            ?>
            <div class="sidebar-row fp-num-range-row fp-num-tpl-<?php echo esc_attr( $filterplus_tpl ); ?>">
                <h4 class="sidebar-label" id="<?php echo esc_attr( $filterplus_nr_id ); ?>-label"><?php echo esc_html( $filterplus_item['label'] ); ?></h4>
                <div class="fp-num-range" role="group" aria-labelledby="<?php echo esc_attr( $filterplus_nr_id ); ?>-label"
                    data-meta_key="<?php echo esc_attr( $filterplus_item['custom_field_list'] ); ?>"
                    data-label="<?php echo esc_attr( $filterplus_item['label'] ); ?>"
                    data-min="<?php echo esc_attr( $filterplus_stats['min'] ); ?>"
                    data-max="<?php echo esc_attr( $filterplus_stats['max'] ); ?>">
                    <?php if ( '1' === $filterplus_tpl ) : // Template 1: histogram + slider + boxes ?>
                    <div class="fp-num-hist" aria-hidden="true">
                        <?php foreach ( $filterplus_stats['bars'] as $filterplus_bar ) : ?>
                            <span class="is-in" style="height:<?php echo esc_attr( max( 8, round( $filterplus_bar / $filterplus_peak * 100 ) ) ); ?>%"></span>
                        <?php endforeach; ?>
                    </div>
                    <div class="fp-num-slider">
                        <div class="fp-num-track" aria-hidden="true"><div class="fp-num-fill"></div></div>
                        <input type="range" class="fp-num-lo" min="<?php echo esc_attr( $filterplus_stats['min'] ); ?>" max="<?php echo esc_attr( $filterplus_stats['max'] ); ?>" step="<?php echo esc_attr( $filterplus_stats['step'] ); ?>" value="<?php echo esc_attr( $filterplus_stats['min'] ); ?>" aria-label="<?php esc_attr_e( 'Minimum', 'filter-plus' ); ?>" />
                        <input type="range" class="fp-num-hi" min="<?php echo esc_attr( $filterplus_stats['min'] ); ?>" max="<?php echo esc_attr( $filterplus_stats['max'] ); ?>" step="<?php echo esc_attr( $filterplus_stats['step'] ); ?>" value="<?php echo esc_attr( $filterplus_stats['max'] ); ?>" aria-label="<?php esc_attr_e( 'Maximum', 'filter-plus' ); ?>" />
                    </div>
                    <?php else : // Template 2: Min / Max boxes only (values kept in hidden fields) ?>
                    <input type="hidden" class="fp-num-lo" value="<?php echo esc_attr( $filterplus_stats['min'] ); ?>" />
                    <input type="hidden" class="fp-num-hi" value="<?php echo esc_attr( $filterplus_stats['max'] ); ?>" />
                    <?php endif; ?>
                    <div class="fp-num-boxes">
                        <label class="fp-num-box"><span><?php esc_html_e( 'Min', 'filter-plus' ); ?></span>
                            <input type="number" class="fp-num-min" inputmode="decimal" min="<?php echo esc_attr( $filterplus_stats['min'] ); ?>" max="<?php echo esc_attr( $filterplus_stats['max'] ); ?>" step="any" value="<?php echo esc_attr( $filterplus_stats['min'] ); ?>" />
                        </label>
                        <span class="fp-num-dash" aria-hidden="true">–</span>
                        <label class="fp-num-box"><span><?php esc_html_e( 'Max', 'filter-plus' ); ?></span>
                            <input type="number" class="fp-num-max" inputmode="decimal" min="<?php echo esc_attr( $filterplus_stats['min'] ); ?>" max="<?php echo esc_attr( $filterplus_stats['max'] ); ?>" step="any" value="<?php echo esc_attr( $filterplus_stats['max'] ); ?>" />
                        </label>
                    </div>
                </div>
                <button type="button" class="fp-range-clear" hidden><?php esc_html_e( 'Reset', 'filter-plus' ); ?></button>
            </div>
            <?php
            continue;
        }

        // Star Rating style: "N+ stars" buttons (one choice).
        if ( isset( $filterplus_item['style'] ) && 'rating' === $filterplus_item['style'] ) {
            $filterplus_tpl  = isset( $filterplus_item['style_template'] ) && '2' === (string) $filterplus_item['style_template'] ? '2' : '1';
            $filterplus_star_svg = '<svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2.5l2.9 6.1 6.6.8-4.9 4.6 1.3 6.6L12 17.3 6.1 20.6l1.3-6.6L2.5 9.4l6.6-.8z"/></svg>';
            ?>
            <div class="sidebar-row fp-star-row">
                <h4 class="sidebar-label"><?php echo esc_html( $filterplus_item['label'] ); ?></h4>
                <?php if ( '2' === $filterplus_tpl ) : // Template 2: rows of 5 stars, highest first ?>
                <div class="fp-star-pills fp-star-list" role="group" aria-label="<?php echo esc_attr( $filterplus_item['label'] ); ?>"
                    data-meta_key="<?php echo esc_attr( $filterplus_item['custom_field_list'] ); ?>"
                    data-label="<?php echo esc_attr( $filterplus_item['label'] ); ?>">
                    <?php for ( $filterplus_star = 5; $filterplus_star >= 1; $filterplus_star-- ) : ?>
                        <button type="button" class="fp-star-pill fp-star-line" data-value="<?php echo esc_attr( $filterplus_star ); ?>" aria-pressed="false"
                            aria-label="<?php /* translators: %d: number of stars */ echo esc_attr( sprintf( _n( '%d star and up', '%d stars and up', $filterplus_star, 'filter-plus' ), $filterplus_star ) ); ?>">
                            <span class="fp-star-icons" aria-hidden="true">
                                <?php for ( $filterplus_i = 1; $filterplus_i <= 5; $filterplus_i++ ) : ?>
                                    <span class="<?php echo $filterplus_i <= $filterplus_star ? 'is-on' : 'is-off'; ?>"><?php echo $filterplus_star_svg; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG ?></span>
                                <?php endfor; ?>
                            </span>
                            <span class="fp-star-up"><?php echo 5 === $filterplus_star ? esc_html__( 'only', 'filter-plus' ) : esc_html__( '& up', 'filter-plus' ); ?></span>
                        </button>
                    <?php endfor; ?>
                </div>
                <?php else : // Template 1: "N ★" buttons ?>
                <div class="fp-star-pills" role="group" aria-label="<?php echo esc_attr( $filterplus_item['label'] ); ?>"
                    data-meta_key="<?php echo esc_attr( $filterplus_item['custom_field_list'] ); ?>"
                    data-label="<?php echo esc_attr( $filterplus_item['label'] ); ?>">
                    <?php for ( $filterplus_star = 1; $filterplus_star <= 5; $filterplus_star++ ) : ?>
                        <button type="button" class="fp-star-pill" data-value="<?php echo esc_attr( $filterplus_star ); ?>" aria-pressed="false"
                            aria-label="<?php /* translators: %d: number of stars */ echo esc_attr( sprintf( _n( '%d star and up', '%d stars and up', $filterplus_star, 'filter-plus' ), $filterplus_star ) ); ?>">
                            <?php echo esc_html( $filterplus_star ); ?>
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2.5l2.9 6.1 6.6.8-4.9 4.6 1.3 6.6L12 17.3 6.1 20.6l1.3-6.6L2.5 9.4l6.6-.8z"/></svg>
                        </button>
                    <?php endfor; ?>
                </div>
                <?php endif; ?>
            </div>
            <?php
            continue;
        }

    ?>
    <div class="sidebar-row radio-wrap">
        <h4 class="sidebar-label"><?php echo esc_html($filterplus_item['label']) ?></h4>
        <div class="param-box custom-field-<?php echo esc_attr($template);?>">
            <?php
                $filterplus_field_list = OptionHelper::instance()->get_custom_fields_values($filterplus_item['custom_field_list']);

                if ( $filterplus_item['style'] !== 'select') {
                    foreach ($filterplus_field_list as $filterplus_key => $filterplus_field) {
                        ?>
                            <label class="checkbox-item checkbox-item-<?php echo esc_html($template);?> custom-field">
                                <input
                                name="custom-field"
                                type="<?php echo esc_attr($filterplus_item['style'])?>"
                                data-meta_condition="<?php echo esc_attr($meta_condition);?>"
                                data-meta_key="<?php echo esc_attr($filterplus_item['custom_field_list']);?>"
                                value="<?php echo esc_attr($filterplus_field->meta_value);?>"/>
                                <?php echo esc_html($filterplus_field->meta_value);?>
                            </label>
                        <?php
                    }
                }else{
                    ?>
                    <select name="custom-field"
                    class="custom-field"
                    data-meta_condition="<?php echo esc_attr($meta_condition);?>"
                    data-meta_key="<?php echo esc_attr($filterplus_item['custom_field_list']);?>"
                    >
                        <option value=""><?php echo esc_html__('Select','filter-plus').' '.esc_html($filterplus_item['label']) ?></option>
                        <?php foreach ($filterplus_field_list as $filterplus_key => $filterplus_field) {  ?>
                            <option value="<?php echo esc_attr($filterplus_field->meta_value);?>">
                                <?php echo esc_html($filterplus_field->meta_value);?>
                            </option>
                        <?php } ?>
                    </select>
                    <?php
                }
            ?>
        </div>
        <span class="reset d-none reset-<?php echo esc_attr($template);?>"><?php esc_html_e('Reset','filter-plus');?></span>
    </div>

    <?php endforeach; ?>
