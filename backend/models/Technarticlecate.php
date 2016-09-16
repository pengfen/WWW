<?php
namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\data\Pagination;

// 技术文章表 2016-09-16
class Technarticlecate extends ActiveRecord {
	
	// 定义对应的表名
	public static function tableName() {
		return '{{%techn_article_cate}}';
	}
	
	// 校验规则
	public function rules() {
		return [
		];
	}
	
	// 添加分类
	public function add($data, $file) {
		// 实例化数据表
		$cate = new self;
		$cate->catename = $data['catename'];
		$cate->pid = $data['pid'];
		// 获取当前管理员 id
		$manager = Yii::$app->session->get('manager');
		$cate->uid = $manager['id'];
		$cate->addtime = time();

		if (!empty($file)) {
			$newdir = 'upload/'.date('Y-m-d', time()).'/';
			$dir = Yii::$app->basePath.'/web/'.$newdir;
			$files = $file['img'];
			$info = Upload::upload($files, $dir, $newdir, 2000000, array('image/png', 'image/gif', 'image/jpeg'));
			//判断是否上传成功
			if ($info['success']){
				$cate->img = $info['info'];
			}
		}
		
		$cate->save();
		// 获取当前添加数据记录的ID
		$id = Yii::$app->db->getLastInsertId();
		$path = $cate->getPath($data['pid'], $id);
		// level 全路径里边中划线的个数
		$level = count(explode('-', $path)) - 1;
		$cate->id = $id;
		$cate->path = $path;
		$cate->level = $level;
	    $cate->save();
	}
	
	// 修改分类
	public static function edit($data) {
		$id = $data['id'];
		$manager = static::findOne($id);
		$manager->catename = $data['catename'];
		$manager->pid = $data['pid'];
		$manager->save();
	}
	
	// 修改分类关联图
	public static function editimg($data, $file) {
		$id = $data['id'];
		$cate = static::findOne($id);
		if (!empty($file)) {
			$newdir = 'upload/'.date('Y-m-d', time()).'/';
			$dir = Yii::$app->basePath.'/web/'.$newdir;
			$files = $file['img'];
			$info = Upload::upload($files, $dir, $newdir, 2000000, array('image/png', 'image/gif', 'image/jpeg'));
			//判断是否上传成功
			if ($info['success']){
				$cate->img = $info['info'];
				$cate->save();
			}
		}
	}
	
	// 删除
	public static function del($id) {
		$info = static::findOne($id);
		$data['image'] = $info->img; // 获取图片地址
		$res = $info->delete();
		if ($res) {
			// 图片回收
			Recycle::add($data);
			return Yii::$app->getResponse()->redirect('/index.php?r=technarticlecate/index');
		} else {
			echo '删除失败';
		}
	}
	
	/**
	  * 获取分类信息
	*/
	public static function getinfo($id = '', $flag = false){
		$cate = new self;
		
		// 获取某条信息
		if ($id) {
			return $cate::find()->select('id, pid, catename, addtime, level, img')->where(['id' => $id])->asArray()->one();
		}
		
		if ($flag == true) { // 只针对列表页进行分页显示
			$info = $cate::find()
			->select('id, catename, addtime, level')
			->where(['<', 'level', 2])
			->orderBy(['path' => SORT_ASC]);
			$pages = new Pagination(['totalCount' =>$info->count(), 'pageSize' => '10']);
            $model = $info->offset($pages->offset)->limit($pages->limit)->asArray()->all();
            $data['pages'] = $pages;
		} else {
			$model = $cate::find()
			->select('id, catename, addtime, level')
			->orderBy(['path' => SORT_ASC])->asArray()->all();
		}
		
		/* tp框架实现
		$auth = D('Auth');
		if ($flag == true){
			$map = array();
			$map['level'] = array('lt', 2);
			$info = $auth -> where($map) -> order('path asc') -> select();
		} else {
			$info = $auth -> order('path asc') -> select();
		}*/
		// 处理缩进关系(根据级别缩进)
		foreach ($model as $k => $v) {
			// echo $k.' : '.$v['level']; 0 : 0 1 : 1 2 : 1 3 : 0 4 : 1
			$model[$k]['catename'] = str_repeat("&nbsp;&nbsp;", $v['level']).$model[$k]['catename'];
		}
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