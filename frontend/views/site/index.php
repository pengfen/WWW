<?php
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>首页</title>
	<link rel="stylesheet" type="text/css" href="">
</head>
<body>
	<div class="search_bar">
		<input type="text" name="search" id='search' value="" autocomplete="off" placeholder="请输入搜索词">
		<input type="button" name="btn" value="搜索">
	</div>
	<div class="search_content">
		<div class="content_area">
			<h3>内容标题</h3>
			<div>内容</div>
		</div>
	</div>

	<script type="text/javascript" src="<?=Url::to('@web/js/jquery-1.8.2.min.js')?>"></script>
	<script type="text/javascript" src="<?=Url::to('@web/js/jquery.autocomplete.min.js')?>"></script>
	<script type="text/javascript">
	    $('#search').autocomplete({
	        serviceUrl: 'index.php?r=site/expand',
	        onSelect: function (suggestion) {
	        	console.log('测试 ' + suggestion.value);
	        }
	    });
	</script>
</body>
</html>