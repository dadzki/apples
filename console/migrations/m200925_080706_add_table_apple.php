<?php

use yii\db\Migration;

/**
 * Class m200925_080706_add_table_apple
 */
class m200925_080706_add_table_apple extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%apple}}', [
            'id' => $this->primaryKey(),
            'color' => $this->string(),
            'created_date' => $this->integer(),
            'fall_date' => $this->integer()->defaultValue(null),
            'status' => $this->string(),
            'size' => $this->float()->defaultValue(1),
            'tree_id' => $this->integer(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%apple}}');
    }
}
