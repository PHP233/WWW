<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf8" /><meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" /><title><?php echo trim(wp_title('',0)); ?>_标签tag页<? $paged = get_query_var('paged'); if ( $paged > 1 ) printf('第 %s 页 ',$paged); ?></title><meta name="description" content="<?php echo trim(strip_tags(tag_description())); ?><? $paged = get_query_var('paged'); if ( $paged > 1 ) printf('第 %s 页 ',$paged); ?>" /><meta name="keywords" content="<?php echo trim(wp_title('',0)); ?>" /><link href="<?php bloginfo('template_url'); ?>/css/article_list.css" rel="stylesheet" type="text/css" /><script language="javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.js"></script><script src="<?php bloginfo('template_url'); ?>/js/w3cer.js" type="text/javascript"></script></head><body><div class="top"><div class="logo left"> <a href="/" title="<?php bloginfo(name);?>"><img src="<?php bloginfo('template_url'); ?>/images/logo.png" alt="<?php bloginfo(name);?>"/></a></div><div class="top_ad right"><?php echo $theme_options["bdfx"]; ?></div></div><?php get_template_part('tb','ty'); ?><div class="map"><span class="home_ico">当前位置：<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?> </span></div>
<div class="article_list_con w972">
<div class="article_list_left left"><div class="article_lanmu"><h2><span class="h2_text"><?php echo trim(wp_title('',0)); ?></span></h2><?phpif (have_posts()) :while (have_posts()) : the_post();?><?php$category = get_the_category();   $name = $category[0]->cat_name;?><dl><dd class="arc_title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></dd>
<dd class="arc_desc"><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 240,"..."); ?></dd>
<dd class="arc_info"><span>所属栏目：<?php echo $name; ?></span>   <span>更新日期：<?php the_time('m-d') ?></span> <span><a rel="nofollow" href="<?php the_permalink() ?>">[阅读全文]</a></span></dd>
<div style="clear:both"></div></dl><?php endwhile; ?>
        </div>
    <div class="fanye">
        	<ul>			<?php wp_pagenavi(); ?>
        </ul>
        <div style="clear:both"></div> 
        </div><?php endif;?>
</div>
<div class="article_list_right right"><?php if(is_dynamic_sidebar()) dynamic_sidebar('list');?></div><div style="clear:both"></div>
</div>
<?php wp_footer();?>    </div>    <div style="clear:both"></div>  </div></div><script type="text/javascript">$(function (){$(window).toTop({showHeight : 100,});});</script></body></html>