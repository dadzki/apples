<?php


namespace apple\repositories;

use apple\entities\Tree;

class TreeRepository
{
    public function get($id): Tree
    {
        return Tree::findOne(['id' => $id]);
    }

    public function save(Tree $tree): void
    {
        if (!$tree->save()) {
            throw new \RuntimeException('Ошибка сохранения.');
        }
    }
}
