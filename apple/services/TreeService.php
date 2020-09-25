<?php

namespace apple\services;

use apple\entities\Tree;
use apple\repositories\TreeRepository;
use backend\forms\TreeForm;


class TreeService
{
    private $repository;

    public function __construct(
        TreeRepository $repository
    ) {
        $this->repository = $repository;
    }

    public function create(TreeForm $form): Tree
    {
        $tree = Tree::create(
            $form->number,
            $form->description
        );

        $tree->save();

        return $tree;
    }

    public function edit($id, TreeForm $form): Tree
    {
        $tree = $this->repository->get($id);

        $tree->number = $form->number;
        $tree->description = $form->description;

        $this->repository->save($tree);

        return $tree;
    }
}
