<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Caducidad;

/**
 * CaducidadSearch represents the model behind the search form about `app\models\Caducidad`.
 */
class CaducidadSearch extends Caducidad
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CADU_ID', 'CADU_MIN', 'CADU_MAX'], 'integer'],
            [['CADU_NOMBRE'], 'safe'],
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
        $query = Caducidad::find();

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
            'CADU_ID' => $this->CADU_ID,
            'CADU_MIN' => $this->CADU_MIN,
            'CADU_MAX' => $this->CADU_MAX,
        ]);

        $query->andFilterWhere(['like', 'CADU_NOMBRE', $this->CADU_NOMBRE]);

        return $dataProvider;
    }
}
