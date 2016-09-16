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
			return Yii::$app->getResponse()->redirect('/index.php?r=technarticlecate/index');
		} else {
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
			Technarticlecate::edit($post);
			return Yii::$app->getResponse()->redirect('/index.php?r=technarticlecate/index');
		} else {
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
			Technarticlecate::editimg($post, $_FILES);
			return Yii::$app->getResponse()->redirect('/index.php?r=technarticlecate/index');
		} else {
			return $this->render('editimg', [
			    'info' => $info,
			]);
		}
	}
	
	// 删除用户
	public function actionDel() {
		$get = Yii::$app->request->get();
		$id = $get['id'];
		Technarticlecate::del($id);
		// return Yii::$app->getResponse()->redirect('/index.php?r=technarticlecate/index');
	}
	
	// 文章分类详情
	public function actionDetail() {
		$get = Yii::$app->request->get();
		$id = $get['id'];
		$info = Technarticlecate::getinfo($id);
		return $this->render('detail', [
		    'info' => $info,
		]);
	}
}
