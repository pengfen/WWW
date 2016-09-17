<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\Technarticlecate;

/**
 * 技术文章分类控制器
 * 作者: caopeng
 * 时间: 2016-09-16
 */
class TechnarticlecateController extends Controller
{
	/**
	 * 使用自定义类做action前置过滤
	 *
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => 'backend\filters\AccessFilter',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * 列表显示
     *
     * @return string
     */
    public function actionIndex()
    {
		$info = Technarticlecate::getinfo('', true); // 获取所有权限信息
		Log::log("technarticlecate,action:index,文章技术分类列表"); // 记录日志
		return $this->render('index',[
		    'info' => $info['model'],
		    'pages' => $info['pages'],
		]);
    }
	
	// 添加文章分类
	public function actionAdd()
	{
		$post = Yii::$app->request->post();
		$info = Technarticlecate::getinfo(); // 获取所有权限信息
		if ($post) {
			Technarticlecate::add($post, $_FILES);
			Log::log("technarticlecate,action:add,文章技术分类列表单击添加文章分类"); // 记录日志
			return Yii::$app->getResponse()->redirect('/index.php?r=technarticlecate/index');
		} else {
			Log::log("technarticlecate,action:add,添加文章分类界面单击添加文章分类"); // 记录日志
			return $this->render('add', [
			    'info' => $info['model'],
			]);
		}
	}
	
	// 修改管理用户
	public function actionEdit() {
		$get = Yii::$app->request->get();
		$id = $get['id'];
		$data = Technarticlecate::getinfo($id);
		$info = Technarticlecate::getinfo(); // 获取所有权限信息
		$post = Yii::$app->request->post();
		if ($post) {
			Log::log("technarticlecate,action:add,文章分类界面单击修改"); // 记录日志
			Technarticlecate::edit($post);
			return Yii::$app->getResponse()->redirect('/index.php?r=technarticlecate/index');
		} else {
			Log::log("technarticlecate,action:add,修改分类界面单击修改文章分类"); // 记录日志
			return $this->render('edit', [
			    'info' => $info['model'],
				'data' => $data,
			]);
		}
	}
	
	// 修改分类关联图
	public function actionEditimg() {
		$get = Yii::$app->request->get();
		$id = $get['id'];
		$info = Technarticlecate::getinfo($id);
		$post = Yii::$app->request->post();
		if ($post) {
			Log::log("technarticlecate,action:editimg,文章分类界面单击修改关联图"); // 记录日志
			Technarticlecate::editimg($post, $_FILES);
			return Yii::$app->getResponse()->redirect('/index.php?r=technarticlecate/index');
		} else {
			Log::log("technarticlecate,action:editimg,修改关联图界面单击修改关联图"); // 记录日志
			return $this->render('editimg', [
			    'info' => $info,
			]);
		}
	}
	
	// 删除用户
	public function actionDel() {
		$get = Yii::$app->request->get();
		$id = $get['id'];
		Log::log("technarticlecate,action:del,文章分类界面单击删除"); // 记录日志
		Technarticlecate::del($id);
		// return Yii::$app->getResponse()->redirect('/index.php?r=technarticlecate/index');
	}
	
	// 文章分类详情
	public function actionDetail() {
		$get = Yii::$app->request->get();
		$id = $get['id'];
		$info = Technarticlecate::getinfo($id);
		Log::log("technarticlecate,action:detail,文章分类界面单击详情"); // 记录日志
		return $this->render('detail', [
		    'info' => $info,
		]);
	}
}
