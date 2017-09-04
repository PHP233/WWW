<?php
function unregister_rss_widget(){
unregister_widget('WP_Widget_RSS');
unregister_widget('WP_Widget_Pages');
unregister_widget('WP_Widget_Text');
unregister_widget('WP_Widget_Categories');
unregister_widget('WP_Nav_Menu_Widget');
unregister_widget('WP_Widget_Search');
unregister_widget('WP_Widget_Recent_Posts');
unregister_widget('WP_Widget_Recent_Comments');
unregister_widget('WP_Widget_Archives');
unregister_widget('WP_Widget_Calendar');
unregister_widget('WP_Widget_Tag_Cloud');
unregister_widget('WP_Widget_Meta');
}
add_action('widgets_init','unregister_rss_widget');




