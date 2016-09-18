<style>
    .menu_info {
        width: 455px; height: 390px; background: #F2F2F2; margin: 10px; float: left;
    }
    h2 {
        margin-left: 10px; height: 40px; line-height: 40px;
    }
    span {
        margin-left: 10px; height: 30px; line-height: 30px;
    }
    img {
        width: 100%; height: auto;
    }
</style>
<?php 
foreach($pinfo as $val) {
	echo "<div class='menu_info'>";
	echo "<h2><a href='/index.php?r=auth/detail&id=".$val['id']."'>".$val['name']."</a></h2>";
	foreach($cinfo as $v) {
		if ($v['pid'] == $val['id'] && $v['isShow'] == 0) {
			$request = Yii::$app->request->getBaseUrl();
            echo "<span><a href='".$request."/index.php?r=".strtolower($v['controller'])."/".$v['action']."'>".$v['name']."</a></span>";
		}
	}
	echo "<a href='/index.php?r=auth/detail&id=".$val['id']."'><img src='".$val['image']."'/></a>";
	echo "</div>";
}
?>

<!--
<div class="menu_info">
    <h2>统计报表</h2>
    <span>权限列表</span><span>权限列表</span>
    <img src="../images/bg.png"/>
</div>

<div class="menu_info">
    目录管理
    <h2>会员管理</h2>
    <span>权限列表</span><span>权限列表</span>
    <img src="../images/bg.png"/>
</div>

<div class="menu_info">
    页面管理
    <h2>会员管理</h2>
    <span>权限列表</span><span>权限列表</span>
    <img src="../images/bg.png"/>
</div>

<div class="menu_info">
    课程管理
    <h2>会员管理</h2>
    <span>权限列表</span><span>权限列表</span>
    <img src="../images/bg.png"/>
</div>

<div class="menu_info">
    <h2>权限管理</h2>
    <span>权限列表</span><span>权限列表</span>
    <img src="../images/bg.png"/>
</div>

<div class="menu_info">
    其它管理
    分类管理
    实现及bug管理
    回收站管理
    <h2>会员管理</h2>
    <span>权限列表</span><span>权限列表</span>
    <img src="../images/bg.png"/>
</div>
-->
