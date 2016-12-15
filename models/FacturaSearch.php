<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Factura;

/**
 * FacturaSearch represents the model behind the search form about `app\models\Factura`.
 */
class FacturaSearch extends Factura
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['FACT_ID', 'PROV_ID', 'PEDI_ID'], 'integer'],
            [['FACT_CODIGO', 'FACT_FECHA', 'FACT_IMAGEPATH'], 'safe'],
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
        $query = Factura::find();

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
            'FACT_ID' => $this->FACT_ID,
            'FACT_FECHA' => $this->FACT_FECHA,
            'PROV_ID' => $this->PROV_ID,
            'PEDI_ID' => $this->PEDI_ID,
        ]);

        $query->andFilterWhere(['like', 'FACT_CODIGO', $this->FACT_CODIGO])
            ->andFilterWhere(['like', 'FACT_IMAGEPATH', $this->FACT_IMAGEPATH]);

        return $dataProvider;
    }
}
