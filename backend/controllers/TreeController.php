<?php
namespace backend\controllers;

use apple\entities\Tree;
use apple\repositories\AppleRepository;
use apple\services\TreeService;
use backend\forms\AppleEatForm;
use backend\forms\TreeForm;
use backend\forms\TreeSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class TreeController extends Controller
{
    private $service;
    private $apples;

    public function __construct($id, $module, TreeService $service, AppleRepository $apples, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
        $this->apples = $apples;
    }

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TreeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $tree = $this->findModel($id);
        $apples = $this->apples->getByTree($id);

        return $this->render('view', [
            'tree' => $tree,
            'apples' => $apples,
            'eat' => new AppleEatForm(),
        ]);
    }

    /**
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new TreeForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $tree = $this->service->create($form);
                return $this->redirect(['view', 'id' => $tree->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', [
            'model' => $form,
        ]);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $tree = $this->findModel($id);
        $form = new TreeForm($tree);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->edit($tree->id, $form);
                return $this->redirect(['view', 'id' => $tree->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('update', [
            'model' => $form,
            'tree' => $tree,
        ]);
    }


    /**
     * @param integer $id
     * @return Tree the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id): Tree
    {
        if (($model = Tree::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
