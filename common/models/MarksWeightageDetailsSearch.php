<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MarksWeightageDetails;

/**
 * MarksWeightageDetailsSearch represents the model behind the search form about `common\models\MarksWeightageDetails`.
 */
class MarksWeightageDetailsSearch extends MarksWeightageDetails
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['weightage_detail_id', 'weightage_head_id', 'weightage_type_id', 'created_by', 'updated_by'], 'integer'],
            [['marks'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
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
        $query = MarksWeightageDetails::find();

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
            'weightage_detail_id' => $this->weightage_detail_id,
            'weightage_head_id' => $this->weightage_head_id,
            'weightage_type_id' => $this->weightage_type_id,
            'marks' => $this->marks,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        return $dataProvider;
    }
}
