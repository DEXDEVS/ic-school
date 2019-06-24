<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MarksHead;

/**
 * MarksHeadSearch represents the model behind the search form about `common\models\MarksHead`.
 */
class MarksHeadSearch extends MarksHead
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['marks_head_id', 'exam_criteria_id', 'std_id', 'created_by', 'updated_by'], 'integer'],
            [['grand_total'], 'number'],
            [['percentage', 'grade', 'exam_status', 'created_at', 'updated_at'], 'safe'],
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
        $query = MarksHead::find();

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
            'marks_head_id' => $this->marks_head_id,
            'exam_criteria_id' => $this->exam_criteria_id,
            'std_id' => $this->std_id,
            'grand_total' => $this->grand_total,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'percentage', $this->percentage])
            ->andFilterWhere(['like', 'grade', $this->grade])
            ->andFilterWhere(['like', 'exam_status', $this->exam_status]);

        return $dataProvider;
    }
}
