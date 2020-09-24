<?php


namespace apple\entities;

use yii\db\ActiveRecord;


/**
 * @property integer $id
 * @property string $number
 * @property string $description
 */
class Tree extends ActiveRecord
{
    public $meta;

    public static function tableName(): string
    {
        return '{{%tree}}';
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

    public static function create($number, $description): self
    {
        $tree = new static();
        $tree->number = $number;
        $tree->description = $description;

        return $tree;
    }

    public function edit($number, $description): void
    {
        $this->number = $number;
        $this->description = $description;
    }
}
