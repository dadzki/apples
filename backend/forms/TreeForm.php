<?php

namespace backend\forms;

use apple\entities\Tree;
use yii\base\Model;


class TreeForm extends Model
{
    public $number;
    public $description;

    public function __construct(Tree $tree = null, $config = [])
    {
        if ($tree) {
            $this->number = $tree->number;
            $this->description = $tree->description;
        }
    }

    public function rules(): array
    {
        return [
            [['number'], 'required'],
            [['number'], 'string', 'max' => 255],
            [['description'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number' => 'Номер',
            'description' => 'Описание',
        ];
    }

}
