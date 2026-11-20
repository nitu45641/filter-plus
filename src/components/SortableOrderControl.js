import { BaseControl, Button } from '@wordpress/components';
import { useState } from '@wordpress/element';
import { __, sprintf } from '@wordpress/i18n';

/**
 * Drag & drop list for the sidebar "Filter Order" (same idea as the Elementor
 * repeater): every section is listed, drag a row or use the arrow buttons to
 * move it. The block attribute stores the full ordered list of section keys.
 *
 * @param {Object}   props
 * @param {string}   props.label
 * @param {string}   [props.help]
 * @param {Array}    props.value    Saved section keys (may be partial or empty).
 * @param {Array}    props.options  [{ value, label }] in default template order.
 * @param {Function} props.onChange Receives the full ordered array of keys.
 * @param {boolean}  [props.disabled]
 */
export default function SortableOrderControl( { label, help, value, options, onChange, disabled } ) {
    const list = Array.isArray( options ) ? options : [];
    const known = list.map( ( opt ) => String( opt.value ) );
    const saved = ( Array.isArray( value ) ? value : [] ).map( String ).filter( ( key, i, arr ) => known.includes( key ) && arr.indexOf( key ) === i );
    // saved keys first, sections not in the saved order keep their default position after them
    const order = [ ...saved, ...known.filter( ( key ) => ! saved.includes( key ) ) ];

    const [ dragIndex, setDragIndex ] = useState( null );
    const [ overIndex, setOverIndex ] = useState( null );

    const labelFor = ( key ) => {
        const found = list.find( ( opt ) => String( opt.value ) === key );
        return found ? String( found.label ) : key;
    };

    const move = ( from, to ) => {
        if ( disabled || from === to || to < 0 || to >= order.length ) {
            return;
        }
        const next = [ ...order ];
        const [ item ] = next.splice( from, 1 );
        next.splice( to, 0, item );
        onChange( next );
    };

    // Reordering is a Pro feature: show the same notice as the Elementor widget.
    if ( disabled ) {
        return (
            <BaseControl label={ label } __nextHasNoMarginBottom>
                <p className="fp-sortable-order__pro">
                    { __( 'Drag & drop to reorder the sidebar filters is a Pro feature.', 'filter-plus' ) }{ ' ' }
                    <a href="https://wpbens.com/filter-plus/" target="_blank" rel="noopener noreferrer">
                        { __( 'Upgrade to Pro', 'filter-plus' ) }
                    </a>
                </p>
            </BaseControl>
        );
    }

    const reset = () => onChange( [] );
    const isDefault = order.every( ( key, i ) => key === known[ i ] );

    return (
        <BaseControl label={ label } help={ help } __nextHasNoMarginBottom>
            <ul className={ 'fp-sortable-order' + ( disabled ? ' is-disabled' : '' ) } role="list">
                { order.map( ( key, index ) => {
                    const name = labelFor( key );
                    const classes = [ 'fp-sortable-order__item' ];
                    if ( index === dragIndex ) {
                        classes.push( 'is-dragging' );
                    }
                    if ( index === overIndex && index !== dragIndex ) {
                        classes.push( dragIndex !== null && dragIndex < index ? 'is-over-after' : 'is-over-before' );
                    }
                    return (
                        <li
                            key={ key }
                            className={ classes.join( ' ' ) }
                            draggable={ ! disabled }
                            onDragStart={ ( e ) => {
                                setDragIndex( index );
                                e.dataTransfer.effectAllowed = 'move';
                                e.dataTransfer.setData( 'text/plain', key );
                            } }
                            onDragOver={ ( e ) => {
                                if ( dragIndex === null ) {
                                    return;
                                }
                                e.preventDefault();
                                e.dataTransfer.dropEffect = 'move';
                                if ( overIndex !== index ) {
                                    setOverIndex( index );
                                }
                            } }
                            onDrop={ ( e ) => {
                                e.preventDefault();
                                if ( dragIndex !== null ) {
                                    move( dragIndex, index );
                                }
                                setDragIndex( null );
                                setOverIndex( null );
                            } }
                            onDragEnd={ () => {
                                setDragIndex( null );
                                setOverIndex( null );
                            } }
                        >
                            <span className="fp-sortable-order__handle" aria-hidden="true">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><circle cx="9" cy="6" r="1.6" /><circle cx="15" cy="6" r="1.6" /><circle cx="9" cy="12" r="1.6" /><circle cx="15" cy="12" r="1.6" /><circle cx="9" cy="18" r="1.6" /><circle cx="15" cy="18" r="1.6" /></svg>
                            </span>
                            <span className="fp-sortable-order__label">{ name }</span>
                            <span className="fp-sortable-order__actions">
                                <Button
                                    size="small"
                                    icon="arrow-up-alt2"
                                    label={ sprintf( /* translators: %s: filter section name */ __( 'Move %s up', 'filter-plus' ), name ) }
                                    disabled={ disabled || 0 === index }
                                    onClick={ () => move( index, index - 1 ) }
                                />
                                <Button
                                    size="small"
                                    icon="arrow-down-alt2"
                                    label={ sprintf( /* translators: %s: filter section name */ __( 'Move %s down', 'filter-plus' ), name ) }
                                    disabled={ disabled || index === order.length - 1 }
                                    onClick={ () => move( index, index + 1 ) }
                                />
                            </span>
                        </li>
                    );
                } ) }
            </ul>
            { ! disabled && ! isDefault && (
                <Button variant="link" onClick={ reset } className="fp-sortable-order__reset">
                    { __( 'Reset to default order', 'filter-plus' ) }
                </Button>
            ) }
        </BaseControl>
    );
}
