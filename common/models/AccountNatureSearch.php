<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AccountNature;

/**
 * AccountNatureSearch represents the model behind the search form about `common\models\AccountNature`.
 */
class AccountNatureSearch extends AccountNature
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_nature_id', 'account_no', 'created_by', 'updated_by'], 'integer'],
            [['account_nature_name', 'account_nature_status', 'created_at', 'updated_at'], 'safe'],
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
        $query = AccountNature::find();

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
            'account_nature_id' => $this->account_nature_id,
            'account_no' => $this->account_no,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'account_nature_name', $this->account_nature_name])
            ->andFilterWhere(['like', 'account_nature_status', $this->account_nature_status]);

        return $dataProvider;
    }
}
