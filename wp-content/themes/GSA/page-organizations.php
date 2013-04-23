<?php
/*
 * Template Name: Organizations Page
 */
?>

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

<div class="bread_crumbs"><?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?></div>

<div class="contentmain">

    <div class="topics_outer">

        <h2>List of Organizations</h2>

    <?php 


        $pageSize = 20;
        
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;    

        $args = array(
            'posts_per_page' => $pageSize,
            'paged' => $paged,
            'terms_per_page' => $pageSize,
            "orderby" => "name"
        );


        $terms = get_terms("course-organization",$args);
        
        $count = count($terms);  


        ?>

    <TABLE>

        <THEAD>
               <TH>Title</TH> 
               <TH>Description</TH>
               <!-- <TH>URL</TH> -->
               
        </THEAD>
    
        <TBODY>
            
           <?php 

               if($count > 0)
               { 

                $index = 0;
                foreach ($terms as $term) { 

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

                        <a href='<?php echo esc_url( get_term_link( $term, $term->taxonomy ) ); ?>'>

                           <?php echo $term->name; ?>
                                
                        </a>
                        
                    </TD>    

                    <TD>
                        <p>
                            <?php echo $term->description; ?>
                        </p>
                    </TD>
                    
                    <!--
                    <TD>
                          <?php //the_title(get_permalink()); ?> 
                    </TD>        
                    -->

                </TR>

                <?php } ?>

            
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
