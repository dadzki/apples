<?php

namespace apple\services;

use apple\entities\Tree;
use apple\repositories\TreeRepository;


class TreeService
{
    private $repository;

    public function __construct(
        TreeRepository $repository
    ) {
        $this->repository = $repository;
    }

    public function create($number, $description): Tree
    {
        $tree = Tree::create(
            $number,
            $description
        );

        $tree->save();

        return $tree;
    }

    public function edit($id, $number, $description): Tree
    {
        $tree = $this->repository->get($id);

        $tree->number = $number;
        $tree->description = $description;

        $this->repository->save($tree);

        return $tree;
    }
}
