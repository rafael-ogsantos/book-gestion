<?php

namespace app\modules\user;

use app\modules\user\models\User;
use yii\rest\Controller;
use yii\web\Response;
use Yii;

class UserController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => \yii\filters\auth\HttpBearerAuth::class,
            'except' => ['login'],
        ];
        $behaviors['contentNegotiator'] = [
            'class' => \yii\filters\ContentNegotiator::class,
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];
        return $behaviors;
    }

    public function actionIndex()
    {
        $clients = User::find()->all();
        Yii::$app->response->statusCode = 200;
        return $clients;
    }
}