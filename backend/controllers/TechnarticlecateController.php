<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\Auth;

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
                        'actions' => ['login', 'error','index'],
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
		echo 'kkkk';
		exit;
		// 获取权限管理的相关菜单
		// $res = Auth::find()->where(['level'=>1])->asArray()->all(); // 获取所有数据
		$auth = Auth::find()->select('name, controller, action')->where(['pid'=>1])->asArray()->all(); // 查询需要的字段
		// 获取资料管理的相关菜单
		$source = Auth::find()->select('name, controller, action')->where(['pid'=>14, 'isShow'=>0])->asArray()->all(); // 查询需要的字段
		return $this->render('index', [
		    'auth' => $auth,
			'source' => $source
		]);
    }
	
}
