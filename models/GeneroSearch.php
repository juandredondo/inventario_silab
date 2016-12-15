<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Genero;

/**
 * GeneroSearch represents the model behind the search form about `app\models\Genero`.
 */
class GeneroSearch extends Genero
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['GENE_ID'], 'integer'],
            [['GENE_NOMBRE'], 'safe'],
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
        $query = Genero::find();

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
            'GENE_ID' => $this->GENE_ID,
        ]);

        $query->andFilterWhere(['like', 'GENE_NOMBRE', $this->GENE_NOMBRE]);

        return $dataProvider;
    }
}
