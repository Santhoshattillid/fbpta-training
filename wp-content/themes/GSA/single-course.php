<?php 
	/*
		Template Name: Course Template
	*/
?>

<?php get_header(); ?>

<div class="bread_crumbs">

	<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>

</div>

<div class="contentmain">
      
	<div class="topics_outer">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

		<?php the_tags( '<p>Tags: ', ', ', '</p>'); ?>

		<?
			// course custom properties
			$p = get_post_custom($post->ID);
			
			// title
			echo '<h1>' . the_title('','',false) . '</h1>';
			
			// image
			$imageProperties = get_the_image();

            
			if (isset($imageProperties) && is_array($imageProperties) && isset($imageProperties['url']))
			{

				$imageUrl = $imageProperties['url'];
				$imagetitle = $imageProperties['title'];
				$width = $imageProperties['width'];
				$height = $imageProperties['height'];
				
				if (isset($imageUrl) && $imageUrl != '')
				{
					echo '<div><img src="' . $imageUrl . '" alt="" style="border:0px;"';
					if ($width != '') { echo ' width="' . $width . 'px"'; }
					echo ' /></div>';
				}

			}
			
			// description
			echo '<div> <p>';
				the_content();
			echo '</div> </p>';
			
			// Organization(s)
			// TODO: display related organization(s)
                       
			// course compencies
			echo '<h2>Organizations</h2>';

			$org_list = wp_get_post_terms($post->ID, 'course-organization', array("fields" => "all"));

			echo "<table> <tbody>";

			$index = 0;

			foreach ($org_list as $key => $org) {
				
				$url = get_term_link($org->slug, 'course-organization');

				if($index++ % 2 == 0)
				{
                        echo "<tr class='alternateRow'>";
                }
                else 
                {
                    echo "<tr>";    
                }
				echo '<td><a href="' . $url . '">' . $org->name . '</a></td></tr>';	
			}

			echo "</tbody></table>";

			// url
			$url = getValue($p, 'url');
			if (isset($url) && $url != "")
			{
				echo '<div>Website: <a href="' . $url . '">' . $url . '</a></div>';
			}
			
			// date
			$date = getValue($p, 'date');
			if (isset($date) && $date != "")
			{
				echo '<div>Date: ' . format_date($date) . '</div>';
			}
			
			// cost
			$cost = getValue($p, 'cost');
			if (isset($cost) && $cost != "")
			{
				echo '<div>Cost: ' . $cost . '</div>';
			}
			
			// length
			$length = getValue($p, 'length');
			if (isset($length) && $length != "")
			{
				echo '<div>Length: ' . $length . '</div>';
			}
			
			// online based?
			$isNotOnline = getValue($p, 'isNotOnline');
			if (isset($isNotOnline) && $isNotOnline != "" && $isNotOnline == "true")
			{
				echo '<div>(This course is not online)</div>';
			}
			else
			{
				// echo '<div style="padding:5px 0px;">(This is an online course)</div>';
			}
			
			echo "<br/><br/>";
			
			// course compencies
			echo '<h2>Competencies</h2>';
            
			//   TODO: ADD categories hierarchical, 
            //   Sorted by name, with each competency clickable link to display all other courses for that compentency

			echo "<table> <tbody>";

			$index = 0;

			$cmpt_list = wp_get_post_terms($post->ID, 'course-competency', array("fields" => "all"));

			foreach ($cmpt_list as $key => $cmpt) {
				
				$url = get_term_link($cmpt->slug, 'course-competency'); 

				if($index++ % 2 == 0)
				{
                        echo "<tr class='alternateRow'>";
                }
                else 
                {
                    echo "<tr>";    
                }							

				echo '<td><a href="' . $url . '">' . $cmpt->name . '</a></td></tr>';	

			}

			echo "</tbody></table>";
			
		?>
        
	<?php endwhile; else: ?>
    
	   <p>Sorry, no posts matched your criteria.</p>
    
	<?php endif; ?>
	
    </div>
    
</div>

<?php get_footer(); ?>
