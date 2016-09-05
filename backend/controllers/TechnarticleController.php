<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\Technarticle;
use yii\web\UploadedFile;

/**
 * Site controller
 */
class TechnarticleController extends Controller
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
                        'actions' => ['login', 'error','index','add','insert'],
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
		$article = Technarticle::find()->select('id, uid, title, addtime, state')->asArray()->all(); 
		
		return $this->render('index', [
		    'article'=>$article,
		]);
    }

	
	// 添加技术文章
	public function actionAdd()
	{
		return $this->render('add');
		
	}
	
	// 添加技术文章内容
	public function actionInsert() {
		// 获取表单数据
		$request = Yii::$app->request;
        $postData = $request->post();
		var_dump($_FILES['img']);
		
		// 实例化数据表
		$Technarticle = new Technarticle();
		$Technarticle->title = $postData['title'];
		$Technarticle->content = $postData['content'];
		
		$Technarticle->img = UploadedFile::getInstance($Technarticle, 'img');
		var_dump($Technarticle->img);
		exit;
		
		// 校验 校验通过跳转到列表页 不通过跳转到添加页
		if ($Technarticle->validate()) {
			$Technarticle->file->saveAs('uploads/' . $Technarticle->file->baseName . '.' . $Technarticle->file->extension);
			$Technarticle->save();
			return $this->render('index');
		} else {
			return $this->render('add', [
			    'errors'=>$Technarticle->getErrors(),
			]);
		}
	}
}
