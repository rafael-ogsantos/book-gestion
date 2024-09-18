<?php

namespace app\commands;

use app\modules\user\models\User;
use Yii;
use yii\console\Controller;

class UserController extends Controller
{
    public function actionCreate($username, $password, $name)
    {
        $user = new User();
        $user->username = $username;
        $user->password_hash = Yii::$app->security->generatePasswordHash($password);
        $user->name = $name;
        $user->authKey = Yii::$app->security->generateRandomString();
        $user->accessToken = Yii::$app->security->generateRandomString(); 

        if ($user->save()) {
            echo "Usuário cadastrado com sucesso.\n";
        } else {
            echo "Erro ao cadastrar usuário:\n";
            foreach ($user->errors as $error) {
                echo "- " . implode("\n- ", $error) . "\n";
            }
        }
    }
}