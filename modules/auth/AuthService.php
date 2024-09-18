<?php

namespace app\modules\auth;

use app\modules\auth\models\LoginForm;
use Yii;

class AuthService
{
    public function login($data)
    {
        $auth = new LoginForm();
        $auth->load($data, '');

        $login = $auth->login();
        if (!$login) {
            throw new \Exception('Login inválido');
        }              
        
        $user = Yii::$app->user->identity;

        $token = Yii::$app->security->generateRandomString();
        $user->accessToken = $token;
        $userSaved = $user->save();

        if (!$userSaved) {
            throw new \Exception('Erro ao salvar o token de acesso');
        }
            
        return [
            'status' => 200, 
            'message' => 'Login efetuado com sucesso', 
            'token' => $token,
        ];
    }
}