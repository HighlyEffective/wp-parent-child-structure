<?php
// register widget
add_action('widgets_init', 'create_zorgkaartnederland_widget');
function create_zorgkaartnederland_widget() {
    $praktijkdata = get_option('Praktijkinformatie');	
    if( ! empty ($praktijkdata["zorgkaart_nederland_url"] ))
	{
		register_widget( 'zknb_widget' );	
	}	
    
}

class zknb_widget extends WP_Widget 
{
	function __construct() 
	{
		parent::__construct(
		// Base ID of your widget
		'zkn_widget', 

		// Widget name will appear in UI
		__('Zorgkaart Nederland', 'zknb_widget_domain'), 

		// Widget description
		array( 'description' => __( 'Toon uw Zorgkaart Nederland reviews', 'zknb_widget_domain' ), ) 
	);
}

	// Creating widget front-end
	// This is where the action happens
	public function widget( $args, $instance ) 
	{
		$zknurl = apply_filters( 'widget_content', $instance['zknurl'] );
		// before and after widget arguments are defined by themes
		//echo $args['before_widget'];
		echo "<div class='col-xs-12' style='margin-bottom: 30px;'>";
		if ( ! empty( $zknurl ) )
		{
			$rss = $zknurl.'/rss/';	
			
			//echo __( $zknurl.'/rss/', 'zknb_widget_domain' );
			// retrieve RSS feed
			$content = file_get_contents($rss);
		    $x = new SimpleXmlElement($content);
		    $rand =  rand(0, sizeof($x->channel->item)-1);
		    
		    $review = $x->channel->item[$rand]->description;
			$limit = 20;
		    
		    if (str_word_count($review, 0) > $limit) {
          		$words = str_word_count($review, 2);
          		$pos = array_keys($words);
          		$review = substr($review, 0, $pos[$limit]) . '...';
      		}
			$rating = array();
			
			foreach($x->channel->item as $entry) {
		        $grade = explode("waardering: ",$entry->title);
				$rating[] = $grade[1];
			}
		    $average = array_sum($rating) / count($rating);
		    echo '<div class="col-md-4 col-xs-12 zkn-logo">
		    	<img src="http://www.pharmeon-wordpress.nl/pharmeon-images/zorgkaartnederland.png" alt="logo zorgkaart nederland" class="img-responsive" />
		    	</div>';
			
			echo '<div class="col-md-2 col-xs-4">
						<div class="zkn-rating">
							<strong>'.round($average, 1).'</strong>
						</div>
					</div>
					<div class="col-md-6 col-xs-8">
					"'.$review.'"
					<br /><br />
					<a href="'.$zknurl.'">Bekijk alle waarderingen</a>
					<br />
					<a href="'.$zknurl.'/waardeer/">Geef ook je mening op Zorgkaart Nederland</a>
					</div>
				';
		    /* 
		    foreach($x->channel->item as $entry) {
		        echo "<li><a href='$entry->link' title='$entry->title'>" . $entry->title . "</a></li>";
				//echo "<li><a href='$entry->link' title='$entry->title'>" . $entry->description . "</a></li>";
		    }
		    */
			
		}
			
			echo $args['after_widget'];
	}
		
	// Widget Backend 
	public function form( $instance ) 
	{
		$praktijkdata = get_option("Praktijkinformatie");	
		
		$zknurl = ( ! empty( $instance[ 'zknurl' ] ) ) ? strip_tags( $instance[ 'zknurl' ] ) : __( strip_tags( $praktijkdata["zorgkaart_nederland_url"]), 'zknb_widget_domain' );	
		// Widget admin form
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'zknurl' ); ?>"><?php _e( 'Zorgkaart Nederland URL' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'zknurl' ); ?>" name="<?php echo $this->get_field_name( 'zknurl' ); ?>" type="text" value="<?php echo esc_attr( $zknurl ); ?>" />
		</p>
		
		<?php 
	}
	
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) 
	{
		$instance = array();
		$instance['zknurl'] = ( ! empty( $new_instance['zknurl'] ) ) ? strip_tags( $new_instance['zknurl'] ) : 'hoi';
		return $instance;
	}
} // Class wpb_widget ends here
?>