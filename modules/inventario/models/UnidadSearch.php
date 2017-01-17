<?php

namespace app\modules\inventario\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\inventario\models\Unidad;

/**
 * UnidadSearch represents the model behind the search form about `app\modules\inventario\models\Unidad`.
 */
class UnidadSearch extends Unidad
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['UNID_ID'], 'integer'],
            [['UNID_NOMBRE', 'UNID_DESCRIPCION'], 'safe'],
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
        $query = Unidad::find();

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
            'UNID_ID' => $this->UNID_ID,
        ]);

        $query->andFilterWhere(['like', 'UNID_NOMBRE', $this->UNID_NOMBRE])
            ->andFilterWhere(['like', 'UNID_DESCRIPCION', $this->UNID_DESCRIPCION]);

        return $dataProvider;
    }
}
