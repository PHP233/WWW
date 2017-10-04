<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<?php v7v3_seo();?>

<?php  $keywords = get_post_meta($post->ID, "v7v3comwp_keywords", true);
    if($keywords == '') {
        $tags = wp_get_post_tags($post->ID);    
        foreach ($tags as $tag ) {        
            $keywords = $keywords . $tag->name . ", ";    
        }
        $keywords = rtrim($keywords, ', ');
    }
	?>
<meta name="keywords" content="<?php echo $keywords; ?>" />
<link href="<?php bloginfo('template_url'); ?>/css/post-wz.css" rel="stylesheet" type="text/css" />
<?php wp_head();?>
</head>

<body>
<div class="top"><div class="logo left"> 
<a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>">
<img src="<?php bloginfo('template_url'); ?>/images/logo.png" alt="<?php bloginfo('name'); ?>"/></a>
</div><div class="top_ad right">

<?php echo $theme_options["bdfx"]; ?>
</div>
</div>
<?php get_template_part('tb','ty'); ?>
<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
<div class="map"><span class="home_ico">当前位置：<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?> </span></div>

<div class="w972" style="margin-top:8px;">

<div class="article_article_left left">

  <div class="article_con">

    <h1 title="<?php the_title(); ?>"><?php the_title(); ?></h1>
<p class="info">

    &nbsp;&nbsp;&nbsp;作者:<?php bloginfo('name'); ?>&nbsp;&nbsp;&nbsp;发布时间:<?php the_time('Y-m-d') ?>&nbsp;&nbsp;&nbsp;
</p>
<div class="article_txt" id="a_fontsize">

	<?php the_content(); ?>

	<p style="color:#ccc;"><?php the_tags('本文标签：', ' , ' , '<br/>'); ?></p>

<?php endwhile; ?>	




    </div>

    <div class="contentpage">

        <ul>

           

        </ul>

        <div style="clear:both"></div>

        </div>

		


    <div class="share">
  <div class="shuming">  

如非注明文章借由<a href="/" title="<?php bloginfo('name')?>"><?php bloginfo('name')?></a>原创，转载请注明出处！<br/>
文章链接：<a href="<?php the_permalink(); ?>"><?php the_permalink(); ?></a><br/>
</div>
</div>

    <div class="related">

	<div class="xiangguan">

    	<h2>相关文章推荐</h2>

       	<ul>
					  			                          						<?php
$rand_posts = get_posts('numberposts=5&orderby=rand');
foreach( $rand_posts as $post ) :
?>
<li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
<?php endforeach; ?>
       </ul>

	   </div>

	   <div class="like_article_ad">

<?php echo $theme_options["ad3"]; ?>
	   </div>

	   <div style="clear:both"></div>

    </div>

    <div class="page">


    	<p>	<?php if (get_previous_post()) { previous_post_link('上一篇: %link');} else {echo "没有了，已经是最后文章";} ?></p>

        <p><?php if (get_next_post()) { next_post_link('下一篇: %link');} else {echo "没有了，已经是最新文章";} ?></p>

    </div>
<?php endif ?>	


  </div>

 

  <div class="duoshuo">
<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
  <h2><span>此评论不代表本站观点</span>大家说</h2>


<?php comments_template( '', true ); ?>

<?php endwhile; ?>	
<?php endif ?>	
  </div>

</div>


<div class="article_list_right right">
<?php if(is_dynamic_sidebar()) dynamic_sidebar('list');?>
</div>


<div style="clear:both"></div>

</div>
<?php wp_footer();?>

    </div>

    <div style="clear:both"></div>

  </div>

</div>

<script type="text/javascript">$(function (){$(window).toTop({showHeight : 100,});});</script>



</body>

</html>