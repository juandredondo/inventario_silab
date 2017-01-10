<?php

namespace app\modules\inventario\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\inventario\models\Flujo;

/**
 * FlujoSearch represents the model behind the search form about `app\models\Flujo`.
 */
class FlujoSearch extends Flujo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['FLUJ_ID', 'MOVI_ID', 'STOC_ID', 'TIFU_ID'], 'integer'],
            [['FLUJ_CANTIDAD'], 'number'],
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
        $query = Flujo::find();

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
            'FLUJ_ID' => $this->FLUJ_ID,
            'FLUJ_CANTIDAD' => $this->FLUJ_CANTIDAD,
            'MOVI_ID' => $this->MOVI_ID,
            'STOC_ID' => $this->STOC_ID,
            'TIFU_ID' => $this->TIFU_ID,
        ]);

        return $dataProvider;
    }
}
