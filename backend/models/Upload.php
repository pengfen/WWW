<?php

namespace backend\models;

// 上传文件
class Upload {

	/**
	  * 上传的函数
	  * @param arrray  $files	要上传的文件信息数组
	  * @param string	  $path  上传的目录		./uploads    ./uploads/
	  * @param int		  $allowSize	默认值 0（不验证大小）
	  * @param	array  $allowType	默认值 array()	如果是空数组 不验证类型		mime类型  
	  * @retrun   array	array('success'=>true/flase, 'info'=>上传路径/错误信息)		
	*/
	function upload($files, $path, $newdir, $allowSize=0, $allowType=array())
	{
	    $return = array('success'=>false, 'info'=>'');			//声明返回信息  默认是错误的
		$path = rtrim($path, '/').'/';							//重新处理路径

		if(!is_dir($path)) { // 如果目录不存在创建目录
		    mkdir($path, 0777, true);
		}
		
		//1. 判断是否错误
		if ($files['error'] != 0){
			//输出错误原因
			switch ($files['error']){
				case 1:  $info = "文件大小超过了php.ini中的限制！"; break;
				case 2:  $info = "文件大小超过了表单中的限制！"; break;
				case 3:  $info = "文件只被部分上传!"; break;
				case 4:  $info = "文件没有上传!"; break;
				case 6:  $info = "找不到临时目录!"; break;
				case 7:  $info = "文件写入失败！"; break;
			}
			$return['info'] = $info;
			return $return;
		}
		
		//2. 验证文件大小
		if ($allowSize != 0){
			if ($files['size'] > $allowSize){
				$return['info'] = "文件超过了限制，最大".$allowSize;
				return $return;
			}
		}
		
		//3. 验证 文件类型
		if (!empty($allowType)){
			if (!in_array($files['type'], $allowType)){
				$return['info'] = "文件类型不合法";
				return $return;
			}
		}
		
		//4. 生成新的文件名
		$suffix = pathinfo($files['name'], PATHINFO_EXTENSION);
		$newName = $newdir.uniqid().'.'.$suffix;
		
		//5. 执行移动
		if (is_uploaded_file($files['tmp_name'])){
			//执行移动
			if (move_uploaded_file($files['tmp_name'], $newName)){
				$return['success'] = true;
				$return['info'] = $newName;
			}else {
			    $return['info'] = "文件移动失败！";
			}
		}else {
			$return['info'] = '上传文件不合法！';
		}
		return $return;
		
	}
}