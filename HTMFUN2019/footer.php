        <footer>
            <div class="footer-area pt-60 clearfix">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="footer-logo pb-60 text-center">
                                <a href="<?php bloginfo('url')?>">
                                    <img src="<?php echo cs_get_option('plus_header_logo') ?>" alt="<?php bloginfo('name')?>" />
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
            <div class="footer-social-links">
                <?php if(cs_get_option('plus_footer_twitter')): ?>
                    <a href="<?php echo cs_get_option('plus_footer_twitter'); ?>" target="_blank"><i class="iconfont icon-twitter"></i></a>
                <?php endif; ?>
                <?php if(cs_get_option('plus_footer_qq')): ?>
                    <a href="tencent://message/?uin=<?php echo cs_get_option('plus_footer_qq'); ?>&;Site=<?php bloginfo('name')?>&;Menu=yes" target="_blank"><i class="iconfont icon-qq"></i></a>
                <?php endif; ?>

                <?php if(cs_get_option('plus_footer_github')): ?>
                    <a href="<?php echo cs_get_option('plus_footer_github'); ?>" target="_blank"><i class="iconfont icon-github"></i></a>
                <?php endif; ?>

                <?php if(cs_get_option('plus_footer_weibo')): ?>
                    <a href="<?php echo cs_get_option('plus_footer_weibo'); ?>" target="_blank"><i class="iconfont icon-weibo1"></i></a>
                <?php endif; ?>
                    <!-- 社交图标 -->
            </div>
                            <div class="footer-text mb-30 text-center">
                                <p><?php last_login();?></p>
                                <p>
                                    &copy;2019 All RIGHTS RESERVED THEME BY
                                    <a href="http://www.htm.fun" target="_blank">
                                        HTM.FUN
                                    </a>
                                </p>
                                <p><a href="http://www.miitbeian.gov.cn"><?php echo cs_get_option('plus_footer_record'); ?></a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <a id="nice-back-to-top" href="#">
                <span class="icon-stack">
                    <i class="iconfont icon-top"></i>
                    <span class="back-to-top-text">Top</span>
                </span>
            </a>
        <?php wp_footer();?>
        <script>
            <?php echo cs_get_option('plus_diy_js');?>
        </script>
    </body>
        
</html>