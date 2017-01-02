<?php

namespace app\modules\inventario\models\core;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * EstadoNoConsumibleSearch represents the model behind the search form about `app\models\EstadoNoConsumible`.
 */
class EstadoNoConsumibleSearch extends EstadoNoConsumible
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ESNC_ID'], 'integer'],
            [['ESNC_NOMBRE', 'ESNC_CODIGO'], 'safe'],
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
        $query = EstadoNoConsumible::find();

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
            'ESNC_ID' => $this->ESNC_ID,
        ]);

        $query->andFilterWhere(['like', 'ESNC_NOMBRE', $this->ESNC_NOMBRE])
            ->andFilterWhere(['like', 'ESNC_CODIGO', $this->ESNC_CODIGO]);

        return $dataProvider;
    }
}
