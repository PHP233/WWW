<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf8" /><meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" /><!--<title><?php echo $theme_options["title"]; ?></title>--><title>中国女医师协会项目申报</title><meta name="Keywords" content="<?php echo $theme_options["sitekeywords"]; ?>"><meta name="Description" content="<?php echo $theme_options["sitedescription"]; ?>"><link href="<?php bloginfo('template_url'); ?>/css/index.css" rel="stylesheet" type="text/css" /><?php wp_head();?><base target="_blank" /></head><body><div class="top"><div class="logo left"><a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><img src="<?php bloginfo('template_url'); ?>/images/newlogo.png" alt="<?php bloginfo('name'); ?>"/></a></div><div class="top_ad right">    <a href="../../../../html/pages/signin/index.html" ><span>请登录</span></a></div>-<div style="clear:both"></div></div><?php get_template_part('tb','ty'); ?><div class="w972 margin8"><div class="index_left left"><div class="top_left"><div class="facus_left left">	<div class="index_slide">	<div class="focusBox"><ul class="pic"><?php query_posts('cat='.$theme_options["tuwenID"].'&showposts=3'); ?><?php if (have_posts()) : while (have_posts()) : the_post(); ?><li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img width="300" height="210" src="<?php bloginfo('template_url'); ?>/img.php?src=<?php echo catch_that_image() ?>&w=300&h=210&zc=1"></a></li><?php endwhile; else : ?><?php endif; ?></ul><div class="txt-bg"></div><div class="txt"><ul><?php query_posts('cat='.$theme_options["tuwenID"].'&showposts=3'); ?><?php if (have_posts()) : while (have_posts()) : the_post(); ?><li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo cut_str($post->post_title,30); ?></a></li><?php endwhile; else : ?><?php endif; ?></ul></div><ul class="num"><li class=""><a>1</a><span></span></li><li class=""><a>2</a><span></span></li><li class=""><a>3</a><span></span></li></ul></div><script type="text/javascript">jQuery(".focusBox").slide({ titCell:".num li", mainCell:".pic",effect:"fold", autoPlay:true,trigger:"click",startFun:function(i){jQuery(".focusBox .txt li").eq(i).animate({"bottom":0}).siblings().animate({"bottom":-36});}});</script>    </div>      	<div class="update">    	<h2><span class="h2_txt">公告栏</span></h2>        <script>        $(function(){			$("#update li:even").css("background","#f2f2f2")						})        </script>       <ul id="update">	   	<?php$rand_posts = get_posts('numberposts=9&orderby=newoffset=1');foreach( $rand_posts as $post ) :?><?php$category = get_the_category();   $name = $category[0]->cat_name;?><li>[<?php echo $name; ?>] <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li><?php endforeach; ?></ul>    </div>       </div>    <div class="top_right right">    <div class="top_news">         <div class="news_bg"></div>					  			                          						<?php$rand_posts = get_posts('numberposts=1&orderby=new');foreach( $rand_posts as $post ) :?><h1><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo cut_str($post->post_title,34); ?></a></h1><p><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 240,"……"); ?><a rel="nofollow" href="<?php the_permalink(); ?>">[查看全文]</a></p><?php endforeach; ?>      </div>        <div class="top_info"><h2><span class="h2_txt">最新要闻</span></h2><div class="ztlist" style="display:block"><?php query_posts('cat='.$theme_options["tuwenID"].'&showposts=3'); ?><?php if (have_posts()) : while (have_posts()) : the_post(); ?><dl><dt><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img width="80" height="70" src="<?php bloginfo('template_url'); ?>/img.php?src=<?php echo catch_that_image() ?>&w=80&h=70&zc=1" alt="<?php the_title();?>" /></a></dt><dd class="info_tt"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo cut_str($post->post_title,30); ?></a></dd><dd class="info_txt"><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 90,"..."); ?></dd></dl><?php endwhile; else : ?><?php endif; ?></div>    </div></div>    <div style="clear:both"></div>    </div></div><div class="index_right right"><?php get_template_part( 'index', 'gz' ); ?><div class="hot_news"><h2><span class="h2_txt">热门文章推荐</span></h2><ul>					  			                          						<?php$rand_posts = get_posts('numberposts=10&orderby=rand');foreach( $rand_posts as $post ) :?><li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo cut_str($post->post_title,34); ?></a></li><?php endforeach; ?></ul></div></div><div style="clear:both"></div></div><!--...<div class="art_pic">    <?php    $link1 = get_category_link( $theme_options["tuwenID"] );    ?>    <h2><span class="more right"><a href="<?php echo $link1;?>">更多>></a></span><span class="h2_txt"><?php $thiscat = get_category($theme_options["tuwenID"]); echo $thiscat ->name;?></span></h2>    <ul>        <?php query_posts('cat='.$theme_options["tuwenID"].'&showposts=10&offset=3'); ?>        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>            <li><a href="<?php the_permalink(); ?>"><span><?php echo cut_str($post->post_title,34); ?></span><img src="<?php bloginfo('template_url'); ?>/img.php?src=<?php echo catch_that_image() ?>&w=200&h=145&zc=1" alt="<?php the_title(); ?>"/></a></li>        <?php endwhile; else : ?>        <?php endif; ?>        <div style="clear:both"></div>    </ul></div>--><!--<div class="w972s margin8"><div class="web_jc"><?php   $link2 = get_category_link( $theme_options["erhaoID"] );?><h2><span class="more right"><a href="<?php echo $link2;?>">更多>></a></span><span class="h2_txt"><?php $thiscat = get_category($theme_options["erhaoID"]); echo $thiscat ->name;?></span></h2><ul><?php query_posts('cat='.$theme_options["erhaoID"].'&showposts=10'); ?><?php if (have_posts()) : while (have_posts()) : the_post(); ?><li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><span class="right"><?php the_time('m-d') ?></span><?php echo cut_str($post->post_title,34); ?></a></li><?php endwhile; else : ?><?php endif; ?></ul></div><div class="web_jc" style="margin-left:8px;"><?php   $link3 = get_category_link( $theme_options["sanhaoID"] );?><h2><span class="more right"><a href="<?php echo $link3;?>">更多>></a></span><span class="h2_txt"><?php $thiscat = get_category($theme_options["sanhaoID"]); echo $thiscat ->name;?></span></h2><ul><?php query_posts('cat='.$theme_options["sanhaoID"].'&showposts=10'); ?><?php if (have_posts()) : while (have_posts()) : the_post(); ?><li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><span class="right"><?php the_time('m-d') ?></span><?php echo cut_str($post->post_title,34); ?></a></li><?php endwhile; else : ?><?php endif; ?></ul></div><div class="web_jc" style="margin-left:7px;"><?php   $link4 = get_category_link( $theme_options["sihaoID"] );?><h2><span class="more right"><a href="<?php echo $link4;?>">更多>></a></span><span class="h2_txt"><?php $thiscat = get_category($theme_options["sihaoID"]); echo $thiscat ->name;?></span></h2><ul><?php query_posts('cat='.$theme_options["sihaoID"].'&showposts=10'); ?><?php if (have_posts()) : while (have_posts()) : the_post(); ?><li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><span class="right"><?php the_time('m-d') ?></span><?php echo cut_str($post->post_title,34); ?></a></li><?php endwhile; else : ?><?php endif; ?></ul></div><div style="clear:both"></div></div>--><!--<div class="big_ad1"><?php echo $theme_options["ad1"]; ?></div>--><!--<div class="w972s w972 margin8"><div class="web_jc"><?php   $link5 = get_category_link( $theme_options["wuhaoID"] );?><h2><span class="more right"><a href="<?php echo $link5;?>">更多>></a></span><span class="h2_txt"><?php $thiscat = get_category($theme_options["wuhaoID"]); echo $thiscat ->name;?></span></h2><ul><?php query_posts('cat='.$theme_options["wuhaoID"].'&showposts=10'); ?><?php if (have_posts()) : while (have_posts()) : the_post(); ?><li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><span class="right"><?php the_time('m-d') ?></span><?php echo cut_str($post->post_title,34); ?></a></li><?php endwhile; else : ?><?php endif; ?></ul></div><div class="web_jc" style="margin-left:8px;"><?php   $link6 = get_category_link( $theme_options["liuhaoID"] );?><h2><span class="more right"><a href="<?php echo $link6;?>">更多>></a></span><span class="h2_txt"><?php $thiscat = get_category($theme_options["liuhaoID"]); echo $thiscat ->name;?></span></h2><ul><?php query_posts('cat='.$theme_options["liuhaoID"].'&showposts=10'); ?><?php if (have_posts()) : while (have_posts()) : the_post(); ?><li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><span class="right"><?php the_time('m-d') ?></span><?php echo cut_str($post->post_title,34); ?></a></li><?php endwhile; else : ?><?php endif; ?></ul></div><div class="web_jc" style="margin-left:7px;"><?php   $link7 = get_category_link( $theme_options["qihaoID"] );?><h2><span class="more right"><a href="<?php echo $link7;?>">更多>></a></span><span class="h2_txt"><?php $thiscat = get_category($theme_options["qihaoID"]); echo $thiscat ->name;?></span></h2><ul><?php query_posts('cat='.$theme_options["qihaoID"].'&showposts=10'); ?><?php if (have_posts()) : while (have_posts()) : the_post(); ?><li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><span class="right"><?php the_time('m-d') ?></span><?php echo cut_str($post->post_title,34); ?></a></li><?php endwhile; else : ?><?php endif; ?></ul></div><div style="clear:both"></div></div>--><?php wp_footer();?>    </div><script type="text/javascript">$(function (){$(window).toTop({showHeight : 100,});});</script><script language="javascript" src="<?php bloginfo('template_url'); ?>/js/roll_ul.js"></script>    <div style="clear:both"></div>  </div></div></body></html>