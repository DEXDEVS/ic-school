<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MarksDetails;

/**
 * MarksDetailsSearch represents the model behind the search form about `common\models\MarksDetails`.
 */
class MarksDetailsSearch extends MarksDetails
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['marks_detail_id', 'marks_head_id', 'subject_id', 'created_by', 'updated_by'], 'integer'],
            [['obtained_marks', 'created_at', 'updated_at'], 'safe'],
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
        $query = MarksDetails::find();

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
            'marks_detail_id' => $this->marks_detail_id,
            'marks_head_id' => $this->marks_head_id,
            'subject_id' => $this->subject_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'obtained_marks', $this->obtained_marks]);

        return $dataProvider;
    }
}
