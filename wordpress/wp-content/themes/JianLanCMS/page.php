<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head></head><body><div class="top"><div class="logo left"> <a href="/" title="<?php bloginfo('name')?>"><img src="<?php bloginfo('template_url'); ?>/images/logo.png" alt="<?php bloginfo('name')?>"/></a></div><div class="top_ad right"><?php echo $theme_options["bdfx"]; ?>    </div><div style="clear:both"></div></div><?php get_template_part('tb','ty'); ?><div class="map"><span class="home_ico">当前位置：<a href="<?php bloginfo('url')?>">主页</a> &gt; 页面</span></div><div class="w972" style="margin-top:8px;">	<div class="article_article_left left">    <ul class="single">            <div style="clear:both"></div>        </ul><?php if (have_posts()) : ?>	<?php while (have_posts()) : the_post(); ?>		<div class="single_con">        				<h2 class="danye_tt"><?php the_title(); ?></h2>			<div class="content">		<?php the_content(); ?><?php endwhile; ?>			  </div><?php endif ?>			</div>	</div>			<div class="article_list_right right">	<div class="side_ad">    <div class="rand_pic">    	<h2><span class="h2_txt">推荐图文</span></h2>        <ul><?php query_posts('cat='.$theme_options["tuwenID"].'&showposts=8'); ?><?php if (have_posts()) : while (have_posts()) : the_post(); ?><li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php bloginfo('template_url'); ?>/img.php?src=<?php echo catch_that_image() ?>&w=140&h=140&zc=1" border="0" width="140"height="100" alt="<?php the_title(); ?>"><span><?php the_title(); ?></span></a></li><?php endwhile; else : ?><?php endif; ?> </ul>        <div style="clear:both"></div>    </div>        <div class="rand">    	<h2><span class="h2_txt">你可能喜欢</span></h2>        <ul>		<?php 				query_posts('showposts=12&orderby=rand');				while (have_posts()): the_post(); 				?><li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo cut_str($post->post_title,34); ?></a></li><?php endwhile; ?>        </ul>    </div>    </div></div><div style="clear:both"></div></div><div id="footer">  <div class="foot_con">   <?php get_template_part('db','ty'); ?>    <div class="txt_con">      <p style="line-height:2;">Copyright @ 2013-2014  All Rights Reserved Powered by <a href="http://v7v3.com">v7v3</a> And <a rel="nofollow" href="http://wordpress.org">WordPress</a> for .net</p>    </div>    <div style="clear:both"></div>  </div></div><script type="text/javascript">$(function (){$(window).toTop({showHeight : 100,});});</script><!-- /footer --></body></html>