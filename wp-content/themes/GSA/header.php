<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> &raquo; Blog Archive <?php } ?> <?php wp_title(); ?></title>
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats -->
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_head(); ?>
<script src="<?php bloginfo('template_directory')?>/jq/css_browser_selector.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory')?>/jq/jquery-1.6.min.js"></script> 

<script type='text/javascript'>
	jQuery(document).ready(function(){
	   jQuery("ul#menu-top-menu li:first").addClass("menu1");
	   jQuery("ul#menu-footer-menu li:first").addClass("menu1");
	});
</script>
<script type='text/javascript'>
jQuery(document).ready(function() {
jQuery("#menu-top-menu ul").css({display: "none"}); // Opera Fix
jQuery("#menu-top-menu li").hover(function(){
		jQuery(this).find('ul:first').css({visibility: "visible",display: "none"}).show(268);
		},function(){
		jQuery(this).find('ul:first').css({visibility: "hidden"});
		jQuery("#menu-top-menu li li:has(ul)").addClass("parent");
		});
		
		jQuery("#menu-top-menu1 ul").css({display: "none"}); // Opera Fix
		jQuery("#menu-top-menu1 li").hover(function(){
		jQuery(this).find('ul:first').css({visibility: "visible",display: "none"}).show(268);
		},function(){
		jQuery(this).find('ul:first').css({visibility: "hidden"});
		jQuery("#menu-top-menu1 li li:has(ul)").addClass("parent");
		});
		
		jQuery("#menu-top-menu2 ul").css({display: "none"}); // Opera Fix
		jQuery("#menu-top-menu2 li").hover(function(){
		jQuery(this).find('ul:first').css({visibility: "visible",display: "none"}).show(268);
		},function(){
		jQuery(this).find('ul:first').css({visibility: "hidden"});
		jQuery("#menu-top-menu2 li li:has(ul)").addClass("parent");
		});
		
		$("form.adjustform input:nth-child(4)").addClass("check_out_button");
});
</script>
<script type="text/javascript" src="<?php bloginfo('template_directory')?>/jq/jquery.nivo.slider.pack.js"></script>
<link rel="stylesheet" href="<?php bloginfo('template_directory')?>/css/nivo-slider.css" type="text/css" media="screen" />
    <script type="text/javascript">
    $(window).load(function() {
	$('#slider').nivoSlider({
        effect:'fade',
		directionNav:false,
		pauseTime: 9000, 
     	animSpeed:1000
    });    });
    </script>
</head>
<body>
<div class="header_outer">
<div id="logo">
<div class="box1">
	<div class="site_logo">
    	<a href="<?php echo get_option('home'); ?>/"><img src="<?php bloginfo('template_directory')?>/images/logo.png" alt="Logo" /></a>
    </div>
    <div class="box2">
    	<div class="menu_outer">
            <div id="access">
                <div class="menu-header">
                  
                </div>
            </div>
        </div>
        <div class="search_outer">
            <div id="search">
            <span class="search_text">Search</span>
            <form id="searchform" method="get" action="<?php bloginfo('url'); ?>/">
                <fieldset>
                <div class="input_outer">
                <input id="s" type="text" name="s" value="Search GSA" class="text"  onblur="if (this.value == '') {this.value = 'Search GSA';}" onfocus="if (this.value == 'Search GSA') {this.value = '';}"/>
                <input id="x" type="submit" value="" class="button" />
                </div>
                </fieldset>
            </form>
        	</div>
       </div> 
       
    </div>
</div>
<div class="box3">
    <div id="access2">
        <div class="menu-header">
        	<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'secondary' ) ); ?>
        </div>
    </div>
</div>
	
</div>
</div>
<hr />

	<?php if(is_home()){?>
		<div class="slider_outer">
            <div class="slider">
            <div id="wrapper">
            <div class="slider-wrapper theme-default">
            <div id="slider" class="nivoSlider">
            <?php query_posts('showpost&cat=5');
            while (have_posts()) : the_post(); 
            $url = get_post_meta($post->ID, 'image', true); ?>
            <a><img src="<?php echo $url;?>" alt="" title="#htmlcaption-<?php the_ID(); ?>" /></a>
            <?php endwhile; wp_reset_query();?>
            </div>
            <?php query_posts('showpost&cat=5');
            while (have_posts()) : the_post(); ?>
            <div id="htmlcaption-<?php the_ID(); ?>" class="nivo-html-caption">
            <p><?php echo substr(get_the_excerpt('Read the rest of this entry &raquo;'),0,200); ?></p>
            <a class="more" href="<?php the_permalink() ?>"></a>
            </div>
            <?php endwhile; wp_reset_query();?>
            </div>
            </div>
            </div>
        </div> <!--nivoslider outer-->
     <?php }else {?>
     	<div class="page_title_outer"> 
            <div class="page_title_inner">
            <h1 class="title"></h1>
            </div>
        </div>
     <?php } ?>

<div id="page">