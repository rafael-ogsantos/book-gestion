<?php

use yii\db\Migration;

/**
 * Class m240918_024014_add_default_value_to_access_token_in_users_table
 */
class m240918_024014_add_default_value_to_access_token_in_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('users', 'accessToken', $this->string()->notNull()->defaultValue(''));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240918_024014_add_default_value_to_access_token_in_users_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240918_024014_add_default_value_to_access_token_in_users_table cannot be reverted.\n";

        return false;
    }
    */
}
