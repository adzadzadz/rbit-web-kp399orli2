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

    public function behaviors() {
        $behaviors = parent::behaviors();
    
        // remove authentication filter necessary because we need to 
        // add CORS filter and it should be added after the CORS
        unset($behaviors['authenticator']);
    
        // add CORS filter
        $behaviors['corsFilter'] = [
            'class' => '\yii\filters\Cors',
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
            ],
        ];
    
        // re-add authentication filter of your choce
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

        if ($model->load(['LoginForm' => Yii::$app->request->post()]) && $model->validate()) {
            $user = $model->login();
            $token = AuthToken::findOne(['user_id' => $user->id]);
            $me = User::findOne($user->id);
            return REST::success([
                'displayName' => isset($me->profile->name) ? $me->profile->name : $me->username,
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

    public function actionUploadData()
    {   
        $name = Yii::$app->request->post('name');
        $rawData = Yii::$app->request->post('data');
        
        $trailing_comma_fix_data_area = \str_replace("},],", "}], \"notes\" : ", $rawData);
        $trailing_comma_fix_notes_area = \str_replace(",]}end", "]}end", $trailing_comma_fix_data_area);
        preg_match_all('/({.+?)(?=end)/', $trailing_comma_fix_notes_area, $matches);

        foreach ($matches[0] as $match) {
            try {
                $data_array = json_decode($match);
                $locs = new \app\models\Locations;
                $locs->name = $name;
                $locs->data = json_encode(['raw' => $rawData]); // json_encode(["locations" => $data_array->data, "notes" => $data_array->notes]);
                if ($locs->save()) {
                    $paste = new \app\models\ClassCarLocation;
                    $paste->trainer_id = Yii::$app->user->id;
                    $paste->student_id = $data_array->student_id;
                    $paste->class_id   = $data_array->class_id;
                    $paste->car_id     = $data_array->car_id;
                    $paste->locations_id = $locs->id;
                    $paste->save();
                }
            } catch(\yii\db\Exception $e) {
                return REST::fail($e->message, $e->code);
            }
        }
        
        return REST::success($name);
    }

    private function remove_utf8_bom($text)
    {
        $bom = pack('H*','EFBBBF');
        $text = preg_replace("/^$bom/", '', $text);
        return $text;
    }

}
