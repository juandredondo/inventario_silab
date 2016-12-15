<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Reactivo;

/**
 * ReactivoSearch represents the model behind the search form about `app\models\Reactivo`.
 */
class ReactivoSearch extends Reactivo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['REAC_ID', 'ITCO_ID', 'UBIC_ID', 'CADU_ID', 'SIMB_ID'], 'integer'],
            [['REAC_CODIGO', 'REAC_UNIDAD', 'REAC_FECHA_VENCIMIENTO'], 'safe'],
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
        $query = Reactivo::find();

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
            'REAC_ID' => $this->REAC_ID,
            'REAC_FECHA_VENCIMIENTO' => $this->REAC_FECHA_VENCIMIENTO,
            'ITCO_ID' => $this->ITCO_ID,
            'UBIC_ID' => $this->UBIC_ID,
            'CADU_ID' => $this->CADU_ID,
            'SIMB_ID' => $this->SIMB_ID,
        ]);

        $query->andFilterWhere(['like', 'REAC_CODIGO', $this->REAC_CODIGO])
            ->andFilterWhere(['like', 'REAC_UNIDAD', $this->REAC_UNIDAD]);

        return $dataProvider;
    }
}
