<?php
/* @var $this yii\web\View */
/* @var $tree \apple\entities\Tree */
/* @var $model \backend\forms\TreeForm */

$this->title = 'Редактирование дерева: ' . $tree->number;
$this->params['breadcrumbs'][] = ['label' => 'Деревья', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $tree->number, 'url' => ['view', 'id' => $tree->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="tree-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
