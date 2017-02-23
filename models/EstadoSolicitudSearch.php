<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EstadoSolicitud;

/**
 * EstadoSolicitudSearch represents the model behind the search form about `app\models\EstadoSolicitud`.
 */
class EstadoSolicitudSearch extends EstadoSolicitud
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ESSO_ID', 'ESSO_NOMBRE', 'ESSO_ORDEN', 'ESSO_PARENT'], 'integer'],
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
        $query = EstadoSolicitud::find();

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
            'ESSO_ID' => $this->ESSO_ID,
            'ESSO_NOMBRE' => $this->ESSO_NOMBRE,
            'ESSO_ORDEN' => $this->ESSO_ORDEN,
            'ESSO_PARENT' => $this->ESSO_PARENT,
        ]);

        return $dataProvider;
    }
}
