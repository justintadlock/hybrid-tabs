<?php
/**
 * Tabs Widget.
 * Add a widget with multiple tab options.
 *
 * In 0.2, converted functions to a class that extends WP 2.8's widget class.
 *
 * @package HybridTabs
 */

/**
 * Output of the tabbed widget.
 *
 * @since 0.2
 */
class Hybrid_Tabs_Widget extends WP_Widget {

	function Hybrid_Tabs_Widget() {
		$widget_ops = array( 'classname' => 'tabs', 'description' => __('A tabbed widget for the Hybrid WordPress theme.', 'hybrid_tabs') );
		$control_ops = array( 'width' => 600, 'height' => 350, 'id_base' => 'hybrid-tabs' );
		$this->WP_Widget( 'hybrid-tabs', __('Tabs', 'hybrid_tabs'), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		global $tab_set_num;

		extract( $args );

		$tab1 = $instance['tab1'];
		$tab2 = $instance['tab2'];
		$tab3 = $instance['tab3'];
		$tab4 = $instance['tab4'];
		$tab5 = $instance['tab5'];
		$tab6 = $instance['tab6'];

		$tab1_title = $instance['tab1_title'] ? apply_filters('widget_title', $instance['tab1_title'] ) : $tab1;
		$tab2_title = $instance['tab2_title'] ? apply_filters('widget_title', $instance['tab2_title'] ) : $tab2;
		$tab3_title = $instance['tab3_title'] ? apply_filters('widget_title', $instance['tab3_title'] ) : $tab3;
		$tab4_title = $instance['tab4_title'] ? apply_filters('widget_title', $instance['tab4_title'] ) : $tab4;
		$tab5_title = $instance['tab5_title'] ? apply_filters('widget_title', $instance['tab5_title'] ) : $tab5;
		$tab6_title = $instance['tab6_title'] ? apply_filters('widget_title', $instance['tab6_title'] ) : $tab6;

		$tabs_arr = array(
			array( $tab1, $tab1_title ),
			array( $tab2, $tab2_title ),
			array( $tab3, $tab3_title ),
			array( $tab4, $tab4_title ),
			array( $tab5, $tab5_title ),
			array( $tab6, $tab6_title )
		);

		$tab_set_num++;

		$before_widget = preg_replace( '/id="[^"]*"/', 'id="tab-set-' . $tab_set_num . '"', $before_widget );

		echo $before_widget;

		echo '<ul class="tabs">';

		foreach ( $tabs_arr as $tab ) :
			if ( $tab[0] ) :
				++$i;
				echo '<li class="t' . $i . ' t"><a class="t' . $i . '" title="' . $tab[1] . '">' . $tab[1] . '</a></li>';
			endif;
		endforeach;

		echo '</ul>';

		foreach ( $tabs_arr as $tab ) :
			if ( $tab[0] ) :
				++$j;
				echo '<div class="tab-content t' . $j . '">';
				hybrid_tabs_get_selected( $tab[0] );
				echo '</div>';
			endif;
		endforeach;

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['tab1'] = $new_instance['tab1'];
		$instance['tab2'] = $new_instance['tab2'];
		$instance['tab3'] = $new_instance['tab3'];
		$instance['tab4'] = $new_instance['tab4'];
		$instance['tab5'] = $new_instance['tab5'];
		$instance['tab6'] = $new_instance['tab6'];

		$instance['tab1_title'] = strip_tags( $new_instance['tab1_title'] );
		$instance['tab2_title'] = strip_tags( $new_instance['tab2_title'] );
		$instance['tab3_title'] = strip_tags( $new_instance['tab3_title'] );
		$instance['tab4_title'] = strip_tags( $new_instance['tab4_title'] );
		$instance['tab5_title'] = strip_tags( $new_instance['tab5_title'] );
		$instance['tab6_title'] = strip_tags( $new_instance['tab6_title'] );

		return $instance;
	}

	function form( $instance ) {
		global $hybrid_tabs;

		//Defaults
		$defaults = array( 'tab1' => 'monthly', 'tab1_title' => __('Monthly', 'hybrid_tabs'), 'tab2' => 'yearly', 'tab2_title' => __('Yearly', 'hybrid_tabs' ) );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<div style="float:left;width:48%;">

		<p>
			<label for="<?php echo $this->get_field_id( 'tab1' ); ?>"><?php _e('Tab 1 Content:','hybrid_tabs'); ?></label>
			<select id="<?php echo $this->get_field_id( 'tab1' ); ?>" name="<?php echo $this->get_field_name( 'tab1' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( !$instance['tab1'] ) echo ' selected="selected"'; ?> value=""></option>
			<?php foreach ( $hybrid_tabs as $tab ) : ?>
				<option <?php if ( $tab->name == $instance['tab1'] ) echo ' selected="selected"'; ?> value="<?php echo $tab->name; ?>"><?php echo $tab->label; ?></option>
			<?php endforeach; ?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'tab2' ); ?>"><?php _e('Tab 2 Content:','hybrid_tabs'); ?></label>
			<select id="<?php echo $this->get_field_id( 'tab2' ); ?>" name="<?php echo $this->get_field_name( 'tab2' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( !$instance['tab2'] ) echo ' selected="selected"'; ?> value=""></option>
			<?php foreach ( $hybrid_tabs as $tab ) : ?>
				<option <?php if ( $tab->name == $instance['tab2'] ) echo ' selected="selected"'; ?> value="<?php echo $tab->name; ?>"><?php echo $tab->label; ?></option>
			<?php endforeach; ?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'tab3' ); ?>"><?php _e('Tab 3 Content:','hybrid_tabs'); ?></label>
			<select id="<?php echo $this->get_field_id( 'tab3' ); ?>" name="<?php echo $this->get_field_name( 'tab3' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( !$instance['tab3'] ) echo ' selected="selected"'; ?> value=""></option>
			<?php foreach ( $hybrid_tabs as $tab ) : ?>
				<option <?php if ( $tab->name == $instance['tab3'] ) echo ' selected="selected"'; ?> value="<?php echo $tab->name; ?>"><?php echo $tab->label; ?></option>
			<?php endforeach; ?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'tab4' ); ?>"><?php _e('Tab 4 Content:','hybrid_tabs'); ?></label>
			<select id="<?php echo $this->get_field_id( 'tab4' ); ?>" name="<?php echo $this->get_field_name( 'tab4' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( !$instance['tab4'] ) echo ' selected="selected"'; ?> value=""></option>
			<?php foreach ( $hybrid_tabs as $tab ) : ?>
				<option <?php if ( $tab->name == $instance['tab4'] ) echo ' selected="selected"'; ?> value="<?php echo $tab->name; ?>"><?php echo $tab->label; ?></option>
			<?php endforeach; ?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'tab5' ); ?>"><?php _e('Tab 5 Content:','hybrid_tabs'); ?></label>
			<select id="<?php echo $this->get_field_id( 'tab5' ); ?>" name="<?php echo $this->get_field_name( 'tab5' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( !$instance['tab5'] ) echo ' selected="selected"'; ?> value=""></option>
			<?php foreach ( $hybrid_tabs as $tab ) : ?>
				<option <?php if ( $tab->name == $instance['tab5'] ) echo ' selected="selected"'; ?> value="<?php echo $tab->name; ?>"><?php echo $tab->label; ?></option>
			<?php endforeach; ?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'tab6' ); ?>"><?php _e('Tab 6 Content:','hybrid_tabs'); ?></label>
			<select id="<?php echo $this->get_field_id( 'tab6' ); ?>" name="<?php echo $this->get_field_name( 'tab6' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( !$instance['tab6'] ) echo ' selected="selected"'; ?> value=""></option>
			<?php foreach ( $hybrid_tabs as $tab ) : ?>
				<option <?php if ( $tab->name == $instance['tab6'] ) echo ' selected="selected"'; ?> value="<?php echo $tab->name; ?>"><?php echo $tab->label; ?></option>
			<?php endforeach; ?>
			</select>
		</p>
		</div>

		<div style="float:right;width:48%;">

		<p>
			<label for="<?php echo $this->get_field_id( 'tab1_title' ); ?>"><?php _e('Tab 1 Title:', 'hybrid_tabs'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'tab1_title' ); ?>" name="<?php echo $this->get_field_name( 'tab1_title' ); ?>" value="<?php echo $instance['tab1_title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'tab2_title' ); ?>"><?php _e('Tab 2 Title:', 'hybrid_tabs'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'tab2_title' ); ?>" name="<?php echo $this->get_field_name( 'tab2_title' ); ?>" value="<?php echo $instance['tab2_title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'tab3_title' ); ?>"><?php _e('Tab 3 Title:', 'hybrid_tabs'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'tab3_title' ); ?>" name="<?php echo $this->get_field_name( 'tab3_title' ); ?>" value="<?php echo $instance['tab3_title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'tab4_title' ); ?>"><?php _e('Tab 4 Title:', 'hybrid_tabs'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'tab4_title' ); ?>" name="<?php echo $this->get_field_name( 'tab4_title' ); ?>" value="<?php echo $instance['tab4_title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'tab5_title' ); ?>"><?php _e('Tab 5 Title:', 'hybrid_tabs'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'tab5_title' ); ?>" name="<?php echo $this->get_field_name( 'tab5_title' ); ?>" value="<?php echo $instance['tab5_title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'tab6_title' ); ?>"><?php _e('Tab 6 Title:', 'hybrid_tabs'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'tab6_title' ); ?>" name="<?php echo $this->get_field_name( 'tab6_title' ); ?>" value="<?php echo $instance['tab6_title']; ?>" />
		</p>

		</div>
		<div style="clear:both;">&nbsp;</div>
	<?php
	}
}

?>