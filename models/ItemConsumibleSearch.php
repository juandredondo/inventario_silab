<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ItemConsumible;

/**
 * ItemConsumibleSearch represents the model behind the search form about `app\models\ItemConsumible`.
 */
class ItemConsumibleSearch extends ItemConsumible
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ITCO_ID', 'ITEM_ID', 'estadoConsumible_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ItemConsumible::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'ITCO_ID' => $this->ITCO_ID,
            'ITEM_ID' => $this->ITEM_ID,
            'estadoConsumible_id' => $this->estadoConsumible_id,
        ]);

        return $dataProvider;
    }
}
