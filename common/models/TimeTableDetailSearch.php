<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TimeTableDetail;

/**
 * TimeTableDetailSearch represents the model behind the search form about `common\models\TimeTableDetail`.
 */
class TimeTableDetailSearch extends TimeTableDetail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['time_table_d_id', 'time_table_h_id', 'subject_id', 'created_by', 'update_by'], 'integer'],
            [['start_time', 'end_time', 'room', 'created_at', 'updated_at'], 'safe'],
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
        $query = TimeTableDetail::find();

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
            'time_table_d_id' => $this->time_table_d_id,
            'time_table_h_id' => $this->time_table_h_id,
            'subject_id' => $this->subject_id,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'created_by' => $this->created_by,
            'update_by' => $this->update_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'room', $this->room]);

        return $dataProvider;
    }
}
