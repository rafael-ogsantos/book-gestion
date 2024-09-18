<?php

namespace app\modules\book\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "books".
 *
 * @property int $id
 * @property string|null $isbn
 * @property string|null $titulo
 * @property string|null $autor
 * @property float|null $preco
 * @property float|null $estoque
 */
class Book extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titulo', 'autor'], 'required', 'message' => '{attribute} não pode estar em branco.'],
            [['estoque', 'preco'], 'number'],
            [['isbn', 'titulo', 'autor'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'isbn' => 'ISBN',
            'titulo' => 'Título',
            'autor' => 'Autor',
            'preco' => 'Preço',
            'estoque' => 'Estoque',
        ];
    }
}