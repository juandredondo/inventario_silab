<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Movimiento;

/**
 * MovimientoSearch represents the model behind the search form about `app\models\Movimiento`.
 */
class MovimientoSearch extends Movimiento
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['MOVI_ID', 'TIMO_ID', 'PERS_ID'], 'integer'],
            [['MOVI_FECHA', 'MOVI_CODIGO'], 'safe'],
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
        $query = Movimiento::find();

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
            'MOVI_ID' => $this->MOVI_ID,
            'MOVI_FECHA' => $this->MOVI_FECHA,
            'TIMO_ID' => $this->TIMO_ID,
            'PERS_ID' => $this->PERS_ID,
        ]);

        $query->andFilterWhere(['like', 'MOVI_CODIGO', $this->MOVI_CODIGO]);

        return $dataProvider;
    }
}
