<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pedido;

/**
 * PedidosSearch represents the model behind the search form about `app\models\Pedido`.
 */
class PedidosSearch extends Pedido
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PEDI_ID', 'MOVI_ID'], 'integer'],
            [['PEDI_FECHA', 'PEDI_CODIGO'], 'safe'],
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
        $query = Pedido::find();

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
            'PEDI_ID' => $this->PEDI_ID,
            'PEDI_FECHA' => $this->PEDI_FECHA,
            'MOVI_ID' => $this->MOVI_ID,
        ]);

        $query->andFilterWhere(['like', 'PEDI_CODIGO', $this->PEDI_CODIGO]);

        return $dataProvider;
    }
}
