<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <?php require 'head.php'?>
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/post-wz.css">
</head>
<body>
<div class="container bs-docs-container">
    <!-- 导航栏 -->
	<?php require 'tb-ty.php'?>
    <!-- 内容 -->
    <div class="row" style="margin-left: 0px">
        <!-- 文章详情部分 -->
        <div class="col-md-9" style="padding-left: 0">
	    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
        <div class="map"><span class="home_ico">当前位置：<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?> </span></div>

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
        <!-- 文章正文结束 -->
        </div>
        <div class="col-md-3">
		    <?php require 'sider_left.php'?>
        </div>
	<?php require 'y-j.php'?>
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php bloginfo('template_url'); ?>/js/bootstrap.min.js"></script>

</body>

</html>