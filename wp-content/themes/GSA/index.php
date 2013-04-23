<?php get_header(); ?>

<div class="contentmain">
    
    <div class="topics_outer">

        <h2>List of Competencies</h2>

    <?php 


        $pageSize = 20;
        
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;    

        $args = array(
            'posts_per_page' => $pageSize,
            'paged' => $paged,
            'terms_per_page' => $pageSize,
        );


        $terms = get_terms("course-competency",$args);
        
        $count = count($terms);  


        ?>

    <table>

        <!-- <THEAD>
               <TH>Title</TH> 
               <TH>Description</TH>
                <TH>URL</TH> 
               
        </THEAD>
    -->
        <tbody>
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
                        <td>
                            <a href='<?php echo esc_url( get_term_link( $term, $term->taxonomy ) ); ?>'>
                                <?php echo $term->name; ?>
                            </a>
                        </td>    
                        <!-- <TD><?php echo $term->description; ?></TD><TD><?php //the_title(get_permalink()); ?></TD>-->
                     </tr>
                <?php 
                } ?>
                <!--<TR><TD><div class="nav-previous">
                <?php 
                    //if($paged != 1 && ($paged  * $pageSize) <= $count )
                    {
                             //  $index = $paged - 1;
                            //    echo "<a href='?paged=$index' > Prev </a>";
                    }
                 ?>    
                </div>
                </TD>
                    <TD>
                        <div class="nav-next">
                            <?php     
                                //if($paged  * $pageSize < $count )
                                {
                                  //  $index = $paged + 1;
                                  //  echo "<a href='?paged=$index' > Next </a>";
                                } 
                            ?>                       
                        </div>
                    </TD>
                </TR> 
            -->
            <?php 
                }
                else {
            ?>   
                <tr>
                    <td colspan="2">
                        There is no records found.
                    </td>    
                </tr>
            <?php 
                }
            ?>
        </tbody>
    </table>
    <?php wp_reset_query();?>
    </div>
</div>
<?php get_footer(); ?>
