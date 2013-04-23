<?php // Do not delete these lines
	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

        if (!empty($post->post_password)) { // if there's a password
            if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
				?>
				
				<p class="nocomments">This post is password protected. Enter the password to view comments.<p>
				
				<?php
				return;
            }
        }

		/* This variable is for alternating comment background */
		$oddcomment = 'odd';
?>

<!-- You can start editing here. -->

<div id="commentsbox">
<?php if ($comments) : ?>
<?php 

	/* Count the totals */
	$numPingBacks = 0;
	$numComments  = 0;

	/* Loop through comments to count these totals */
	foreach ($comments as $comment) {
		if (get_comment_type() != "comment") { $numPingBacks++; }
		else { $numComments++; }
	}

?>
<?php 
/* This is a loop for printing comments */
	if ($numComments != 0) : ?>
<center><h2 class="comlabel" id="comments">
<span class="comtext"><?php comments_number('No People have', 'One Person has', '% People have' );?>  left comments on this post</span>
</h2></center><br /><br />
<?php foreach ($comments as $comment) : ?>
<?php if (get_comment_type()=="comment") : ?>
<div class="<?php if ($comment->comment_author_email == "") echo 'authorcomment'; else echo $oddcomment; ?>" id="comment-<?php comment_ID() ?>">
<strong style="text-transform: capitalize;">&raquo; <?php comment_author_link() ?></strong> said: <?php edit_comment_link('Edit',' | ',''); ?> 
<small>{ <?php comment_date('M j, Y');?> - <?php comment_time('h:m:s') ?> }</small>
<?php if ($comment->comment_approved == '0') : ?>
<b style="color:#FF0000;">Comment is awaiting moderation.</b>
<?php endif; ?>
</div> 
<div class="commenttext"><?php comment_text() ?></div>
	<?php /* Changes every other comment to a different class */	
	if ('alt' == $oddcomment) $oddcomment = '';
	else $oddcomment = 'odd';
	?>
	<?php endif; endforeach; ?>
	<?php endif; ?>
	<?php
	/* This is a loop for printing trackbacks if there are any */
	if ($numPingBacks != 0) : ?>
<center><h2 class="postlabel"><span class="posttext"><?php _e($numPingBacks); ?> Trackback(s)</span></h2></center>
<?php foreach ($comments as $comment) : ?>
<?php if (get_comment_type()!="comment") : ?>
	<div id="comment-<?php comment_ID() ?>">
		<div class="commenttext"><small>{ <?php comment_date('M j, Y');?> - <?php comment_time('h:m:s') ?> }</small> <?php comment_author_link() ?></div>
		<?php if ($comment->comment_approved == '0') : ?>
		<em>Your comment is awaiting moderation.</em>
		<?php endif; ?>
	</div>
	<?php if('odd'==$thiscomment) { $thiscomment = 'even'; } else { $thiscomment = 'odd'; } ?>
<?php endif; endforeach; ?>
<?php endif; ?>
<?php else : 
/* No comments at all means a simple message instead */ 
?>
<?php endif; ?>
<?php if (comments_open()) : ?>
<?php if (get_option('comment_registration') && !$user_ID ) : ?>
		<p id="comments-blocked">You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=
		<?php the_permalink(); ?>">logged in</a> to post a comment.</p>
	<?php else : ?>
<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<center><h2 class="postlabel"><span class="posttext">Post a Comment</span></h2></center><br /><br />
<?php if ($user_ID) : ?>
<p>You are logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php">
<?php echo $user_identity; ?></a>. To logout, <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">click here</a>.
</p>
<?php else : ?>	
<p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
<label for="author"><small>Name <?php if ($req) echo "(required)"; ?></small></label></p>
<p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
<label for="email"><small>Mail (will not be published) <?php if ($req) echo "(required)"; ?></small></label></p>
<p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
<label for="url"><small>Website</small></label></p>
	<?php 
/****** Math Comment Spam Protection Plugin ******/
if ( function_exists('math_comment_spam_protection') ) { 
	$mcsp_info = math_comment_spam_protection();
?> 	<p><input type="text" name="mcspvalue" id="mcspvalue" value="" size="22" tabindex="4" />
	<label for="mcspvalue"><small>Spam protection: Sum of <?php echo $mcsp_info['operand1'] . ' + ' . $mcsp_info['operand2'] . ' ?' ?></small></label>
	<input type="hidden" name="mcspinfo" value="<?php echo $mcsp_info['result']; ?>" />
</p>
<?php } // if function_exists... ?>
	<?php endif; ?>
<p><textarea name="comment" id="comment" cols="5" rows="10" tabindex="4"></textarea></p>
<p><input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" />
<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" /></p>
<?php do_action('comment_form', $post->ID); ?>
</form>
<?php endif; // If registration required and not logged in ?>
<?php else : // Comments are closed ?>
<p id="comments-closed">Sorry, comments for this entry are closed at this time.</p>
<?php endif; ?></div>