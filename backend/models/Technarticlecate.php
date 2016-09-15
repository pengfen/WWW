<?php
namespace backend\models;

use yii\db\ActiveRecord;
use yii\data\Pagination;

// 技术文章表 2016-09-15
class Technarticlecate extends ActiveRecord {
	
	// 定义对应的表名
	public static function tableName() {
		return '{{%techn_article_cate}}';
	}
	
	// 校验规则
	public function rules() {
		return [
		    ['title', 'required', 'message'=>'标题不能为空'],
			['content', 'required', 'message'=>'内容不能为空'],
		];
	}
	
	/**
	  * 获取分类信息
	*/
	public function getinfo(){
		//$cate = new Technarticlecate();
		$cate = new self;
		$info = $cate::find()
			->select('id, catename')
			->orderBy(['path' => SORT_ASC]);
		$pages = new Pagination(['totalCount' =>$info->count(), 'pageSize' => '10']);
        $model = $info->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        $data['pages'] = $pages;
		
		// 处理缩进关系(根据级别缩进)
		// foreach ($model as $k => $v) {
		// 	// echo $k.' : '.$v['level']; 0 : 0 1 : 1 2 : 1 3 : 0 4 : 1
		// 	$model[$k]['name'] = str_repeat("&nbsp;&nbsp;", $v['level']).$model[$k]['name'];
		// }
		$data['model'] = $model;
		return $data;
	}

	/**
	  * 获取全路径
	  * $pid 权限父id
	  * $id 记录id 
	*/
	private function getPath($pid, $id){
		// path 父级全路径与本身id 的连接信息 如 1-3 (顶级权限则为id本身)
		if ($pid == 0) {
			$path = $id; // 顶级权限
		} else { // 1-3 ...
			/* tp框架查找
			$pinfo = $this -> find($pid);
			$p_path = $pinfo['path']; */
			$pinfo = Auth::find()->select('path')->where(['id' => $pid])->asArray()->one();
			$p_path = $pinfo['path'];
			$path = $p_path.'-'.$id;
		}
		return $path;
	}
}