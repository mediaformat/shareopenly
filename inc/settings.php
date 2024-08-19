<?php
/**
 * Settings functions
 *
 * Assorted functions to add and create settings.
 *
 * @package plugin-slug
 */

// Exit if accessed directly.

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get the settings
 *
 * @return   array     Settings array.
 */
function shareopenly_get_settings() {

	$settings = array();

	// Get the post types.

	$settings['type'] = shareopenly_get_post_types();

	// Get the share text.

	$settings['text'] = esc_attr( get_option( 'shareopenly_text' ) );
	if ( ! $settings['text'] ) {
		$settings['text'] = __( 'Share this post on social media.', 'shareopenly' );
	}

	// Get the output priority.

	$settings['priority'] = esc_attr( get_option( 'shareopenly_priority' ) );
	if ( ! $settings['priority'] ) {
		$settings['priority'] = 10;
	}

	return $settings;
}

/**
 * Get the post types
 *
 * @return   array     Post types array.
 */
function shareopenly_get_post_types() {

	// Get the saved post types.
	$support_post_types = get_option( 'shareopenly_type', array( 'post' ) ) ? get_option( 'shareopenly_type', array( 'post' ) ) : array();

	if ( is_array( $support_post_types ) ) {
		$shareopenly_post_types = $support_post_types;
	} else {
		switch ( $support_post_types ) {
			case 'post':
				$shareopenly_post_types = array( 'post' );
				break;
			case 'page':
				$shareopenly_post_types = array( 'page' );
				break;
			case 'postpage':
				$shareopenly_post_types = array( 'post', 'page' );
				break;
		}
	}

	return $shareopenly_post_types;
}

/**
 * Add to settings
 *
 * Add a field to the general settings screen for assorted options
 */
function shareopenly_settings_init() {

	add_settings_section( 'shareopenly_section', __( 'ShareOpenly', 'shareopenly' ), 'shareopenly_settings_section', 'discussion' );

	add_settings_field( 'shareopenly_type', __( 'Sharing link location', 'shareopenly' ), 'shareopenly_type_callback', 'discussion', 'shareopenly_section', array( 'label_for' => 'shareopenly_type' ) );

	register_setting( 'discussion', 'shareopenly_type' );

	add_settings_field( 'shareopenly_text', __( 'Share Text', 'shareopenly' ), 'shareopenly_text_callback', 'discussion', 'shareopenly_section', array( 'label_for' => 'shareopenly_text' ) );

	register_setting( 'discussion', 'shareopenly_text' );

	add_settings_field( 'shareopenly_priority', __( 'Priority', 'shareopenly' ), 'shareopenly_priority_callback', 'discussion', 'shareopenly_section', array( 'label_for' => 'shareopenly_priority' ) );

	register_setting( 'discussion', 'shareopenly_priority' );
}

add_action( 'admin_init', 'shareopenly_settings_init' );

/**
 * Settings main section paragraph.
 */
function shareopenly_settings_section() {
	printf(
		'<p id="shareopenly-settings">%s</p>',
		esc_html__( 'ShareOpenly allows to add a sharing link to the bottom of posts and pages on your site. Use the settings below to customize the display of that sharing link.', 'shareopenly' )
	);
}

/**
 * Type setting callback
 *
 * Output the settings fields for selecting on which post types to display sharing link.
 */
function shareopenly_type_callback() {

	$support_post_types = shareopenly_get_post_types();
	$post_types         = get_post_types( array( 'public' => true ), 'objects' );
	?>
	<fieldset>
		<ul>
		<?php foreach ( $post_types as $post_type ) : ?>
			<li>
				<input type="checkbox" id="shareopenly_type_<?php echo esc_attr( $post_type->name ); ?>" name="shareopenly_type[]" value="<?php echo esc_attr( $post_type->name ); ?>" <?php echo checked( in_array( $post_type->name, $support_post_types, true ) ); ?> />
				<label for="shareopenly_type_<?php echo esc_attr( $post_type->name ); ?>"><?php echo esc_html( $post_type->label ); ?></label>
			</li>
		<?php endforeach; ?>
		</ul>
	</fieldset>
	<?php
}

/**
 * Share text setting callback
 *
 * Output the settings field for defining the sharing text.
 */
function shareopenly_text_callback() {

	$options = shareopenly_get_settings();
	$text    = $options['text'];

	echo '<input name="shareopenly_text" size="40" type="text" value="' . esc_attr( $text ) . '" />';
}

/**
 * Priority setting callback
 *
 * Output the settings field for defining the priority of the output on the page.
 */
function shareopenly_priority_callback() {

	$options = shareopenly_get_settings();
	$type    = $options['priority'];

	echo '<input name="shareopenly_priority" size="4" maxlength="4" type="text" value="' . esc_attr( $type ) . '" />';
}
