<?php
if ( !class_exists('myCustomFields') ) {

class myCustomFields {
/**
* @var  string  $prefix  自定义栏目名的前缀
*/
var $prefix = 'v7v3comwp_';
/**
* @var  array  $postTypes  包含了标准的“文章”、“页面”和自定义文章类型的数组，自定义栏目面板将出现在这些文章类型中
*/
var $postTypes = array( "page", "post" );

/**
* @var  array  $customFields  定义了所有的自定义栏目
*/
var $customFields =    array(
array(
"name"            => "keywords",
"title"            => "页面关键词keywords",
"description"    => "（当前页面关键词，可以选填，不填则自动截取文章标签作为关键词。）",
"type"            =>    "text",
"scope"            =>    array( "post" ),
"capability"    => "edit_posts"
),
array(
"name"            => "description",
"title"            => "页面描述description",
"description"    => "（当前页面描述，可以选填，不填则自动截取文章前200字。）",
"type"            =>    "textarea",
"scope"            =>    array( "post" ),
"capability"    => "edit_posts"
),
array(
"name"            => "robot",
"title"            => "是否屏蔽本页搜索引擎引索",
"description"    => "（默认为不屏蔽，勾选后为屏蔽。原理：通过页面META NAME='ROBOTS' CONTENT='NOINDEX, NOFOLLOW'属性屏蔽）<br/><b>PS：图文类文章只需上传图片即可，主题或自动抓取文章内图片作为列表页封面</b>",
"type"            => "checkbox",
"scope"            =>    array( "post", "page" ),
"capability"    => "edit_posts"
),

);
/**
* 用于兼容 PHP 4 的构造函数
*/
function myCustomFields() { $this->__construct(); }
/**
* 用于 PHP 5 的构造函数
*/
function __construct() {
add_action( 'admin_menu', array( &$this, 'createCustomFields' ) );
add_action( 'save_post', array( &$this, 'saveCustomFields' ), 1, 2 );
// 如果想要保留 WordPress 自带“自定义栏目”面板，请注释下一行
add_action( 'do_meta_boxes', array( &$this, 'removeDefaultCustomFields' ), 10, 3 );
}
/**
* 移除 WordPress 自带“自定义栏目”面板
*/
function removeDefaultCustomFields( $type, $context, $post ) {
foreach ( array( 'normal', 'advanced', 'side' ) as $context ) {
foreach ( $this->postTypes as $postType ) {
remove_meta_box( 'postcustom', $postType, $context );
}
}
}
/**
* 创建新的“自定义栏目”面板
*/
function createCustomFields() {
if ( function_exists( 'add_meta_box' ) ) {
foreach ( $this->postTypes as $postType ) {
add_meta_box( 'my-custom-fields', '简蓝CMS主题优化设置', array( &$this, 'displayCustomFields' ), $postType, 'normal', 'high' );
}
}
}
/**
* 显示新的“自定义栏目”面板
*/
function displayCustomFields() {
global $post;
?>
<div>
<?php
wp_nonce_field( 'my-custom-fields', 'my-custom-fields_wpnonce', false, true );
foreach ( $this->customFields as $customField ) {
// 范围检查
$scope = $customField[ 'scope' ];
$output = false;
foreach ( $scope as $scopeItem ) {
if ( $post->post_type == $scopeItem ) {
$output = true;
break;
}
}
// 权限检查
if ( !current_user_can( $customField['capability'], $post->ID ) )
$output = false;
// 如果允许，则输出
if ( $output ) { ?>
<div>
<?php
switch ( $customField[ 'type' ] ) {
case "checkbox": {
// 输出复选框
echo '<label for="' . $this->prefix . $customField[ 'name' ] .'" style="display:inline;"><b>' . $customField[ 'title' ] . '</b></label>&nbsp;&nbsp;';
echo '<input type="checkbox" name="' . $this->prefix . $customField['name'] . '" id="' . $this->prefix . $customField['name'] . '" value="yes"';
if ( get_post_meta( $post->ID, $this->prefix . $customField['name'], true ) == "yes" )
echo ' checked="checked"';
echo '" style="width: auto;" />';
break;
}
case "textarea":
case "wysiwyg": {
// 输出多行文本框
echo '<label for="' . $this->prefix . $customField[ 'name' ] .'"><b>' . $customField[ 'title' ] . '</b></label>';
echo '<textarea name="' . $this->prefix . $customField[ 'name' ] . '" id="' . $this->prefix . $customField[ 'name' ] . '" cols="170" rows="5">' . htmlspecialchars( get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) ) . '</textarea>';
// 输出富文本编辑框
if ( $customField[ 'type' ] == "wysiwyg" ) { ?>
<script type="text/javascript">
jQuery( document ).ready( function() {
jQuery( "<?php echo $this->prefix . $customField[ 'name' ]; ?>" ).addClass( "mceEditor" );
if ( typeof( tinyMCE ) == "object" && typeof( tinyMCE.execCommand ) == "function" ) {
tinyMCE.execCommand( "mceAddControl", false, "<?php echo $this->prefix . $customField[ 'name' ]; ?>" );
}
});
</script>
<?php }
break;
}
default: {
// 输出单行文本框
echo '<label for="' . $this->prefix . $customField[ 'name' ] .'"><b>' . $customField[ 'title' ] . '</b></label>';
echo '<input style="height: 30px;width:100%;" type="text" name="' . $this->prefix . $customField[ 'name' ] . '" id="' . $this->prefix . $customField[ 'name' ] . '" value="' . htmlspecialchars( get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) ) . '"/>';
break;
}
}
?>
<?php if ( $customField[ 'description' ] ) echo '<p>' . $customField[ 'description' ] . '</p>'; ?>
</div>
<?php
}
} ?>
</div>
<?php
}
/**
* 保存自定义栏目的值
*/
function saveCustomFields( $post_id, $post ) {
if ( !wp_verify_nonce( $_POST[ 'my-custom-fields_wpnonce' ], 'my-custom-fields' ) )
return;
if ( !current_user_can( 'edit_post', $post_id ) )
return;
if ( ! in_array( $post->post_type, $this->postTypes ) )
return;
foreach ( $this->customFields as $customField ) {
if ( current_user_can( $customField['capability'], $post_id ) ) {
if ( isset( $_POST[ $this->prefix . $customField['name'] ] ) && trim( $_POST[ $this->prefix . $customField['name'] ] ) ) {
$value = $_POST[ $this->prefix . $customField['name'] ];
// 为富文本框的文本自动分段
if ( $customField['type'] == "wysiwyg" ) $value = wpautop( $value );
update_post_meta( $post_id, $this->prefix . $customField[ 'name' ], $value );
} else {
delete_post_meta( $post_id, $this->prefix . $customField[ 'name' ] );
}
}
}
}

} // End Class

} // End if class exists statement

// 实例化类
if ( class_exists('myCustomFields') ) {
$myCustomFields_var = new myCustomFields();
} ?>