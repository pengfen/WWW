<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Log;

/**
 * ������־��¼
 * ����: caopeng
 * ʱ��: 2016-09-16
*/
class LogController extends Controller
{
	/**
	 * ʹ���Զ�������actionǰ�ù���
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
	
	// ��ɫ�б�
	public function actionIndex()
	{
		$info = Log::getinfo();
		return $this->render('index', [
		    'info' => $info,
		]);
	}
	
	public function actionDetail()
	{
		$get = Yii::$app->request->get();
		$id = $get['id'];
		$info = Log::getinfo($id);
		return $this->render('detail', [
		    'info' => $info,
		]);
	}
}