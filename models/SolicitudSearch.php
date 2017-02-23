<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Solicitud;

/**
 * SolicitudSearch represents the model behind the search form about `app\models\Solicitud`.
 */
class SolicitudSearch extends Solicitud
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SOLI_ID', 'TISO_ID', 'ESSO_ID'], 'integer'],
            [['SOLI_FECHA', 'SOLI_CODIGO'], 'safe'],
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
        $query = Solicitud::find();

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
            'SOLI_ID' => $this->SOLI_ID,
            'SOLI_FECHA' => $this->SOLI_FECHA,
            'TISO_ID' => $this->TISO_ID,
            'ESSO_ID' => $this->ESSO_ID,
        ]);

        $query->andFilterWhere(['like', 'SOLI_CODIGO', $this->SOLI_CODIGO]);

        return $dataProvider;
    }
}
