<?php

namespace app;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DetalleSolicitud;

/**
 * DetalleSolicitudSearch represents the model behind the search form about `app\models\DetalleSolicitud`.
 */
class DetalleSolicitudSearch extends DetalleSolicitud
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DESO_ID', 'SOLI_ID', 'STOC_ID'], 'integer'],
            [['DESO_CANTIDAD'], 'number'],
            [['DESO_VALIDO'], 'boolean'],
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
        $query = DetalleSolicitud::find();

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
            'DESO_ID' => $this->DESO_ID,
            'DESO_CANTIDAD' => $this->DESO_CANTIDAD,
            'SOLI_ID' => $this->SOLI_ID,
            'STOC_ID' => $this->STOC_ID,
            'DESO_VALIDO' => $this->DESO_VALIDO,
        ]);

        return $dataProvider;
    }
}
