<?php

namespace app\modules\inventario\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\inventario\models\Inventario;

/**
 * InventarioSearch represents the model behind the search form about `app\models\Inventario`.
 */
class InventarioSearch extends Inventario
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['INVE_ID', 'LABO_ID'], 'integer'],
            [['INVE_NOMBRE'], 'string'],
            [['INVE_ESSINGLETON'], 'boolean'],
            [['INVE_CANTIDAD'], 'number'],
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
        $query = Inventario::find();

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
            'INVE_ID'           => $this->INVE_ID,
            'INVE_ESSINGLETON'  => $this->INVE_ESSINGLETON,
            'LABO_ID'           => $this->LABO_ID,
        ]);

        if( $this->INVE_NOMBRE != "" )
            $query->andFilterWhere([ 'like', 'INVE_NOMBRE', $this->INVE_NOMBRE ]);

        return $dataProvider;
    }
}
