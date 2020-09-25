<?php

use kartik\file\FileInput;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $tree \apple\entities\Tree */
/* @var $apples \yii\data\ActiveDataProvider */
/* @var $eat \backend\forms\AppleEatForm */


$this->title = $tree->number;
$this->params['breadcrumbs'][] = ['label' => 'Деревья', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $tree->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <div class="box">
        <div class="box-header with-border">Яблоня #<?=$tree->number?></div>
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $tree,
                'attributes' => [
                    'id',
                    'number',
                    'description',
                ],
            ]) ?>
        </div>
    </div>
    </div>



<?= $this->render('_apples', [
    'apples' => $apples,
    'tree' => $tree,
    'eat' => $eat,
]) ?>

</div>
