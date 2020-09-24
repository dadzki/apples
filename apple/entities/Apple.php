<?php


namespace apple\entities;

use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property string $color
 * @property string $created_date
 * @property string $fall_date
 * @property integer $status
 * @property float $size
 * @property integer $tree_id
 *
 *
 */
class Apple extends ActiveRecord
{
    const STATE_TREE = 'On the tree';
    const STATE_GROUND = 'On the ground';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%apple}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'color' => 'Цвет',
            'created_date' => 'Время создания',
            'fall_date' => 'Время падения',
            'status' => 'Статус',
            'size' => 'Размер',
        ];
    }

    public static function create(int $treeId, string $color): self
    {
        $apple = new self();
        $apple->color = $color;
        $apple->created_date = time();
        $apple->status = self::STATE_TREE;
        $apple->size = 1;
        $apple->tree_id = $treeId;

        return $apple;
    }

    public function fall(): self
    {
        if ($this->onGround()) {
            throw new \DomainException('Яблоко уже упало.');
        }
        $this->felled_date = time();
        $this->status = self::STATE_GROUND;

        return $this;
    }

    public function eat(int $percent): self
    {
        if ($this->onTree()) {
            throw new \DomainException('Съесть нельзя, яблоко на дереве.');
        }
        if ($this->isRotten()) {
            throw new \DomainException('Съесть нельзя, яблоко сгнило.');
        }
        $remainSize = ($this->size - $percent / 100);
        $this->size = $remainSize >= 0 ? $remainSize : 0;

        return $this;
    }

    /**
     * @return bool
     */
    public function onTree(): bool
    {
        return $this->status === self::STATE_TREE;
    }

    /**
     * @return bool
     */
    public function onGround(): bool
    {
        return $this->status === self::STATE_GROUND;
    }

    /**
     * @return bool
     */
    public function wasEaten(): bool
    {
        return $this->size <= 0;
    }

    /**
     * @return bool
     */
    public function isRotten(): bool
    {
        return time() - $this->fall_date >= 3600 * 5;
    }


}
