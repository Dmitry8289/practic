<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Proposal;

/**
 * ProposalSearch represents the model behind the search form of `app\models\Proposal`.
 */
class ProposalSearch extends Proposal
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'child_age', 'user_id', 'coterie_id', 'status'], 'integer'],
            [['parent_name', 'parent_surname', 'parent_patronymic', 'parent_phone', 'parent_email', 'child_name', 'child_surname', 'child_patronymic'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Proposal::find();

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
            'id' => $this->id,
            'child_age' => $this->child_age,
            'user_id' => $this->user_id,
            'coterie_id' => $this->coterie_id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'parent_name', $this->parent_name])
            ->andFilterWhere(['like', 'parent_surname', $this->parent_surname])
            ->andFilterWhere(['like', 'parent_patronymic', $this->parent_patronymic])
            ->andFilterWhere(['like', 'parent_phone', $this->parent_phone])
            ->andFilterWhere(['like', 'parent_email', $this->parent_email])
            ->andFilterWhere(['like', 'child_name', $this->child_name])
            ->andFilterWhere(['like', 'child_surname', $this->child_surname])
            ->andFilterWhere(['like', 'child_patronymic', $this->child_patronymic]);

        return $dataProvider;
    }
}
