<?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define('WP_USE_THEMES', true);

/** Loads the WordPress Environment and Template */
require('./wp-blog-header.php');
?>

<?php get_header(); ?>

<div class="contentmain">
    
<div id="content" class="widecolumn">

	<div style="padding:5px 0px;"><b>List of Courses</b></div>

    <div class="topics_outer">

    <?php 

        $pageSize = 20;
        // query to get count
        $countquery = new WP_Query( array( 'post_type' => 'course' ) ) ; 

        $count = $countquery->found_posts;

        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;    

        $loop = new WP_Query( array(    'post_type' => 'course', 
                                        'paged' => $paged,
                                        'posts_per_page' => $pageSize
                                        ) ); ?>

    <TABLE style="border: 1px solid #eee;padding:10px;width:100%;">

        <THEAD>
               <TH>Title</TH> 
               <TH>Description</TH>
               <!-- <TH>URL</TH> -->
               
        </THEAD>
    
        <TBODY>
            
           <?php 

               if($loop->have_posts())
               { 
                while ( $loop->have_posts() ) : $loop->the_post(); ?>

                <TR >

                    <TD >
                        <?php the_title( '<h4 class="entry-title"><a href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '" rel="bookmark">', '</a></h4>' ); ?>
                    </TD>    

                    <TD>
                        <?php the_content(); ?>
                    </TD>
                    
                    <!--
                    <TD>
                          <?php //the_title(get_permalink()); ?> 
                    </TD>        
                    -->

                </TR>

                <?php endwhile; ?>

            
                <TR>

                    <TD>

                        <div class="nav-previous">
                    
                        <?php 
                            if($paged != 1 && ($paged  * $pageSize) <= $count )
                            {
                                $index = $paged - 1;
                                echo "<a href='?paged=$index' > Prev </a>";
                            }

                        ?>    
                        </div>
                
                    </TD>

                    <TD>
                    </TD>

                    <TD>

                        <div class="nav-next">

                            <?php     
                                if($paged  * $pageSize < $count )
                                {
                                    $index = $paged + 1;
                                    echo "<a href='?paged=$index' > Next </a>";
                                } 
                            ?>                       

                        </div>

                    </TD>

                </TR> 
            <?php 
                }
                else {
            ?>   

                <TR >

                    <TD colspan="2">

                        There is no records found.

                    </TD>    

                </TR>

            <?php 
                }
            ?>
        </TBODY>

    </TABLE>

    <?php wp_reset_query();?>

	
    </div>
</div>
</div>
