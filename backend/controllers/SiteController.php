<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\Auth;
use backend\models\Manager;

/**
 * 后台首页
 * 作者: caopeng
 * 时间: 2016-09-11
*/
class SiteController extends Controller
{
	//public $layout = false; // 整个控制器不使用布局文件
	
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
     * 首页显示
     *
     * @return string
     */
    public function actionIndex()
    {
        // 获取权限管理的相关菜单
        // $res = Auth::find()->where(['level'=>1])->asArray()->all(); // 获取所有数据
        $auth = Auth::find()->select('name, controller, action')->where(['pid'=>1])->asArray()->all(); // 查询需要的字段
        // 获取资料管理的相关菜单
        $source = Auth::find()->select('name, controller, action')->where(['pid'=>14, 'isShow'=>0])->asArray()->all(); // 查询需要的字段
        return $this->render('index', [
            'auth' => $auth,
            'source' => $source
        ]);
        return $this->render('index');
    }

    /**
     * 登录页
     *
     * @return string
     */
    public function actionLogin()
    {
        $this->layout = false; // 此操作方法不使用布局文件
		
		if (Yii::$app->request->post()) {
            // 获取 post 请求数据
			$data = Yii::$app->request->post();
			$username = $data['username'];
			$password = $data['password'];
			$info = Manager::findByUsername($username);
			if ($info) {
				if ($info['password'] == md5($password)) {
                    $manager['id'] = $info['id'];
                    $manager['username'] = $username;
                    // 设置 session 数据
                    Yii::$app->session->set('manager', $manager);
					return $this->goBack();
				} else {
					return $this->render('login');
				}
			} else {
				return $this->render('login');
			}
		} else {
			return $this->render('login');
		}
		
        /*if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }*/
    }

    /**
     * 退出
     *
     * @return string
     */
    public function actionLogout()
    {
        // 删除 session
        Yii::$app->session->remove('manager');

        return $this->goHome();
    }
}
