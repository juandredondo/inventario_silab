<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Accesorios;

/**
 * AccesoriosSearch represents the model behind the search form about `app\models\Accesorios`.
 */
class AccesoriosSearch extends Accesorios
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ACCE_ID', 'ITNC_ID'], 'integer'],
            [['ACCE_SERIAL', 'ACCE_MODELO'], 'safe'],
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
        $query = Accesorios::find();

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
            'ACCE_ID' => $this->ACCE_ID,
            'ITNC_ID' => $this->ITNC_ID,
        ]);

        $query->andFilterWhere(['like', 'ACCE_SERIAL', $this->ACCE_SERIAL])
            ->andFilterWhere(['like', 'ACCE_MODELO', $this->ACCE_MODELO]);

        return $dataProvider;
    }
}
