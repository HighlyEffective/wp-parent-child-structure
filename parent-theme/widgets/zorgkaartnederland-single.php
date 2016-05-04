<?php

function zorgkaartnederland_display($args) {
   		$praktijkdata = get_option('Praktijkinformatie');	
		
		$zknurl = $praktijkdata["zorgkaart_nederland_url"];
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

wp_register_sidebar_widget(
    'zorgkaartnederland_widget',        // your unique widget id
    'Zorgkaart Nederland',          // widget name
    'zorgkaartnederland_display',  // callback function
    array(                  // options
        'description' => 'Plaats de Zorgkaart Nederland widget op uw website'
    )
);
?>