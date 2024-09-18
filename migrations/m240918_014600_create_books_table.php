<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%books}}`.
 */
class m240918_014600_create_books_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%books}}', [
            'id' => $this->primaryKey(),
            'isbn' => $this->string()->null(),
            'titulo' => $this->string()->null(),
            'autor' => $this->string()->null(),
            'preco' => $this->string()->null(),
            'estoque' => $this->decimal(10, 2)->null(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%books}}');
    }
}
