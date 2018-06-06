<?php /**
 * WordStar Functions file
 *
 * @category WordPress
 * @package  WordStar
 * @author   Linesh Jose <lineshjos@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://linesh.com/projects/wordstar/
 *
 */

// Adding body class --------------->
add_filter('body_class', 'wordstar_body_classes');
function wordstar_body_classes( $classes ) 
{
    $classes[] = get_theme_mod( 'wordstar_columns', 'multi' ) . '-column';
	
	if (get_header_image() ) {
		$classes[] = 'custom-header';
	}
	
	if (get_background_image() ) { 
        $classes[] = 'custom-background-image';
    }
    if (is_multi_author() ) {
        $classes[] = 'group-blog';
    }else{
		$classes[] = 'single-author';
	}
    if (!wordstar_active_sidebars()) {
        $classes[] = 'no-sidebar';
    }
    if (!is_singular() ) {
        $classes[] = 'hfeed';
		$classes[] = 'h-feed';
		$classes[] = 'feed';
    }
    return $classes;
}

// Adds custom classes to the array of post classes. ------------------>
function wordstar_post_classes( $classes ) 
{
	$classes[] = 'h-entry';
	$classes[] = 'hentry';

	if ( get_post_type() === 'page' ) {
		$classes[] = 'h-as-page';
	}
	if ( !get_post_format() && 'post' === get_post_type() ) {
		$classes[] = 'h-as-article';
	}

	switch ( get_post_format() ) 
	{
		case 'aside':
		case 'status':
			$classes[] = 'h-as-note';
			break;
		case 'audio':
			$classes[] = 'h-as-audio';
			break;
		case 'video':
			$classes[] = 'h-as-video';
			break;
		case 'gallery':
		case 'image':
			$classes[] = 'h-as-image';
			break;
		case 'link':
			$classes[] = 'h-as-bookmark';
			break;
	}
	return array_unique( $classes );
}
add_filter( 'post_class', 'wordstar_post_classes', 99 );



// Adding comment class --------------->
add_filter( 'comment_class', 'wordstar_comment_classes', 99 );
function wordstar_comment_classes( $classes ) {
	$classes[] = 'h-as-comment';
	$classes[] = 'h-entry';
	$classes[] = 'h-cite';
	$classes[] = 'p-comment';
	$classes[] = 'comment';
	return array_unique( $classes );
}


/**
 * add semantics
 *
 * @param string $id the class identifier
 * @return array
 */
function wordstar_get_semantics( $id = null ) {
	$classes = array();

	// add default values
	switch ( $id ) {
		case 'body':
			if ( ! is_singular() ) {
				$classes['itemscope'] = array( '' );
				$classes['itemtype'] = array( 'http://schema.org/Blog', 'http://schema.org/WebPage' );
			} elseif ( is_single() ) {
				$classes['itemscope'] = array( '' );
				$classes['itemtype'] = array( 'http://schema.org/BlogPosting' );
			} elseif ( is_page() ) {
				$classes['itemscope'] = array( '' );
				$classes['itemtype'] = array( 'http://schema.org/WebPage' );
			}
			break;
		case 'post':
			if ( ! is_singular() ) {
				$classes['itemprop'] = array( 'blogPost' );
				$classes['itemscope'] = array( '' );
				$classes['itemtype'] = array( 'http://schema.org/BlogPosting' );
			}
			break;
	}

	$classes = apply_filters( 'sempress_semantics', $classes, $id );
	$classes = apply_filters( "sempress_semantics_{$id}", $classes, $id );
	return $classes;
}

/**
 * echos the semantic classes added via
 * the "sempress_semantics" filters
 *
 * @param string $id the class identifier
 */
function wordstar_semantics( $id ) {
	$classes = wordstar_get_semantics( $id );

	if ( ! $classes ) {
		return;
	}

	foreach ( $classes as $key => $value ) {
		echo ' ' . esc_attr( $key ) . '="' . esc_attr( join( ' ', $value ) ) . '"';
	}
}

// Avatar class -------------->
function wordstar_pre_get_avatar_data( $args, $id_or_email ) {
	if ( ! isset( $args['class'] ) ) {
		$args['class'] = array();
	}
	// Adds a class for microformats v2
	$args['class'] = array_unique( array_merge( $args['class'], array( 'u-photo' ) ) );
	$args['extra_attr'] = 'itemprop="image"';
	return $args;
}
add_filter( 'pre_get_avatar_data', 'wordstar_pre_get_avatar_data', 99, 2 );




function wordstar_active_sidebars(){
	if(is_active_sidebar('wordstar-sidebar') || is_active_sidebar('wordstar-social-widget') ){
		return true;	
	}else{
		return false;	
	}
}




// Handles JavaScript detection.Adds a `js` class to the root `<html>` element when JavaScript is detected. --------------->
add_action('wp_head', 'wordstar_javascript_detection', 0);
function wordstar_javascript_detection() 
{
    echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}


// Post entery metas --------------->
function wordstar_entry_meta()
{
    
    echo '<ul>';
    // sticky post ------------->	
    if (is_sticky() && is_home() && ! is_paged() ) {
        echo '<li class="sticky-post"><i class="fa fa-bookmark"></i>'.esc_html__('Featured', 'wordstar').'</li>';
    }
    
    // post format ------------->
    $format = get_post_format();
    $formats_class=array(    
                'aside'=>'file-text',
                'image'=>'image',
                'video'=>'video-camera',
                'quote'=>'quote-left', 
                'link'=>'link',
                'gallery'=>'image',
                'status'=>'thumb-tack', 
                'audio'=>'music',
                'chat'=>'commenting-o',
    );
        
    if (current_theme_supports('post-formats', $format) ) {
        echo '<li class="entry-format '.esc_attr($format).'">
			<i class="fa fa-'.esc_attr($formats_class[$format]).'"></i>
			<span class="screen-reader-text">'.esc_html__('Format:', 'wordstar') .'</span>
			<a href="'.esc_url(get_post_format_link($format)).'" title="'.esc_attr($format).' post">'.esc_html(get_post_format_string($format)).'</a></li>';
    }
    
    // Time ------------->
    echo '<li class="posted-on">
				<i class="fa fa-calendar"></i>
				<span class="screen-reader-text">'.esc_html__('Posted on:', 'wordstar').'</span>
				<a href="'.esc_url(get_permalink()).'" rel="bookmark">
					<time class="entry-date published dt-published" itemprop="datePublished" datetime="'.esc_attr(get_the_date('c')).'">'.get_the_date().'</time>
					<time class="entry-date updated dt-updated screen-reader-text" itemprop="dateModified" datetime="'.esc_attr(get_the_modified_date('c')).'">'. esc_html(get_the_modified_date()).'</time>
				</a>
			</li>';
        
	if(!is_single()){ 
    
    // Author ---->
    echo '<li class="byline author p-author vcard hcard h-card" itemprop="author " itemscope itemtype="http://schema.org/Person">
				<i class="fa fa-user"></i>
				<span class="screen-reader-text">'. esc_html__('Author:', 'wordstar').'</span>
				<span class="screen-reader-text">'.get_avatar( get_the_author_meta( 'ID' ), 40 ).'</span>
				<a class="url u-url" href="'.esc_url(get_author_posts_url(get_the_author_meta('ID'))).'" rel="author" itemprop="url" ><span  class=" fn p-name" itemprop="name">'.esc_html(get_the_author()).'</span></a>
			</li>';
	}
      
    // categories ---->
    if (($categories_list = get_the_category_list(', ')) && wordstar_categorized_blog() ) {
        echo '<li class="cat-links">
				<i class="fa fa-folder-open"></i>
				<span class="screen-reader-text">'. esc_html__('Categories:', 'wordstar').'</span>
				'.ent2ncr($categories_list).'
			</li>';
    }
    
    // tags ---->
    if ($tags_list = get_the_tag_list('', ', ')) {
        echo '<li class="tag-links">
				<i class="fa fa-tags"></i>
				<span class="screen-reader-text">'. esc_html__('Tags:', 'wordstar').'</span>
				'.ent2ncr($tags_list).'
			</li>';
    }
    
    // attachemnt ---->
    if (is_attachment() && wp_attachment_is_image() ) {
        // Retrieve attachment metadata.
        $metadata = wp_get_attachment_metadata();
        echo '<li class="full-size-link">
				<i class="fa fa-link"></i>
				<span class="screen-reader-text">'.esc_html__('Full size link:', 'wordstar').'</span>
				<a href="'.esc_url(wp_get_attachment_url()).'">'.esc_html($metadata['width']).' &times; '.esc_html($metadata['height']).'</a>
			</li>';
    }
    
    // Comments ---->
    if (! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
        echo '<li class="comment">
				<i class="fa fa-comments"></i>';
        comments_popup_link(__('Leave a comment', 'wordstar').'<span class="screen-reader-text">:&nbsp;'.get_the_title().'</span>');
        echo '</li>';
    }
    
    // Edit Link ---->
    edit_post_link(__('Edit', 'wordstar'), '<li class="edit-link"><i class="fa fa-pencil"></i>', '</li>'); 
    echo '<div class="clear"></div></ul>';
}
    
function wordstar_categorized_blog()
{
    if (false === ( $all_the_cool_cats = get_transient('wordstar_categories') ) ) {
        // Create an array of all the categories that are attached to posts.
        $all_the_cool_cats = get_categories(
            array(
            'fields'     => 'ids',
            'hide_empty' => 1,
            'number'     => 2,
            ) 
        );
        // Count the number of categories that are attached to the posts.
        $all_the_cool_cats = count($all_the_cool_cats);
        set_transient('wordstar_categories', $all_the_cool_cats);
    }
    if ($all_the_cool_cats > 1 ) {
        // This blog has more than 1 category so wordstar_categorized_blog should return true.
        return true;
    } else {
        // This blog has only 1 category so wordstar_categorized_blog should return false.
        return false;
    }
}
function wordstar_category_transient_flusher(){
    delete_transient('wordstar_categories');
}
add_action('edit_category', 'wordstar_category_transient_flusher');
add_action('save_post',   'wordstar_category_transient_flusher');


// Post featured image --------------->
function wordstar_post_thumbnail($size='')
{
    $size=trim($size);
    if(has_post_thumbnail()) { 
        echo '<div class="post-thumbnail entry-media"><a class="" href="'.esc_url(get_the_permalink()).'" aria-hidden="true">';
        the_post_thumbnail($size, 
			array(
			'alt' => get_the_title(), 
			'class' => ' photo u-photo',
			'itemprop' => 'image'
		));
        echo '</a></div>';
    }
}


// Excerpt more --------------->
add_filter('excerpt_more', 'wordstar_excerpt_more');
function wordstar_excerpt_more( $more ) 
{
    if(! is_admin()) {
        /* translators: %s: Name of current post */
        $link = sprintf('<a href="%1$s" class="more-link read-more" rel="bookmark">%2$s</a>', esc_url(get_permalink(get_the_ID())), sprintf(__('Continue Reading %s', 'wordstar'), '<span class="screen-reader-text">'.get_the_title(get_the_ID()).'</span><i class="fa fa-arrow-right"></i>'));
        return '&hellip; ' . $link;
    }
}

// Excerpt character length --------------->
    add_filter('excerpt_length', 'wordstar_custom_excerpt_length', 999);
function wordstar_custom_excerpt_length( $length ) 
{
    return 50;
}


// home page validation --------------->
function wordstar_is_home_page(){
    if (is_home() && is_front_page()) { 
        return true;
    }else{
        return false;    
    }

}

// Displays the optional custom logo --------------->
function wordstar_the_custom_logo() 
{

    if (function_exists('the_custom_logo')  && has_custom_logo() ) 
	{
		$image = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ) );
		echo ' <div class="site-branding logo-active u-photo photo logo" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
		 <a href="'.esc_url(home_url('/')).'" rel="home" itemprop="url" class="u-url url"><img src="'.esc_url($image[0]).'" width="'.esc_attr($image[1]).'" height="'.esc_attr($image[2]).'" alt="site-logo"/></a>
		 <meta itemprop="url" content="'.esc_url($image[0]).'" />
		 <meta itemprop="width" content="'.esc_attr($image[1]).'" />
    	 <meta itemprop="height" content="'.esc_attr($image[2]).'" />
		';
    }else{
        echo ' <div class="site-branding">';
        if(wordstar_is_home_page()) {
            echo '<h1 id="site-title" class="site-title p-name" itemprop="name"><a href="'.esc_url(home_url('/')).'" rel="home" itemprop="url" class="u-url url">'.esc_html(get_bloginfo('name')).'</a></h1>';
        } else{
            echo '<p id="site-title" class="site-title p-name" itemprop="name"><a href="'.esc_url(home_url('/')).'" rel="home" itemprop="url" class="u-url url">'.esc_html(get_bloginfo('name')).'</a></p>';
        }
    }
            
    if ($description = get_bloginfo('description', 'display')) {
        $class="";
        if(!is_customize_preview()) {
            $class="says";
        }
        echo '<p  id="site-description" class="site-description p-summary e-content '.esc_attr($class).'" itemprop="description">'.esc_html($description).'</p>';
    }
      echo '</div>';
}


//  Adds postMessage support for site title and description for the Customizer. --------------->
function wordstar_customize_partial_blogname() {
    bloginfo('name');
}
function wordstar_customize_partial_blogdescription(){
    bloginfo('description');
}

add_action('customize_register', 'wordstar_customize_register', 11);
function wordstar_customize_register( $wp_customize ) 
{
    $wp_customize->get_setting('blogname')->transport         = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
    
    if (isset($wp_customize->selective_refresh) ) {
        $wp_customize->selective_refresh->add_partial(
            'blogname', array(
            'selector' => '.site-title a',
            'container_inclusive' => false,
            'render_callback' => 'wordstar_customize_partial_blogname',
            ) 
        );
        $wp_customize->selective_refresh->add_partial(
            'blogdescription', array(
            'selector' => '.site-description',
            'container_inclusive' => false,
            'render_callback' => 'wordstar_customize_partial_blogdescription',
            ) 
        );
    }
}
 

// Social media profile links fields in user profile page  ------------------>
add_filter('user_contactmethods', 'wordstar_user_contact_methods');
function wordstar_user_contact_methods($profile_fields) {
	$profile_fields['wordstar_twitter'] = __('Twitter Username', 'wordstar');
	$profile_fields['wordstar_facebook'] = __('Facebook URL', 'wordstar');
	$profile_fields['wordstar_instagram'] = __('Instagram URL', 'wordstar');
	$profile_fields['wordstar_gplus'] = __('Google+ URL', 'wordstar');
	$profile_fields['wordstar_flickr'] =__( 'Flickr URL', 'wordstar');
	$profile_fields['wordstar_github'] =__( 'Github URL', 'wordstar');
	$profile_fields['wordstar_pinterest'] =__( 'Pinterest URL', 'wordstar');
	$profile_fields['wordstar_tumblr'] =__( 'Tumblr URL', 'wordstar');
	$profile_fields['wordstar_medium'] =__( 'Medium URL', 'wordstar');
	return $profile_fields;
} 
    
// Author's meta ----------------> 	
function wordstar_author_metas($author_id)
{
    echo '<div class="author-metas">';
        
    if($post_count=count_user_posts($author_id)) { 
        echo '<a href='.esc_url(get_author_posts_url($author_id)).' title="'.esc_attr($post_count).' '.esc_attr('Posts', 'wordstar').'" class="posts"><i class="fa fa-thumb-tack"></i><span>'.esc_html($post_count).'</span></a>';
    }
    if($website=esc_url(get_the_author_meta('url', $author_id)) ) {
        echo '<a href="'.esc_url($website).'" rel="noopener" target="_blank" class="social web" title="'. esc_attr('Author\'s Website', 'wordstar').'"><i class="fa fa-globe"></i><span>'. esc_html__('Website', 'wordstar').'</span></a>';
    }
	
	if($twitter=esc_url(get_the_author_meta('wordstar_twitter', $author_id)) ) {
        echo '<a href="https://twitter.com/'.esc_attr($twitter).'/" rel="noopener" target="_blank" class="social twitter" title="'. esc_attr('Twitter', 'wordstar').'"><i class="fa fa-twitter"></i><span>'. esc_html__('Twitter', 'wordstar').'</span></a>';
    }
	
	if($facebook=esc_url(get_the_author_meta('wordstar_facebook', $author_id)) ) {
        echo '<a href="'.esc_url($facebook).'" rel="noopener" target="_blank" class="social facebook" title="'. esc_attr('Facebook', 'wordstar').'"><i class="fa fa-facebook"></i><span>'. esc_html__('Facebook', 'wordstar').'</span></a>';
    }
	
	if($instagram=esc_url(get_the_author_meta('wordstar_instagram', $author_id)) ) {
        echo '<a href="'.esc_url($instagram).'" rel="noopener" target="_blank" class="social instagram" title="'. esc_attr('Instagram', 'wordstar').'"><i class="fa fa-instagram"></i><span>'. esc_html__('Instagram', 'wordstar').'</span></a>';
    }
	
	if($gplus=esc_url(get_the_author_meta('wordstar_gplus', $author_id)) ) {
        echo '<a href="'.esc_url($gplus).'" rel="noopener author" target="_blank" class="social gplus" title="'. esc_attr('Google Plus', 'wordstar').'"><i class="fa fa-google-plus"></i><span>'. esc_html__('Google Plus', 'wordstar').'</span></a>';
    }
	
	if($linked_in=esc_url(get_the_author_meta('wordstar_linked_in', $author_id)) ) {
        echo '<a href="'.esc_url($linked_in).'" rel="noopener" target="_blank" class="social linked-in" title="'. esc_attr('LinkedIn', 'wordstar').'"><i class="fa fa-linkedin"></i><span>'. esc_html__('LinkedIn', 'wordstar').'</span></a>';
    }
	
	if($wordstar_flickr=esc_url(get_the_author_meta('wordstar_flickr', $author_id)) ) {
        echo '<a href="'.esc_url($wordstar_flickr).'" rel="noopener" target="_blank" class="social flickr" title="'. esc_attr('Flickr', 'wordstar').'"><i class="fa fa-flickr"></i><span>'. esc_html__('Flickr', 'wordstar').'</span></a>';
    }
	
	if($wordstar_github=esc_url(get_the_author_meta('wordstar_github', $author_id)) ) {
        echo '<a href="'.esc_url($wordstar_github).'" rel="noopener" target="_blank" class="social github" title="'. esc_attr('Github', 'wordstar').'"><i class="fa fa-github"></i><span>'. esc_html__('Github', 'wordstar').'</span></a>';
    }
	
	if($wordstar_pinterest=esc_url(get_the_author_meta('wordstar_pinterest', $author_id)) ) {
        echo '<a href="'.esc_url($wordstar_pinterest).'" rel="noopener" target="_blank" class="social pinterest" title="'. esc_attr('Pinterest', 'wordstar').'"><i class="fa fa-pinterest"></i><span>'. esc_html__('Pinterest', 'wordstar').'</span></a>';
    }
	
	if($wordstar_tumblr=esc_url(get_the_author_meta('wordstar_tumblr', $author_id)) ) {
        echo '<a href="'.esc_url($wordstar_tumblr).'" rel="noopener" target="_blank" class="social tumblr" title="'. esc_attr('Tumblr', 'wordstar').'"><i class="fa fa-tumblr"></i><span>'. esc_html__('Tumblr', 'wordstar').'</span></a>';
    }
	
	if($wordstar_medium=esc_url(get_the_author_meta('wordstar_medium', $author_id)) ) {
        echo '<a href="'.esc_url($wordstar_medium).'" rel="noopener" target="_blank" class="social medium" title="'. esc_attr('Medium', 'wordstar').'"><i class="fa fa-medium"></i><span>'. esc_html__('Medium', 'wordstar').'</span></a>';
    }
	
	
    echo '<a href="'.esc_url(get_author_feed_link($author_id)).'" rel="noopener"  title="'.esc_attr('Subscribe RSS Feed', 'wordstar').'" target="_blank" class="social rss"><i class="fa fa-rss"></i><span>'. esc_html__('RSS Feed', 'wordstar').'</span></a>';
    echo '<div class="clear"></div>
		</div>';
}

// Archive title --------------------->
add_filter('get_the_archive_title', 'wordstar_filter_archive_title');    
function wordstar_filter_archive_title($title )
{
    $rss='';
    if (is_search()) {
        $title = '<span>'. __('Searching for:', 'wordstar').'</span><strong>"'.get_search_query().'"</strong>' ;
    }elseif (is_category() ) {
        $title = '<strong>'.single_cat_title('', false).'</strong><span>'. __('Category', 'wordstar').'</span>' ;
        $rss=get_category_feed_link(get_query_var('cat'));
    } elseif (is_tag() ) {
        $title = '<strong>'.single_tag_title('', false).'</strong><span>'. __('Tag Archive', 'wordstar').'</span>' ;
        $rss=get_tag_feed_link(get_query_var('tag_id')); 
    } elseif (is_author() ) {
        $title = '<strong class="vcard">' . get_the_author() . '</strong><span>'. __('Author', 'wordstar').'</span>' ;
        $rss= get_author_feed_link(get_the_author_meta('ID'));
    } elseif (is_year() ) {
        $title = '<strong>' .get_the_date(__('Y', 'wordstar'))  . '</strong><span>'. __('Yearly Archives', 'wordstar').'</span>' ;
    } elseif (is_month() ) {
        $title = '<strong>' .get_the_date(__('F Y', 'wordstar'))  . '</strong><span>'. __('Monthly Archives ', 'wordstar').'</span>' ;
    } elseif (is_day() ) {
        $title = '<strong>' .get_the_date(__('F j, Y', 'wordstar'))  . '</strong><span>'. __('Daily Archives', 'wordstar').'</span>' ;
    } elseif (is_post_type_archive() ) {
        $title = '<strong>' .post_type_archive_title('', false)  . '</strong>' ;
        $rss=get_post_type_archive_feed_link(get_query_var('post_type'));
    } elseif (is_tax() ) {
        $tax = get_taxonomy(get_queried_object()->taxonomy);
        $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
        $title = '<strong>'.single_term_title('', false).'</strong><span>'.$tax->labels->singular_name.'</span>' ;
        $rss=get_term_feed_link($term->term_id, get_query_var('taxonomy'));

    } else {
        $title = '' ;//__( '<span>Blog Archives:</span> <strong>All Posts</strong>' );
        $rss=get_bloginfo('rss2_url');
    }
    if($title && $rss) {
        $title=$title.'<a href="'.$rss.'" title="'.esc_attr(__('Subscribe this', 'wordstar')).'" class="subscribe" rel="noopener noreferrer" target="_blank"><i class="fa fa-rss"></i><srong class="">'.__('Subscribe', 'wordstar').'</srong></a>	';
    }
    return $title;
}
?>