<nav class="bs-docs-sidebar hidden-print hidden-xs hidden-sm affix-top">
	<p>
		<a href="/proposer" class="btn btn-info btn-lg btn-block" type="button" >
			项目申请
		</a>
	</p>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">战略合作</h3>
		</div>
		<div id="marqueediv1" class="panel-body">
			<ul class="list-group">
			  <li class="list-group-item">Cras justo odio111</li>
			</ul>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">顾问专家</h3>
		</div>
		<div id="marqueediv2" class="panel-body">
		<?php query_posts('cat='.$theme_options["tuwenID"]); ?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="media">
				<a href="<?php the_permalink(); ?>" style="text-decoration:none; color: #000">
			        <div class="media-left">
			           <img class="media-object" alt="64x64" src="<?php bloginfo('template_url'); ?>/img.php?src=<?php echo catch_that_image() ?>&w=300&h=210&zc=1" data-holder-rendered="true" style="width: 64px; height: 64px;">
			        </div>
			        <div class="media-body">
				        <h5 class="media-heading"><?php the_title(); ?></h5>
				        <p style="height: 60px; overflow: hidden;"><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 50,"..."); ?></p>
			        </div>
		        </a>
		    </div>
		<?php endwhile; else : ?>
		<?php endif; ?>
		</div>
	</div>
</nav>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/ms.js" ></script>
<script>
	new Marquee("marqueediv1", 0, 1, 191, 440, 10, 0, 0);
	new Marquee("marqueediv2", 0, 1, 191, 440, 10, 0, 0);
</script>