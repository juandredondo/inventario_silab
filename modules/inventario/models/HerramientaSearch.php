<?php

namespace app\modules\inventario\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\inventario\models\Herramienta;

/**
 * HerramientaSearch represents the model behind the search form about `app\models\Herramienta`.
 */
class HerramientaSearch extends Herramienta
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['HERR_ID', 'HERR_CANTIDAD', 'ITNC_ID'], 'integer'],
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
        $query = Herramienta::find();

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
            'HERR_ID' => $this->HERR_ID,
            'HERR_CANTIDAD' => $this->HERR_CANTIDAD,
            'ITNC_ID' => $this->ITNC_ID,
        ]);

        return $dataProvider;
    }
}
