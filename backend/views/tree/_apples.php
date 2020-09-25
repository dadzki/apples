<?php


/* @var $this yii\web\View */
/* @var $apples \yii\data\ActiveDataProvider */
/* @var $tree \apple\entities\Tree*/
/* @var $eat \backend\forms\AppleEatForm */

use apple\entities\Apple;
use apple\helpers\AppleHelper;
use kartik\helpers\Html;
use yii\bootstrap\Modal;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

?>

<div class="apples">

    <div class="box">
        <div class="box-header with-border">Яблоки</div>
        <p>
            <?= Html::a('Добавить яблоко', ['/apple/create/', 'tree_id' => $tree->id], ['class' => 'btn btn-primary']) ?>
        </p>
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $apples,
                'columns' => [
                    [
                        'attribute' => 'color',
                        'contentOptions' => function (Apple $apple) {
                            return ['style' => 'background-color: ' . $apple->color];
                        },

                    ],
                    'created_date:datetime',
                    'fall_date:datetime',
                    [
                        'attribute' => 'status',
                        'value' => function (Apple $apple) {
                            return AppleHelper::statusLabel($apple->getState());
                        },
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'size',
                        'value' => function (Apple $apple) {
                            return $apple->getSizePercent() . '%';
                        },

                    ],
                    [
                        'value' => function (Apple $apple) {
                            return  Html::a('Сорвать', ['/apple/fall', 'id' => $apple->id], ['class' => 'btn btn-primary']);
                        },
                        'format' => 'raw',
                    ],
                    [
                        'value' => function (Apple $apple) {
                            return  Html::a('Откусить...', 'javascript:void(0)', ['class' => 'btn btn-success', 'onClick' => "eatApple({$apple->id})"]);
                        },
                        'format' => 'raw',
                    ],
                ],
            ]) ?>
        </div>
    </div>

    <?php
    Modal::begin([
        'header' => '<h2>Сколько откусить от яблока? (в процентах)</h2>',
        'toggleButton' => [
            'label' => 'click me',
            'tag' => 'button',
            'class' => 'btn btn-success hidden',
            'id' => 'showModalPercent',
        ],
    ]);
    ?>
    <?php $form = ActiveForm::begin([
        'action' => ['/apple/eat'],
        'method' => 'post',
        'id' => 'eat-form'
    ]); ?>

    <div class="box box-default">
        <div class="box-body">
            <?= $form->field($eat, 'appleId')->hiddenInput() ?>
            <?= $form->field($eat, 'percent', [ 'options' => ['min' => 0, 'max' => 100]])->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Откусить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php Modal::end(); ?>

    <script type="text/javascript">
        function eatApple(id)
        {
            document.getElementById('appleeatform-appleid').value = id;
            document.getElementById('showModalPercent').click();
        }
    </script>

</div>
