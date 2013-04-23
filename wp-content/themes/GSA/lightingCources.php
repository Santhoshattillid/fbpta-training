<?php /*
    Template Name: LightingCource page Template
*/?>
<?php get_header(); ?>
<div class="bread_crumbs"><?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?></div>

	<div class="contentmain">
	<div id="content" class="widecolumn">

		<div class="course_outer">
        <?php query_posts('showposts=-1&cat=8&order=ASC');?>
		<?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
        <div class="course_box">
       <div class="course_content"> <?php the_content(); ?> </div>
       </div>
        <?php endwhile; ?>
    <?php else : ?>
    <?php endif; ?>
    <?php wp_reset_query();?>
        </div>
		
	</div>
	</div>
<?php get_footer(); ?>