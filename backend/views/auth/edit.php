<style>
    .info {
		width: 90%; min-height: 800px; margin: 10px auto; background: #f2f2f2;
	}
	.info li {
		height: 49px; margin: 5px;
	}
	.label {
		width: 200px; line-height: 49px; font-size: 20px; font-weight: bold; display: inline-block; padding-left: 8px;
	}
	.info .info_title {
		width: 300px; height: 40px; padding-left: 8px; border-radius: 5px;
	}
	.info .info_pid {
		width: 200px; height: 40px; padding-left: 8px; border-radius: 5px;
	}
	.content_area, .content_area .label {
		height: 400px; line-height: 400px; 
	}
	.info .info_content {
		width: 1000px; height: 390px; padding-left: 8px; border-radius: 5px;
	}
	.info .info_btn {
		width: 160px; height: 39px; line-height: 39px; font-size: 16px; font-weight: bold; background: red; border-radius: 6px;
	}
</style>

<div class="info">
    <form action="/index.php?r=auth/upd" method="post">
    <input type="hidden" name="id" value="<?php echo $data['id'];?>">
	    <ul>
		    <li class="">
			    <span class="label">权限名</span>
				<input type="text" class="info_title" name="name" value="<?php echo $data['name'];?>"  placeholder=请输入权限名>
			</li>
			<li class="">
			    <span class="label">权限父级</span>
				<select class="info_pid" name="pid">
				    <option value='0'>请选择父级权限</option>
				    <?php
				    foreach ($info as $val) {
				    	if ($val['id'] == $data['pid']) {
				    		echo "<option value='".$val['id']."' selected>".$val['name']."</option>";
				    	} else {
				    		echo "<option value='".$val['id']."'>".$val['name']."</option>";
				    	}
				    }
				    ?>
				</select>
			</li>
			<li class="">
			    <span class="label">权限控制器</span>
				<input type="text" class="info_title" name="controller" value="<?php echo $data['controller'];?>" placeholder=请输入权限控制器名 >
			</li>
			<li class="">
			    <span class="label">权限操作方法</span>
				<input type="text" class="info_title" name="action" value="<?php echo $data['action'];?>" placeholder=请输入权限操方法名 >
			</li>
			<li class="">
			    <span class="label">添加时间</span>
				<span><?php echo date('Y-m-d H:i:s', $data['addtime']);?></span>
			</li>
			<li class="">
			    <span class="label"></span>
				<input type="submit" class="info_btn" value="修改权限"/>
			</li>
		</ul>
	</form>
</div>