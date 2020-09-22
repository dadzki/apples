<?php
namespace frontend\controllers;

use apple\services\auth\AuthService;
use frontend\forms\ResendVerificationEmailForm;
use frontend\forms\VerifyEmailForm;
use apple\services\auth\PasswordResetService;
use apple\services\auth\SignupService;
use apple\services\ContactService;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use apple\forms\auth\LoginForm;
use apple\forms\auth\PasswordResetRequestForm;
use apple\forms\auth\ResetPasswordForm;
use apple\forms\auth\SignupForm;
use apple\forms\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

}
