<?php

namespace app\modules\inventario\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\inventario\models\EstadoConsumible;

/**
 * EstadoConsumibleSearch represents the model behind the search form about `app\models\EstadoConsumible`.
 */
class EstadoConsumibleSearch extends EstadoConsumible
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ESCO_ID', 'ESCO_MIN', 'ESCO_MAX'], 'integer'],
            [['ESCO_NOMBRE'], 'safe'],
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
        $query = EstadoConsumible::find();

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
            'ESCO_ID' => $this->ESCO_ID,
            'ESCO_MIN' => $this->ESCO_MIN,
            'ESCO_MAX' => $this->ESCO_MAX,
        ]);

        $query->andFilterWhere(['like', 'ESCO_NOMBRE', $this->ESCO_NOMBRE]);

        return $dataProvider;
    }
}
