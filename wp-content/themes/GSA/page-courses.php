<?php 
	/*
		Template Name: Courses Template
	*/
?>

<?php get_header(); ?>


<div class="bread_crumbs"><?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?></div>

<div class="contentmain">

    <div class="topics_outer">

    <h2>List of Courses</h2>

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

    <TABLE >

        <THEAD>
               <TH>Title</TH> 
               <TH>Description</TH>
               <!-- <TH>URL</TH> -->
               
        </THEAD>
    
        <TBODY>
            
           <?php 

               if($loop->have_posts())
               { 

                $index = 0;

                while ( $loop->have_posts() ) : $loop->the_post();

                if($index++ % 2 == 0)
                    {
                        echo "<tr class='alternateRow'>";
                    }
                    else 
                    {
                        echo "<tr>";    
                    }

            ?>

                

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

<?php get_footer(); ?>