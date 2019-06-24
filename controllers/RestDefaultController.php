<?php

namespace app\controllers;

use Yii;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use app\components\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use app\models\AuthToken;
use app\models\User;
use app\components\RestTemplate as REST;

class RestDefaultController extends \yii\rest\ActiveController
{
    public $modelClass = 'app\models\User';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'except' => ['options', 'login'],
            'authMethods' => [
                HttpBasicAuth::className(),
                HttpBearerAuth::className(),
                QueryParamAuth::className(),
            ],
        ];
        return $behaviors;
    }

    public function actionAdz()
    {
        $token = AuthToken::getToken(Yii::$app->user->id);
        return [
            'token' => $token
        ];
    }

    public function actionLogin()
    {
        $model = new \app\models\LoginForm;

        if ($model->load(['LoginForm' => Yii::$app->request->post()]) && $user = $model->login()) {
            $token = AuthToken::findOne(['user_id' => $user->id]);
            return REST::success([
                'displayName' => User::findOne($user->id)->profile->name,
                'userId' => $user->id,
                'token' => $token->token
            ]);
        }
        return REST::fail();
    }

    public function actionRequiredData()
    {
        $users = \app\models\User::find()->all();
        $classes = \app\models\TesterClass::find()->all();
        $cars = \app\models\Car::find()->all();
        
        $userList = [];
        foreach ($users as $user) {
            $userList[] = [
                'userId' => $user->id,
                'name'   => $user->profile->name
            ];
        }

        return REST::success([
            'users' => $userList,
            'classes' => $classes,
            'cars' => $cars
        ]);
    }

}
