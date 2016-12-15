<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TipoLaboratorio;

/**
 * TipoLaboratorioSearch represents the model behind the search form about `app\models\TipoLaboratorio`.
 */
class TipoLaboratorioSearch extends TipoLaboratorio
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TILA_ID'], 'integer'],
            [['TILA_NOMBRE'], 'safe'],
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
        $query = TipoLaboratorio::find();

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
            'TILA_ID' => $this->TILA_ID,
        ]);

        $query->andFilterWhere(['like', 'TILA_NOMBRE', $this->TILA_NOMBRE]);

        return $dataProvider;
    }
}
