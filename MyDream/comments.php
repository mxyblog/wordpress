<?php
if ( post_password_required() ) {
	return;
}
?>

<?php
  $numPingBacks = 0;
  $numComments  = 0;
  foreach ($comments as $comment)
  if (get_comment_type() != "comment") $numPingBacks++; else $numComments++;
?><!-- 引用 -->
<div id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
	<h2 class="comments-title">
		<?php
			$my_email = get_bloginfo ( 'admin_email' );
			$str = "SELECT COUNT(*) FROM $wpdb->comments WHERE comment_post_ID = $post->ID 
			AND comment_approved = '1' AND comment_type = '' AND comment_author_email";
			$count_t = $post->comment_count;
			$count_v = $wpdb->get_var("$str != '$my_email'");
			$count_h = $wpdb->get_var("$str = '$my_email'");
			echo $count_t, " 条留言&nbsp;&nbsp;访客：", $count_v, " 条&nbsp;&nbsp;博主：", $count_h, " 条 ";
		?>
		<?php if($numPingBacks>0) { ?>&nbsp;&nbsp;引用：<?php echo ' '.$numPingBacks.' 条';?><?php } ?>
	</h2>

	<ol class="comment-list">
		<?php wp_list_comments( 'type=comment&callback=mytheme_comment' ); ?>
	</ol><!-- .comment-list -->

	<?php if($numPingBacks>0) { ?>
		<div id="trackbacks">
			<h2 class="backs">来自外部的引用：<?php echo ' '.$numPingBacks.'';?> 条</h2>
			<ul class="track">
				<?php foreach ($comments as $comment) : ?>
				<?php $comment_type = get_comment_type(); ?>
				<?php if($comment_type != 'comment') { ?>
					<li><?php comment_author() ?></li>
				<?php } ?>
				<?php endforeach; ?>
	 		</ul>
		</div>
	<?php } ?>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav class="comment-navigation">
				<div class="pagination"><?php paginate_comments_links('prev_text=<i class="iconfont icon-chevronleft"></i>&next_text=<i class="iconfont icon-chevronright"></i>'); ?></div>
			</nav>
			<div class="clear"></div>
	<?php endif; // Check for comment navigation. ?>

	<?php endif; // have_comments() ?>
	<?php if ( comments_open() ) : ?>

		<div id="respond" class="comment-respond">
			<h3 id="reply-title" class="comment-reply-title">给我留言<small><?php cancel_comment_reply_link( '取消回复' ); ?></small></h3>
			
			<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
				<p><?php print '您必须'; ?><a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">  登录  </a>才能发表留言！</p>
			<?php else : ?>

			<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
				<?php if ( $user_ID ) : ?>
				<div class="user_avatar">
					<?php echo get_avatar( get_the_author_email(), '64' ); ?>
					登录者：<a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>
					<a href="<?php echo wp_logout_url(get_permalink()); ?>" title="退出"><?php print ' 退出'; ?></a>
				</div>
					<?php elseif ( '' != $comment_author ): ?>
					<div class="author_avatar">
						<?php echo get_avatar($comment_author_email, $size = '32');  ?>
						<?php printf ('欢迎 <strong>%s</strong>', $comment_author); ?> 再次光临
						<a href="javascript:toggleCommentAuthorInfo();" id="toggle-comment-author-info"> 修改信息</a>
						<script type="text/javascript" charset="utf-8">
							//<![CDATA[
							var changeMsg = " 修改信息";
							var closeMsg = " 关闭";
							function toggleCommentAuthorInfo() {
								jQuery('#comment-author-info').slideToggle('slow', function(){
									if ( jQuery('#comment-author-info').css('display') == 'none' ) {
									jQuery('#toggle-comment-author-info').text(changeMsg);
									} else {
									jQuery('#toggle-comment-author-info').text(closeMsg);
									}
								});
							}
							jQuery(document).ready(function(){
								jQuery('#comment-author-info').hide();
							});
							//]]>
						</script>
					</div>
					<?php endif; ?>

				<?php if ( ! $user_ID ): ?>
				<div id="comment-author-info">
					<p class="comment-form-author">
						<input type="text" name="author" id="author" class="commenttext" value="<?php echo $comment_author; ?>" tabindex="1" />
						<label for="author">昵称<?php if ($req) echo "（必填）"; ?></label>
					</p>
					<p class="comment-form-email">
						<input type="text" name="email" id="email" class="commenttext" value="<?php echo $comment_author_email; ?>" tabindex="2" />
						<label for="email">邮箱<?php if ($req) echo "（必填）"; ?></label>
					</p>
					<p class="comment-form-url">
						<input type="text" name="url" id="url" class="commenttext" value="<?php echo $comment_author_url; ?>" tabindex="3" />
						<label for="url">网址</label>
					</p>					
				</div>
				<div class="clear"></div>
				<?php endif; ?>

		        <p class="comment-tool">		        	
		        	<span class="smiley-box"><?php get_template_part( 'inc/smiley' ); ?></span>
		        </p>

		        <p class="comment-form-comment"><textarea id="comment" name="comment" rows="4" tabindex="4"></textarea></p>

				<p class="form-submit">
					<input id="submit" name="submit" type="submit" tabindex="5" value="提&nbsp;交"/>
					<input id="reset" name="reset" type="reset" tabindex="6" value="<?php esc_attr_e( '重&nbsp;写' ); ?>" />
					<?php comment_id_fields(); do_action('comment_form', $post->ID); ?>
				</p>
			</form>
			<script type="text/javascript">
				document.getElementById("comment").onkeydown = function (moz_ev){
				var ev = null;
				if (window.event){
				ev = window.event;
				}else{
				ev = moz_ev;
				}
				if (ev != null && ev.ctrlKey && ev.keyCode == 13){
				document.getElementById("submit").click();}
				}
			</script>
	 		<?php endif; ?>
		</div>
	<?php endif; ?>
	<?php if ( ! comments_open() ) : ?>
		<p class="no-comments">评论已关闭！</p>
	<?php endif; ?>
</div>
<!-- #comments -->