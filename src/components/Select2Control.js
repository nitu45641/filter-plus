import { FormTokenField, BaseControl } from '@wordpress/components';

/**
 * Select2-style multi select for the block sidebar.
 *
 * Wraps FormTokenField so editors get a searchable dropdown with removable
 * chips while the block attribute keeps storing option values (not labels).
 *
 * @param {Object}   props
 * @param {string}   props.label
 * @param {string}   [props.help]
 * @param {Array}    props.value    Selected option values.
 * @param {Array}    props.options  [{ value, label }].
 * @param {Function} props.onChange Receives the new array of values.
 * @param {boolean}  [props.disabled]
 */
export default function Select2Control( { label, help, value, options, onChange, disabled, placeholder } ) {
    const list = Array.isArray( options ) ? options : [];
    const selected = Array.isArray( value ) ? value.map( String ) : [];

    const labelFor = ( val ) => {
        const found = list.find( ( opt ) => String( opt.value ) === String( val ) );
        return found ? String( found.label ) : String( val );
    };
    const valueFor = ( text ) => {
        const found = list.find( ( opt ) => String( opt.label ) === String( text ) );
        return found ? String( found.value ) : null;
    };

    const tokens = selected.map( labelFor );
    const suggestions = list.map( ( opt ) => String( opt.label ) );

    return (
        <BaseControl help={ help } __nextHasNoMarginBottom>
            <FormTokenField
                label={ label }
                value={ tokens }
                suggestions={ suggestions }
                disabled={ disabled }
                placeholder={ placeholder }
                __experimentalExpandOnFocus
                __experimentalShowHowTo={ false }
                __experimentalValidateInput={ ( text ) => null !== valueFor( text ) }
                __next40pxDefaultSize
                __nextHasNoMarginBottom
                onChange={ ( next ) => {
                    const values = [];
                    next.forEach( ( token ) => {
                        const text = 'object' === typeof token && token ? token.value : token;
                        const val = valueFor( text );
                        if ( null !== val && ! values.includes( val ) ) {
                            values.push( val );
                        }
                    } );
                    onChange( values );
                } }
            />
        </BaseControl>
    );
}
