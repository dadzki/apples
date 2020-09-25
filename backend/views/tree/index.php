<?php

use apple\entities\Tree;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel \backend\forms\TreeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Деревья';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tree-index">

    <p>
        <?= Html::a('Добавить Дерево', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'attribute' => 'number',
                        'value' => function (Tree $model) {
                            return Html::a(Html::encode($model->number), ['view', 'id' => $model->id]);
                        },
                        'format' => 'raw',
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
