<?php
show_admin_bar(false);
/********gzip压缩****/
function gzippy() {

ob_start('ob_gzhandler');

}

if(!stristr($_SERVER['REQUEST_URI'], 'tinymce') && !ini_get('zlib.output_compression')) {

add_action('init', 'gzippy');

}
/*搜索结果优化*/
add_action('template_redirect', 'v7v3_single_post');
function v7v3_single_post() {
    if (is_search()) {
        global $wp_query;
        if ($wp_query->post_count == 1) {
            wp_redirect( get_permalink( $wp_query->posts['0']->ID ) );
        }
    }
}
//不准内页页面相互ping
function no_self_ping( &$links ) {
	$home = get_option( 'home' );
	foreach ( $links as $l => $link )
	if ( 0 === strpos( $link, $home ) )
	unset($links[$l]);
	}
add_action( 'pre_ping', 'no_self_ping' );
/*****************定义url常量*******************/
define('THEME_URI', get_template_directory_uri() . '/');



//删去留言框链接
remove_filter('comment_text', 'make_clickable', 9);
//文字截断
function cut_str($src_str,$cut_length)
{
$return_str='';
$i=0;
$n=0;
$str_length=strlen($src_str);
while (($n<$cut_length) && ($i<=$str_length))
{
$tmp_str=substr($src_str,$i,1);
$ascnum=ord($tmp_str);
if ($ascnum>=224)
{
$return_str=$return_str.substr($src_str,$i,3);
$i=$i+3;
$n=$n+2;
}
elseif ($ascnum>=192)
{
$return_str=$return_str.substr($src_str,$i,2);
$i=$i+2;
$n=$n+2;
}
elseif ($ascnum>=65 && $ascnum<=90)
{
$return_str=$return_str.substr($src_str,$i,1);
$i=$i+1;
$n=$n+2;
}
else
{
$return_str=$return_str.substr($src_str,$i,1);
$i=$i+1;
$n=$n+1;
}
}
if ($i<$str_length)
{
$return_str = $return_str . '';
}
if (get_post_status() == 'private')
{
$return_str = $return_str . '（private）';
}
return $return_str;
}
//页面描述去除换行
function v7v3_deletehtml($str) {  
    return trim(strip_tags($str)); 
} 
add_filter('tag_description', 'v7v3_deletehtml');

//禁止wptexturize函数
remove_filter('the_content', 'wptexturize');
remove_action('pre_post_update', 'wp_save_post_revision' );
add_action( 'wp_print_scripts', 'disable_autosave' );
function disable_autosave() {
    wp_deregister_script('autosave');
}
//定义后台登录错误信息
function failed_login() {
    return '噢，貌似你填错了什么！';
}
add_filter('login_errors', 'failed_login');
//标题截断
function excerpttitle($max_length) {   
$title_str = get_the_title();   
if (mb_strlen($title_str,'utf-8') > $max_length ) {   
$title_str = mb_substr($title_str,0,$max_length,'utf-8').'...';   
}   
return $title_str;   
}  
//分页函数
function wp_pagenavi($range = 5){
	global $paged, $wp_query;
	if ( !$max_page ) {
		$max_page = $wp_query->max_num_pages;
	}
	if($max_page > 1){
		if(!$paged){
			$paged = 1;
		}
		if($paged != 1){
			echo "<a href='" . get_pagenum_link(1) . "' class='last' title='跳转到首页'> 首页 </a>";
		}
		previous_posts_link(' 上一页 ');
		if($max_page > $range){
			if($paged < $range){
				for($i = 1; $i <= ($range + 1); $i++){
					if($i==$paged) echo "<a class='current'>$i</a>";
					else echo "<a href='" . get_pagenum_link($i) ."'>$i</a>";
				}
			}
			elseif($paged >= ($max_page - ceil(($range/2)))){
				for($i = $max_page - $range; $i <= $max_page; $i++){
					if($i==$paged) echo "<a class='current'>$i</a>";
					else echo "<a href='" . get_pagenum_link($i) ."'>$i</a>";
				}
			}
			elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){
				for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){
					if($i==$paged) echo "<a class='current'>$i</a>";
					else echo "<a href='" . get_pagenum_link($i) ."'>$i</a>";
				}
			}
		}
		else{
			for($i = 1; $i <= $max_page; $i++){
				if($i==$paged) echo "<a class='current'>$i</a>";
				else echo "<a href='" . get_pagenum_link($i) ."'>$i</a>";
			}
		}
		next_posts_link(' 下一页 ');
		if($paged != $max_page){
			echo "<a href='" . get_pagenum_link($max_page) . "' class='extend' title='跳转到最后一页'> 末页 </a>";
		}
	}
}

add_action('admin_init', 'v7v3_blogroll_settings_api_init');
function v7v3_blogroll_settings_api_init() {
    add_settings_field('v7v3_blogroll_setting', '友情链接', 'v7v3_blogroll_setting_callback_function', 'reading');
    register_setting('reading','v7v3_blogroll_setting');
}
 
function v7v3_blogroll_setting_callback_function() {
    echo '<textarea name="v7v3_blogroll_setting" rows="10" cols="50" id="v7v3_blogroll_setting" class="large-text code">' . get_option('v7v3_blogroll_setting') . '</textarea>
	<br/>按照 链接 | 标题 的方式输入所有的友情链接。
	';
}

function v7v3_blogroll(){
    $v7v3_blogroll_setting =  get_option('v7v3_blogroll_setting');
    if($v7v3_blogroll_setting){
        $v7v3_blogrolls = explode("\n", $v7v3_blogroll_setting);
        foreach ($v7v3_blogrolls as $v7v3_blogroll) {
            $v7v3_blogroll = explode("|", $v7v3_blogroll );
            echo '<a href="'.trim($v7v3_blogroll[0]).'" title="'.esc_attr(trim($v7v3_blogroll[1])).'">'.trim($v7v3_blogroll[1]).'</a>';
        }
    }
}

function v7v3_seo() {
    do_action('v7v3_seo');
}

include TEMPLATEPATH. '/do/adm-do.php'; 

remove_action( 'wp_head', 'wp_enqueue_scripts', 1 ); 
remove_action( 'wp_head', 'feed_links', 2 ); 
remove_action( 'wp_head', 'feed_links_extra', 3 ); 
remove_action( 'wp_head', 'rsd_link' ); 
remove_action( 'wp_head', 'wlwmanifest_link' );  
remove_action( 'wp_head', 'index_rel_link' );
remove_action('wp_head', 'parent_post_rel_link', 10, 0 );
remove_action('wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'wp_generator' ); 
include TEMPLATEPATH. '/seo/postx.php'; 
include TEMPLATEPATH. '/do/action/jscss.php'; 
include TEMPLATEPATH. '/do/action/seo.php'; 

function catch_that_image() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches [1] [0];
   
  if(empty($first_img)){ 
    $first_img = "/images/default.jpg";
  }
  return $first_img;
}


add_filter( 'avatar_defaults', 'fb_addgravatar' );
function fb_addgravatar( $avatar_defaults ) {
$myavatar = get_bloginfo('template_directory') . '/images/gravatar.png';
  $avatar_defaults[$myavatar] = '自定义头像';
  return $avatar_defaults;
}

// 评论回复/头像缓存
function weisay_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment;
global $commentcount,$wpdb, $post;
     if(!$commentcount) { //初始化楼层计数器
          $comments = $wpdb->get_results("SELECT * FROM $wpdb->comments WHERE comment_post_ID = $post->ID AND comment_type = '' AND comment_approved = '1' AND !comment_parent");
          $cnt = count($comments);//获取主评论总数量
          $page = get_query_var('cpage');//获取当前评论列表页码
          $cpp=get_option('comments_per_page');//获取每页评论显示数量
         if (ceil($cnt / $cpp) == 1 || ($page > 1 && $page  == ceil($cnt / $cpp))) {
             $commentcount = $cnt + 1;//如果评论只有1页或者是最后一页，初始值为主评论总数
         } else {
             $commentcount = $cpp * $page + 1;
         }
     }
?>
<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
   <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
      <?php $add_below = 'div-comment'; ?>
		<div class="comment-author vcard"><?php if (get_option('swt_type') == 'Display') { ?>
			<?php
				$p = 'avatar/';
				$f = md5(strtolower($comment->comment_author_email));
				$a = $p . $f .'.jpg';
				$e = ABSPATH . $a;
				if (!is_file($e)){ //当头像不存在就更新
				$d = get_bloginfo('wpurl'). '/avatar/default.jpg';
				$s = '40'; //头像大小 自行根据自己模板设置
				$r = get_option('avatar_rating');
				$g = 'http://www.gravatar.com/avatar/'.$f.'.jpg?s='.$s.'&d='.$d.'&r='.$r;
                $avatarContent = file_get_contents($g);
                file_put_contents($e, $avatarContent);
				if ( filesize($e) == 0 ){ copy($d, $e); }
				};
			?>
			<img src='<?php bloginfo('wpurl'); ?>/<?php echo $a ?>' alt='' class='avatar' />
                <?php { echo ''; } ?>
			<?php } else { include(TEMPLATEPATH . '/comment_gravatar.php'); } ?>
					<div class="floor"><?php
 if(!$parent_id = $comment->comment_parent){
   switch ($commentcount){
     case 2 :echo "沙发";--$commentcount;break;
     case 3 :echo "板凳";--$commentcount;break;
     case 4 :echo "地板";--$commentcount;break;
     default:printf('%1$s楼', --$commentcount);
   }
 }
 ?>
         </div><strong><?php comment_author_link() ?></strong>:<?php edit_comment_link('编辑','&nbsp;&nbsp;',''); ?></div>
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<span style="color:#C00; font-style:inherit">您的评论正在等待审核中...</span>
			<br />			
		<?php endif; ?>
		<?php comment_text() ?>
        
		<div class="clear"></div><span class="datetime"><?php comment_date('Y-m-d') ?> <?php comment_time() ?> </span> <span class="reply"><?php comment_reply_link(array_merge( $args, array('reply_text' => '[回复]', 'add_below' =>$add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?></span>
  </div>
<?php
}
function weisay_end_comment() {
		echo '</li>';
}

//登陆显示头像
function weisay_get_avatar($email, $size = 48){
return get_avatar($email, $size);
}