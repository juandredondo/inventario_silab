<?php

namespace app\modules\inventario\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\inventario\models\ItemNoConsumible;

/**
 * ItemNoConsumibleSearch represents the model behind the search form about `app\models\ItemNoConsumible`.
 */
class ItemNoConsumibleSearch extends ItemNoConsumible
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ITNC_ID', 'ITEM_ID', 'ESNC_ID', 'MODE_ID'], 'integer'],
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
        $query = ItemNoConsumible::find();

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
            'ITNC_ID' => $this->ITNC_ID,
            'ITEM_ID' => $this->ITEM_ID,
            'ESNC_ID' => $this->ESNC_ID,
            'MODE_ID' => $this->MODE_ID,
        ]);

        return $dataProvider;
    }
}
