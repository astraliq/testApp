<?php

use yii\db\Migration;

/**
 * Class m221203_204523_add_console_auth_token_to_user_table
 */
class m221203_204523_add_console_auth_token_to_user_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}', 'console_auth_token', $this->string()->defaultValue(null));
    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'console_auth_token');
    }
}
