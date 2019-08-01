<?php

/**
 * Smart Author Box Widget
 */

class YZ_Smart_Author_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'yz_smart_author_widget',
			__( 'Youzer - Smart Author', 'youzer' ),
			array( 'description' => __( 'Smart Author Widget', 'youzer' ) )
		);
	}
	
	/**
	 * Back-end widget form.
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

		global $Youzer;
	    
		// Default Widget Settings
	    $defaults = array(
	        'default_user_id' => false,
	        'meta_icon' => 'at',
	        'meta_type' => 'user_login',
	        'layout' => 'yzb-author-v1',
	        'show_for_everyone' => 'on',
	        'show_cover_overlay' => false,
	        'show_cover_pattern' => false,
	        'statistics_silver_bg' => false,
	        'show_statistics_borders' => false,
	        'networks_icons_style' => 'circle',
	        'networks_icons_type'  => 'colorful'
	    );

	    // Get Widget Data.
	    $instance = wp_parse_args( (array) $instance, $defaults ); 

	    // Get Input's Data.
		$meta_types = yz_get_panel_profile_fields();
		$box_layouts = $Youzer->fields->get_field_options( 'author_box_layouts' );
		$networks_icons_types = $Youzer->fields->get_field_options( 'icons_colors' );
		$networks_icons_styles = $Youzer->fields->get_field_options( 'border_styles' );

		?>

		<!-- Default User ID. -->   
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'default_user_id' ) ); ?>"><?php esc_attr_e( 'Default User ID', 'youzer' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'default_user_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'default_user_id' ) ); ?>" type="number" value="<?php echo esc_attr( $instance['default_user_id'] ); ?>">
		</p>

		<!-- Show Widget For Logged Out Users -->
		<p>
	        <input class="checkbox" type="checkbox" <?php checked( $instance['show_for_everyone'], 'on' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_for_everyone' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_for_everyone' ) ); ?>" /> 
	        <label for="<?php echo $this->get_field_id( 'show_for_everyone' ); ?>"><?php _e( 'Show Widget For Logged Out Users', 'youzer' ); ?></label>
    	</p>

		<!-- Author Display Cover Over-->
		<p>
	        <input class="checkbox" type="checkbox" <?php checked( $instance['show_cover_overlay'], 'on' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_cover_overlay' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_cover_overlay' ) ); ?>" /> 
	        <label for="<?php echo $this->get_field_id( 'show_cover_overlay' ); ?>"><?php _e( 'Show Cover Overlay', 'youzer' ); ?></label>
    	</p>

		<!-- Author Display Cover Pattern-->
		<p>
	        <input class="checkbox" type="checkbox" <?php checked( $instance['show_cover_pattern'], 'on' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_cover_pattern' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_cover_pattern' ) ); ?>" /> 
	        <label for="<?php echo $this->get_field_id( 'show_cover_pattern' ); ?>"><?php _e( 'Show Cover Pattern', 'youzer' ); ?></label>
    	</p>

		<!-- Author Box Layout-->
	    <p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>"><?php esc_attr_e( 'Author Box Layout', 'youzer' ); ?></label> 
	        <select id="<?php echo $this->get_field_id( 'layout' ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'layout' ) ); ?>" class="widefat" style="width:100%;">
	            <?php foreach( $box_layouts as $layout_id => $layout_name ) { ?>
	            	<option <?php selected( $instance['layout'], $layout_id ); ?> value="<?php echo $layout_id; ?>"><?php echo $layout_name; ?></option>
	            <?php } ?>      
	        </select>
	    </p>
		
		<!-- Author Meta types-->   
	    <p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'meta_type' ) ); ?>"><?php esc_attr_e( 'Author Meta Type', 'youzer' ); ?></label>
	        <select id="<?php echo $this->get_field_id( 'meta_type' ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'meta_type' ) ); ?>" class="widefat" style="width:100%;">
	            <?php foreach( $meta_types as $meta_id => $meta_name ) { ?>
	            	<option <?php selected( $instance['meta_type'], $meta_id ); ?> value="<?php echo $meta_id; ?>"><?php echo $meta_name; ?></option>
	            <?php } ?>      
	        </select>
	    </p>
	    
		<!-- Author Meta Icon -->   
	    <p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'meta_icon' ) ); ?>"><?php esc_attr_e( 'Author Meta Icon', 'youzer' ); ?></label>
			<div id="<?php echo $this->get_field_id( 'meta_icon' ); ?>" class="ukai_iconPicker" data-icons-type="web_application">
				<div class="ukai_icon_selector">
					<i class="fa fa-<?php echo $instance['meta_icon']; ?>" aria-hidden="true"></i>
					<span class="ukai_select_icon">
						<i class="fa fa-sort-desc" aria-hidden="true"></i>
					</span>
				</div>
				<input type="hidden" class="ukai-selected-icon" name="<?php echo esc_attr( $this->get_field_name( 'meta_icon' ) ); ?>" value="<?php echo $instance['meta_icon']; ?>">
			</div>
	    </p>

		<!-- Author Networks Background types-->   
	    <p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'networks_icons_type' ) ); ?>"><?php esc_attr_e( 'Networks Icons Type', 'youzer' ); ?></label>
	        <select id="<?php echo $this->get_field_id( 'networks_icons_type' ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'networks_icons_type' ) ); ?>" class="widefat" style="width:100%;">
	            <?php foreach( $networks_icons_types as $bg_id => $by_name ) { ?>
	            	<option <?php selected( $instance['networks_icons_type'], $bg_id ); ?> value="<?php echo $bg_id; ?>"><?php echo $by_name; ?></option>
	            <?php } ?>      
	        </select>
	    </p>

		<!-- Author Networks Icons Styles-->
	    <p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'networks_icons_style' ) ); ?>"><?php esc_attr_e( 'Networks Icons Style', 'youzer' ); ?></label>
	        <select id="<?php echo $this->get_field_id( 'networks_icons_style' ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'networks_icons_style' ) ); ?>" class="widefat" style="width:100%;">
	            <?php foreach( $networks_icons_styles as $style_id => $style_name ) { ?>
	            	<option <?php selected( $instance['networks_icons_style'], $style_id ); ?> value="<?php echo $style_id; ?>"><?php echo $style_name; ?></option>
	            <?php } ?>      
	        </select>
	    </p>

		<!-- Author Display Statistics Borders-->
		<p>
	        <input class="checkbox" type="checkbox" <?php checked( $instance['show_statistics_borders'], 'on' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_statistics_borders' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_statistics_borders' ) ); ?>" /> 
	        <label for="<?php echo $this->get_field_id( 'show_statistics_borders' ); ?>"><?php _e( 'Show Statistics Borders', 'youzer' ); ?></label>
    	</p>
    	

		<!-- Author Display Statistics Silver Background-->
		<p>
	        <input class="checkbox" type="checkbox" <?php checked( $instance['statistics_silver_bg'], 'on' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'statistics_silver_bg' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'statistics_silver_bg' ) ); ?>" /> 
	        <label for="<?php echo $this->get_field_id( 'statistics_silver_bg' ); ?>"><?php _e( 'Show Statistics Silver Background', 'youzer' ); ?></label>
    	</p>

		<?php 
	}
	
	/**
	 * Sanitize widget form values as they are saved.
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = array();

		// Update Values.
		$instance['default_user_id'] = ( ! empty( $new_instance['default_user_id'] ) ) ? strip_tags( $new_instance['default_user_id'] ) : '1';
		$instance['layout'] = ( ! empty( $new_instance['layout'] ) ) ? strip_tags( $new_instance['layout'] ) : 'yzb-author-v1';
		$instance['meta_type'] = ( ! empty( $new_instance['meta_type'] ) ) ? strip_tags( $new_instance['meta_type'] ) : 'username';
		$instance['meta_icon'] = $new_instance['meta_icon'];
		$instance['networks_icons_style'] = ( ! empty( $new_instance['networks_icons_style'] ) ) ? strip_tags( $new_instance['networks_icons_style'] ) : 'circle';
		$instance['networks_icons_type'] = ( ! empty( $new_instance['networks_icons_type'] ) ) ? $new_instance['networks_icons_type'] : 'colorful';

		// Save Checkbox Values.
		$instance['show_for_everyone'] = $new_instance['show_for_everyone'];
		$instance['show_cover_overlay'] = $new_instance['show_cover_overlay'];
		$instance['show_cover_pattern'] = $new_instance['show_cover_pattern'];
		$instance['statistics_silver_bg'] = $new_instance['statistics_silver_bg'];
		$instance['show_statistics_borders'] = $new_instance['show_statistics_borders'];

		return $instance;
	}

	/**
	 * Login Widget Content
	 */
	public function widget( $args, $instance ) {
		
		// Init Vars.
		$show_for_everyone = $instance['show_for_everyone'] ? 'on' : 'off';
		
		// Check if Widget available for everyone ??
		if ( 'off' == $show_for_everyone && ! is_user_logged_in() ) {
			return false;
		}

		// Get Data.
		$show_cover_overlay = $instance['show_cover_overlay'] ? 'on' : 'off';
		$show_cover_pattern = $instance['show_cover_pattern'] ? 'on' : 'off';
		$statistics_silver_bg = $instance['statistics_silver_bg'] ? 'on' : 'off';
		$show_statistics_borders = $instance['show_statistics_borders'] ? 'on' : 'off';
		$meta_icon = isset( $instance['meta_icon'] ) ? $instance['meta_icon'] : 'globe';
		$post_author = is_user_logged_in() ? get_current_user_id() : $instance['default_user_id'];

		// Display Widgets.
		echo '<div class="yz-wp-author-widget yz-smart-author-box-widget">';
		echo do_shortcode( "[youzer_author_box user_id='$post_author' layout='{$instance["layout"]}' meta_type='{$instance["meta_type"]}' meta_icon='{$meta_icon}' statistics_bg='$statistics_silver_bg' statistics_border='$show_statistics_borders' networks_type='{$instance["networks_icons_type"]}' networks_format='{$instance["networks_icons_style"]}' cover_overlay='$show_cover_overlay' cover_pattern='$show_cover_pattern']" );
		echo '</div>';

	}

}