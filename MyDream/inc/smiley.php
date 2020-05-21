<script type="text/javascript">
/* <![CDATA[ */
    function grin(tag) {
    	var myField;
    	tag = ' ' + tag + ' ';
        if (document.getElementById('comment') && document.getElementById('comment').type == 'textarea') {
    		myField = document.getElementById('comment');
    	} else {
    		return false;
    	}
    	if (document.selection) {
    		myField.focus();
    		sel = document.selection.createRange();
    		sel.text = tag;
    		myField.focus();
    	}
    	else if (myField.selectionStart || myField.selectionStart == '0') {
    		var startPos = myField.selectionStart;
    		var endPos = myField.selectionEnd;
    		var cursorPos = endPos;
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
/* ]]> */
</script>

<a href="javascript:grin(':?:')"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/smilies/icon_question.gif" alt=":?:" title="疑问" /></a>
<a href="javascript:grin(':razz:')"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/smilies/icon_razz.gif" alt=":razz:" title="调皮" /></a>
<a href="javascript:grin(':sad:')"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/smilies/icon_sad.gif" alt=":sad:" title="难过" /></a>
<a href="javascript:grin(':evil:')"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/smilies/icon_evil.gif" alt=":evil:" title="抠鼻" /></a>
<a href="javascript:grin(':!:')"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/smilies/icon_exclaim.gif" alt=":!:" title="吓" /></a>
<a href="javascript:grin(':smile:')"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/smilies/icon_smile.gif" alt=":smile:" title="微笑" /></a>
<a href="javascript:grin(':oops:')"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/smilies/icon_redface.gif" alt=":oops:" title="憨笑" /></a>
<a href="javascript:grin(':grin:')"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/smilies/icon_biggrin.gif" alt=":grin:" title="坏笑" /></a>
<a href="javascript:grin(':eek:')"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/smilies/icon_surprised.gif" alt=":eek:" title="惊讶" /></a>
<a href="javascript:grin(':shock:')"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/smilies/icon_eek.gif" alt=":shock:" title="发呆" /></a>
<a href="javascript:grin(':???:')"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/smilies/icon_confused.gif" alt=":???:" title="撇嘴" /></a>
<a href="javascript:grin(':cool:')"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/smilies/icon_cool.gif" alt=":cool:" title="大兵" /></a>
<a href="javascript:grin(':lol:')"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/smilies/icon_lol.gif" alt=":lol:" title="偷笑" /></a>
<a href="javascript:grin(':mad:')"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/smilies/icon_mad.gif" alt=":mad:" title="咒骂" /></a>
<a href="javascript:grin(':twisted:')"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/smilies/icon_twisted.gif" alt=":twisted:" title="发怒" /></a>
<a href="javascript:grin(':roll:')"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/smilies/icon_rolleyes.gif" alt=":roll:" title="白眼" /></a>
<a href="javascript:grin(':wink:')"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/smilies/icon_wink.gif" alt=":wink:" title="鼓掌" /></a>
<a href="javascript:grin(':idea:')"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/smilies/icon_idea.gif" alt=":idea:" title="酷" /></a>
<a href="javascript:grin(':arrow:')"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/smilies/icon_arrow.gif" alt=":arrow:" title="擦汗" /></a>
<a href="javascript:grin(':neutral:')"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/smilies/icon_neutral.gif" alt=":neutral:" title="亲亲" /></a>
<a href="javascript:grin(':cry:')"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/smilies/icon_cry.gif" alt=":cry:" title="大哭" /></a>
<a href="javascript:grin(':mrgreen:')"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/smilies/icon_mrgreen.gif" alt=":mrgreen:" title="呲牙" /></a>
<br />