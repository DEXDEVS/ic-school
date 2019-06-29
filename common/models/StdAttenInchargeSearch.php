<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\StdAttenIncharge;

/**
 * StdAttenInchargeSearch represents the model behind the search form about `common\models\StdAttenIncharge`.
 */
class StdAttenInchargeSearch extends StdAttenIncharge
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['atten_id', 'branch_id', 'teacher_id', 'class_name_id', 'session_id', 'section_id', 'std_id', 'created_by', 'updated_by'], 'integer'],
            [['date', 'attendance', 'created_at', 'updated_at'], 'safe'],
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
        $query = StdAttenIncharge::find();

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
            'atten_id' => $this->atten_id,
            'branch_id' => $this->branch_id,
            'teacher_id' => $this->teacher_id,
            'class_name_id' => $this->class_name_id,
            'session_id' => $this->session_id,
            'section_id' => $this->section_id,
            'date' => $this->date,
            'std_id' => $this->std_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'attendance', $this->attendance]);

        return $dataProvider;
    }
}
