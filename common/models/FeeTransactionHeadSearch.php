<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\FeeTransactionHead;

/**
 * FeeTransactionHeadSearch represents the model behind the search form about `common\models\FeeTransactionHead`.
 */
class FeeTransactionHeadSearch extends FeeTransactionHead
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fee_trans_id', 'branch_id', 'class_name_id', 'session_id', 'section_id', 'std_id', 'created_by', 'updated_by'], 'integer'],
            [['std_name', 'month', 'transaction_date', 'status', 'created_at', 'updated_at'], 'safe'],
            [['total_amount', 'total_discount', 'paid_amount', 'remaining'], 'number'],
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
        $query = FeeTransactionHead::find();

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
            'fee_trans_id' => $this->fee_trans_id,
            'branch_id' => $this->branch_id,
            'class_name_id' => $this->class_name_id,
            'session_id' => $this->session_id,
            'section_id' => $this->section_id,
            'std_id' => $this->std_id,
            'transaction_date' => $this->transaction_date,
            'total_amount' => $this->total_amount,
            'total_discount' => $this->total_discount,
            'paid_amount' => $this->paid_amount,
            'remaining' => $this->remaining,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'std_name', $this->std_name])
            ->andFilterWhere(['like', 'month', $this->month])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
