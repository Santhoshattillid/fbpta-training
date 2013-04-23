<?php get_header(); ?>
<div class="bread_crumbs">
	<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
</div>
<div class="contentmain">
	<div class="topics_outer">
		<?php
			if( is_tax() ) {
 			   	global $wp_query;
    			$term = $wp_query->get_queried_object();
    			echo "<h1>" . $term->name . "</h1>";
    			// description
				echo '<div> <p>'. $term->description  .'</div> </p>';
			}
			query_posts($query_string . '&order=ASC');
			if (have_posts())	{ 
		?>
			<h2> Related Courses </h2>
			<table>
				<thead>
						<th> Title </th>
						<th> Description </th>
						<th> Organizations </th>
						<th> Competencies </th>
				</thead>
				<tbody>	
					<?php 
						$index = 0;
						while (have_posts()) : the_post(); 
						// course custom properties
						$p = get_post_custom($post->ID);
						if($index++ % 2 == 0)
	                    {
    	                    echo "<tr class='alternateRow'>";
        	            }
            	        else 
                	    {
                    	    echo "<tr>";    
                    	}
					?>
						<td> 
					<?php 
						// title
						the_title("<a href='" . get_permalink() . "' title='" . the_title_attribute( 'echo=0' ) . "' rel='course'>", '</a>' ); 
					?> 
						</td>
						<td> <?php the_content(); ?> </td>
						<td> 
							<ul>
								<?php
									// Organization(s)
            						$org_list = wp_get_post_terms($post->ID, 'course-organization', array("fields" => "all","orderby" => "name"));
									foreach ($org_list as $key => $org) {
										$url = get_term_link($org->slug, 'course-organization'); 							
										echo '<li><a href="' . $url . '">' . $org->name . '</a></li>';	
									}
								?>		
							</ul>
						</td>
						<td>
							<ul>
							<?php
								// Course Compencies(s)	
								$cmpt_list = wp_get_post_terms($post->ID, 'course-competency', array("fields" => "all","orderby" => "name"));
								foreach ($cmpt_list as $key => $cmpt) {
									$url = get_term_link($cmpt->slug, 'course-competency'); 							
									echo '<li><a href="' . $url . '">' . $cmpt->name . '</a></li>';	
								}
							?>
							</ul>	
						</td>
					</tr>
					<?php 
						endwhile;
					?>
				</tbody>
			</table>
		<?php }
			else 
		{ ?>
			<h3> There is no course related to this competencies. </h3>
		<?php }
		 ?>
	</div>
</div>
<?php get_footer(); ?>