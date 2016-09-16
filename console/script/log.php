<?php
/**
 * 将操作日志写进数据库 (定时执行)
 * 作者: caopeng
 * 时间: 2016-09-16
*/
	$cont = __DIR__ ; // D:\WWW\console\script
	$file = substr($cont, 0, -14)."common/config/main-local.php";
	$content = require_once($file);
	$db = $content['components']['db'];
	
	// 脚本执行日志记录
	$date = date('Y-m-d', time());
	$log = '/tmp/logs/log'.$date.'.log';
	
	// 连接数据库
	$dsn = $db['dsn'];
	$serv = explode(";", $dsn);
	if (isset($serv[0]) && isset($serv[1])) {
		// 获取数据库连接相关参数
		$host = explode(":", $serv[0]);
		$host = explode("=", $host[1]);
		$host = $host[1];
		$datebase = $serv[1];
		$username = $db['username'];
		$password = $db['password'];
		$pre = $db['tablePrefix'];
		
		// 连接数据库
		mysql_connect($host, $username, $password);
		mysql_select_db($datebase);
		mysql_query("set names 'utf8'");
		
		// 处理后台日志
		$file = substr($cont, 0, -14)."backend/runtime/logs/res.log.1";
		$content = file_get_contents($file);
		
		// 匹配时间
	    $pattern = "/<time>(.*?)<\/time>/ism";
        preg_match_all($pattern, $content, $match);
		if (isset($match[1])) {
			$time = $match[1];
			
			// 匹配处理内容
			$pattern = "/<text>(.*?)<\/text>/ism";
			preg_match_all($pattern, $content, $match);
			$cont = $match[1];
			
			// 拼接sql
			$sql = "insert into ".$pre."log(controller, action, content, flag, rectime, addtime, uid) values";
			foreach ($time as $key => $val) {
				$message = $cont[$key];
				$message = explode(',', $message);
				$uid = explode(':', $message[0]);
				$uid = $uid[1];
				$controller = explode(":", $message[1]);
				$controller = $controller[1];
				$action = explode(":", $message[2]);
				$action = $action[1];
				$content = $message[3];
				$rectime = strtotime($val);
				$sql .= "('{$controller}', '{$action}', '{$content}', 1, '{$rectime}', '".time()."', '{$uid}'),";
			}
			$sql = substr($sql, 0, -1);
			
			// 执行添加
			$res = mysql_query($sql);
			if ($res) {
				$message = '['.date('Y-m-d H:i:s', time()).'] 执行成功---当前执行sql是 : '.$sql.PHP_EOL;
			    file_put_contents($log, $message);
				echo $message;
				if (is_file($file)) {
					unlink($file); // 删除主机物理图片
				}
			} else {
				$message = '['.date('Y-m-d H:i:s', time()).'] 执行失败---当前执行sql是 : '.$sql.PHP_EOL;
		        file_put_contents($log, $message);
			}

		}
		exit;
	} else {
		$message = '['.date('Y-m-d H:i:s', time()).'] 配置文件错误'.PHP_EOL;
		file_put_contents($log, $message);
		exit;
	}
		
		
