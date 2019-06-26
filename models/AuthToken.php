<?php

namespace app\models;

use Yii;
use dektrium\user\models\Token;

/**
 * This is the model class for table "{{%auth_token}}".
 *
 * @property string $token
 * @property int $company_id
 * @property int $user_id
 * @property int $verify_ip
 * @property string $user_ip
 * @property string $user_agent
 * @property int $frozen_expire
 * @property int $status
 * @property string $created_at
 * @property string $expired_at
 */
class AuthToken extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%auth_token}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['token', 'user_id'], 'required'],
            [['user_id', 'verify_ip', 'frozen_expire', 'status'], 'integer'],
            [['user_agent'], 'string'],
            [['created_at', 'expired_at'], 'safe'],
            [['token'], 'string', 'max' => 128],
            [['user_ip'], 'string', 'max' => 46],
        ];
    }


    public static function generateUniqueToken()
    {
        $token = Yii::$app->security->generateRandomString(128);
        $userToken = self::findOne(['token' => $token]);
        if (!$userToken) {
            return $token;
        }
        return self::generateUniqueToken();
    }

    public static function getToken($user_id)
    {
        if ($userToken = self::findOne(['user_id' => $user_id])) {
            return $userToken->token;
        }
        return null;
    }

    public static function findIdentityByAccessToken($token)
    {
        $token = self::findOne(['token' => $token]);
        return \app\models\User::findOne(['id' => $token->user_id]);
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'token' => 'Token',
            'company_id' => 'Company ID',
            'user_id' => 'User ID',
            'verify_ip' => 'Verify Ip',
            'user_ip' => 'User Ip',
            'user_agent' => 'User Agent',
            'frozen_expire' => 'Frozen Expire',
            'status' => 'Status',
            'created_at' => 'Created At',
            'expired_at' => 'Expired At',
        ];
    }
}
