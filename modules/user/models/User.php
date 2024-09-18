<?php

namespace app\modules\user\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class User extends ActiveRecord implements IdentityInterface
{
    public static function tableName()
    {
        return 'users';
    }

    public function rules()
    {
        return [
            [['username', 'password_hash', 'name'], 'required'],
            [['username', 'name'], 'string', 'max' => 255],
            [['username'], 'unique'],
        ];
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['accessToken' => $token]);
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public function generateJwt()
    {
        $payload = [
            'id' => $this->id,
            'exp' => time() + 3600,
        ];

        return JWT::encode($payload, Yii::$app->params['jwtSecretKey'], 'HS256');
    }
}