<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TipoFlujo;

/**
 * TipoFlujoSearch represents the model behind the search form about `app\models\TipoFlujo`.
 */
class TipoFlujoSearch extends TipoFlujo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TIFL_ID'], 'integer'],
            [['TIFL_NOMBRE'], 'safe'],
            [['TIFL_CONSTANTE'], 'number'],
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
        $query = TipoFlujo::find();

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
            'TIFL_ID' => $this->TIFL_ID,
            'TIFL_CONSTANTE' => $this->TIFL_CONSTANTE,
        ]);

        $query->andFilterWhere(['like', 'TIFL_NOMBRE', $this->TIFL_NOMBRE]);

        return $dataProvider;
    }
}
