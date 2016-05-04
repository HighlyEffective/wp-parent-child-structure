<?php
// register widget
add_action('widgets_init', 'create_openingstijden_widget');
function create_openingstijden_widget() 
{
    register_widget( 'openingstijden_widget' );
}

class openingstijden_widget extends WP_Widget 
{
	function __construct() 
	{
		parent::__construct(
		// Base ID of your widget
		'openingstijden_widget', 

		// Widget name will appear in UI
		__('Openingstijden', 'openingstijden_widget_domain'), 

		// Widget description
		array( 'description' => __( 'Toon de openingstijden van uw praktijk op de website', 'openingstijden_widget_domain' ), ) 
		);
	}
	
	// Creating widget front-end
	// This is where the action happens
	public function widget( $args, $instance ) 
	{
		?>
		<style>
			.floatleft
			{
				float: left;
				padding-right: 15px;
				width: 50%;
			}
		</style>
		
		<?php	
		echo $args['before_widget'];
			
			echo $args['before_title'];
				echo apply_filters( 'widget_title', $instance['title'] );
			echo $args['after_title'];
			?>
			<div class='openingstijden-item border-none'>
				<?php echo "
					<div class='floatleft'>
						<strong>Maandag:</strong> 
					</div>
					<div class='floatleft'>
						".$instance['monday-from']." - ".$instance['monday-till']."
					</div>
					<div style='clear:both;'></div>
					<div class='floatleft'>
						<strong>Dinsdag:</strong> 
					</div>
					<div class='floatleft'>
						".$instance['tuesday-from']." - ".$instance['tuesday-till']."<br />
					</div>
					<div style='clear:both;'></div>
					<div class='floatleft'>
						<strong>Woensdag:</strong> 
					</div>
					<div class='floatleft'>
						".$instance['wednesday-from']." - ".$instance['wednesday-till']."<br />
					</div>
					<div style='clear:both;'></div>
					<div class='floatleft'>
						<strong>Donderdag: </strong>
					</div>
					<div class='floatleft'>
						".$instance['thursday-from']." - ".$instance['thursday-till']."<br />
					</div>
					<div style='clear:both;'></div>
					<div class='floatleft'>
						<strong>Vrijdag:</strong> 
					</div>
					<div class='floatleft'>
						".$instance['friday-from']." - ".$instance['friday-till']."<br />
					</div>
					<div style='clear:both;'></div>
					<div class='floatleft'>
						<strong>Zaterdag:</strong> 
					</div>
					<div class='floatleft'>
						".$instance['saturday-from']." - ".$instance['saturday-till']."<br />
					</div>
					<div style='clear:both;'></div>
					<div class='floatleft'>
						<strong>Zondag:</strong> 
					</div>
					<div class='floatleft'>
						".$instance['sunday-from']." - ".$instance['sunday-till']."
					</div>
					<div style='clear:both;'></div>
					"; 
				?>
			</div>
			<?php
		
		echo $args['after_widget'];
	}
	
	// Widget Backend 
	public function form( $instance ) 
	{
		$title = ( ! empty( $instance[ 'title' ] ) ) ? strip_tags( $instance[ 'title' ] ) : __( '', 'openingstijden_widget_domain' );
		$monday_from = ( ! empty( $instance[ 'monday-from' ] ) ) ? strip_tags( $instance[ 'monday-from' ] ) : __( '', 'openingstijden_widget_domain' );
		$monday_till = ( ! empty( $instance[ 'monday-till' ] ) ) ? strip_tags( $instance[ 'monday-till' ] ) : __( '', 'openingstijden_widget_domain' );
		$tuesday_from = ( ! empty( $instance[ 'tuesday-from' ] ) ) ? strip_tags( $instance[ 'tuesday-from' ] ) : __( '', 'openingstijden_widget_domain' );
		$tuesday_till = ( ! empty( $instance[ 'tuesday-till' ] ) ) ? strip_tags( $instance[ 'tuesday-till' ] ) : __( '', 'openingstijden_widget_domain' );
		$wednesday_from = ( ! empty( $instance[ 'wednesday-from' ] ) ) ? strip_tags( $instance[ 'wednesday-from' ] ) : __( '', 'openingstijden_widget_domain' );
		$wednesday_till = ( ! empty( $instance[ 'wednesday-till' ] ) ) ? strip_tags( $instance[ 'wednesday-till' ] ) : __( '', 'openingstijden_widget_domain' );
		$thursday_from = ( ! empty( $instance[ 'thursday-from' ] ) ) ? strip_tags( $instance[ 'thursday-from' ] ) : __( '', 'openingstijden_widget_domain' );
		$thursday_till = ( ! empty( $instance[ 'thursday-till' ] ) ) ? strip_tags( $instance[ 'thursday-till' ] ) : __( '', 'openingstijden_widget_domain' );
		$friday_from = ( ! empty( $instance[ 'friday-from' ] ) ) ? strip_tags( $instance[ 'friday-from' ] ) : __( '', 'openingstijden_widget_domain' );
		$friday_till = ( ! empty( $instance[ 'friday-till' ] ) ) ? strip_tags( $instance[ 'friday-till' ] ) : __( '', 'openingstijden_widget_domain' );
		$saturday_from = ( ! empty( $instance[ 'saturday-from' ] ) ) ? strip_tags( $instance[ 'saturday-from' ] ) : __( '', 'openingstijden_widget_domain' );
		$saturday_till = ( ! empty( $instance[ 'saturday-till' ] ) ) ? strip_tags( $instance[ 'saturday-till' ] ) : __( '', 'openingstijden_widget_domain' );
		$sunday_from = ( ! empty( $instance[ 'sunday-from' ] ) ) ? strip_tags( $instance[ 'sunday-from' ] ) : __( '', 'openingstijden_widget_domain' );
		$sunday_till = ( ! empty( $instance[ 'sunday-till' ] ) ) ? strip_tags( $instance[ 'sunday-till' ] ) : __( '', 'openingstijden_widget_domain' );
		
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Titel</label><br />
			<input type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo $title; ?>" class="widefat" />
		</p>
		<p>
			<div style="width: 30%; float: left; margin-top:7px"><strong>Maandag:</strong></div>
			<div style="width: 26%; float: left;">
				van <input type="text" name="<?php echo $this->get_field_name('monday-from'); ?>" id="<?php echo $this->get_field_id('monday-from'); ?>" value="<?php echo $monday_from; ?>" style="width: 75px;"/>
			</div>
			<div style="width: 26%; float: left;">
				tot <input type="text" name="<?php echo $this->get_field_name('monday-till'); ?>" id="<?php echo $this->get_field_id('monday-till'); ?>" value="<?php echo $monday_till; ?>" style="width: 75px;"/>
			</div>
			<div style="clear: both;"></div>
			
		</p>
		<p>
			<div style="width: 30%; float: left; margin-top:7px"><strong>Dinsdag:</strong></div>
			<div style="width: 26%; float: left;">
				van <input type="text" name="<?php echo $this->get_field_name('tuesday-from'); ?>" id="<?php echo $this->get_field_id('tuesday-from'); ?>" value="<?php echo $tuesday_from; ?>" style="width: 75px;"/>
			</div>
			<div style="width: 26%; float: left;">
				tot <input type="text" name="<?php echo $this->get_field_name('tuesday-till'); ?>" id="<?php echo $this->get_field_id('tuesday-till'); ?>" value="<?php echo $tuesday_till; ?>" style="width: 75px;"/>
			</div>
			<div style="clear: both;"></div>
			
		</p>
		<p>
			<div style="width: 30%; float: left; margin-top:7px"><strong>Woensdag:</strong></div>
			<div style="width: 26%; float: left;">
				van <input type="text" name="<?php echo $this->get_field_name('wednesday-from'); ?>" id="<?php echo $this->get_field_id('wednesday-from'); ?>" value="<?php echo $wednesday_from; ?>" style="width: 75px;"/>
			</div>
			<div style="width: 26%; float: left;">
				tot <input type="text" name="<?php echo $this->get_field_name('wednesday-till'); ?>" id="<?php echo $this->get_field_id('wednesday-till'); ?>" value="<?php echo $wednesday_till; ?>" style="width: 75px;"/>
			</div>
			<div style="clear: both;"></div>
			
		</p>
		<p>
			<div style="width: 30%; float: left; margin-top:7px"><strong>Donderdag:</strong></div>
			<div style="width: 26%; float: left;">
				van <input type="text" name="<?php echo $this->get_field_name('thursday-from'); ?>" id="<?php echo $this->get_field_id('thursday-from'); ?>" value="<?php echo $thursday_from; ?>" style="width: 75px;"/>
			</div>
			<div style="width: 26%; float: left;">
				tot <input type="text" name="<?php echo $this->get_field_name('thursday-till'); ?>" id="<?php echo $this->get_field_id('thursday-till'); ?>" value="<?php echo $thursday_till; ?>" style="width: 75px;"/>
			</div>
			<div style="clear: both;"></div>
			
		</p>
		<p>
			<div style="width: 30%; float: left; margin-top:7px"><strong>Vrijdag:</strong></div>
			<div style="width: 26%; float: left;">
				van <input type="text" name="<?php echo $this->get_field_name('friday-from'); ?>" id="<?php echo $this->get_field_id('friday-from'); ?>" value="<?php echo $friday_from; ?>" style="width: 75px;"/>
			</div>
			<div style="width: 26%; float: left;">
				tot <input type="text" name="<?php echo $this->get_field_name('friday-till'); ?>" id="<?php echo $this->get_field_id('friday-till'); ?>" value="<?php echo $friday_till; ?>" style="width: 75px;"/>
			</div>
			<div style="clear: both;"></div>
			
		</p>
		<p>
			<div style="width: 30%; float: left; margin-top:7px"><strong>Zaterdag:</strong></div>
			<div style="width: 26%; float: left;">
				van <input type="text" name="<?php echo $this->get_field_name('saturday-from'); ?>" id="<?php echo $this->get_field_id('saturday-from'); ?>" value="<?php echo $saturday_from; ?>" style="width: 75px;"/>
			</div>
			<div style="width: 26%; float: left;">
				tot <input type="text" name="<?php echo $this->get_field_name('saturday-till'); ?>" id="<?php echo $this->get_field_id('saturday-till'); ?>" value="<?php echo $saturday_till; ?>" style="width: 75px;"/>
			</div>
			<div style="clear: both;"></div>
			
		</p>
		<p>
			<div style="width: 30%; float: left; margin-top:7px"><strong>Zondag:</strong></div>
			<div style="width: 26%; float: left;">
				van <input type="text" name="<?php echo $this->get_field_name('sunday-from'); ?>" id="<?php echo $this->get_field_id('sunday-from'); ?>" value="<?php echo $sunday_from; ?>" style="width: 75px;"/>
			</div>
			<div style="width: 26%; float: left;">
				tot <input type="text" name="<?php echo $this->get_field_name('sunday-till'); ?>" id="<?php echo $this->get_field_id('sunday-till'); ?>" value="<?php echo $sunday_till; ?>" style="width: 75px;"/>
			</div>
			<div style="clear: both;"></div>
			
		</p>
		<?php 
	}
	
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) 
	{
		$instance = $old_instance;
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['monday-from'] = strip_tags( $new_instance['monday-from'] );
		$instance['monday-till'] = strip_tags( $new_instance['monday-till'] );
		$instance['tuesday-from'] = strip_tags( $new_instance['tuesday-from'] );
		$instance['tuesday-till'] = strip_tags( $new_instance['tuesday-till'] );
		$instance['wednesday-from'] = strip_tags( $new_instance['wednesday-from'] );
		$instance['wednesday-till'] = strip_tags( $new_instance['wednesday-till'] );
		$instance['thursday-from'] = strip_tags( $new_instance['thursday-from'] );
		$instance['thursday-till'] = strip_tags( $new_instance['thursday-till'] );
		$instance['friday-from'] = strip_tags( $new_instance['friday-from'] );
		$instance['friday-till'] = strip_tags( $new_instance['friday-till'] );
		$instance['saturday-from'] = strip_tags( $new_instance['saturday-from'] );
		$instance['saturday-till'] = strip_tags( $new_instance['saturday-till'] );
		$instance['sunday-from'] = strip_tags( $new_instance['sunday-from'] );
		$instance['sunday-till'] = strip_tags( $new_instance['sunday-till'] );
		
		return $instance;
	}
	
}
?>
