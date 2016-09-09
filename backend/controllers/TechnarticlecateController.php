<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\Technarticlecate;

/**
 * Site controller
 */
class TechnarticlecateController extends Controller
{
    //public $layout = false;
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
                        'actions' => ['login', 'error', 'index', 'add', 'insert'],
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
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
		// 获取权限管理的相关菜单
		// $res = Auth::find()->where(['level'=>1])->asArray()->all(); // 获取所有数据
		$auth = Auth::find()->select('name, controller, action')->where(['pid'=>1])->asArray()->all(); // 
		return $this->render('index', [
		    'auth' => $auth,
			'source' => $source
		]);
    }
	
    /**
     * 添加界面 
     */
    public function actionAdd()
    {
        /* tp
        $info = $this -> getinfo(); // 获取顶级,次顶级权限
        $this -> assign('info', $info);
        $this -> display(); */
    }
}
