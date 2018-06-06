<?php if ( is_home() ) { ?><title><?php bloginfo('name'); ?><?php esc_html_e( ' - ', 'chopstack' ); ?><?php bloginfo('description'); ?></title><?php } ?>
<?php if ( is_search() ) { ?><title><?php esc_html_e( '搜索结果 - ', 'chopstack' ); ?><?php bloginfo('name'); ?></title><?php } ?>
<?php if ( is_single() ) { ?><title><?php echo trim(wp_title('',0)); ?><?php esc_html_e( ' - ', 'chopstack' ); ?><?php bloginfo('name'); ?></title><?php } ?>
<?php if ( is_page() ) { ?><title><?php echo trim(wp_title('',0)); ?><?php esc_html_e( ' - ', 'chopstack' ); ?><?php bloginfo('name'); ?></title><?php } ?>
<?php if ( is_category() ) { ?><title><?php single_cat_title(); ?><?php esc_html_e( ' - ', 'chopstack' ); ?><?php bloginfo('name'); ?></title><?php } ?>
<?php if ( is_month() ) { ?><title><?php the_time('F'); ?><?php esc_html_e( ' - ', 'chopstack' ); ?><?php bloginfo('name'); ?></title><?php } ?>
<?php if (function_exists('is_tag')) { if ( is_tag() ) { ?><title><?php single_tag_title("", true); ?><?php esc_html_e( ' - ', 'chopstack' ); ?><?php bloginfo('name'); ?></title><?php }?> <?php } ?>