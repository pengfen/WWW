<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\Auth;
use yii\data\Pagination;

/**
 * Site controller
 */
class AuthController extends Controller
{
	/**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['error', 'index', 'add'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
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
		/* tp框架实现
		$info = $this -> getinfo(true); // 获取所有权限信息
		// 向模板中分配数据及显示模板
		$this -> assign('title', '权限列表');
		//$this -> assign('link', U('Auth/index'));
		$this -> assign('info', $info);
		$this -> display(); */
		$info = $this -> getinfo(true); // 获取所有权限信息
		return $this->render('index',[
		    'auth' => $info['model'],
		    'pages' => $info['pages'],
		]);
    }
	
	/**
	 * 添加界面
	*/
	public function actionAdd()
	{
		return $this->render('add');
	}
	
	/**
	  * 获取权限信息 
	  * @param $flag true 只查询顶级,次顶级权限 false 查询所有权限
	*/
	private function getinfo($flag = false){
		if ($flag == true) {
			$info = Auth::find()->select('id, name, controller, action, addtime, level')->where(['<', 'level', 2]);
		} else {
			$info = Auth::find()->select('id, name, controller, action, addtime, level');
		}
		$pages = new Pagination(['totalCount' =>$info->count(), 'pageSize' => '2']);
        $model = $info->offset($pages->offset)->limit($pages->limit)->asArray()->all();
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
			$model[$k]['name'] = str_repeat("&nbsp;&nbsp;", $v['level']).$model[$k]['name'];
		}
		$data['model'] = $model;
		$data['pages'] = $pages;
		return $data;
	}
}
