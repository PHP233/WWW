<div class="nav">
<div id="nav-menu">
<div class="container">
<div class="outerbox">
<div class="innerbox clearfixmenu">
<ul class="menu">
<li class="stmenu"><h3><a href="/wordpress/" class="xialaguang" title="首页"><span>首页</span></a></h3></li>
<li class="stmenu"><h3><a href="/wpjiaocheng/" class="xialaguang" title="申请立项"><span>申请立项</span></a></h3></li>
<li class="stmenu"><h3><a href="/wordpress/wp-login.php" class="xialaguang" title="站内管理"><span>站内管理</span></a></h3></li>

<li class="overlay">
</li>
</ul>
<script type="text/javascript">$('#nav-menu .menu > li').hover(function() {$(this).find('.children').animate({ opacity:'show', height:'show' },300);$(this).find('.xialaguang').addClass('navhover');}, function() {$('.children').stop(true,true).slideUp(100);$('.xialaguang').removeClass('navhover');}).slice(-3,-1).find('.children').addClass('sleft');</script>
</div></div></div></div>
</div>
<div class="search">
<form  name="formsearch" class="form" action="<?php bloginfo('url')?>" autocomplete="off">
<input type="text" name="s" size="24" class="search-keyword"  id="inputString" onkeyup="lookup(this.value);" onblur="fill();" class="f-text"/>
<input type="submit" class="search-submit"  id="search-submit" value="搜 索" />
<div class="suggestionsBox" id="suggestions" style="display: none;"> 
<div class="suggestionList"><ul id="autoSuggestionsList"></ul></div> </div> </form>
</div>
