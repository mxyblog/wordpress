</section>
<footer class="footer">
    <div class="footer-inner">
        <div class="copyright pull-left">
         <a href="https://dedewp.com/" title="陌小雨博客">陌小雨博客&欲思博客</a> 版权所有，保留一切权利 · <a href="https://dedewp.com/sitemap.xml" title="站点地图">站点地图</a>   ·   基于WordPress构建   © 2015-2018  ·   托管于 <a rel="nofollow" target="_blank" href="https://promotion.aliyun.com/ntms/act/ambassador/sharetouser.html?userCode=coywfy8d&utm_source=coywfy8d">阿里云主机</a> & <a rel="nofollow" target="_blank" href="https://portal.qiniu.com/signup?code=3laqnnp0wqixe">七牛云存储</a>
        </div>
        <div class="trackcode pull-right">
            <?php if( dopt('d_track_b') ) echo dopt('d_track'); ?>
        </div>
    </div>
</footer>

<?php 
wp_footer(); 
global $dHasShare; 
if($dHasShare == true){ 
	echo'<script>with(document)0[(getElementsByTagName("head")[0]||body).appendChild(createElement("script")).src="http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion="+~(-new Date()/36e5)];</script>';
}  
if( dopt('d_footcode_b') ) echo dopt('d_footcode'); 
?>
</body>
</html>