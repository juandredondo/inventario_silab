<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FuncionarioLaboratorio;

/**
 * FuncionarioLaboratorioSearch represents the model behind the search form about `app\models\FuncionarioLaboratorio`.
 */
class FuncionarioLaboratorioSearch extends FuncionarioLaboratorio
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['FULA_ID', 'FUNC_ID', 'LABO_ID'], 'integer'],
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
        $query = FuncionarioLaboratorio::find();

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
            'FULA_ID' => $this->FULA_ID,
            'FUNC_ID' => $this->FUNC_ID,
            'LABO_ID' => $this->LABO_ID,
        ]);

        return $dataProvider;
    }
}
