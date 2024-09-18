<?php

namespace app\modules\book;

use Yii;
use yii\rest\Controller;
use yii\filters\auth\HttpBearerAuth;
use yii\web\Response;

class BookController extends Controller
{
    private $bookService;

    public function __construct($id, $module, BookService $bookService, $config = [])
    {
        $this->bookService = $bookService;
        parent::__construct($id, $module, $config);
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
        ];
        $behaviors['contentNegotiator'] = [
            'class' => \yii\filters\ContentNegotiator::class,
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];
        return $behaviors;
    }

    /**
     * Lista todos os livros cadastrados (responde com 200 OK).
     * Inclui suporte para paginação e filtros.
     * @param integer $limit Quantidade de livros por página.
     * @param integer $offset Posição inicial dos resultados.
     * @return array Lista de livros.
     */
    public function actionIndex($limit = 10, $offset = 0)
    {
        return $this->bookService->findAll($limit, $offset);
    }

    /**
     * Cadastra um novo livro (retorna 201 Created ou 400 Bad Request).
     * @return array Resposta contendo o livro cadastrado ou erros.
     */
    public function actionCreate()
    {
        try {
            $data = Yii::$app->request->post();
            $result = $this->bookService->create($data);

            Yii::$app->response->statusCode = $result['status'];

            return $result;
        } catch (\Exception $e) {
            Yii::$app->response->statusCode = 500;
            return ['error' => $e->getMessage()];
        }
    }
}
