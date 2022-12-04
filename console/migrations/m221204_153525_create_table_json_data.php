<?php

use yii\db\Migration;

/**
 * Class m221204_153525_create_table_json_data
 */
class m221204_153525_create_table_json_data extends Migration
{
    public function safeUp()
    {
        $this->createTable('json_data', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'data' => $this->json()->notNull(),
            'date_create' => $this->timestamp()->defaultExpression("now()"),
            'date_update' => $this->timestamp()->defaultValue(null)->append('ON UPDATE CURRENT_TIMESTAMP'),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('json_data');
    }
}
