<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Provedor;

/**
 * ProvedorSearch represents the model behind the search form about `app\models\Provedor`.
 */
class ProvedorSearch extends Provedor
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PROV_ID'], 'integer'],
            [['PROV_NOMBRE', 'PROV_NIT'], 'safe'],
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
        $query = Provedor::find();

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
            'PROV_ID' => $this->PROV_ID,
        ]);

        $query->andFilterWhere(['like', 'PROV_NOMBRE', $this->PROV_NOMBRE])
            ->andFilterWhere(['like', 'PROV_NIT', $this->PROV_NIT]);

        return $dataProvider;
    }
}
