<?php

namespace app\http\middleware;

use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Yii;
use yii\base\Component;

class JwtAuth extends Component
{
    public function authenticate()
    {
        $request = Yii::$app->request;
        $token = $request->getHeaders()->get('Authorization');

        if ($token === null) {
            throw new UnauthorizedHttpException('Token not provided');
        }

        // Remove "Bearer " do token
        $token = str_replace('Bearer ', '', $token);

        try {
            $decoded = JWT::decode($token, new Key(Yii::$app->params['jwtSecret'], 'HS256'));
            $userId = $decoded->sub;

            $user = \app\models\User::findIdentity($userId);
            if ($user === null) {
                throw new UnauthorizedHttpException('Invalid token');
            }

            return $user;

        } catch (\Exception $e) {
            throw new UnauthorizedHttpException('Invalid token');
        }
    }
}