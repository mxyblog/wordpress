<?php get_header();
    /*
    Template Name: link  
    */ 
?>

        <div class="page-header pb-100 pt-85 clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-sm-6">
                        <div class="headerr-image">
                            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/static/picture/links.png" alt="小伙伴们">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <div class="author-text">
                            <div class="single-author-d">
                                <div class="title">
                                    <h2>
                                        小伙伴们
                                    </h2>
                                    <p>
                                        <p>
                                            相聚离开都有时候，没有什么会永垂不朽
                                        </p>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="authors-area pb-100 clearfix">
            <div class="container">
                <div class="row">

                <?php 
                $bookmarks = get_bookmarks('title_li=&orderby=rand');
                if ( !empty($bookmarks) ) {
                    foreach ($bookmarks as $bookmark) {
                    echo '<div class="col-lg-6">
                            <div class="author-details d-flex">
                                <div class="author-pic">
                                    <a href="'.$bookmark->link_url.'">
                                        <img alt="" src="'.$bookmark->link_description.'" srcset="'.$bookmark->link_description.'" class="avatar photo" height="132" width="132" style="border-radius: 50%;">
                                    </a>
                                </div>
                                <div class="author-details-text">
                                    <div class="title">
                                        <h3>
                                            <a target="_blank" href="'.$bookmark->link_url.'">
                                                '.$bookmark->link_name.'
                                            </a>
                                        </h3>
                                    </div>
                                    <p>
                                       '.$bookmark->link_notes.'
                                    </p>
                                </div>
                            </div>
                        </div>';}};?>
                </div>
            </div>
        </div>

        <?php get_footer();?>