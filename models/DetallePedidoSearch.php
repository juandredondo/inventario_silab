<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DetallePedido;

/**
 * DetallePedidoSearch represents the model behind the search form about `app\models\DetallePedido`.
 */
class DetallePedidoSearch extends DetallePedido
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DEPE_ID', 'PEDI_ID', 'ITEM_ID'], 'integer'],
            [['DEPE_CANTIDAD'], 'number'],
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
        $query = DetallePedido::find();

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
            'DEPE_ID' => $this->DEPE_ID,
            'DEPE_CANTIDAD' => $this->DEPE_CANTIDAD,
            'PEDI_ID' => $this->PEDI_ID,
            'ITEM_ID' => $this->ITEM_ID,
        ]);

        return $dataProvider;
    }
}
