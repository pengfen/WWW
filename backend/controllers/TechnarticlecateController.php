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
		// 获取所有分类信息
		$cate = Technarticlecate::getinfo();
		return $this->render('index', [
		    'cate' => $cate,
		]);
    }
	
    /**
     * 添加界面 
     */
    public function actionAdd()
    {
        $curl = curl_init("http://localhost:8080/data/wel");
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);			// 执行之后不直接打印出来
        $con = curl_exec($curl);
        curl_close($curl);
		$res = json_decode($con);
        var_dump($res);
		exit;
		/* tp
        $info = $this -> getinfo(); // 获取顶级,次顶级权限
        $this -> assign('info', $info);
        $this -> display(); */
    }
}
