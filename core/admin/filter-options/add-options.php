<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<?php
	$filterplus_meta_keys = \FilterPlus\Utils\Helper::instance()->get_custom_fields_keys();
	$filterplus_is_pro    = class_exists( 'FilterPlusPro' );
	$filterplus_styles    = array(
		'select'     => __( 'Dropdown', 'filter-plus' ),
		'checkbox'   => __( 'Checkbox', 'filter-plus' ),
		'radio'      => __( 'Radio', 'filter-plus' ),
		'date_range' => __( 'Date Range', 'filter-plus' ),
	);
?>
<div id="filter-options-form-wrap" class="d-none mt-2">
	<div class="content-header flp-form-header mb-2">
		<button type="button" class="close-filter-option-form flp-back-btn" aria-label="<?php esc_attr_e( 'Back to Filter Options', 'filter-plus' ); ?>">
			<span aria-hidden="true">&larr;</span> <?php esc_html_e( 'Back', 'filter-plus' ); ?>
		</button>
		<div class="title filter-option-form-title"><?php esc_html_e( 'Add New Filter Option', 'filter-plus' ); ?></div>
	</div>

	<section class="filter-option-form-card">
		<form method="POST" id="add-filter-option" class="filter-option-form" novalidate>
			<input type="hidden" name="id" id="id" value="" />
			<?php // Only one field type exists today; kept as a field so saved options and edits stay compatible. ?>
			<input type="hidden" name="type" id="type" value="custom_field" />

			<div class="fo-field">
				<label class="fo-label" for="label">
					<?php esc_html_e( 'Label', 'filter-plus' ); ?> <span class="fo-required" aria-hidden="true">*</span>
				</label>
				<input type="text" class="fo-control" name="label" id="label" value="" required aria-required="true" aria-describedby="label-help"
					placeholder="<?php esc_attr_e( 'e.g. Color, Room type, Brand', 'filter-plus' ); ?>" />
				<p class="fo-help" id="label-help"><?php esc_html_e( 'Shown as the filter heading on your site.', 'filter-plus' ); ?></p>
				<p class="fo-error" id="label-error" role="alert" hidden><?php esc_html_e( 'Enter a label.', 'filter-plus' ); ?></p>
			</div>

			<div class="fo-field">
				<label class="fo-label" for="custom_field_list"><?php esc_html_e( 'Custom field', 'filter-plus' ); ?></label>
				<select class="fo-control" name="custom_field_list" id="custom_field_list" aria-describedby="custom-field-help">
					<?php foreach ( $filterplus_meta_keys as $filterplus_key => $filterplus_name ) : ?>
						<option value="<?php echo esc_attr( $filterplus_key ); ?>"><?php echo esc_html( $filterplus_name ); ?></option>
					<?php endforeach; ?>
				</select>
				<p class="fo-help" id="custom-field-help">
					<?php
					echo empty( $filterplus_meta_keys )
						? esc_html__( 'No custom fields found on your posts yet.', 'filter-plus' )
						: esc_html__( 'The field whose saved values become the filter choices.', 'filter-plus' );
					?>
				</p>
			</div>

			<fieldset class="fo-field">
				<legend class="fo-label"><?php esc_html_e( 'Display style', 'filter-plus' ); ?></legend>
				<?php // Hidden select keeps the existing edit/save code working; the cards drive it. ?>
				<select name="style" id="style" class="screen-reader-text" tabindex="-1" aria-hidden="true">
					<?php foreach ( $filterplus_styles as $filterplus_key => $filterplus_name ) : ?>
						<option value="<?php echo esc_attr( $filterplus_key ); ?>"><?php echo esc_html( $filterplus_name ); ?></option>
					<?php endforeach; ?>
				</select>
				<div class="fo-styles" role="radiogroup" aria-label="<?php esc_attr_e( 'Display style', 'filter-plus' ); ?>">
					<?php foreach ( $filterplus_styles as $filterplus_key => $filterplus_name ) : ?>
						<label class="fo-style">
							<input type="radio" name="fo_style_choice" value="<?php echo esc_attr( $filterplus_key ); ?>" <?php checked( 'select', $filterplus_key ); ?> />
							<span class="fo-style__icon fo-style__icon--<?php echo esc_attr( $filterplus_key ); ?>" aria-hidden="true"></span>
							<span class="fo-style__name"><?php echo esc_html( $filterplus_name ); ?></span>
						</label>
					<?php endforeach; ?>
				</div>
			</fieldset>

			<div class="filter-option-form-actions">
				<?php if ( ! $filterplus_is_pro ) : ?>
					<p class="fo-pro-note"><?php esc_html_e( 'Saving filter options needs FilterPlus Pro.', 'filter-plus' ); ?></p>
				<?php endif; ?>
				<button type="button" class="button close-filter-option-form"><?php esc_html_e( 'Cancel', 'filter-plus' ); ?></button>
				<button type="submit" class="button button-primary add-filter-option <?php echo $filterplus_is_pro ? '' : 'disable'; ?>" <?php disabled( ! $filterplus_is_pro ); ?>>
					<?php esc_html_e( 'Save Filter Option', 'filter-plus' ); ?>
				</button>
			</div>
		</form>
	</section>
</div>
