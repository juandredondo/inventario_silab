<?php

namespace app\modules\inventario\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\inventario\models\Simbolo;

/**
 * SimboloSearch represents the model behind the search form about `app\models\Simbolo`.
 */
class SimboloSearch extends Simbolo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SIMB_ID'], 'integer'],
            [['SIMB_NOMBRE', 'SIMB_CODIGO'], 'safe'],
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
        $query = Simbolo::find();

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
            'SIMB_ID' => $this->SIMB_ID,
        ]);

        $query->andFilterWhere(['like', 'SIMB_NOMBRE', $this->SIMB_NOMBRE])
            ->andFilterWhere(['like', 'SIMB_CODIGO', $this->SIMB_CODIGO]);

        return $dataProvider;
    }
}
