<?php

use yii\db\Migration;

/**
 * Class m200925_073317_add_table_tree
 */
class m200925_073317_add_table_tree extends Migration
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

        $this->createTable('{{%tree}}', [
            'id' => $this->primaryKey(),
            'number' => $this->string()->notNull()->unique(),
            'description' => $this->text(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tree}}');
    }
}
