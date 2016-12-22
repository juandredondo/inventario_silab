<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Permiso;

/**
 * PermisoSearch represents the model behind the search form about `app\modules\admin\models\Permiso`.
 */
class PermisoSearch extends Permiso
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PERM_ID', 'PERM_PADRE'], 'integer'],
            [['PERM_ACCION', 'PERM_CONTROLADOR', 'PERM_MODULO'], 'safe'],
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
        $query = Permiso::find();

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
            'PERM_ID' => $this->PERM_ID,
            'PERM_PADRE' => $this->PERM_PADRE,
        ]);

        $query->andFilterWhere(['like', 'PERM_ACCION', $this->PERM_ACCION])
            ->andFilterWhere(['like', 'PERM_CONTROLADOR', $this->PERM_CONTROLADOR])
            ->andFilterWhere(['like', 'PERM_MODULO', $this->PERM_MODULO]);

        return $dataProvider;
    }
}
