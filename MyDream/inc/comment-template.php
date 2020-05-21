<?php
function mytheme_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
	// 楼层
	global $commentcount;
	if(!$commentcount) {
		if ( get_query_var('cpage') > 0 )
		$page = get_query_var('cpage')-1;
		else $page = get_query_var('cpage');
		$cpp=get_option('comments_per_page');
		$commentcount = $cpp * $page;
	}
?>

	<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 48 ); ?>
		<!--<?php printf( __( '<cite class="fn">%s</cite> <span class="says">:</span>' ), get_comment_author_link() ); ?>-->
		<strong>
			<?php if(!get_comment_author_url()) : ?>
				<?php comment_author(); ?>
				<?php else : ?>
				<a href="<?php comment_author_url(); ?>" target="_blank" rel='nofollow'><?php comment_author(); ?></a>
			<?php endif; ?>
		</strong>
		<?php if(user_can($comment->user_id, 1)){echo '<strong><font color="#0AB59B">博主</font></strong>';}; ?>
		<span class="comment-meta commentmetadata">
			<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>" ></a><br />
			<span class="comment-aux">
				<span class="reply"><?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></span>
				<?php printf('%1$s %2$s', get_comment_date( 'Y年m月d日' ),  get_comment_time() ); ?>
				<?php
					if ( current_user_can('level_10') ) {
						$url = home_url();
						echo '<a id="delete-'. $comment->comment_ID .'" href="' . wp_nonce_url("$url/wp-admin/comment.php?action=deletecomment&amp;p=" . $comment->comment_post_ID . '&amp;c=' . $comment->comment_ID, 'delete-comment_' . $comment->comment_ID) . '" >&nbsp;删除</a>';
					}
				?>
				<?php edit_comment_link( '编辑' , '&nbsp;', '' ); ?>
					<span class="floor">
						<?php
							if(!$parent_id = $comment->comment_parent){
								switch ($commentcount){
									case 0 :echo "&nbsp;沙发";++$commentcount;break;
									case 1 :echo "&nbsp;板凳";++$commentcount;break;
									case 2 :echo "&nbsp;地板";++$commentcount;break;
									default:printf('&nbsp;%1$s楼', ++$commentcount);
								}
							}
						?>
						<?php if( $depth > 1){printf('&nbsp;%1$s层', $depth-1);} ?>
					</span>
			</span>
		</span>
	</div>
	<?php comment_text( $comment_ID ); ?> 
	<?php if ( $comment->comment_approved == '0' ) : ?>
		<div class="comment-awaiting-moderation">您的评论正在等待审核！</div>
	<?php endif; ?>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php
}