<?php


namespace backend\forms;


use apple\entities\Tree;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class TreeSearch extends Model
{
    public $id;
    public $number;

    public function rules(): array
    {
        return [
            [['id'], 'integer'],
            [['number'], 'safe'],
        ];
    }

    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params): ActiveDataProvider
    {
        $query = Tree::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query
            ->andFilterWhere(['like', 'number', $this->number]);

        return $dataProvider;
    }
}
