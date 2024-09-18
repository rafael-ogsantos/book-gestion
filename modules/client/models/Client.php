<?php

namespace app\modules\client\models;

use Yii;

/**
 * This is the model class for table "clients".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $cpf
 * @property string|null $email
 * @property string|null $logradouro
 * @property string|null $number
 * @property string|null $cidade
 * @property string|null $estado
 * @property string|null $complemento
 * @property string|null $sexo
 * @property string $timestamp
 */
class Client extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clients';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sexo'], 'string'],
            [['timestamp'], 'safe'],
            [['name', 'cpf', 'email', 'logradouro', 'number', 'cidade', 'estado', 'complemento'], 'string', 'max' => 255],
            ['cpf', 'match', 'pattern' => '/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/', 'message' => 'CPF inválido. O formato correto é XXX.XXX.XXX-XX.'],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'cpf' => 'Cpf',
            'email' => 'Email',
            'logradouro' => 'Logradouro',
            'number' => 'Number',
            'cidade' => 'Cidade',
            'estado' => 'Estado',
            'complemento' => 'Complemento',
            'sexo' => 'Sexo',
            'timestamp' => 'Timestamp',
        ];
    }
}
