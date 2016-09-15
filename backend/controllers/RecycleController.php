<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Recycle;

/**
 * 回收 (回收列表 回收请情 回收删除)
 * 作者: caopeng
 * 时间: 2016-09-15
*/
class RecycleController extends Controller
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
	
	// 回收列表
	public function actionIndex()
	{
		$info = Recycle::getinfo();
		return $this->render('index', [
		    'info' => $info,
		]);
	}
	/** tp框架实现
	public function index(){
		$info = D('ImageRecycle') -> select();
		$this -> assign('info', $info);
		$this -> display();
	}*/
	
	// 回收请情
	public function actionDetail()
	{
		$get = Yii::$app->request->get();
		$id = $get['id'];
		$info = Recycle::getinfo($id);
		return $this->render('detail', [
		    'info' => $info,
		]);
	}
	/** tp框架实现 
	public function detail(){
		$id = I('get.id');
		$info = D('ImageRecycle') -> find($id);
		$this -> assign('info', $info);
		$this -> display();
	}*/
	
	// 删除图片
	public function actionDel()
	{
		$get = Yii::$app->request->get();
		$id = $get['id'];
		Recycle::del($id);
		return Yii::$app->getResponse()->redirect('/index.php?r=recycle/index');
	}
	/** tp框架实现
	public function delete(){
		$id = I('get.id');
		$res = D('ImageRecycle') -> delete($id);
		if ($res) {
			// IO 流删除文件夹中的真实的图片
		}
		$mess = new MessController();
		$mess -> message($res, '删除成功', '删除失败', U('ImageRecycle/index', array('mess'=>'删除成功')));
	}*/
}