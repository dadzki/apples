<?php

namespace apple\services;

use apple\entities\Apple;
use apple\entities\Color;
use apple\repositories\AppleRepository;
use apple\repositories\TreeRepository;


class AppleService
{
    private $repository;
    private $trees;

    public function __construct(
        AppleRepository $repository,
        TreeRepository $trees
    ){
        $this->repository = $repository;
        $this->trees = $trees;
    }

    public function create($treeId, $color = null): Apple
    {
        $tree = $this->trees->get($treeId);
        $apple = Apple::create(
            $tree->id,
            (new Color($color))->getValue()
        );

        $apple->save();

        return $apple;
    }

    public function fall(int $id): Apple
    {
        $apple = $this->repository->getById($id);
        $apple->fall();

        $this->repository->save($apple);

        return $apple;
    }

    public function eat(int $id, int $persent): Apple
    {
        $apple = $this->repository->getById($id);
        $apple->eat($persent);

        $this->repository->save($apple);

        return $apple;
    }

    public function remove($id): void
    {
        $apple = $this->repository->getById($id);

        $this->repository->remove($apple);
    }
}
