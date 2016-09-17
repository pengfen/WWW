<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\Technarticlecate;
use backend\models\Technarticle;
use backend\models\Upload;
use backend\models\Manager;
use backend\models\User;

/**
 * 技术文章控制器 (文章列表 添加文章 修改文章 文章详情)
 * 作者: caopeng
 * 时间: 2016-09-17
 */
class TechnarticleController extends Controller
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
     * 文章列表
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
		$info = Technarticlecate::getinfo('', true); // 获取所有权限信息
		return $this->render('add', [
		    'info' => $info['model'],
		]);
	}
	
	// 添加技术文章内容
	public function actionInsert() {
		// 获取表单数据
		$request = Yii::$app->request;
        $postData = $request->post();
		
		// 实例化数据表
		$Technarticle = new Technarticle();
		$Technarticle->title = $postData['title'];
		$Technarticle->pid = $postData['pid'];
		// 内容使用 htmlspecialchars 过滤 页面显示使用nl2br反过滤
		$Technarticle->content = htmlspecialchars($postData['content'], ENT_QUOTES);
        // 后台管理员添加
        $Technarticle->uid = '1';
        $Technarticle->addtime = time();

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
		$info = Technarticle::find()->select("uid, title, addtime, content, img, state")->where(['id'=>$id])->asArray()->one();
        if ($info['state'] == 0) {
            $model = new Manager;
        } else {
            $model = new User;
        }
        $user = $model::find()->select("username")->where(['id'=>$info['uid']])->asArray()->one();
        $info['username'] = $user['username'];
        return $this->render('detail', [
		    'info' => $info,
		]);
    } 
}
