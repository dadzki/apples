<?php

namespace apple\services\manage;

use apple\entities\User;

use apple\forms\manage\User\UserCreateForm;
use apple\forms\manage\User\UserEditForm;
use apple\repositories\UserRepository;

class UserManageService
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(UserCreateForm $form): User
    {
        $user = User::create(
            $form->username,
            $form->email,
            $form->password
        );

        $user->save();

        return $user;
    }


    public function edit($id, UserEditForm $form): void
    {
        $user = $this->repository->getById($id);

        $user->edit(
            $form->username,
            $form->email
        );

        $user->save($user);
    }

    public function remove($id): void
    {
        $user = $this->repository->getById($id);

        $this->repository->remove($user);
    }
}
