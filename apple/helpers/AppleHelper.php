<?php

namespace apple\helpers;

use apple\entities\Apple;
use apple\entities\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class AppleHelper
{
    public static function statusList(): array
    {
        return [
            Apple::STATE_TREE => 'Висит на дереве',
            Apple::STATE_GROUND => 'Лежит на земле',
            Apple::STATE_ROTTEN => 'Гнилое яблоко',
        ];
    }

    public static function statusName($status): string
    {
        return ArrayHelper::getValue(self::statusList(), $status);
    }

    public static function statusLabel($status): string
    {
        switch ($status) {
            case Apple::STATE_TREE:
                $class = 'label label-success';
                break;
            case Apple::STATE_GROUND:
                $class = 'label label-warning';
                break;
            case Apple::STATE_ROTTEN:
                $class = 'label label-danger';
                break;
            default:
                $class = 'label label-default';
        }

        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), [
            'class' => $class,
        ]);
    }
}
