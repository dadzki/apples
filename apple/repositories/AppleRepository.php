<?php


namespace apple\repositories;

use apple\entities\Apple;

class AppleRepository
{
    public function getById($id): Apple
    {
        return Apple::findOne(['id' => $id]);
    }

    public function remove(Apple $apple): void
    {
        if (!$apple->delete()) {
            throw new \RuntimeException('Ошибка удаления.');
        }
    }

    public function save(Apple $apple): void
    {
        if (!$apple->save()) {
            throw new \RuntimeException('Ошибка сохранения.');
        }
    }
}
