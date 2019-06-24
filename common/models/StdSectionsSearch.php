<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\StdSections;

/**
 * StdSectionsSearch represents the model behind the search form about `common\models\StdSections`.
 */
class StdSectionsSearch extends StdSections
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['section_id', 'section_intake', 'created_by', 'updated_by'], 'integer'],
            [['class_id', 'branch_id', 'session_id','section_name', 'section_description', 'created_at', 'updated_at', 'delete_status'], 'safe'],
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
        if(Yii::$app->user->identity->user_type == 'Superadmin'){
            $query = StdSections::find();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            $this->load($params);

            if (!$this->validate()) {
                // uncomment the following line if you do not want to return any records when validation fails
                // $query->where('0=1');
                return $dataProvider;
            }
            $query->joinWith('branch');
            $query->joinWith('session');
            $query->joinWith('class');

            $query->andFilterWhere([
                'section_id' => $this->section_id,
                'section_intake' => $this->section_intake,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'created_by' => $this->created_by,
                'updated_by' => $this->updated_by,
            ]);

            $query->andFilterWhere(['like', 'section_name', $this->section_name])
                ->andFilterWhere(['like', 'section_description', $this->section_description])
                ->andFilterWhere(['like', 'delete_status', $this->delete_status])
                ->andFilterWhere(['like', 'branches.branch_name', $this->branch_id])
                ->andFilterWhere(['like', 'std_sessions.session_name', $this->session_id])
                ->andFilterWhere(['like', 'std_class_name.class_name', $this->class_id]);

            return $dataProvider;
        } else {
            $branch_id = Yii::$app->user->identity->branch_id;
            $query = StdSections::find()->innerJoinWith('branch')->innerJoinWith('session')->innerJoinWith('class')->where(['branches.branch_id' => $branch_id]);
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
                'section_id' => $this->section_id,
                'section_intake' => $this->section_intake,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'created_by' => $this->created_by,
                'updated_by' => $this->updated_by,
            ]);

            $query->andFilterWhere(['like', 'section_name', $this->section_name])
                ->andFilterWhere(['like', 'section_description', $this->section_description])
                ->andFilterWhere(['like', 'delete_status', $this->delete_status])
                ->andFilterWhere(['like', 'branches.branch_name', $this->branch_id])
                ->andFilterWhere(['like', 'std_sessions.session_name', $this->session_id])
                ->andFilterWhere(['like', 'std_class_name.class_name', $this->class_id]);

            return $dataProvider;
        }
    }
}
