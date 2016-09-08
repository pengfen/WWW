<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\Technarticle;
use backend\models\Upload;
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
                        'actions' => ['login', 'error','index','add','insert', 'detail'],
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
		
		// 实例化数据表
		$Technarticle = new Technarticle();
		$Technarticle->title = $postData['title'];
		// 内容使用 htmlspecialchars 过滤 页面显示使用nl2br反过滤
		$Technarticle->content = htmlspecialchars($postData['content'], ENT_QUOTES);

        if (!empty($_FILES)) {
			$newdir = 'upload/'.date('Y-m-d', time()).'/';
			$dir = Yii::$app->basePath.'/web/'.$newdir;
			$files = $_FILES['img'];
			$info = Upload::upload($files, $dir, $newdir, 2000000, array('image/png', 'image/gif', 'image/jpeg'));
			//判断是否上传成功
			if ($info['success']){
				$Technarticle->img = $info['info'];
			}
		}
		

		// 校验 校验通过跳转到列表页 不通过跳转到添加页
		if ($Technarticle->validate()) {
			$Technarticle->save();
            return Yii::$app->getResponse()->redirect('/index.php?r=technarticle/index');
		} else {
			return $this->render('add', [
			    'errors'=>$Technarticle->getErrors(),
			]);
		}
	}

    // 查看详情
    public function actionDetail() {
		$request = Yii::$app->request->get();
		$id = $request['id'];
		$info = Technarticle::find()->where(['id'=>$id])->asArray()->one();
        return $this->render('detail', [
		    'info' => $info,
		]);
    } 
}
