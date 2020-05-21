<?php
//自动加载
function ajax_scroll_js() {
if ( !is_singular() && !is_paged() ) { ?>
<script type="text/javascript">var ias=$.ias({container:"#primary",item:"article",pagination:"#nav-below",next:"#nav-below .nav-previous a",});ias.extension(new IASTriggerExtension({text:'<i class="iconfont icon-chevrondoubledown"></i>更多',offset:<?php echo md_get_option('scroll_n');?>,}));ias.extension(new IASSpinnerExtension());ias.extension(new IASNoneLeftExtension({text:'已是最后',}));</script>
<?php }
}
if (md_get_option('scroll')) {
	add_action('wp_footer', 'ajax_scroll_js', 100);
}

// 后台美化
function admin_style(){
	echo'<style type="text/css">body{ font-family: Microsoft YaHei;}#activity-widget #the-comment-list .avatar {width: 48px;height: 48px;}.show-id {float: left;color: #999;width: 50%;margin: 0;padding: 3px 0;}.clear {clear: both;margin: 0 0 8px 0}</style>';
}
add_action('admin_head', 'admin_style');

//	自定义登录页面
function custom_login_head(){
echo'<style type="text/css">
body{
	background: #f1f1f1;
	font-family: "Microsoft YaHei", Helvetica, Arial, Lucida Grande, Tahoma, sans-serif;
	width:100%;
	height:100%;
}
.login h1 a {
	background:url('.get_bloginfo('template_directory').'/img/login.png) no-repeat 0 0 transparent;
	padding: 0;
	margin: 0 auto 1em;
}
.login form, .login .message {
	background: #fff;
	background: rgba(255, 255, 255, 0.6);
	border-radius: 2px;
	border: 1px solid #ddd;
	box-shadow: 0 1px 1px rgba(0, 0, 0, 0.5);
}
.login label {
	color: #444;
}
.login .message {
	color: #444;
}
#backtoblog a, #nav a {
	color: #444 !important;
}
</style>';
}
add_action('login_head', 'custom_login_head');

//	自定义登录页面的LOGO链接为首页链接
add_filter('login_headerurl', create_function(false,"return get_bloginfo('url');"));


// 自定义背景
function head_css(){
	back_img();
}
function back_img(){
	if (md_get_option("back-img-show")) {
		$img = substr(md_get_option("back-img"), 0);
		echo "<style>body{background:url(" . $img . ")}</style>";		
    }
}
add_action('wp_head', 'head_css');	

/* WordPress文字标签关键词自动内链 */
$match_num_from = 1;		//一篇文章中同一個少于几次不自动链接
$match_num_to = 2;		//一篇文章中同一個标签最多自动链接次数
function tag_sort($a, $b){
	if ( $a->name == $b->name ) return 0;
	return ( strlen($a->name) > strlen($b->name) ) ? -1 : 1;
}
function tin_tag_link($content){
	global $match_num_from,$match_num_to;
		$posttags = get_the_tags();
		if ($posttags) {
			usort($posttags, "tag_sort");
			$ex_word = '';
			$case = '';
			foreach($posttags as $tag) {
				$link = get_tag_link($tag->term_id);
				$keyword = $tag->name;
				$cleankeyword = stripslashes($keyword);
				$url = "<a href=\"$link\"  title=\"".str_replace('%s',addcslashes($cleankeyword, '$'),__('查看更多关于 %s 的文章'))."\"";
				$url .= ' target="_blank"';
				$url .= ">".addcslashes($cleankeyword, '$')."</a>";
				$limit = rand($match_num_from,$match_num_to);
				$content = preg_replace( '|(<a[^>]+>)(.*)<pre.*?>('.$ex_word.')(.*)<\/pre>(</a[^>]*>)|U'.$case, '$1$2$4$5', $content);
				$content = preg_replace( '|(<img)(.*?)('.$ex_word.')(.*?)(>)|U'.$case, '$1$2$4$5', $content);
				$cleankeyword = preg_quote($cleankeyword,'\'');
				$regEx = '\'(?!((<.*?)|(<a.*?)))('. $cleankeyword . ')(?!(([^<>]*?)>)|([^>]*?</a>))\'s' . $case;
				$content = preg_replace($regEx,$url,$content,$limit);
				$content = str_replace( '', stripslashes($ex_word), $content);
			}
		}
	return $content;
}
add_filter('the_content','tin_tag_link',12);

if (md_get_option('baidu_submit')) {
// 主动推送
if(!function_exists('Baidu_Submit')){
    function Baidu_Submit($post_ID) {
        $WEB_DOMAIN = get_option('home');
        if(get_post_meta($post_ID,'Baidusubmit',true) == 1) return;
        $url = get_permalink($post_ID);
        $api = 'http://data.zz.baidu.com/urls?site='.$WEB_DOMAIN.'&token='.md_get_option('baidu_token');
        $request = new WP_Http;
        $result = $request->request( $api , array( 'method' => 'POST', 'body' => $url , 'headers' => 'Content-Type: text/plain') );
        $result = json_decode($result['body'],true);
        if (array_key_exists('success',$result)) {
            add_post_meta($post_ID, 'Baidusubmit', 1, true);
        }
    }
    add_action('publish_post', 'Baidu_Submit', 0);
}
}

//点击最多文章
function get_timespan_most_viewed($mode = '', $limit = 10, $days = 7, $display = true) {
	global $wpdb, $post;
	$limit_date = current_time('timestamp') - ($days*86400);
	$limit_date = date("Y-m-d H:i:s",$limit_date);	
	$where = '';
	$temp = '';
	if(!empty($mode) && $mode != 'both') {
		$where = "post_type = '$mode'";
	} else {
		$where = '1=1';
	}
	$most_viewed = $wpdb->get_results("SELECT $wpdb->posts.*, (meta_value+0) AS views FROM $wpdb->posts LEFT JOIN $wpdb->postmeta ON $wpdb->postmeta.post_id = $wpdb->posts.ID WHERE post_date < '".current_time('mysql')."' AND post_date > '".$limit_date."' AND $where AND post_status = 'publish' AND meta_key = 'views' AND post_password = '' ORDER  BY views DESC LIMIT $limit");
	if($most_viewed) {
		$i = 1;
		foreach ($most_viewed as $post) {
			$post_title =  get_the_title();
			$post_views = intval($post->views);
			$post_views = number_format($post_views);
			$temp .= "<li><span class='li-icon li-icon-$i'>$i</span><a href=\"".get_permalink()."\">$post_title</a></li>";
			$i++;
		}
	} else {
		$temp = '<li>暂无文章</li>';
	}
	if($display) {
		echo $temp;
	} else {
		return $temp;
	}
}

//点赞
function md_like(){
    global $wpdb,$post;
    $id = $_POST["um_id"];
    $action = $_POST["um_action"];
    if ( $action == 'ding'){
        $specs_raters = get_post_meta($id,'md_like',true);
        $expire = time() + 99999999;
        $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false; // make cookies work with localhost
        setcookie('md_like_'.$id,$id,$expire,'/',$domain,false);
        if (!$specs_raters || !is_numeric($specs_raters)) {
            update_post_meta($id, 'md_like', 1);
        } 
        else {
            update_post_meta($id, 'md_like', ($specs_raters + 1));
        }
        echo get_post_meta($id,'md_like',true);
    } 
    die;
}
add_action('wp_ajax_nopriv_md_like', 'md_like');
add_action('wp_ajax_md_like', 'md_like');

//点赞最多文章
function get_like_most($mode = '', $limit = 10, $days = 7, $display = true) {
	global $wpdb, $post;
	$limit_date = current_time('timestamp') - ($days*86400);
	$limit_date = date("Y-m-d H:i:s",$limit_date);	
	$where = '';
	$temp = '';
	if(!empty($mode) && $mode != 'both') {
		$where = "post_type = '$mode'";
	} else {
		$where = '1=1';
	}
	$most_viewed = $wpdb->get_results("SELECT $wpdb->posts.*, (meta_value+0) AS md_like FROM $wpdb->posts LEFT JOIN $wpdb->postmeta ON $wpdb->postmeta.post_id = $wpdb->posts.ID WHERE post_date < '".current_time('mysql')."' AND post_date > '".$limit_date."' AND $where AND post_status = 'publish' AND meta_key = 'md_like' AND post_password = '' ORDER  BY md_like DESC LIMIT $limit");
	if($most_viewed) {
		$i = 1;
		foreach ($most_viewed as $post) {
			$post_title = get_the_title();
			$post_like = intval($post->like);
			$post_like = number_format($post_like);
			$temp .= "<li><span class='li-icon li-icon-$i'>$i</span><a href=\"".get_permalink()."\">$post_title</a></li>";
			$i++;
		}
	} else {
		$temp = '<li>暂无文章</li>';
	}
	if($display) {
		echo $temp;
	} else {
		return $temp;
	}
}

// 文章归档
function md_archives_list() {
	if( !$output = get_option('md_db_cache_archives_list') ){
		$output = '<div id="archives"><p><a id="expand_collapse" href="#">全部展开/收缩</a> <em>(注: 点击月份可以展开)</em></p>';
		$args = array(
			'post_type' => 'post', //如果你有多个 post type，可以这样 array('post', 'product', 'news')  
			'posts_per_page' => -1, //全部 posts
			'ignore_sticky_posts' => 1 //忽略 sticky posts

		);
		$the_query = new WP_Query( $args );
		$posts_rebuild = array();
		$year = $mon = 0;
		while ( $the_query->have_posts() ) : $the_query->the_post();
			$post_year = get_the_time('Y');
			$post_mon = get_the_time('m');
			$post_day = get_the_time('d');
			if ($year != $post_year) $year = $post_year;
			if ($mon != $post_mon) $mon = $post_mon;
			$posts_rebuild[$year][$mon][] = '<li>'. get_the_time('d日: ') .'<a href="'. get_permalink() .'">'. get_the_title() .'</a> <em>('. get_comments_number('0', '1', '%') .')</em></li>';
		endwhile;
		wp_reset_postdata();

		foreach ($posts_rebuild as $key_y => $y) {
			$output .= '<h3 class="year">'. $key_y .' 年</h3><ul class="mon_list">'; //输出年份
			foreach ($y as $key_m => $m) {
				$posts = ''; $i = 0;
				foreach ($m as $p) {
					++$i;
					$posts .= $p;
				}
				$output .= '<li><span class="mon">'. $key_m .' 月 <em> ( '. $i .' 篇文章 )</em></span><ul class="post_list">'; //输出月份
				$output .= $posts; //输出 posts
				$output .= '</ul></li>';
			}
			$output .= '</ul>';
		}

		$output .= '</div>';
		update_option('md_db_cache_archives_list', $output);
	}
	echo $output;
}
function clear_db_cache_archives_list() {
	update_option('md_db_cache_archives_list', ''); // 清空 zww_archives_list
}
add_action('save_post', 'clear_db_cache_archives_list');

// 分类添加SEO字段
function add_category_field(){
	echo '<div class="form-field">
            <label for="cat-title">分类标题</label>
            <input name="cat-title" id="cat-title" type="text" value="" size="40">
            <p>用于SEO自定义标题</p>
          </div>';

	echo '<div class="form-field">
			<label for="cat-words">分类关键字</label>
            <input name="cat-words" id="cat-words" type="text" value="" size="40">
            <p>用于SEO自定义关键字</p>
          </div>';
}
add_action('category_add_form_fields','add_category_field',10,2);
  
// 分类编辑SEO字段
function edit_category_field($tag){
    echo '<tr class="form-field">
            <th scope="row"><label for="cat-title">分类标题</label></th>
            <td>
                <input name="cat-title" id="cat-title" type="text" value="';
                echo get_option('cat-title-'.$tag->term_id).'" size="40"/><br>
                <span class="cat-title">用于'.$tag->name.'分类SEO自定义标题</span>
            </td>
        </tr>';

    echo '<tr class="form-field">
            <th scope="row"><label for="cat-words">分类关键字</label></th>
            <td>
                <input name="cat-words" id="cat-words" type="text" value="';
                echo get_option('cat-words-'.$tag->term_id).'" size="40"/><br>
                <span class="cat-words">用于'.$tag->name.'分类SEO自定义关键字</span>
            </td>
        </tr>';
}
add_action('category_edit_form_fields','edit_category_field',10,2);

// 保存数据SEO
function taxonomy_metadate($term_id){
    if(isset($_POST['cat-title']) && isset($_POST['cat-words'])){
        //判断权限--可改
        if(!current_user_can('manage_categories')){
            return $term_id;
        }
        // 标题
        $title_key = 'cat-title-'.$term_id; // key
        $title_value = $_POST['cat-title']; // value

        // 关键字
        $words_key = 'cat-words-'.$term_id;
        $words_value = $_POST['cat-words'];

        // 更新选项值
        update_option( $title_key, $title_value );
        update_option( $words_key, $words_value );
    }
}

add_action('created_category','taxonomy_metadate',10,1);
add_action('edited_category','taxonomy_metadate',10,1);

?>