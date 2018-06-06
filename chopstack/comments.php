<?php
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area clearfix">
	<?php if ( have_comments() ) : ?>
		<h4 class="comments-title">
			<span><?php comments_number( esc_html__( '没有评论', 'chopstack' ), esc_html__( '1 条评论', 'chopstack' ), esc_html__( '% 条评论', 'chopstack' ) ); ?></span>
		</h4>

		<ol class="comment-list">
			<?php
			wp_list_comments( array(
				'style'       => 'ol',
				'short_ping'  => true,
				'avatar_size' => 36,
			) );
			?>
		</ol><!-- 评论列表 -->

		<?php
		the_comments_navigation( array(
			'prev_text' => '' . esc_html__( '先前评论 »', 'chopstack' ),
			'next_text' => esc_html__( '« 较新评论', 'chopstack' ) . '',
		) );
		?>
	<?php endif; ?>

	<?php
	// 如果评论是关闭的，让我们留下一点说明。
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments"><?php esc_html_e( '评论已经被关闭。', 'chopstack' ); ?></p>
	<?php endif;?>

	<?php
		$args =  array(
		'comment_field'=> '<p class="comment-smilies"/>
		<a href="javascript:grin(\':?:\')"      ><img class="wp-smiley" src="'.get_template_directory_uri().'/static/smilies/icon_question.gif"  alt="" /></a>
		<a href="javascript:grin(\':razz:\')"   ><img class="wp-smiley" src="'.get_template_directory_uri().'/static/smilies/icon_razz.gif"      alt="" /></a>
		<a href="javascript:grin(\':sad:\')"    ><img class="wp-smiley" src="'.get_template_directory_uri().'/static/smilies/icon_sad.gif"       alt="" /></a>
		<a href="javascript:grin(\':evil:\')"   ><img class="wp-smiley" src="'.get_template_directory_uri().'/static/smilies/icon_evil.gif"      alt="" /></a>
		<a href="javascript:grin(\':!:\')"      ><img class="wp-smiley" src="'.get_template_directory_uri().'/static/smilies/icon_exclaim.gif"   alt="" /></a>
		<a href="javascript:grin(\':smile:\')"  ><img class="wp-smiley" src="'.get_template_directory_uri().'/static/smilies/icon_smile.gif"     alt="" /></a>
		<a href="javascript:grin(\':oops:\')"   ><img class="wp-smiley" src="'.get_template_directory_uri().'/static/smilies/icon_redface.gif"   alt="" /></a>
		<a href="javascript:grin(\':grin:\')"   ><img class="wp-smiley" src="'.get_template_directory_uri().'/static/smilies/icon_biggrin.gif"   alt="" /></a>
		<a href="javascript:grin(\':eek:\')"    ><img class="wp-smiley" src="'.get_template_directory_uri().'/static/smilies/icon_surprised.gif" alt="" /></a>
		<a href="javascript:grin(\':shock:\')"  ><img class="wp-smiley" src="'.get_template_directory_uri().'/static/smilies/icon_eek.gif"       alt="" /></a>
		<a href="javascript:grin(\':???:\')"    ><img class="wp-smiley" src="'.get_template_directory_uri().'/static/smilies/icon_confused.gif"  alt="" /></a>
		<a href="javascript:grin(\':cool:\')"   ><img class="wp-smiley" src="'.get_template_directory_uri().'/static/smilies/icon_cool.gif"      alt="" /></a>
		<a href="javascript:grin(\':lol:\')"    ><img class="wp-smiley" src="'.get_template_directory_uri().'/static/smilies/icon_lol.gif"       alt="" /></a>
		<a href="javascript:grin(\':mad:\')"    ><img class="wp-smiley" src="'.get_template_directory_uri().'/static/smilies/icon_mad.gif"       alt="" /></a>
		<a href="javascript:grin(\':twisted:\')"><img class="wp-smiley" src="'.get_template_directory_uri().'/static/smilies/icon_twisted.gif"   alt="" /></a>
		<a href="javascript:grin(\':roll:\')"   ><img class="wp-smiley" src="'.get_template_directory_uri().'/static/smilies/icon_rolleyes.gif"  alt="" /></a>
		<a href="javascript:grin(\':wink:\')"   ><img class="wp-smiley" src="'.get_template_directory_uri().'/static/smilies/icon_wink.gif"      alt="" /></a>
		<a href="javascript:grin(\':idea:\')"   ><img class="wp-smiley" src="'.get_template_directory_uri().'/static/smilies/icon_idea.gif"      alt="" /></a>
		<a href="javascript:grin(\':arrow:\')"  ><img class="wp-smiley" src="'.get_template_directory_uri().'/static/smilies/icon_arrow.gif"     alt="" /></a>
		<a href="javascript:grin(\':neutral:\')"><img class="wp-smiley" src="'.get_template_directory_uri().'/static/smilies/icon_neutral.gif"   alt="" /></a>
		<a href="javascript:grin(\':cry:\')"    ><img class="wp-smiley" src="'.get_template_directory_uri().'/static/smilies/icon_cry.gif"       alt="" /></a>
		<a href="javascript:grin(\':mrgreen:\')"><img class="wp-smiley" src="'.get_template_directory_uri().'/static/smilies/icon_mrgreen.gif"   alt="" /></a>
		</p>
		<textarea id="comment" name="comment"></textarea>
		<div class="comment-button">
		<label class="chopstack-checkbox-label"><input class="chopstack-checkbox-radio" type="checkbox" name="no-robot"><span class="chopstack-no-robot-checkbox chopstack-checkbox-radioInput"></span>点击以证明你不是机器人！</label>
		</div>',
		'label_submit'=> '发表评论',
		);
		comment_form($args);
	?>

		<!--wp-compress-html--><!--wp-compress-html no compression-->
		<!-- 自定义表情添加入文本框js -->
		<script type="text/javascript">
		    function grin(tag) {
		      if (document.getElementById('comment') && document.getElementById('comment').type == 'textarea') {
		        myField = document.getElementById('comment');
		      } else {
		        return false;
		      }
		      tag = ' ' + tag + ' ';
		      if (document.selection) {
		        myField.focus();
		        sel = document.selection.createRange();
		        sel.text = tag;
		        myField.focus();
		      }
		      else if (myField.selectionStart || myField.selectionStart == '0') {
		        startPos = myField.selectionStart
		        endPos = myField.selectionEnd;
		        cursorPos = startPos;
		        myField.value = myField.value.substring(0, startPos)
		                      + tag
		                      + myField.value.substring(endPos, myField.value.length);
		        cursorPos += tag.length;
		        myField.focus();
		        myField.selectionStart = cursorPos;
		        myField.selectionEnd = cursorPos;
		      }
		      else {
		        myField.value += tag;
		        myField.focus();
		      }
		    }
		</script>
		<!--wp-compress-html no compression--><!--wp-compress-html-->

</div><!-- #comments -->