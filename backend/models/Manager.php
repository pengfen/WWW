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
		$cate = new self;
		$info = $cate::find()
			->select('id,password')
			->where(['username' => $username])
			->asArray()->one();
		return $info;
    }
	
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