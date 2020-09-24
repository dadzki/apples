<?php


namespace common\bootstrap;

use apple\services\auth\AuthService;
use apple\services\auth\PasswordResetService;
use apple\services\auth\SignService;
use apple\services\auth\VerifyEmailService;
use apple\services\ContactService;
use Yii;
use yii\base\BootstrapInterface;
use yii\caching\Cache;
use yii\mail\MailerInterface;

class SetUp implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $container = Yii::$container;

        $container->setSingleton(MailerInterface::class, function () use ($app) {
            return $app->mailer;
        });

        $container->setSingleton(Cache::class, function () use ($app) {
            return $app->cache;
        });

        $container->setSingleton(PasswordResetService::class);
        $container->setSingleton(SignService::class);
        $container->setSingleton(VerifyEmailService::class);
        $container->setSingleton(AuthService::class);

        $container->setSingleton(ContactService::class, [], [
            $app->params['adminEmail'],
        ]);
    }
}
