<img class="img-responsive" src="<?php bloginfo('template_url'); ?>/images/button.gif" alt="">
<div class="row" style="margin-left: 0">
    <div class="col-sm-9">
        <ul class="list-inline" style="margin: 4% 0;">
	        <?php query_posts('cat=9'); ?>
	        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <li style="margin: 8px 0px"><a href="<?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 100); ?>"><?php echo the_title(); ?></a></li>
	        <?php endwhile; else : ?>
	        <?php endif; ?>
        </ul>
    </div>
    <div class="col-sm-3" style="text-align: right">
        <img src="<?php bloginfo('template_url'); ?>/images/cheng.jpg" alt="">
    </div>
</div>
<hr />
<p class="text-center" style="font-size: 12px;color: #A6A6A6;">中国基因行业标准化技术委员会...</p>
<p class="text-center" style="font-size: 12px;color: #A6A6A6;">联系电话：...</p>