<?php get_header(); ?>
<!-- start content -->
<div class="contentmain">
<div id="content">
	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>
        
	<div class="post topics_outer" id="post-<?php the_ID(); ?>">
		<h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
		<p class="meta"><div class="paragraph"><small>Posted on <?php the_time('F jS, Y') ?> by <?php the_author() ?> <?php edit_post_link('Edit', ' | ', ''); ?></small></div></p>
       
	</div>
    <?php endwhile; ?>
    	<div class="navigation">
                        <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
       </div>
<?php else : ?>
	<h2 class="center">Not Found</h2>
	<p class="center">Sorry, but you are looking for something that isn't here.</p>
	<?php include (TEMPLATEPATH . "/searchform.php"); ?>
<?php endif; ?>
</div>
</div>
<!-- end content -->
<?php get_footer(); ?>