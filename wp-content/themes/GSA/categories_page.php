<?php /*
    Template Name: Categories page Template
*/?>
<?php get_header(); ?>
<div class="bread_crumbs"><?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?></div>
	<div class="contentmain">
	<div id="content" class="widecolumn">
		<div class="listcategory_outer">
        <div class="listcategory_box">
        <?php 
 	$args = array(
	'type'                     => 'post',
	'child_of'                 => 10,
	'parent'                   => '',
	'orderby'                  => 'name',
	'order'                    => 'ASC',
	'hide_empty'               => 0,
	'hierarchical'             => 1,
	'exclude'                  => '',
	'include'                  => '',
	'number'                   => '',
	'taxonomy'                 => 'category',
	'pad_counts'               => false );
	
	$categories = get_categories( $args );
	$percolumn=ceil(sizeof($categories)/3); 
	$i=0;
		
		foreach($categories as $cat){
		$i++;
		
		
		echo '<div class="course_category">'.$cat->name.'</div>';
		query_posts('showposts=-1&cat='.$cat->term_id.'&order=ASC');?>
		<?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
       	     <?php $New = get_post_meta($post->ID, 'New', true);?>
        <?php if($New!=''){  ?>
            <div class="course_title">
                <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> <span class="new"><?php echo $New;?></span></a>
            </div>
       <?php } else{?>
       <div class="course_title">
                <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a>
            </div>
       <?php }?>
        <?php endwhile; ?>
		<?php else : ?>
        <?php endif; ?>
        <?php wp_reset_query();
		if( $i==$percolumn ){
		$i=0;
		echo '</div><div class="listcategory_box">';
		}
		}
		
		
		echo '</div>';
		
		?>
        </div><!--	/atOuter-->
        
        </div>
        </div>
	

<?php get_footer(); ?>