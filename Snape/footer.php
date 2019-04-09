<?php
/**
 * The template for displaying the footer
 *
 * @package Vtrois
 * @version 1.1
 */
?>
        <footer id="footer">
            <a class="cd-top visible-lg text-center"><span class="fa fa-chevron-up"></span></a>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3 text-center">
                        <p class="social-icons">
                        <?php echo (!Snape_option('social_weibo')) ? '' : '<a target="_blank" rel="nofollow" href="' . Snape_option('social_weibo') . '"><i class="fa fa-weibo"></i></a>'; ?>
                        <?php echo (!Snape_option('social_tweibo')) ? '' : '<a target="_blank" rel="nofollow" href="' . Snape_option('social_tweibo') . '"><i class="fa fa-tencent-weibo"></i></a>'; ?>
                        <?php echo (!Snape_option('social_twitter')) ? '' : '<a target="_blank" rel="nofollow" href="' . Snape_option('social_twitter') . '"><i class="fa fa-twitter"></i></a>'; ?>
                        <?php echo (!Snape_option('social_facebook')) ? '' : '<a target="_blank" rel="nofollow" href="' . Snape_option('social_facebook') . '"><i class="fa fa-facebook-official"></i></a>'; ?>
                        <?php echo (!Snape_option('social_linkedin')) ? '' : '<a target="_blank" rel="nofollow" href="' . Snape_option('social_linkedin') . '"><i class="fa fa-linkedin-square"></i></a>'; ?>
                        <?php echo (!Snape_option('social_github')) ? '' : '<a target="_blank" rel="nofollow" href="' . Snape_option('social_github') . '"><i class="fa fa-github"></i></a>'; ?>
                        </p>
                        <p>© <?php echo date('Y'); ?> <a href="<?php echo get_option('home'); ?>"><?php bloginfo('name'); ?></a> All Rights Reserved.<br>Theme <a href="https://github.com/vtrois/snape" target="_blank" rel="nofollow">Snape</a> made by <a href="https://www.vtrois.com/" target="_blank" rel="nofollow">Vtrois</a><?php if(snape_option('icp_num')){?><br><a href="http://www.miitbeian.gov.cn/" rel="external nofollow" target="_blank"><?php echo snape_option( 'icp_num' ); } ?></a><?php if(snape_option('gov_num')){?><br><a href="<?php echo snape_option( 'gov_link' ); ?>" rel="external nofollow" target="_blank"><i class="govimg"></i><?php echo snape_option( 'gov_num' ); ?></a><?php }?></p><p><?php echo (!snape_option('site_tongji')) ? '' : '<script>' . snape_option('site_tongji') . '</script>'; ?></p>
                    </div>
                </div>
            </div>
        </footer>
        <?php wp_footer();?>
        <?php echo (!snape_option('ad_code')) ? '' : '<script>' . snape_option('ad_code') . '</script>'; ?>
   </body>
</html>