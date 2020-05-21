<?php
// 最新文章
class new_post extends WP_Widget {
	function __construct(){
		parent::__construct(false,'主题 | 最新文章',array( 'description' => '最新文章，也可以是某个分类的最新文章' ,'classname' => 'new_post'));
	}	

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $before_widget;
		if ( ! empty( $title ) )
		echo $before_title . $title . $after_title; 
?>

<div class="post_cat">
	<ul>
		<?php $q = 'showposts='.$instance['numposts']; if (!empty($instance['cat'])) $q .= '&cat='.$instance['cat']; query_posts($q); while (have_posts()) : the_post(); ?>
			<?php the_title( sprintf( '<li class="cat-title"><i class="iconfont icon-chevronright"></i><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></li>' ); ?>
		<?php endwhile; ?>
		<?php wp_reset_query(); ?>
	</ul>
	<div class="clear"></div>
</div>

<?php
	echo $after_widget;
}

function update( $new_instance, $old_instance ) {
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
	$instance['numposts'] = $new_instance['numposts'];
	$instance['cat'] = $new_instance['cat'];
	return $instance;
}

function form( $instance ) {
	$instance = wp_parse_args( (array) $instance, array( 
		'title' => '最新文章',
		'numposts' => 5,
		'cat' => 0)); ?> 

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">标题：</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('numposts'); ?>">显示篇数：</label> 
			<input id="<?php echo $this->get_field_id('numposts'); ?>" name="<?php echo $this->get_field_name('numposts'); ?>" type="text" value="<?php echo $instance['numposts']; ?>" size="3" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('cat'); ?>">选择分类：
			<?php wp_dropdown_categories(array('name' => $this->get_field_name('cat'), 'show_option_all' => 全部分类, 'hide_empty'=>0, 'hierarchical'=>1, 'selected'=>$instance['cat'])); ?></label>
		</p>
<?php }
}
add_action( 'widgets_init', create_function( '', 'register_widget( "new_post" );' ) );

// 分类文章（图片）
class img_cat extends WP_Widget {
	
	function __construct(){
		parent::__construct(false,'主题 | 分类图片',array( 'description' => '以图片形式调用一个分类的文章' ,'classname' => 'img_cat'));
	}	

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $before_widget;
		if ( ! empty( $title ) )
		echo $before_title . $title . $after_title; 
?>

<div class="img_cat">
	<ul>
	
	<?php
		$posts = new WP_Query( array(
			'showposts'				=> $instance['numposts'],
			'ignore_sticky_posts' 	=> 1,
			'cat'					=> $instance['cat'],
			'orderby'				=> $instance['posts_orderby'],
		) );
	?>
	<?php while ($posts->have_posts()): $posts->the_post(); ?>	
		
		<div class="img-box">
			<div class="img-x2">
				<figure class="insets">					
					<?php  get_thumbnail(300,180);  ?>
					<?php the_title( sprintf( '<div class="img-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></div>' ); ?>
				</figure>
			</div>
		
		</div>
		<?php endwhile;?>
		<?php wp_reset_query(); ?>
		<div class="clear"></div>
	</ul>
</div>

<?php
	echo $after_widget;
}

function update( $new_instance, $old_instance ) {
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
	$instance['numposts'] = $new_instance['numposts'];
	$instance['cat'] = $new_instance['cat'];
	$instance['posts_orderby'] = strip_tags($new_instance['posts_orderby']);;
	return $instance;
}

function form( $instance ) {
	$instance = wp_parse_args( (array) $instance, array( 
		'title' => '分类图片',
		'numposts' => 6,
		'posts_orderby' => 'rand',
		'cat' => 0)); ?> 

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">标题：</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('numposts'); ?>">显示篇数：</label> 
			<input id="<?php echo $this->get_field_id('numposts'); ?>" name="<?php echo $this->get_field_name('numposts'); ?>" type="text" value="<?php echo $instance['numposts']; ?>" size="3" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('cat'); ?>">选择分类：
			<?php wp_dropdown_categories(array('name' => $this->get_field_name('cat'), 'show_option_all' => 全部分类, 'hide_empty'=>0, 'hierarchical'=>1, 'selected'=>$instance['cat'])); ?></label>
		</p>
		<p>
			<label  for="<?php echo $this->get_field_id("posts_orderby"); ?>">排序：</label>
			<select  id="<?php echo $this->get_field_id("posts_orderby"); ?>" name="<?php echo $this->get_field_name("posts_orderby"); ?>">
			  <option value="date"<?php selected( $instance["posts_orderby"], "date" ); ?>>日期最新</option>
			  <option value="comment_count"<?php selected( $instance["posts_orderby"], "comment_count" ); ?>>最多评论</option>
			  <option value="rand"<?php selected( $instance["posts_orderby"], "rand" ); ?>>随机排序</option>
			</select>	
		</p>
<?php }
}

add_action( 'widgets_init', create_function( '', 'register_widget( "img_cat" );' ) );

// 近期留言
class recent_comments extends WP_Widget {
	function __construct(){
			parent::__construct(false,'主题 | 近期留言',array( 'description' => '带头像的近期留言' ,'classname' => 'recent_comments'));
	}		 
     function widget($args, $instance) {
		extract($args);
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $before_widget;
		if ( ! empty( $title ) )
		echo $before_title . $title . $after_title;
		$number = strip_tags($instance['number']) ? absint( $instance['number'] ) : 5;
?>

<div id="message" class="message-widget">
	<ul>
		<?php
		$show_comments = $number;
		$my_email = get_bloginfo ('admin_email');
		$i = 1;
		$comments = get_comments('number=200&status=approve&type=comment');
		foreach ($comments as $my_comment) {
			if ($my_comment->comment_author_email != $my_email) {
				?>
				<li>
					<a href="<?php echo get_permalink($my_comment->comment_post_ID); ?>#comment-<?php echo $my_comment->comment_ID; ?>" title="<?php echo get_the_title($my_comment->comment_post_ID); ?>" >
						<?php echo get_avatar($my_comment->comment_author_email,64); ?>
						<span class="comment_author"><strong><?php echo $my_comment->comment_author; ?></strong></span>
						<?php echo convert_smilies($my_comment->comment_content); ?>
					</a>
				</li>
				<?php
				if ($i == $show_comments) break;
				$i++;
			}
		}
		?>
	</ul>
</div>

<?php
	echo $after_widget;
	}
	function update( $new_instance, $old_instance ) {
		if (!isset($new_instance['submit'])) {
			return false;
		}
			$instance = $old_instance;
			$instance = array();
			$instance['title'] = strip_tags( $new_instance['title'] );
			$instance['number'] = strip_tags($new_instance['number']);
			return $instance;
		}
	function form($instance) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = '近期评论';
		}
		global $wpdb;
		$instance = wp_parse_args((array) $instance, array('number' => '5'));
		$number = strip_tags($instance['number']);
?>
	<p><label for="<?php echo $this->get_field_id( 'title' ); ?>">标题：</label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
	<p><label for="<?php echo $this->get_field_id('number'); ?>">显示数量：</label>
	<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
	<input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
<?php }
}
add_action( 'widgets_init', create_function( '', 'register_widget( "recent_comments" );' ) );

// 热门文章
class hot_post extends WP_Widget {
	function __construct(){
			parent::__construct(false,'主题 | 热门文章',array( 'description' => '调用点击最多的文章，必须安装 wp-postviews 插件,并有统计数据' ,'classname' => 'hot_post'));
	}
     function widget($args, $instance) {
		extract($args);
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $before_widget;
		if ( ! empty( $title ) )
		echo $before_title . $title . $after_title;
		$number = strip_tags($instance['number']) ? absint( $instance['number'] ) : 5;
		$days = strip_tags($instance['days']) ? absint( $instance['days'] ) : 90;
?>

<div id="hot_post_widget">
	<ul>
	    <?php if (function_exists('get_most_viewed')): ?> 
	    <?php get_timespan_most_viewed('post', $number, $days, true, true); ?>
	    <?php endif; ?>
		<?php wp_reset_query(); ?>
	</ul>
</div>

<?php
	echo $after_widget;
	}
	function update( $new_instance, $old_instance ) {
		if (!isset($new_instance['submit'])) {
			return false;
		}
			$instance = $old_instance;
			$instance = array();
			$instance['title'] = strip_tags( $new_instance['title'] );
			$instance['number'] = strip_tags($new_instance['number']);
			$instance['days'] = strip_tags($new_instance['days']);
			return $instance;
		}
	function form($instance) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = '热门文章';
		}
		global $wpdb;
		$instance = wp_parse_args((array) $instance, array('number' => '5'));
		$instance = wp_parse_args((array) $instance, array('days' => '90'));
		$number = strip_tags($instance['number']);
		$days = strip_tags($instance['days']);
 ?>
	<p><label for="<?php echo $this->get_field_id( 'title' ); ?>">标题：</label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
	<p><label for="<?php echo $this->get_field_id('number'); ?>">显示数量：</label>
	<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
	<p><label for="<?php echo $this->get_field_id('days'); ?>">时间限定（天）：</label>
	<input id="<?php echo $this->get_field_id( 'days' ); ?>" name="<?php echo $this->get_field_name( 'days' ); ?>" type="text" value="<?php echo $days; ?>" size="3" /></p>
	<input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
<?php }
}
add_action( 'widgets_init', create_function( '', 'register_widget( "hot_post" );' ) );

// 热评文章
class hot_comment extends WP_Widget {
	function __construct(){
			parent::__construct(false,'主题 | 热评文章',array( 'description' => '调用评论最多的文章' ,'classname' => 'hot_comment'));
	}
     function widget($args, $instance) {
		extract($args);
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $before_widget;
		if ( ! empty( $title ) )
		echo $before_title . $title . $after_title;
		$number = strip_tags($instance['number']) ? absint( $instance['number'] ) : 5;
		$days = strip_tags($instance['days']) ? absint( $instance['days'] ) : 90;
?>

<?php
function hot_comment_viewed($number, $days){
    global $wpdb;
    $sql = "SELECT ID , post_title , comment_count
           FROM $wpdb->posts
           WHERE post_type = 'post' AND post_status = 'publish' AND TO_DAYS(now()) - TO_DAYS(post_date) < $days
           ORDER BY comment_count DESC LIMIT 0 , $number ";
    $posts = $wpdb->get_results($sql);
	$i = 1;
    $output = "";
    foreach ($posts as $post){
        $output .= "\n<li><span class='li-icon li-icon-$i'>$i</span><a href= \"".get_permalink($post->ID)."\" rel=\"bookmark\" title=\" (".$post->comment_count."条评论)\" >".$post->post_title."</a></li>";
		$i++;
    }
    echo $output;
}
?>
<div id="hot_comment_widget">
	<ul>
		<?php hot_comment_viewed($number, $days); ?>
		<?php wp_reset_query(); ?>
	</ul>
</div>

<?php
	echo $after_widget;
	}
	function update( $new_instance, $old_instance ) {
		if (!isset($new_instance['submit'])) {
			return false;
		}
			$instance = $old_instance;
			$instance = array();
			$instance['title'] = strip_tags( $new_instance['title'] );
			$instance['number'] = strip_tags($new_instance['number']);
			$instance['days'] = strip_tags($new_instance['days']);
			return $instance;
		}
	function form($instance) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = '热评文章';
		}
		global $wpdb;
		$instance = wp_parse_args((array) $instance, array('number' => '5'));
		$instance = wp_parse_args((array) $instance, array('days' => '90'));
		$number = strip_tags($instance['number']);
		$days = strip_tags($instance['days']);
 ?>
	<p><label for="<?php echo $this->get_field_id( 'title' ); ?>">标题：</label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
	<p><label for="<?php echo $this->get_field_id('number'); ?>">显示数量：</label>
	<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
	<p><label for="<?php echo $this->get_field_id('days'); ?>">时间限定（天）：</label>
	<input id="<?php echo $this->get_field_id( 'days' ); ?>" name="<?php echo $this->get_field_name( 'days' ); ?>" type="text" value="<?php echo $days; ?>" size="3" /></p>
	<input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
<?php }
}
add_action( 'widgets_init', create_function( '', 'register_widget( "hot_comment" );' ) );

// 大家喜欢
class like_most extends WP_Widget {
	function __construct(){
			parent::__construct(false,'主题 | 大家喜欢',array( 'description' => '调用点击赞最多的文章' ,'classname' => 'like_most'));
	}	 
     function widget($args, $instance) {
		extract($args);
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $before_widget;
		if ( ! empty( $title ) )
		echo $before_title . $title . $after_title;
		$number = strip_tags($instance['number']) ? absint( $instance['number'] ) : 5;
		$days = strip_tags($instance['days']) ? absint( $instance['days'] ) : 90;
?>

<div id="like" class="like_most">
	<ul>
	    <?php if (function_exists('get_most_viewed')): ?> 
	    <?php get_like_most('post',$number,$days, true, true); ?>
	    <?php endif; ?>
		<?php wp_reset_query(); ?>
	</ul>
</div>

<?php
	echo $after_widget;
	}
	function update( $new_instance, $old_instance ) {
		if (!isset($new_instance['submit'])) {
			return false;
		}
			$instance = $old_instance;
			$instance = array();
			$instance['title'] = strip_tags( $new_instance['title'] );
			$instance['number'] = strip_tags($new_instance['number']);
			$instance['days'] = strip_tags($new_instance['days']);
			return $instance;
		}
	function form($instance) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = '大家喜欢';
		}
		global $wpdb;
		$instance = wp_parse_args((array) $instance, array('number' => '5'));
		$instance = wp_parse_args((array) $instance, array('days' => '90'));
		$number = strip_tags($instance['number']);
		$days = strip_tags($instance['days']);
 ?>
	<p><label for="<?php echo $this->get_field_id( 'title' ); ?>">标题：</label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
	<p><label for="<?php echo $this->get_field_id('number'); ?>">显示数量：</label>
	<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
	<p><label for="<?php echo $this->get_field_id('days'); ?>">时间限定（天）：</label>
	<input id="<?php echo $this->get_field_id( 'days' ); ?>" name="<?php echo $this->get_field_name( 'days' ); ?>" type="text" value="<?php echo $days; ?>" size="3" /></p>
	<input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
<?php }
}
add_action( 'widgets_init', create_function( '', 'register_widget( "like_most" );' ) );


// 随机文章
class random_post extends WP_Widget {
	function __construct(){
			parent::__construct(false,'主题 | 随机文章',array( 'description' => '显示随机文章' ,'classname' => 'random_post'));
	}
     function widget($args, $instance) {
		extract($args);
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $before_widget;
		if ( ! empty( $title ) )
		echo $before_title . $title . $after_title;
		$number = strip_tags($instance['number']) ? absint( $instance['number'] ) : 5;
?>

<div class="random_post_widget">
	<ul>
		<?php query_posts( array ( 'orderby' => 'rand', 'showposts' => $number, 'ignore_sticky_posts' => 10 ) ); while ( have_posts() ) : the_post(); ?>
			<?php the_title( sprintf( '<li><i class="iconfont icon-chevronrightt"></i><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></li>' ); ?>

		<?php endwhile; ?>
		<?php wp_reset_query(); ?>
	</ul>
</div>

<?php
	echo $after_widget;
	}
	function update( $new_instance, $old_instance ) {
		if (!isset($new_instance['submit'])) {
			return false;
		}
			$instance = $old_instance;
			$instance = array();
			$instance['title'] = strip_tags( $new_instance['title'] );
			$instance['number'] = strip_tags($new_instance['number']);
			return $instance;
		}
	function form($instance) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = '随机文章';
		}
		global $wpdb;
		$instance = wp_parse_args((array) $instance, array('number' => '5'));
		$number = strip_tags($instance['number']);
?>
	<p><label for="<?php echo $this->get_field_id( 'title' ); ?>">标题：</label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
	<p><label for="<?php echo $this->get_field_id('number'); ?>">显示数量：</label>
	<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
	<input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
<?php }
}
add_action( 'widgets_init', create_function( '', 'register_widget( "random_post" );' ) );

// 标签云
class tag_cloud extends WP_Widget {
     function tag_cloud() {
		$widget_ops = array('description' => '标签云');
		$this->WP_Widget('tag_cloud', '主题&nbsp;&nbsp;热门标签', $widget_ops);
     }
	function __construct(){
			parent::__construct(false,'主题 | 多彩标签云',array( 'description' => '多彩的热门标签' ,'classname' => 'tag_cloud'));
	}
     function widget($args, $instance) {
		extract($args);
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $before_widget;
		if ( ! empty( $title ) )
		echo $before_title . $title . $after_title;
		$number = strip_tags($instance['number']) ? absint( $instance['number'] ) : 20;
?>

	<div class="tagcloud">
	<?php wp_tag_cloud( array ( 'smallest' => '15', 'largest' => 15, 'unit' => 'px', 'order' => 'RAND', 'number' => $number ) ); ?>
	<div class="clear"></div>	
</div>

<?php
	echo $after_widget;
	}
	function update( $new_instance, $old_instance ) {
		if (!isset($new_instance['submit'])) {
			return false;
		}
			$instance = $old_instance;
			$instance = array();
			$instance['title'] = strip_tags( $new_instance['title'] );
			$instance['number'] = strip_tags($new_instance['number']);
			return $instance;
		}
	function form($instance) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = '热门标签';
		}
		global $wpdb;
		$instance = wp_parse_args((array) $instance, array('number' => '20'));
		$number = strip_tags($instance['number']);
?>
	<p><label for="<?php echo $this->get_field_id( 'title' ); ?>">标题：</label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
	<p><label for="<?php echo $this->get_field_id('number'); ?>">显示数量：</label>
	<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
	<input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
<?php }
}
add_action( 'widgets_init', create_function( '', 'register_widget( "tag_cloud" );' ) );

// 相关文章
class related_post extends WP_Widget {
     function __construct(){
			parent::__construct(false,'主题 | 相关文章',array( 'description' => '显示相关文章' ,'classname' => 'related_post'));
	}	
     function widget($args, $instance) {
		extract($args);
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $before_widget;
		if ( ! empty( $title ) )
		echo $before_title . $title . $after_title;
		$number = strip_tags($instance['number']) ? absint( $instance['number'] ) : 5;
?>

<div id="related_post_widget">
	<ul>
		<?php
			$post_num = $number;
			global $post;
			$tmp_post = $post;
			$tags = ''; $i = 0;
			if ( get_the_tags( $post->ID ) ) {
			foreach ( get_the_tags( $post->ID ) as $tag ) $tags .= $tag->name . ',';
			$tags = strtr(rtrim($tags, ','), ' ', '-');
			$myposts = get_posts('numberposts='.$post_num.'&tag='.$tags.'&exclude='.$post->ID);
			foreach($myposts as $post) {
			setup_postdata($post);
		?>
		<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
		<?php
			$i += 1;
			}
			}
			if ( $i < $post_num ) {
			$post = $tmp_post; setup_postdata($post);
			$cats = ''; $post_num -= $i;
			foreach ( get_the_category( $post->ID ) as $cat ) $cats .= $cat->cat_ID . ',';
			$cats = strtr(rtrim($cats, ','), ' ', '-');
			$myposts = get_posts('numberposts='.$post_num.'&category='.$cats.'&exclude='.$post->ID);
			foreach($myposts as $post) {
			setup_postdata($post);
		?>
		<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
		<?php
		}
		}
		$post = $tmp_post; setup_postdata($post);
		?>
	</ul>
</div>

<?php
	echo $after_widget;
	}
	function update( $new_instance, $old_instance ) {
		if (!isset($new_instance['submit'])) {
			return false;
		}
			$instance = $old_instance;
			$instance = array();
			$instance['title'] = strip_tags( $new_instance['title'] );
			$instance['number'] = strip_tags($new_instance['number']);
			return $instance;
		}
	function form($instance) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = '相关文章';
		}
		global $wpdb;
		$instance = wp_parse_args((array) $instance, array('number' => '5'));
		$number = strip_tags($instance['number']);
?>
	<p><label for="<?php echo $this->get_field_id( 'title' ); ?>">标题：</label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
	<p><label for="<?php echo $this->get_field_id('number'); ?>">显示数量：</label>
	<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
	<input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
<?php }
}
add_action( 'widgets_init', create_function( '', 'register_widget( "related_post" );' ) );

//网站统计小工具
class md_tongji extends WP_Widget {
function __construct(){
			parent::__construct(false,'主题 | 网站统计',array( 'description' => '显示网站统计数' ,'classname' => 'md_tongji'));
	}	
    function form($instance) {
        $instance = wp_parse_args((array)$instance, array(
            'title' => '网站统计',
            'establish_time' => '2014-08-01'
        ));
        $title = htmlspecialchars($instance['title']);
        $establish_time = htmlspecialchars($instance['establish_time']);
        $output = '<table>';
        $output.= '<tr><td>标题</td><td>';
        $output.= '<input id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $instance['title'] . '" />';
        $output.= '</td></tr><tr><td>建站日期：</td><td>';
        $output.= '<input id="' . $this->get_field_id('establish_time') . '" name="' . $this->get_field_name('establish_time') . '" type="text" value="' . $instance['establish_time'] . '" />';
        $output.= '</td></tr></table>';
        echo $output;
    }
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags(stripslashes($new_instance['title']));
        $instance['establish_time'] = strip_tags(stripslashes($new_instance['establish_time']));
        return $instance;
    }
    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '&nbsp;' : $instance['title']);
        $establish_time = empty($instance['establish_time']) ? '2013-01-27' : $instance['establish_time'];
        echo $before_widget;
        echo $before_title . $title . $after_title;
        echo '<div class="tongji" ><ul>';
        $this->efan_get_blogstat($establish_time);
        echo '</ul></div>';
        echo $after_widget;
    }
    function efan_get_blogstat($establish_time /*, $instance */) {
        global $wpdb;
        $count_posts = wp_count_posts();
		$all_view = all_view();
        $published_posts = $count_posts->publish;
        $draft_posts = $count_posts->draft;
        $comments_count = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->comments");
        $time = floor((time() - strtotime($establish_time)) / 86400);
        $count_tags = wp_count_terms('post_tag');
        $count_pages = wp_count_posts('page');
        $page_posts = $count_pages->publish;
        $count_categories = wp_count_terms('category');
        $link = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->links WHERE link_visible = 'Y'");
        $users = $wpdb->get_var("SELECT COUNT(ID) FROM $wpdb->users");
        $last = $wpdb->get_results("SELECT MAX(post_modified) AS MAX_m FROM $wpdb->posts WHERE (post_type = 'post' OR post_type = 'page') AND (post_status = 'publish' OR post_status = 'private')");
        $last = date('Y-n-j', strtotime($last[0]->MAX_m));
        $output = '<li>日志总数：';
        $output.= $published_posts;
        $output.= ' 篇</li>';
        $output.= '<li>浏览量：';
        $output.= $all_view;
        $output.= '次</li>';			
        $output.= '<li>评论数目：';
        $output.= $comments_count;
        $output.= ' 条</li>';
        $output.= '<li>建站日期：';
        $output.= $establish_time;
        $output.= '</li>';		
        $output.= '<li>运行天数：';
        $output.= $time;
        $output.= ' 天</li>';
        if (is_user_logged_in()) {
            $output.= '<li>页面总数：';
            $output.= $page_posts;
            $output.= ' 个</li>';
            $output.= '<li>分类总数：';
            $output.= $count_categories;
            $output.= ' 个</li>';
            $output.= '<li>友链总数：';
            $output.= $link;
            $output.= ' 个</li>';
			$output.= '<li>标签总数：';
			$output.= $count_tags;
			$output.= ' 个</li>';
        }
        if (get_option("users_can_register") == 1) {
            $output.= '<li>用户总数：';
            $output.= $users;
            $output.= ' 个</li>';
        }
        $output.= '<li>最后更新：';
        $output.= $last;
        $output.= '</li>';
        echo $output;
    }
}
add_action( 'widgets_init', create_function( '', 'register_widget( "md_tongji" );' ) );

// 分类ID
function show_id() {
	global $wpdb;
	$request = "SELECT $wpdb->terms.term_id, name FROM $wpdb->terms ";
	$request .= " LEFT JOIN $wpdb->term_taxonomy ON $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id ";
	$request .= " WHERE $wpdb->term_taxonomy.taxonomy = 'category' ";
	$request .= " ORDER BY term_id asc";
	$categorys = $wpdb->get_results($request);
	foreach ($categorys as $category) { 
		$output = '<ol class="show-id">'.$category->name.' [ ' .$category->term_id.' ]</ol>';
		echo $output;
	}
}