<?php

namespace app\modules\inventario\models\views;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * StockSearch represents the model behind the search form about `app\models\Stock`.
 */
class StockActualSearch extends VStockActual
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['STOC_ID', 'ITEM_ID', 'INVE_ID', 'PERI_ID', 'TIIT_ID', "STOC_MIN", "STOC_MAX"], 'integer'],
            [['STOC_CANTIDAD'], 'number'],
            [['STOC_ESCONSUMIBLE'], 'boolean'],
            [['ITEM_NOMBRE'], 'string'],
            [['TIIT_NOMBRE'], 'string'],
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
        $query = VStockActual::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            "pagination" => [
                "pageSize" => 5,
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'STOC_ID' => $this->STOC_ID,
            'ITEM_ID' => $this->ITEM_ID,
            
            'TIIT_ID' => $this->TIIT_ID,            
            'INVE_ID' => $this->INVE_ID,
            'PERI_ID' => $this->TIIT_ID,
            'STOC_CANTIDAD' => $this->STOC_CANTIDAD,
            'STOC_MIN' => $this->STOC_MIN,
            'STOC_MAX' => $this->STOC_MAX,
            'STOC_ESCONSUMIBLE' => $this->STOC_ESCONSUMIBLE,
        ]);

        $query->andFilterWhere(
            ["LIKE", 'ITEM_NOMBRE', $this->ITEM_NOMBRE]
        );
        $query->andFilterWhere(
            ["LIKE", 'TIIT_NOMBRE', $this->TIIT_NOMBRE]
        );

        return $dataProvider;
    }
}