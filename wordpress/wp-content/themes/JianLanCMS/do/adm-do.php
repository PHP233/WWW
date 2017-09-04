<?php
class ControlPanel {
/********************************************************
Create a unique array that contains all theme settings
********************************************************/
var $default_settings = Array(
	'enable_video' => 1,
	'enable_aboutusLink' => 1,
	'enablePhotoGallery' => 1,
	'enableFlickronFooter' => 1,
	'enable_about' => 1,
	'tuwenID' => '3',
	'erhaoID' => '4',
	'sanhaoID' => '5',
	'sihaoID' => '6',
	'wuhaoID' => '7',
	'bottomLeftCatID' => '8',
	'bottomRightCatID' => '9,10,11',
	'bpnewID' => '9',
	'newID1' => '1',
	'newID2' => '2',
	'newID3' => '3',
	'newID4' => '4',
	'newID5' => '5',
	'newID6' => '6',
	'newID7' => '7',
	'newID8' => '8',
	'newID9' => '9',
	'softPopularID' => '10',
	'liuhaoID' => '11',
	'qihaoID' => '12',
	'videoCatID' => '12',
	'photoGalleryCatID' => '13',		
	'leftColPostCount' => '1',
	'firstTabPostCount' => 1,
	'secondTabPostCount' => 1,
	'thirdTabPostCount' => 1,
	'fourthTabPostCount' => 1,
	'bottomLeftPostCount' => 3,
	'bottomRightPostCount' => 6,
	'videoPostCount' => '1',
	'photoQuantity' => 4,
	'bdfx' => '在这里输入460x120px的广告',
	'ad1' => '在这里输入720x80px的广告',
	'ad2' => '在这里输入230x80px的广告',
	'ad3' => '在这里输入720x80px的广告',
	'bddc' => '在这里输入720x80px的广告',
	'newad3' => '在这里输入230x80px的广告',
	'newad4' => '在这里输入650x80px的广告',
	'newad5' => '在这里输入300x100px的广告',
	'newad6' => '在这里输入250x250px的广告',
	'blad' => '在这里输入16条文字链广告',
	'ad12501' => '125_125ad.gif',
	'ad12502' => '125_125ad.gif',
	'ad12503' => '125_125ad.gif',
	'ad12504' => '125_125ad.gif',
	'urlad12501' => '',
	'urlad12502' => '',
	'urlad12503' => '',
	'urlad12504' => '',
	'flickrID' => '14415997@N07',
	'flickrPhotoCount' => '14',
	'titleAbout' => 'ABOUT _SITE NAME_',
	'titleFlickr' => 'FLICKR PHOTO STREAM',
	'sitekeywords' => '默认关键词',
	'sitedescription' => '默认描述',	
	'title' => '维7维3',			
	'recentCommentCount' => '3',
	'excludeCat' => '',
	'excludePage' => '',
	'feedburnerID' => '',
	'recpostCount' => '10',
);
	
var $options;
function ControlPanel() {
	add_action('admin_menu', array(&$this, 'add_menu'));
 	add_action('admin_head', array(&$this, 'admin_head'));
	if (!is_array(get_option('jianlan')))
 	add_option('jianlan', $this->default_settings);
 
 	$this->options = get_option('jianlan');
}
function add_menu() {
 	add_theme_page('Theme Settings', '简蓝主题设置', 'edit_themes', "jianlan", array(&$this, 'optionsmenu'));
}
function admin_head() {
	echo '
	<script type="text/javascript" src="' .get_template_directory_uri(). '/js/jquery.idTabs.min.js"></script>
	<style type="text/css" media="screen">@import url( ' .get_template_directory_uri(). '/css/controlpanel.css );</style>';
}

function optionsmenu() {
if ($_POST['ss_action'] == 'save') {
 	$this->options["enable_video"] = isset($_POST['cp_enable_video']) ? 1 : 0;
	$this->options["enablePhotoGallery"] = isset($_POST['cp_enablePhotoGallery']) ? 1 : 0;
	$this->options["enableFlickronFooter"] = isset($_POST['cp_enableFlickronFooter']) ? 1 : 0;
	$this->options["enable_about"] = isset($_POST['cp_enable_about']) ? 1 : 0;
	$this->options["enable_aboutusLink"] = isset($_POST['cp_enable_aboutusLink']) ? 1 : 0;
	$this->options["tuwenID"] = $_POST['cp_tuwenID'];
	$this->options["erhaoID"] = $_POST['cp_erhaoID'];
	$this->options["sanhaoID"] = $_POST['cp_sanhaoID'];
	$this->options["sihaoID"] = $_POST['cp_sihaoID'];
	$this->options["wuhaoID"] = $_POST['cp_wuhaoID'];
	$this->options["bottomLeftCatID"] = $_POST['cp_bottomLeftCatID'];
	$this->options["bottomRightCatID"] = $_POST['cp_bottomRightCatID'];
	$this->options["newID1"] = $_POST['cp_newID1'];
	$this->options["newID2"] = $_POST['cp_newID2'];
	$this->options["newID3"] = $_POST['cp_newID3'];
	$this->options["newID4"] = $_POST['cp_newID4'];
	$this->options["newID5"] = $_POST['cp_newID5'];
	$this->options["newID6"] = $_POST['cp_newID6'];
	$this->options["newID7"] = $_POST['cp_newID7'];
	$this->options["newID8"] = $_POST['cp_newID8'];
	$this->options["newID9"] = $_POST['cp_newID9'];
	$this->options["softPopularID"] = $_POST['cp_softPopularID'];
	$this->options["liuhaoID"] = $_POST['cp_liuhaoID'];	
	$this->options["qihaoID"] = $_POST['cp_qihaoID'];
	$this->options["bpnewID"] = $_POST['cp_bpnewID'];
	$this->options["videoCatID"] = $_POST['cp_videoCatID'];
	$this->options["leftColPostCount"] = $_POST['cp_leftColPostCount'];
	$this->options["firstTabPostCount"] = $_POST['cp_firstTabPostCount'];
	$this->options["secondTabPostCount"] = $_POST['cp_secondTabPostCount'];
	$this->options["thirdTabPostCount"] = $_POST['cp_thirdTabPostCount'];
	$this->options["fourthTabPostCount"] = $_POST['cp_fourthTabPostCount'];
	$this->options["bottomLeftPostCount"] = $_POST['cp_bottomLeftPostCount'];
	$this->options["bottomRightPostCount"] = $_POST['cp_bottomRightPostCount'];	
	$this->options["videoPostCount"] = $_POST['cp_videoPostCount'];
	$this->options["photoGalleryCatID"] = $_POST['cp_photoGalleryCatID'];
	$this->options["photoQuantity"] = $_POST['cp_photoQuantity'];
	$this->options["titleLeftColumn"] = $_POST['cp_titleLeftColumn'];
	$this->options["titleFirstTab"] = $_POST['cp_titleFirstTab'];
	$this->options["titleSecondTab"] = $_POST['cp_titleSecondTab'];
	$this->options["titleThirdTab"] = $_POST['cp_titleThirdTab'];
	$this->options["titleFourthTab"] = $_POST['cp_titleFourthTab'];
	$this->options["titleBottomLeft"] = $_POST['cp_titleBottomLeft'];
	$this->options["titleBottomRight"] = $_POST['cp_titleBottomRight'];
	$this->options["titlePopular"] = $_POST['cp_titlePopular'];
	$this->options["titleTags"] = $_POST['cp_titleTags'];
	$this->options["bdfx"] = stripslashes($_POST['cp_bdfx']);
	$this->options["ad1"] = stripslashes($_POST['cp_ad1']);
	$this->options["ad2"] = stripslashes($_POST['cp_ad2']);
	$this->options["ad3"] = stripslashes($_POST['cp_ad3']);
	$this->options["bddc"] = stripslashes($_POST['cp_bddc']);
	$this->options["newad3"] = stripslashes($_POST['cp_newad3']);
	$this->options["newad4"] = stripslashes($_POST['cp_newad4']);
	$this->options["newad5"] = stripslashes($_POST['cp_newad5']);
	$this->options["newad6"] = stripslashes($_POST['cp_newad6']);
	$this->options["blad"] = stripslashes($_POST['cp_blad']);
	$this->options["titleRecentPosts"] = $_POST['cp_titleRecentPosts'];
	$this->options["titleAdvertisement"] = $_POST['cp_titleAdvertisement'];
	$this->options["titleLinks"] = $_POST['cp_titleLinks'];
	$this->options["titleArchive"] = $_POST['cp_titleArchive'];
	$this->options["titleComments"] = $_POST['cp_titleComments'];
	$this->options["titlea"] = $_POST['cp_titlea'];
	$this->options["titleb"] = $_POST['cp_titleb'];
	$this->options["titlec"] = $_POST['cp_titlec'];
	$this->options["softPopular"] = $_POST['cp_softPopular'];
	$this->options["Populara"] = $_POST['cp_Populara'];
	$this->options["Popularb"] = $_POST['cp_Popularb'];
	$this->options["ad12501"] = $_POST['cp_ad12501'];
	$this->options["ad12502"] = $_POST['cp_ad12502'];	
	$this->options["ad12503"] = $_POST['cp_ad12503'];	
	$this->options["ad12504"] = $_POST['cp_ad12504'];	
	$this->options["urlad12501"] = $_POST['cp_urlad12501'];	
	$this->options["urlad12502"] = $_POST['cp_urlad12502'];	
	$this->options["urlad12503"] = $_POST['cp_urlad12503'];	
	$this->options["urlad12504"] = $_POST['cp_urlad12504'];	
	$this->options["flickrID"] = $_POST['cp_flickrID'];
	$this->options["titleFlickr"] = $_POST['cp_titleFlickr'];	
	$this->options["flickrPhotoCount"] = $_POST['cp_flickrPhotoCount'];	
	$this->options["titleAbout"] = $_POST['cp_titleAbout'];
	$this->options["recentCommentCount"] = $_POST['cp_recentCommentCount'];
	$this->options["excludeCat"] = $_POST['cp_excludeCat'];
	$this->options["excludePage"] = $_POST['cp_excludePage'];
	$this->options["feedburnerID"] = $_POST['cp_feedburnerID'];
	$this->options["aboutEntry"] = stripslashes($_POST['cp_aboutEntry']);
	$this->options["aboutusLink"] = $_POST['cp_aboutusLink'];
	$this->options["recpostCount"] = $_POST['cp_recpostCount'];	
	$this->options["sitekeywords"] = $_POST['cp_sitekeywords'];	
	$this->options["sitekeywords"] = $_POST['cp_sitekeywords'];	
	$this->options["title"] = $_POST['cp_title'];	
update_option('jianlan', $this->options);
echo '<div class="updated fade" id="message" style="background-color: rgb(255, 251, 204); width: 500px; margin-left: 50px"><p>恭喜，主题设置<strong>完成</strong>！</p></div>';
}
echo '
	<form action="" method="post" class="themeform">
	<fieldset>
<input type="hidden" id="ss_action" name="ss_action" value="save">
	<h1>简蓝主题设置选项页面（请严格按照教程设置，否则可能造成主题报错！）</h1>
<h5>主题综述：本主题适用于门户资讯类的网站，由于门户站栏目众多，为了追求更好的客户体验，请您花几分钟设置一下主题选项。</h5>
	请设置网站首页标题<strong>( Title )</strong>:<input class="widefat" style="width:370px" name="cp_title" id="cp_title" type="text" value="'.$this->options["title"].'" /><label for="cp_title"></label><br />
	请设置网站首页关键词 <strong>( Keywords )</strong>:<input class="widefat" style="width:370px" name="cp_sitekeywords" id="cp_sitekeywords" type="text" value="'.$this->options["sitekeywords"].'" /><label for="cp_sitekeywords"></label><br />
	请设置网站首页描述词 <strong>(Description)</strong>:<input class="widefat" style="width:570px" name="cp_sitedescription" id="cp_sitedescription" type="text" value="'.$this->options["sitedescription"].'" /><label for="cp_sitedescription"></label><br />	
	<ul id="ajaxtabs" class="idTabs">
		<li><a href="#panel1">设置首页栏目ID</a></li>
		<li><a href="#panel2">全局设置</a></li>

	</ul>
		
		
	<div class="ajaxtabsinner" id="panel1">
		<h5>首页文章布局设置(可以按需求将分类ID填入相应展位)： <a href="http://v7v3.com/jljc.php" target="_blank">具体安装教程</a> </h5>
		<input class="widefat" style="width:80px" name="cp_tuwenID" id="cp_tuwenID" type="text" value="'.$this->options["tuwenID"].'" /><label for="cp_tuwenID">一号图文模式展位分类ID</label><br />
		<input class="widefat" style="width:80px" name="cp_erhaoID" id="cp_erhaoID" type="text" value="'.$this->options["erhaoID"].'" /><label for="cp_erhaoID">二号文章列表分类ID</label><br />
		<input class="widefat" style="width:80px" name="cp_sanhaoID" id="cp_sanhaoID" type="text" value="'.$this->options["sanhaoID"].'" /><label for="cp_sanhaoID">三号文章列表分类ID</label><br />
		<input class="widefat" style="width:80px" name="cp_sihaoID" id="cp_sihaoID" type="text" value="'.$this->options["sihaoID"].'" /><label for="cp_sihaoID">四号文章列表分类ID</label><br />
		<input class="widefat" style="width:80px" name="cp_wuhaoID" id="cp_wuhaoID" type="text" value="'.$this->options["wuhaoID"].'" /><label for="cp_wuhaoID">五号文章列表分类ID</label><br />
	<input class="widefat" style="width:80px" name="cp_liuhaoID" id="cp_liuhaoID" type="text" value="'.$this->options["liuhaoID"].'" /><label for="cp_liuhaoID">六号文章列表分类ID</label><br />
	<input class="widefat" style="width:80px" name="cp_qihaoID" id="cp_qihaoID" type="text" value="'.$this->options["qihaoID"].'" /><label for="cp_qihaoID">七号文章列表表分类ID</label><br />
	</div>
	
	
	<div class="ajaxtabsinner" id="panel2">
		<h5 style="margin:15px 0 0;">（顶部百度分享代码，也可当做广告位）在这里输入代码</h5><textarea name="cp_bdfx" id="cp_bdfx" cols="80" rows="5">'.stripslashes($this->options["bdfx"]).'</textarea><br />
		<h5 style="margin:15px 0 0;">（首页文章列表中部广告代码）在这里输入广告代码</h5><textarea name="cp_ad1" id="cp_ad1" cols="80" rows="5">'.stripslashes($this->options["ad1"]).'</textarea><br />
		<h5 style="margin:15px 0 0;">（文章页标题下方内容上方广告位）在这里输入广告代码</h5><textarea name="cp_ad2" id="cp_bdfx" cols="80" rows="5">'.stripslashes($this->options["ad2"]).'</textarea><br />
		<h5 style="margin:15px 0 0;">（文章页相关文章推荐右侧广告位）在这里输入广告代码</h5><textarea name="cp_ad3" id="cp_ad3" cols="80" rows="5">'.stripslashes($this->options["ad3"]).'</textarea><br />
		<h5 style="margin:15px 0 0;">（文章页下方左部百度顶踩按钮代码）在这里输入广告代码</h5><textarea name="cp_bddc" id="cp_bddc" cols="80" rows="5">'.stripslashes($this->options["bddc"]).'</textarea><br />
	</div>		
		

		
	<p class="submit"><input type="submit" value="保存设置" name="cp_save" /></p>
	</fieldset>
</form>';
}
/********************************************************
END
********************************************************/
}
/********************************************************
New Control Panel - Do not remove!
********************************************************/
$cpanel = new ControlPanel();
$theme_options = get_option('jianlan');
function showthumb() {
	global $theme_options;
	if($theme_options['thumb'] == 1) {
	echo get_the_image(array('Thumbnail','My Thumbnail'),'thumbnail');
	} else {
}

}

function showthumb_i() {

	global $theme_options;

	if($theme_options['thumb_sub'] == 1 && $theme_options['thumb'] == 1) {
	echo get_the_image(array('Thumbnail','My Thumbnail'),'thumbnail');
	} else {
	}

}
 ?>
<?php
if( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'id' => 'list',
		'name' => '边栏设置',
		'before_widget' => '<li class="widget">',
		'after_widget' => '</li>',
		'before_title' => '<h3>', 
		'after_title' => '</h3>' 
 
	));

}

if( function_exists( 'register_sidebar_widget' ) ) {   
    register_sidebar_widget('热点推荐','hot');
	register_sidebar_widget('猜你喜欢','xihuan'); 
	register_sidebar_widget('最新文章','xin');
	register_sidebar_widget('随机图文','tuwen');
} 
function hot() { include(TEMPLATEPATH . '/do/action/hot.php'); }
function xihuan() { include(TEMPLATEPATH . '/do/action/list.php'); }
function xin() { include(TEMPLATEPATH . '/do/action/new.php'); }
function tuwen() { include(TEMPLATEPATH . '/do/action/tuwen.php'); }
include TEMPLATEPATH. '/do/action/del.php'; 