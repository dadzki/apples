<?php
/* @var $this yii\web\View */
/* @var $model \backend\forms\TreeForm */

$this->title = 'Создание дерева';
$this->params['breadcrumbs'][] = ['label' => 'Деревья', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tree-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
