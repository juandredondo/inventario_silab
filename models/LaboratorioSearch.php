<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Laboratorio;

/**
 * LaboratorioSearch represents the model behind the search form about `app\models\Laboratorio`.
 */
class LaboratorioSearch extends Laboratorio
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['LABO_ID', 'LABO_NIVEL', 'EDIF_ID', 'COOR_ID', 'TILA_ID'], 'integer'],
            [['LABO_NOMBRE'], 'safe'],
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
        $query = Laboratorio::find();

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
            'LABO_ID' => $this->LABO_ID,
            'LABO_NIVEL' => $this->LABO_NIVEL,
            'EDIF_ID' => $this->EDIF_ID,
            'COOR_ID' => $this->COOR_ID,
            'TILA_ID' => $this->TILA_ID,
        ]);

        $query->andFilterWhere(['like', 'LABO_NOMBRE', $this->LABO_NOMBRE]);

        return $dataProvider;
    }
}
