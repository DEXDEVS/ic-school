<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MarksWeightageType;

/**
 * MarksWeightageTypeSearch represents the model behind the search form about `common\models\MarksWeightageType`.
 */
class MarksWeightageTypeSearch extends MarksWeightageType
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['weightage_type_id', 'created_by', 'updated_by'], 'integer'],
            [['weightage_type_name', 'weightage_type_description', 'created_at', 'updated_at'], 'safe'],
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
        $query = MarksWeightageType::find();

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
            'weightage_type_id' => $this->weightage_type_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'weightage_type_name', $this->weightage_type_name])
            ->andFilterWhere(['like', 'weightage_type_description', $this->weightage_type_description]);

        return $dataProvider;
    }
}
