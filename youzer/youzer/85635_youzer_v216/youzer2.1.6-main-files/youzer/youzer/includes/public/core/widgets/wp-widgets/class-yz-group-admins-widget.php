<?php

/**
 * Group Administrators Widget
 */

class YZ_Group_Admins_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'yz_group_administrators_widget',
			__( 'Youzer - Group Administrators', 'youzer' ),
			array( 'description' => __( 'Group Administrators Widget', 'youzer' ) )
		);
	}
	
	/**
	 * Back-end widget form.
	 */
	public function form( $instance ) {

		global $Youzer;

	    // Get Widget Data.
	    $instance = wp_parse_args( (array) $instance,
	    	array(
		    	'title' => __( 'Group Administrators', 'youzer' ),
		        'avatar_border_style' => 'circle',
		        'limit' => '10',
	    	)
	    );

	    // Get Input's Data.
		$limit = absint( $instance['limit'] );
		$title = strip_tags( $instance['title'] );
		$avatar_border_styles = $Youzer->fields->get_field_options( 'border_styles' );

		?>

		<!-- Title. -->   
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'youzer' ); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" class="widefat" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		
		<!-- Admins Number. -->   
		<p>
			<label for="<?php echo $this->get_field_id( 'limit' ); ?>"><?php _e( 'Admins Number:', 'youzer' ); ?>
				<input class="widefat" id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>" type="text" value="<?php echo esc_attr( $limit ); ?>" style="width: 30%" />
			</label>
		</p>

		<!-- Avatar Border Style -->
	    <p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'avatar_border_style' ) ); ?>"><?php esc_attr_e( 'Avatar Border Style', 'youzer' ); ?></label> 
	        <select id="<?php echo $this->get_field_id( 'avatar_border_style' ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'avatar_border_style' ) ); ?>" class="widefat" style="width:100%;">
	            <?php foreach( $avatar_border_styles as $style_id => $style_name ) { ?>
	            	<option <?php selected( $instance['avatar_border_style'], $style_id ); ?> value="<?php echo $style_id; ?>"><?php echo $style_name; ?></option>
	            <?php } ?>      
	        </select>
	    </p>
		
		<?php 
	}
	
	/**
	 * Sanitize widget form values as they are saved.
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = array();

		$instance = $old_instance;
		$instance['limit'] = absint( $new_instance['limit'] );
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['avatar_border_style'] = strip_tags( $new_instance['avatar_border_style'] );

		return $instance;
	}

	/**
	 * Widget Content
	 */
	public function widget( $args, $instance ) {

		if ( ! bp_is_active( 'groups' ) ) {
			return false;
		}
		
		if ( bp_group_has_members(
			array( 'per_page' => $instance['limit'], 'group_role' => array( 'admin' ) )
			)) {			

			echo $args['before_widget'];

			if ( ! empty( $instance['title'] ) ) {
				echo $args['before_title'];
				echo apply_filters( 'widget_title', $instance['title'] );
				echo $args['after_title'];
			}
			
			$this->get_admins_list( $instance );
			
			echo $args['after_widget'];

		}

	}

	/**
	 * Get Admins List.
	 */
	function get_admins_list( $args ) {

		// Get Widget Class.
		$list_class = array( 'yz-items-list-widget', 'yz-groups-admins-widget' );

		// Add Widgets Avatars Border Style Class.
		$list_class[] = 'yz-list-avatar-' . $args['avatar_border_style'];
		
		?>

		<div class="<?php echo yz_generate_class( $list_class ); ?>">

			<?php while ( bp_group_members() ) : bp_group_the_member(); ?>

			<?php $member_id = bp_get_group_member_id(); ?>
			<?php $profile_url = bp_core_get_user_domain( $member_id ); ?>

			<div class="yz-list-item">
				<a href="<?php echo $profile_url; ?>" class="yz-item-avatar"><?php echo bp_core_fetch_avatar( array( 'item_id' => $member_id, 'type' => 'thumb' ) ); ?></a>
				<div class="yz-item-data">
					<a href="<?php echo $profile_url; ?>" class="yz-item-name"><?php echo bp_core_get_user_displayname( $member_id ); ?><?php yz_the_user_verification_icon( $member_id ); ?></a>
					<div class="yz-item-meta">
						<div class="yz-meta-item">@<?php echo bp_core_get_username( $member_id ); ?></div>
					</div>
				</div>
			</div>

			<?php endwhile; ?>

		</div>

		<?php

	}

}