<?php


namespace apple\repositories;

use apple\entities\Apple;
use yii\data\ActiveDataProvider;

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

    public function getByTree($id): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => Apple::find()
                ->andWhere(['tree_id' => $id])
                ->orderBy(['id' => SORT_DESC]),
            'sort' => false,
        ]);
    }

    public function save(Apple $apple): void
    {
        if (!$apple->save()) {
            throw new \RuntimeException('Ошибка сохранения.');
        }
    }
}
