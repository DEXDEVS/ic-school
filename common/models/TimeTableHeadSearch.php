<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TimeTableHead;

/**
 * TimeTableHeadSearch represents the model behind the search form about `common\models\TimeTableHead`.
 */
class TimeTableHeadSearch extends TimeTableHead
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['time_table_h_id', 'class_id', 'created_by', 'updated_by'], 'integer'],
            [['days', 'status', 'created_at', 'updated_at'], 'safe'],
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
        $query = TimeTableHead::find();

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
            'time_table_h_id' => $this->time_table_h_id,
            'class_id' => $this->class_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'days', $this->days])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
