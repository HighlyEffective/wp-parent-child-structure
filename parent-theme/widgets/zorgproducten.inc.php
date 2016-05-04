<?php
// register widget
add_action('widgets_init', 'create_zorgproducten_widget');
function create_zorgproducten_widget() {
    register_widget( 'ph_zorgproducten' );
}

// Class for the "TEAM" Widget.
class ph_zorgproducten extends WP_Widget 
{
	function ph_zorgproducten() 
	{
		$widget_ops = array('classname' => 'ph_zorgproducten');
		$this->WP_Widget('ph_zorgproducten-widget', 'Zorgproducten', $widget_ops);
	}

	function widget($args, $instance) 
	{
		extract($args);

		// widget content
		echo $before_widget;
	
		$linktopage = !empty ( $instance['linktopage'] ) ? get_page_link( $instance['linktopage'] ) : "#";
		$title = !empty ( $instance['title'] ) ? apply_filters('widget_title', $instance['title'] ) : "";
		$description = !empty ( $instance['description'] ) ? apply_filters('content', $instance['description'] ) : "";
		?>
		<div class="col-sm-4 top-space topline">
			<a href="<?php echo $linktopage; ?>" style="color: #000; text-decoration: none;">
			<div class="overlay">
				<h3 class="center"><?php echo $title; ?></h3>
				<div class="circle blue">
					<?php
						if(!empty($instance['image_uri']))
						{
							?>
							<img src="<?php echo esc_url($instance['image_uri']); ?>""/>
							<?php
						}
					?>
				</div>
				<p>
					<?php echo $description; ?>
				</p>
			</div>
			<div class="leesmeer">Meer informatie</div>
			</a>
		</div>
	<?php
		echo $after_widget;
	}

	function update($new_instance, $old_instance) 
	{
		$instance = $old_instance;
		$instance['image_uri'] = strip_tags( $new_instance['image_uri'] );
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['description'] = strip_tags( $new_instance['description'] );
		$instance['linktopage'] = strip_tags( $new_instance['linktopage'] );
		
		return $instance;
	}

	function form($instance) 
	{
	?>
		<p>
			<label for="<?php echo $this->get_field_id('image_uri'); ?>">Afbeelding</label><br />
			<?php
			if ( $instance['image_uri'] != '' ) {
				echo '<img id="'.$this->get_field_id('image_uri').'-image" class="custom_media_image" src="' . $instance['image_uri'] . '" style="margin:0;padding:0;max-width:100px;float:left;display:inline-block" /><br />';
			}
			?>
			<input type="text" class="widefat custom_media_url" name="<?php echo $this->get_field_name('image_uri'); ?>" id="<?php echo $this->get_field_id('image_uri'); ?>-input" value="<?php echo $instance['image_uri']; ?>" style="margin-top:5px;">

			<input type="button" class="button button-primary custom_media_button" id="<?php echo $this->get_field_id('image_uri'); ?>-button" name="<?php echo $this->get_field_name('image_uri'); ?>" value="Upload Image" style="margin-top:5px;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Zorgdiscipline</label><br />
			<input type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('description'); ?>">Korte omschrijving</label><br />
			<!--<input type="text" name="<?php echo $this->get_field_name('description'); ?>" id="<?php echo $this->get_field_id('description'); ?>" value="<?php echo $instance['description']; ?>" class="widefat" />-->
			<textarea name="<?php echo $this->get_field_name('description'); ?>" id="<?php echo $this->get_field_id('description'); ?>" rows="8" class="widefat"><?php echo $instance['description']; ?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('linktopage'); ?>">Link naar pagina </label><br />
			<select name="<?php echo $this->get_field_name('linktopage'); ?>"> 
				<option value="">
				<?php echo esc_attr( __( 'Select page' ) ); ?></option> 
				<?php 
					$pages = get_pages('exclude=7&parent=0&sort_column=menu_order');
					//$pages = get_pages('exclude=7&sort_column=menu_order'); 
					
					foreach ( $pages as $page ) 
					{
						if($page->ID == $instance['linktopage'])
						{
							$option = '<option value="' . $page->ID.'" selected>';
						}	
						else
						{
							$option = '<option value="' .$page->ID. '">';		
						}
						
						$option .= $page->post_title;
						$option .= '</option>';
						echo $option;
						
						$subpages = get_pages('exclude=7&parent='.$page->ID.'&sort_column=menu_order');
						$optgroup = '<optgroup label="">';
						echo $optgroup;
						foreach ( $subpages as $subpage ) 
						{
								
							if($subpage->ID == $instance['linktopage'])
							{
								$suboption = '<option value="'.$subpage->ID.'" selected>';
							}	
							else
							{
								$suboption = '<option value="'.$subpage->ID.'">';		
							}
							
							$suboption .= ''.$subpage->post_title;
							$suboption .= '</option>';
						echo $suboption;
						}
						echo "</optgroup>";
					}
				?>
			</select>
		</p>
	<?php
	
	}
}
?>
