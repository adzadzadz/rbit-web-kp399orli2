<?php
namespace app\components;

use yii\filters\auth\HttpBearerAuth as Base;

class HttpBearerAuth extends Base
{
    public function authenticate($user, $request, $response)
    {
        $authHeader = $request->getHeaders()->get($this->header);

        if ($authHeader !== null) {
            if ($this->pattern !== null) {
                if (preg_match($this->pattern, $authHeader, $matches)) {
                    $authHeader = $matches[1];
                } else {
                    return null;
                }
            }

            $identity = \app\models\AuthToken::findIdentityByAccessToken($authHeader);
            //   $identity = $user->loginByAccessToken($authHeader, get_class($this));
            if ($identity === null) {
                $this->challenge($response);
                $this->handleFailure($response);
            }

            \Yii::$app->user->login($identity);
            return $identity;
        }

        return null;
    }
}
