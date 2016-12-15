<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Periodo;

/**
 * PeriodoSearch represents the model behind the search form about `app\models\Periodo`.
 */
class PeriodoSearch extends Periodo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PERI_ID', 'PERI_SEMESTRE'], 'integer'],
            [['PERI_FECHA'], 'safe'],
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
        $query = Periodo::find();

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
            'PERI_ID' => $this->PERI_ID,
            'PERI_SEMESTRE' => $this->PERI_SEMESTRE,
            'PERI_FECHA' => $this->PERI_FECHA,
        ]);

        return $dataProvider;
    }
}
