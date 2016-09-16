<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\Auth;
use backend\models\Manager;
use backend\models\Log;

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
        // $auth = Auth::find()->select('name, controller, action')->where(['pid'=>1])->asArray()->all(); // 查询需要的字段
        // 获取资料管理的相关菜单
        // $source = Auth::find()->select('name, controller, action')->where(['pid'=>14, 'isShow'=>0])->asArray()->all(); // 查询需要的字段
        
		//return $this->render('index', [
        //    'auth' => $auth,
        //    'source' => $source
        //]);
		
		/* ---------------------- 日志配置 --------------------------
		 * ---------------------- 配置在 components 下---------------
		'log' => [
		    'flushInterval' => 1000, // 配置刷新默认为1000条
			'targets' => [
				[
					'class' => 'yii\log\FileTarget',
					'levels' => ['error'],
					'categories' => ['catalog'], // 分类策略
					'exportInterval' => 1000, // 配置导出消息 默认为1000条
					'logFile' => '@app/runtime/logs/res.log',
					'maxFileSize' => 1024 * 4, // 4M 换文件 文件会以 req.log, req.log.1 .... 一直换
					'maxLogFiles' => 20,
					'logVars' => [],
				],
			],
		],
		*/
		// 获取当前管理员 id
		$manager = Yii::$app->session->get('manager');
		$mid = $manager['id'];
		\Yii::error("id:{$mid}进入首页", 'catalog');
		
		// 查询顶级分类
		$pinfo = Auth::find()->select('id, image, name, controller, action')->where(['pid' => 0, 'isShow' => 0])->asArray()->all();
		// 查询非顶级分类
		$cinfo = Auth::find()->select('pid, name, controller, action, isShow')->where(['>', 'pid', 0])->asArray()->all();
        return $this->render('index', [
		    'pinfo' => $pinfo,
			'cinfo' => $cinfo,
		]);
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
					
					// 获取当前管理员 id
					//$manager = Yii::$app->session->get('manager');
					//$mid = $manager['id'];
					//\Yii::error("id:{$mid}登录成功", 'catalog');
					Log::log("site,action:login,登录成功"); // 记录日志
					
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
        Log::log("site,action:logout,退出登录"); // 记录日志
		
		// 删除 session
        Yii::$app->session->remove('manager');
        return $this->goHome();
    }
}
