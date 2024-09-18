<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%clients}}`.
 */
class m240918_013943_create_clients_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%clients}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->null(),
            'cpf' => $this->string()->null(),
            'email' => $this->string()->null(),
            'logradouro' => $this->string()->null(),
            'number' => $this->string()->null(),
            'cidade' => $this->string()->null(),
            'estado' => $this->string()->null(),
            'complemento' => $this->string()->null(),
            'sexo' => "ENUM('M', 'F')",
            'timestamp' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%clients}}');
    }
}
