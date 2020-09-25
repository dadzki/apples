<?php
namespace backend\controllers;

use apple\repositories\AppleRepository;
use apple\services\AppleService;
use backend\forms\AppleEatForm;
use Yii;
use yii\web\Controller;


class AppleController extends Controller
{
    private $service;
    private $repository;

    public function __construct($id, $module, AppleService $service, AppleRepository $repository, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
        $this->repository = $repository;
    }

    /**
     * @return mixed
     */
    public function actionCreate($tree_id)
    {
        try {
            $apple = $this->service->create($tree_id);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        return $this->redirect(['/tree/view', 'id' => $tree_id]);
    }

    /**
     * @return mixed
     */
    public function actionFall($id)
    {
        $apple = $this->repository->getById($id);
        try {
            $this->service->fall($apple->id);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());

        } finally {
            return $this->redirect(['/tree/view', 'id' => $apple->tree_id]);
        }
    }

    /**
     * @return mixed
     */
    public function actionEat()
    {
        $form = new AppleEatForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $apple = $this->repository->getById($form->appleId);
            try {
                $apple = $this->service->eat($form);

            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            } finally {
                return $this->redirect(['/tree/view', 'id' => $apple->tree_id]);
            }
        }

        return $this->redirect(['/tree/index']);
    }

}
