<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Visitors;

/**
 * VisitorsSearch represents the model behind the search form about `common\models\Visitors`.
 */
class VisitorsSearch extends Visitors
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['visitor_id', 'created_by', 'updated_by'], 'integer'],
            [['visitor_name', 'visitor_contact_no', 'visitor_photo', 'visitor_cnic', 'date_time', 'visit_purpose', 'created_at', 'updated_at'], 'safe'],
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
        $query = Visitors::find();

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
            'visitor_id' => $this->visitor_id,
            'date_time' => $this->date_time,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'visitor_name', $this->visitor_name])
            ->andFilterWhere(['like', 'visitor_contact_no', $this->visitor_contact_no])
            ->andFilterWhere(['like', 'visitor_photo', $this->visitor_photo])
            ->andFilterWhere(['like', 'visitor_cnic', $this->visitor_cnic])
            ->andFilterWhere(['like', 'visit_purpose', $this->visit_purpose]);

        return $dataProvider;
    }
}
