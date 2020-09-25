<?php

namespace backend\forms;

use apple\entities\Tree;
use yii\base\Model;


class AppleEatForm extends Model
{
    public $appleId;
    public $percent;

    public function rules(): array
    {
        return [
            [['appleId', 'percent'], 'required'],
            [['appleId'], 'integer'],
            [['percent'], 'integer', 'min' => 0, 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'appleId' => '',
            'percent' => 'Процент откусанного',
        ];
    }

}
