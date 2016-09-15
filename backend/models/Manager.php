<?php
namespace backend\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

// 管理员表
class Manager extends ActiveRecord implements IdentityInterface {
	
	const STATUS_DELETED = 0; // 无效用户
	const STATUS_ACTIVE = 1; // 有效用户
	
	// 定义对应的表名
	public static function tableName() {
		return '{{%manager}}';
	}
	
	/**
     * 根据用户名查找密码
     *
     * @param string $username
     * @return 密码|null
     */
    public static function findByUsername($username)
    {
        //return static::findOne(['username' => $username, 'state' => self::STATUS_ACTIVE]);
		$manager = new self;
		return $manager::find()->select('id,password')->where(['username' => $username])->asArray()->one();
		//return $info;
    }
	
	// 列表数据
	public static function getinfo($id = '') {
		$manager = new self;
		if ($id) {
			$info = $manager::find()->select('id, rid, username, email, regtime')->where(['id' => $id])->asArray()->one();
		} else {
			$info = $manager::find()->select('id, rid, username, regtime')->asArray()->all();
		}
		return $info;
	}
	
	// 添加数据
	public static function add($data) {
		$manager = new self;
		$manager->username = $data['username'];
		$manager->password = $data['password'];
		$manager->regtime = time();
		$manager->email = $data['email'];
		$manager->save();
	}
	
	// 修改数据
	public static function edit($data) {
		$id = $data['id'];
		$manager = static::findOne($id);
		$manager->username = $data['username'];
		$manager->password = $data['password'];
		$manager->email = $data['email'];
		$manager->save();
	}
	
		// 删除
	public static function del($id) {
		$info = static::findOne($id);
		$res = $info->delete(); // 删除数据库中删除
		if ($res) {
			// 调用成功
		}
	}
	
	
	/**
	 * ---------------------------------------
	 * 以下是继承 IdentityInterface 实现的方法
	 *
	*/
	/**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }
    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }
	
    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
	
    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

}