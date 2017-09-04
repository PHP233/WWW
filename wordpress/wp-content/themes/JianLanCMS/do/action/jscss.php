<?php
function v7v3_jscss() { ?>
<script language="javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/w3cer.js" type="text/javascript"></script> 
<?php
}
add_action( 'wp_head', 'v7v3_jscss');

function v7v3_copyright() { ?>
<?php wp_reset_query(); if(is_home()){?>
<div id="links">

	<h2><span class="more right"><a href="<?php bloginfo(url);?>/link/" >申请加入>></a></span><span class="h2_txt">友情链接/Links</span></h2>

<div class="link_con">
<span class="link_a">
<?php v7v3_blogroll();?>
</span>

</div>

</div>
<?php }?>
<div id="footer">

  <div class="foot_con">

<?php get_template_part( 'y', 'j' ); ?>

    <div class="txt_con">

      <p style="line-height:2;">
Copyright @ 2013-2014  All Rights Reserved Powered by <a href='http://v7v3.com'>WordPress教程网</a> And <a href="<?php bloginfo(url);?>"><?php bloginfo(name);?></a> For WordPress。</p>

<?php
}
add_action( 'wp_footer', 'v7v3_copyright');