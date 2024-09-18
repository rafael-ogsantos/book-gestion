<?php

namespace app\modules\client;

use app\modules\client\models\Client;
use yii\rest\Controller;
use yii\web\Response;
use Yii;

class ClientController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => \yii\filters\auth\HttpBearerAuth::class,
        ];
        $behaviors['contentNegotiator'] = [
            'class' => \yii\filters\ContentNegotiator::class,
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];
        return $behaviors;
    }

    public function actionIndex($limit = 10, $offset = 0)
    {
        $clients = Client::find()->limit($limit)->offset($offset)->all();
        Yii::$app->response->statusCode = 200; 
        return $clients;
    }

 
    public function actionCreate()
    {
        $client = new Client();
        $data = Yii::$app->request->post();

        if ($client->load($data, '') && $client->validate()) {
            $client->save();
            Yii::$app->response->statusCode = 201; 
            return ['message' => 'Cliente cadastrado com sucesso', 'client' => $client];
        }
        
        Yii::$app->response->statusCode = 400; 
        return ['errors' => $client->errors];
    }

    public function actionView($id)
    {
        $client = Client::findOne($id);
        if ($client) {
            Yii::$app->response->statusCode = 200; 
        }
        
        Yii::$app->response->statusCode = 404;
        return ['error' => 'Cliente não encontrado'];
    }


    public function actionUpdate($id)
    {
        $client = Client::findOne($id);
        $data = Yii::$app->request->post();

        if (!$client) {
            Yii::$app->response->statusCode = 404;
            return ['error' => 'Cliente não encontrado'];
        }

        if ($client->load($data, '') && $client->validate()) {
            $client->save();
            Yii::$app->response->statusCode = 200;
            return ['message' => 'Cliente atualizado com sucesso', 'client' => $client];
        }

        Yii::$app->response->statusCode = 400;
        return ['errors' => $client->errors];
    }

    public function actionDelete($id)
    {
        $client = Client::findOne($id);
        if ($client) {
            $client->delete();
            Yii::$app->response->statusCode = 204; 
            return; 
        }

        Yii::$app->response->statusCode = 404; 
        return ['error' => 'Cliente não encontrado'];
    }
}
