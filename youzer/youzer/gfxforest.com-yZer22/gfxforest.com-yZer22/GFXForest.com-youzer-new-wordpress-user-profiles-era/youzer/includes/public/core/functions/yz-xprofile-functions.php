<?php

/**
 * Check if displayed user has user tags.
 */
function yz_is_user_have_user_tags() {

	if ( ! bp_is_active( 'xprofile' ) ) {
		return false;
	}

	// Init Vars
	$have_content = false;

	// Get User Tags
	$user_tags = yz_options( 'yz_user_tags' );
	
	if ( empty( $user_tags ) ) {
		return false;
	}

    foreach ( $user_tags as $tag ) {

        // Get Data
        $field = xprofile_get_field( $tag['field'],  bp_displayed_user_id() );

        // Unserialize Profile field
        $field_value = maybe_unserialize( $field->data->value );

        if ( ! empty( $field_value ) ) {
            $have_content = true;
            break;
        }

    }

    return $have_content;
}


/**
 * # Get Xprofile Field Data.
 */
add_shortcode( 'yz_xprofile_fields', 'yzc_get_xprofile_data_shortcode' );

function yzc_get_xprofile_data_shortcode( $atts ) {

    if ( ! bp_is_active( 'xprofile' ) ) {
        return false;
    }

    $options = shortcode_atts( array(
        'user_id' => bp_displayed_user_id(),
        'fields' => null,
    ), $atts );
    
    $fields = explode( ',', $options['fields'] );

    if ( empty( $fields ) ) {
        return;
    }

    ?>

    <div class="yz-infos-content">
        
        <?php 

            foreach ( $fields as $field_id ) : 

                // Get Field Value.
                $field_data = bp_get_profile_field_data( array( 'user_id' => $options['user_id'],'field' => $field_id ) );

                // Get Field Data
                $field = new BP_XProfile_Field( $field_id );
                
            ?>
            <?php if ( ! empty( $field_data ) ) : ?>
            <div class="yz-info-item yz-info-item-<?php echo $field_id; ?>">
                <div class="yz-info-label"><?php echo $field->name; ?></div>
                <div class="yz-info-data"><?php echo $field_data; ?></div>
            </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <?php

}

/**
 * # Get Custom Widgets functions.
 */

add_shortcode( 'yz_xprofile_group', 'yz_get_xprofile_group_shortcode' );

function yz_get_xprofile_group_shortcode( $atts = null ) {

    $options = shortcode_atts( array(
        'user_id' => bp_displayed_user_id(),
        'profile_group_id' => false,
    ), $atts );

    if ( ! bp_is_active( 'xprofile' ) ) {
        return false;
    }

    do_action( 'bp_before_profile_loop_content' );
    
    if ( bp_has_profile( $options ) ) : while ( bp_profile_groups() ) : bp_the_profile_group();
            
        if ( bp_profile_group_has_fields() ) :
                
            $group_id = bp_get_the_profile_group_id();

            // Custom infos Widget Arguments
            $custom_infos_args = array(
                'widget_icon'       => yz_get_xprofile_group_icon( $group_id ),
                'widget_title'      => bp_get_the_profile_group_name(),
                'widget_name'       => 'custom_infos',
            );

            youzer()->widgets->custom_infos->widget( $custom_infos_args );

    endif; endwhile;
    
    endif;

    do_action( 'bp_after_profile_loop_content' );

}