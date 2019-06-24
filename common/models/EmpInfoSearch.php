<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\EmpInfo;

/**
 * EmpInfoSearch represents the model behind the search form about `common\models\EmpInfo`.
 */
class EmpInfoSearch extends EmpInfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['emp_id', 'emp_branch_id', 'emp_dept_id', 'emp_passing_year', 'created_by', 'updated_by'], 'integer'],
            [['emp_reg_no', 'emp_name', 'emp_father_name', 'emp_cnic', 'emp_contact_no', 'emp_perm_address', 'emp_temp_address', 'emp_marital_status', 'emp_gender', 'emp_photo', 'emp_salary_type', 'emp_email', 'emp_qualification', 'emp_institute_name', 'degree_scan_copy', 'emp_cv', 'emp_status', 'created_at', 'updated_at','emp_date_of_birth','emp_religion','emp_domicile'], 'safe'],
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
            $query = EmpInfo::find();

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
                'emp_id' => $this->emp_id,
                'emp_branch_id' => $this->emp_branch_id,
                'emp_dept_id' => $this->emp_dept_id,
                'emp_passing_year' => $this->emp_passing_year,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'created_by' => $this->created_by,
                'updated_by' => $this->updated_by,
            ]);

            $query->andFilterWhere(['like', 'emp_reg_no', $this->emp_reg_no])
                ->andFilterWhere(['like', 'emp_name', $this->emp_name])
                ->andFilterWhere(['like', 'emp_father_name', $this->emp_father_name])
                ->andFilterWhere(['like', 'emp_cnic', $this->emp_cnic])
                ->andFilterWhere(['like', 'emp_contact_no', $this->emp_contact_no])
                ->andFilterWhere(['like', 'emp_perm_address', $this->emp_perm_address])
                ->andFilterWhere(['like', 'emp_temp_address', $this->emp_temp_address])
                ->andFilterWhere(['like', 'emp_marital_status', $this->emp_marital_status])
                ->andFilterWhere(['like', 'emp_gender', $this->emp_gender])
                ->andFilterWhere(['like', 'emp_photo', $this->emp_photo])
                ->andFilterWhere(['like', 'emp_salary_type', $this->emp_salary_type])
                ->andFilterWhere(['like', 'emp_email', $this->emp_email])
                ->andFilterWhere(['like', 'emp_qualification', $this->emp_qualification])
                ->andFilterWhere(['like', 'emp_institute_name', $this->emp_institute_name])
                ->andFilterWhere(['like', 'degree_scan_copy', $this->degree_scan_copy])
                ->andFilterWhere(['like', 'emp_cv', $this->emp_cv])
                ->andFilterWhere(['like', 'emp_date_of_birth', $this->emp_date_of_birth])
                ->andFilterWhere(['like', 'emp_religion', $this->emp_religion])
                ->andFilterWhere(['like', 'emp_domicile', $this->emp_domicile])
                ->andFilterWhere(['like', 'emp_status', $this->emp_status]);
            return $dataProvider;
        } else {
            $branch_id = Yii::$app->user->identity->branch_id;
            $query = EmpInfo::find()->where(['delete_status' => 1 , 'emp_branch_id'=> $branch_id]);

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
                'emp_id' => $this->emp_id,
                'emp_branch_id' => $this->emp_branch_id,
                'emp_dept_id' => $this->emp_dept_id,
                'emp_passing_year' => $this->emp_passing_year,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'created_by' => $this->created_by,
                'updated_by' => $this->updated_by,
            ]);

            $query->andFilterWhere(['like', 'emp_reg_no', $this->emp_reg_no])
                ->andFilterWhere(['like', 'emp_name', $this->emp_name])
                ->andFilterWhere(['like', 'emp_father_name', $this->emp_father_name])
                ->andFilterWhere(['like', 'emp_cnic', $this->emp_cnic])
                ->andFilterWhere(['like', 'emp_contact_no', $this->emp_contact_no])
                ->andFilterWhere(['like', 'emp_perm_address', $this->emp_perm_address])
                ->andFilterWhere(['like', 'emp_temp_address', $this->emp_temp_address])
                ->andFilterWhere(['like', 'emp_marital_status', $this->emp_marital_status])
                ->andFilterWhere(['like', 'emp_gender', $this->emp_gender])
                ->andFilterWhere(['like', 'emp_photo', $this->emp_photo])
                ->andFilterWhere(['like', 'emp_salary_type', $this->emp_salary_type])
                ->andFilterWhere(['like', 'emp_email', $this->emp_email])
                ->andFilterWhere(['like', 'emp_qualification', $this->emp_qualification])
                ->andFilterWhere(['like', 'emp_institute_name', $this->emp_institute_name])
                ->andFilterWhere(['like', 'degree_scan_copy', $this->degree_scan_copy])
                ->andFilterWhere(['like', 'emp_cv', $this->emp_cv])
                ->andFilterWhere(['like', 'emp_date_of_birth', $this->emp_date_of_birth])
                ->andFilterWhere(['like', 'emp_religion', $this->emp_religion])
                ->andFilterWhere(['like', 'emp_domicile', $this->emp_domicile])
                ->andFilterWhere(['like', 'emp_status', $this->emp_status]);

            return $dataProvider;
        }
    }
}
