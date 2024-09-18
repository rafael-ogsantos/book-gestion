<?php

namespace app\modules\auth;

use Yii;
use yii\rest\Controller;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(string $id, $module, AuthService $authService, array $config = [])
    {
        $this->authService = $authService;
        parent::__construct($id, $module, $config);
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        
        $behaviors['contentNegotiator']['formats']['application/json'] = yii\web\Response::FORMAT_JSON;
        
        return $behaviors;
    }

    public function actionLogin()
    {
        try {
            $data = Yii::$app->request->post();

            $result = $this->authService->login($data);

            Yii::$app->response->statusCode = $result['status'];

            return $this->authService->login($data);
        } catch (\Exception $e) {
            Yii::$app->response->statusCode = 500;
            return ['error' => $e->getMessage()];
        }
    }
}
