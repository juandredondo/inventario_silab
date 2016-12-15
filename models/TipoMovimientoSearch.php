<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TipoMovimiento;

/**
 * TipoMovimientoSearch represents the model behind the search form about `app\models\TipoMovimiento`.
 */
class TipoMovimientoSearch extends TipoMovimiento
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TIMO_ID'], 'integer'],
            [['TIMO_NOMBRE'], 'safe'],
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
        $query = TipoMovimiento::find();

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
            'TIMO_ID' => $this->TIMO_ID,
        ]);

        $query->andFilterWhere(['like', 'TIMO_NOMBRE', $this->TIMO_NOMBRE]);

        return $dataProvider;
    }
}
