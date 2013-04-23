<?php
	if ( function_exists('register_sidebar') )
    register_sidebar (array(
	'name'          => 'footer Sidebar ',
	'id'            => 'footer-sidebar',
	'description'   => 'Footer Widgets here',
	'before_widget' => '<li id="%1$s" class="widget %2$s">',
	'after_widget'  => '</li>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>' ));
	
	add_theme_support('post-thumbnails');
	set_post_thumbnail_size('my_thumb',190,140,true);
	add_image_size("thumb1",215,150,true);
	
	 // to call this thumbnail, put this in template:-> the_post_thumbnail('my_thumb'); 
	 register_nav_menus( array('my_nav' => __( 'Primary Navigation', 'sw theme' ),
'secondary' => __('Secondary Navigation', 'sw theme'),
'third' => __('Third Navigation', 'sw theme') 
)); 
function get_images($size = 'thumbnail') {
	global $post;
	return get_children( array('post_parent' => get_the_ID(), 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID') );
}
function trim_excerpt($text) {
  return rtrim($text,'[...]');
}
add_filter('get_the_excerpt', 'trim_excerpt');

function dimox_breadcrumbs() {

  $delimiter = '/';
  $home = 'Home'; // text for the 'Home' link
  $before = '<span>'; // tag before the current crumb
  $after = '</span>'; // tag after the current crumb

  if ( !is_home() && !is_front_page() || is_paged() ) {

    echo '<div id="crumbs">';

    global $post;
    $homeLink = get_bloginfo('url');
    echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';

    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;

    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> '
. $delimiter . ' ';
      echo $before . get_the_time('d') . $after;

    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('F') . $after;

    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;

    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> '
 . $delimiter . ' ';
        echo $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        echo $before . get_the_title() . $after;
      }

    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;

    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
      echo $before . get_the_title() . $after;

    } elseif ( is_page() && !$post->post_parent ) {
      echo $before . get_the_title() . $after;

    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $before . get_the_title() . $after;

    } elseif ( is_search() ) {
      echo $before . 'Search results for "' . get_search_query() . '"' . $after;

    } elseif ( is_tag() ) {
      echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;

    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . 'Articles posted by ' . $userdata->display_name . $after;

    } elseif ( is_404() ) {
      echo $before . 'Error 404' . $after;
    }

    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }

    echo '</div>';

  }
} // end dimox_breadcrumbs()







////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////
// course

add_action('init', 'course_register');
function course_register() 
{
	$labels = array(
		'name' => _x('Courses', 'post type general name'),
		'singular_name' => _x('Course', 'post type singular name'),
		'add_new' => _x('Add New', 'Course'),
		'add_new_item' => __('Add New Course'),
		'edit_item' => __('Edit Course'),
		'new_item' => __('New Course'),
		'view_item' => __('View Course'),
		'search_items' => __('Search Courses'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail')
	  ); 
 
	register_post_type( 'course' , $args );
}


// LKK: Create and register course competency hierarchcal taxonomy
add_action( 'init', 'create_courseCompetency_taxonomy', 0 );
function create_courseCompetency_taxonomy() 
{
	// http://codex.wordpress.org/Function_Reference/register_taxonomy
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
    'name' => _x( 'Course Competencies', 'taxonomy general name' ),
    'singular_name' => _x( 'Course Competency', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Course Competencies' ),
    'all_items' => __( 'All Course Competencies' ),
    'parent_item' => __( 'Parent Course Competency' ),
    'parent_item_colon' => __( 'Parent Course Competency:' ),
    'edit_item' => __( 'Edit Course Competency' ), 
    'update_item' => __( 'Update Course Competency' ),
    'add_new_item' => __( 'Add New Course Competency' ),
    'new_item_name' => __( 'New Course Competency Name' ),
    'menu_name' => __( 'Course Competency' ),
  ); 	

  register_taxonomy('course-competency',array('course'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'course-competency' ),
  ));
}

// LKK: Create and register organization taxonomy
add_action( 'init', 'create_courseOrganization_taxonomy', 0 );
function create_courseOrganization_taxonomy() 
{
	// http://codex.wordpress.org/Function_Reference/register_taxonomy
	// Add new taxonomy, not hierarchical
	$labels = array(
    'name' => _x( 'Organizations', 'taxonomy general name' ),
    'singular_name' => _x( 'Organization', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Organizations' ),
    'all_items' => __( 'All Organizations' ),
    'parent_item' => __( 'Parent Organization' ),
    'parent_item_colon' => __( 'Parent Organization:' ),
    'edit_item' => __( 'Edit Organization' ), 
    'update_item' => __( 'Update Organization' ),
    'add_new_item' => __( 'Add New Organization' ),
    'new_item_name' => __( 'New Organization Name' ),
    'menu_name' => __( 'Organization' ),
  ); 	

  register_taxonomy('course-organization',array('course'), array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'course-organization' ),
  ));
}

add_action("admin_init", "course_init");
function course_init(){
  add_meta_box("courseProperties_meta", "Course Properties", "courseProperties_meta", "course", "normal", "low");
}
function courseProperties_meta()
{
	global $post;
	$properties = get_post_custom($post->ID);
	
	$url = getValue($properties, 'url');
	$date = getValue($properties, 'date');
	$cost = getValue($properties, 'cost');
	$length = getValue($properties, 'length');
	$isNotOnline = getValue($properties, 'isNotOnline');

  ?>
<table border="0" cellpadding="10px" cellspacing="0">
	<tr><td><b>URL:</b></td><td><input name="url" value="<?php echo $url; ?>" style="width:500px;" /></td></tr>
	<tr><td><b>Date:</b></td><td><input name="date" value="<?php echo $date; ?>" style="width:100px;" /></td></tr>
	<tr><td><b>Cost:</b></td><td><input name="cost" value="<?php echo $cost; ?>" style="width:100px;" /><div style="font-size:10px; color:#777;">(If free, leave blank. Be sure to include currency symbol)</div></td></tr>
	<tr><td><b>Length:</b></td><td><input name="length" value="<?php echo $length; ?>" style="width:100px;" /></td></tr>
	<tr><td><b>Not Online?:</b></td><td align="left"><input type="checkbox" name="isNotOnline" value="true" <?php if ($isNotOnline) { echo "checked"; } ?> /></td></tr>
</table>

  <?php
}
 
add_action('save_post', 'save_course');
function save_course()
{
	global $post;
	
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
    {
		// dont update custom fields
    }
	else if (isset($post) && is_object($post) && $post->post_type == "course")
	{
		if (isset($_POST["url"])) { update_post_meta($post->ID, "url", $_POST["url"]); }
		if (isset($_POST["date"])) { update_post_meta($post->ID, "date", $_POST["date"]); }
		if (isset($_POST["cost"])) { update_post_meta($post->ID, "cost", $_POST["cost"]); }
		if (isset($_POST["length"])) { update_post_meta($post->ID, "length", $_POST["length"]); }
		if (isset($_POST["isOnline"])) { update_post_meta($post->ID, "isOnline", $_POST["isOnline"]); }
	}
}








////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////
// HELPER FUNCTIONS

function getValue($properties, $propertyName)
{
	if (isset($properties))
	{
		if (isset($properties[$propertyName][0]))
		{
			return $properties[$propertyName][0];
		}
		else
		{
			// custom property undefined
			return '';
		}
	}
	else
	{
		// properties array passed is null
		return '';
	}
}

/// returns array with the url, title, width, and height
function get_the_image($size = 'full', $menuOrder = 0)
{
	// http://wp-fun.co.uk/2009/01/08/post-image-the-easy-peasy-way/#ixzz1IFi1RKQc
	global $post;

	// setup the attachment array
	$att_array = array(
	'post_parent' => $post->ID,
	'post_type' => 'attachment',
	'post_mime_type' => 'image',
	'order_by' => 'menu_order'
	);
	
	$o = array();

	// get the post attachments
	$attachments = get_children($att_array);

	// make sure there are attachments
	if (is_array($attachments))
	{
		// loop through them
		foreach ($attachments as $att)
		{
			// find the one we want based on its characteristics
			if ($att->menu_order == $menuOrder)
			{
				$image_src_array = wp_get_attachment_image_src($att->ID, $size);
				
				// get url - 1 and 2 are the x and y dimensions
				$o['url'] = $image_src_array[0];
				$o['title'] = $att->post_title;
				$o['width'] = $image_src_array[1];
				$o['height'] = $image_src_array[2];
			}
		}
	}
	return $o;
}

function format_date($date)
{
	if (isset($date) && $date != '')
	{
		$date = strtotime($date);
		$date = date('F jS, Y', $date);
	}
	return $date;
}

?>