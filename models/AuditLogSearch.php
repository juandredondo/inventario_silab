<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AuditLog;

/**
 * AuditLogSearch represents the model behind the search form about `app\models\AuditLog`.
 */
class AuditLogSearch extends AuditLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['AULOG_ID', 'USUA_ID', 'LOTI_ID'], 'integer'],
            [['AULOG_TABLENAME', 'AULOG_FECHA'], 'safe'],
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
        $query = AuditLog::find();

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
            'AULOG_ID' => $this->AULOG_ID,
            'AULOG_FECHA' => $this->AULOG_FECHA,
            'USUA_ID' => $this->USUA_ID,
            'LOTI_ID' => $this->LOTI_ID,
        ]);

        $query->andFilterWhere(['like', 'AULOG_TABLENAME', $this->AULOG_TABLENAME]);

        return $dataProvider;
    }
}
