<?php


namespace apple\services\auth;


use apple\forms\LoginForm;
use apple\entities\User;
use apple\repositories\UserRepository;
use yii\mail\MailerInterface;

class AuthService
{
    /**
     * @var MailerInterface
     */
    private $mailer;

    protected $users;

    /**
     * ContactService constructor.
     * @param MailerInterface $mailer
     * @param UserRepository $users
     */
    public function __construct(MailerInterface $mailer, UserRepository $users)
    {
        $this->mailer = $mailer;
        $this->users = $users;
    }

    public function auth(LoginForm $form): User
    {
        $user = $this->users->findByUsernameOrEmail($form->username);
        if (!$user || !$user->isActive() || !$user->validatePassword($form->password)) {
            throw new \DomainException('Undefined user or password.');
        }
        return $user;
    }
}
