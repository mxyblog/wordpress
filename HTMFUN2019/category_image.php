<?php 
/**
* Plugin Name: 分类图像
*/
define('Z_IMAGE_PLACEHOLDER', 'https://i.loli.net/2018/11/12/5be9035ec03af.jpg'); //默认缩略图

add_action('admin_init', 'z_init');
function z_init() {
	$z_taxonomies = get_taxonomies();
	if (is_array($z_taxonomies)) {
		$zci_options = get_option('zci_options');
		if (empty($zci_options['excluded_taxonomies']))
		$zci_options['excluded_taxonomies'] = array();

		foreach ($z_taxonomies as $z_taxonomy) {
		if (in_array($z_taxonomy, $zci_options['excluded_taxonomies']))
		continue;
		add_action($z_taxonomy.'_add_form_fields', 'z_add_texonomy_field');
		add_action($z_taxonomy.'_edit_form_fields', 'z_edit_texonomy_field');
		add_filter( 'manage_edit-' . $z_taxonomy . '_columns', 'z_taxonomy_columns' );
		add_filter( 'manage_' . $z_taxonomy . '_custom_column', 'z_taxonomy_column', 10, 3 );
		}
	}
}
// add image field in add form
function z_add_texonomy_field() {
if (get_bloginfo('version') >= 3.5)
wp_enqueue_media();
else {
wp_enqueue_style('thickbox');
wp_enqueue_script('thickbox');
}

}

// 在编辑表单中添加图像字段
function z_edit_texonomy_field($taxonomy) {
if (get_bloginfo('version') >= 3.5)
wp_enqueue_media();
else {
wp_enqueue_style('thickbox');
wp_enqueue_script('thickbox');
}

if (z_taxonomy_image_url( $taxonomy->term_id, NULL, TRUE ) == Z_IMAGE_PLACEHOLDER)
$image_text = "";
else
$image_text = z_taxonomy_image_url( $taxonomy->term_id, NULL, TRUE );
echo '<tr class="form-field">
<th scope="row" valign="top"><label for="taxonomy_image">图像</label></th>
<td><input type="text" name="taxonomy_image" id="taxonomy_image" value="'.$image_text.'" />
<button class="z_upload_image_button button">上传/添加图像</button>
<button class="z_remove_image_button button">删除图像</button>
<img class="taxonomy-image" src="' . $image_text . '" width="150" height="auto"/>
</td>
</tr>'.z_script();
}
// 图片上传函数
function z_script() {
return '<script type="text/javascript">
jQuery(document).ready(function($) {
var wordpress_ver = "'.get_bloginfo("version").'", upload_button;
$(".z_upload_image_button").click(function(event) {
upload_button = $(this);
var frame;
if (wordpress_ver >= "3.5") {
event.preventDefault();
if (frame) {
frame.open();
return;
}
frame = wp.media();
frame.on( "select", function() {
// Grab the selected attachment.
var attachment = frame.state().get("selection").first();
frame.close();
if (upload_button.parent().prev().children().hasClass("tax_list")) {
upload_button.parent().prev().children().val(attachment.attributes.url);
upload_button.parent().prev().prev().children().attr("src", attachment.attributes.url);
}
else
$("#taxonomy_image").val(attachment.attributes.url);
});
frame.open();
}
else {
tb_show("", "media-upload.php?type=image&amp;TB_iframe=true");
return false;
}
});

$(".z_remove_image_button").click(function() {
$("#taxonomy_image").val("");
$(this).parent().siblings(".title").children("img").attr("src","' . Z_IMAGE_PLACEHOLDER . '");
$(".inline-edit-col :input[name=\'taxonomy_image\']").val("");
return false;
});

if (wordpress_ver < "3.5") {
window.send_to_editor = function(html) {
imgurl = $("img",html).attr("src");
if (upload_button.parent().prev().children().hasClass("tax_list")) {
upload_button.parent().prev().children().val(imgurl);
upload_button.parent().prev().prev().children().attr("src", imgurl);
}
else
$("#taxonomy_image").val(imgurl);
tb_remove();
}
}

$(".editinline").live("click", function(){
var tax_id = $(this).parents("tr").attr("id").substr(4);
var thumb = $("#tag-"+tax_id+" .thumb img").attr("src");
if (thumb != "' . Z_IMAGE_PLACEHOLDER . '") {
$(".inline-edit-col :input[name=\'taxonomy_image\']").val(thumb);
} else {
$(".inline-edit-col :input[name=\'taxonomy_image\']").val("");
}
$(".inline-edit-col .title img").attr("src",thumb);
return false;
});
});
</script>';
}

// 保存分类图像，同时编辑或保存期限
add_action('edit_term','z_save_taxonomy_image');
add_action('create_term','z_save_taxonomy_image');
function z_save_taxonomy_image($term_id) {
if(isset($_POST['taxonomy_image']))
update_option('z_taxonomy_image'.$term_id, $_POST['taxonomy_image']);
}

// 通过图片网址获取附件
function z_get_attachment_id_by_url($image_src) {
global $wpdb;
$query = "SELECT ID FROM {$wpdb->posts} WHERE guid = '$image_src'";
$id = $wpdb->get_var($query);
return (!empty($id)) ? $id : NULL;
}

// 对于给定的term_id得到分类图像的URL（默认占位符图像）
function z_taxonomy_image_url($term_id = NULL, $size = NULL, $return_placeholder = FALSE) {
if (!$term_id) {
if (is_category())
$term_id = get_query_var('cat');
elseif (is_tax()) {
$current_term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
$term_id = $current_term->term_id;
}
}

$taxonomy_image_url = get_option('z_taxonomy_image'.$term_id);
if(!empty($taxonomy_image_url)) {
$attachment_id = z_get_attachment_id_by_url($taxonomy_image_url);
if(!empty($attachment_id)) {
if (empty($size))
$size = 'full';
$taxonomy_image_url = wp_get_attachment_image_src($attachment_id, $size);
$taxonomy_image_url = $taxonomy_image_url[0];
}
}

if ($return_placeholder)
return ($taxonomy_image_url != '') ? $taxonomy_image_url : Z_IMAGE_PLACEHOLDER;
else
return $taxonomy_image_url;
}

function z_quick_edit_custom_box($column_name, $screen, $name) {
if ($column_name == 'thumb')
echo '<fieldset>
<div class="thumb inline-edit-col">
<label>
<span class="title"><img src="" alt="Thumbnail"/></span>
<span class="input-text-wrap"><input type="text" name="taxonomy_image" value="" class="tax_list" /></span>
<span class="input-text-wrap">
<button class="z_upload_image_button button">上传/添加图像</button>
<button class="z_remove_image_button button">删除图像</button>
</span>
</label>
</div>
</fieldset>';
}

// 缩略图列添加到类别管理
function z_taxonomy_columns( $columns ) {
$new_columns = array();
$new_columns['cb'] = $columns['cb'];
$new_columns['thumb'] = '图像';
unset( $columns['cb'] );
return array_merge( $new_columns, $columns );
}

// 缩略图列值添加到类别管理。
function z_taxonomy_column( $columns, $column, $id ) {
if ( $column == 'thumb' )
$columns = '<span><img src="' . z_taxonomy_image_url($id, NULL, TRUE) . '" alt="Thumbnail" class="wp-post-image"/></span>';
return $columns;
}

// “更改”插入“使用该图像”
function z_change_insert_button_text($safe_text, $text) {
return str_replace("Insert into Post", "Use this image", $text);
}

// 在类别列表中的图像
if ( strpos( $_SERVER['SCRIPT_NAME'], 'edit-tags.php' ) > 0 ) {
add_action( 'admin_head', 'z_add_style' );
add_action('quick_edit_custom_box', 'z_quick_edit_custom_box', 10, 3);
add_filter("attribute_escape", "z_change_insert_button_text", 10, 2);
}

// 注册插件设置
function z_register_settings() {
register_setting('zci_options', 'zci_options', 'z_options_validate');
add_settings_section('zci_settings', '', 'z_section_text', 'zci-options');
add_settings_field('z_excluded_taxonomies', '排除的分类','z_excluded_taxonomies', 'zci-options', 'zci_settings');
}
function z_add_style() {
echo '<style type="text/css" media="screen">
th.column-thumb {width:60px;}
.form-field #taxonomy_image {border:1px solid #eee;width:200px; margin-left:30px;}
.inline-edit-row fieldset .thumb label span.title {width:48px;height:48px;border:1px solid #eee;display:inline-block;}
.column-thumb span {width:48px;height:48px;border:1px solid #eee;display:inline-block;}
.inline-edit-row fieldset .thumb img,.column-thumb img {width:48px;height:48px;}
label{ font-weight:800; font-size:16px;}
.taxonomy-image {border:1px solid #eee;width:auto !important;height:60px; margin-bottom:-40px; }
#taxonomy_image{ margin-left:180px; }
#taxonomy_image,.z_upload_image_button,.z_remove_image_button{vertical-align:bottom !important;}
</style>';
}