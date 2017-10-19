<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo trim(wp_title('',0)); ?>_<? $paged = get_query_var('paged'); if ( $paged > 1 ) printf('第 %s 页 ',$paged); ?> - v7v3.com</title>
<link rel="stylesheet" type="text/css" href="http://v7v3code.cdn.duapp.com/css/so.css" />
<?php get_template_part('head','tongji'); ?>
</head>
<body>
<div class="doc">
	
	<div class="header-search">
        <div class="inner">
            <div class="logo"><a href="<?php bloginfo('url'); ?>"><img src="http://v7v3img.cdn.duapp.com/so_logo.png" width="155" height="70" alt="v7v3站内搜索"></a></div>
            <form id="q-form" method="get" action="<?php bloginfo('url'); ?>"> 
            <div class="search" id="q-input">
                <div class="cat"><a href="<?php bloginfo('url'); ?>" class="current">v7v3首页</a></div>
                <div class="input">
				<span class="kw">
				<input class="text ui-autocomplete-input" type="text" name="s" size="40" title="" value=""></span><input type="submit" class="btn-search" value=""></div>
               
            <ul class="ui-autocomplete ui-menu ui-widget ui-widget-content ui-corner-all" role="listbox" aria-activedescendant="ui-active-menuitem" style="z-index: 1; top: 0px; left: 0px; display: none;"></ul></div>
            </form>
        </div>
    </div>
    <div id="main" class="lo-wrap">
        <div class="filter">
            <div class="cat">
                <h2>本站目录</h2>
                <ul>
<?php wp_list_categories( $args ); ?>
                </ul>
            </div>
          
        </div>
        <div class="side-handle"><a id="toggle" href="javascript:void(0);" class="btn-close"></a></div>
        <div class="lo-main">
        	<div class="result">
                <div class="list">
       
                <?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
                		
		                       


                                                <div class="item">
                    <div class="i-title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" target="_blank"><?php the_title(); ?></a></div>
                    <div class="i-des"><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 200,"......","utf-8"); ?></div>
                    <div class="i-info"><?php the_permalink() ?> - <?php the_time('Y-m-d') ?></div>
                </div>
                <?php endwhile; ?>
				
				<?php else : ?>
                     <div class="empty">
					<h3>抱歉，未找到相符的网页。</h3>
					<h4>建议您：</h4>
					<ul>
						<li>请检查您输入的关键词是否有错误；</li>
						<li>换另一个相似的词，或常见的词试试。</li>
					</ul>
				</div>
<?php endif ?>
               
                                </div>
  
            	<div class="pages"><?php wp_pagenavi(); ?>
				</div>
				
				 
            </div>
            <div class="lo-side"></div>
	    <div class="fix"></div>
        </div>
    </div>
    
      <div class="footer">
        <p class="copyright_en">Copyright 20013-2014 v7v3.com Corporation,All Rights Reserved</p>
        <p class="copyright_zh">v7v3.com 版权所有
		</p>
    </div>
</div>
</body>
</html>