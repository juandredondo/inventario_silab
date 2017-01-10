<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\PerfilRole;

/**
 * PerfilRoleSeach represents the model behind the search form about `app\modules\admin\models\PerfilRole`.
 */
class PerfilRoleSearch extends PerfilRole
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PERO_ID', 'ROL_ID', 'PERM_ID', 'PERO_PADRE'], 'integer'],
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
        $query = PerfilRole::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'PERO_ID' => $this->PERO_ID,
            'ROL_ID' => $this->ROL_ID,
            'PERM_ID' => $this->PERM_ID,
            'PERO_PADRE' => $this->PERO_PADRE,
        ]);

        return $dataProvider;
    }
}
