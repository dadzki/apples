<?php

use yii\db\Migration;

/**
 * Class m200921_075522_add_user
 */
class m200921_075522_add_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('user', [
            'username' => 'user',
            'auth_key' => 'bJIczzEESO9AA7fOfw_3Xvk_97UttSEr',
            'password_hash' => '$2y$13$I1tUsv2GIiFKL.Vk06rrSOWGtEI1.tMb8KXe4yfx4K5GRuW1S/GpC',
            'email' => 'user@user.ru',
            'status' => 10,
            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('user', ['username' => 'user']);
    }
}
