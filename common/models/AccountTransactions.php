<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "account_transactions".
 *
 * @property int $trans_id
 * @property int $branch_id
 * @property string $account_nature
 * @property int $account_register_id
 * @property string $date
 * @property string $description
 * @property double $total_amount
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property AccountRegister $accountRegister
 * @property Branches $branch
 */
class AccountTransactions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'account_transactions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['account_nature', 'account_register_id', 'date', 'description', 'total_amount'], 'required'],
            [['branch_id', 'account_register_id', 'created_by', 'updated_by'], 'integer'],
            [['branch_id','date', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
            [['total_amount'], 'number'],
            [['account_nature'], 'string', 'max' => 11],
            [['description'], 'string', 'max' => 200],
            [['account_register_id'], 'exist', 'skipOnError' => true, 'targetClass' => AccountRegister::className(), 'targetAttribute' => ['account_register_id' => 'account_register_id']],
            [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branches::className(), 'targetAttribute' => ['branch_id' => 'branch_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'trans_id' => 'Trans ID',
            'branch_id' => 'Branch Name',
            'account_nature' => 'Account Nature',
            'account_register_id' => 'Account Head',
            'date' => 'Date',
            'description' => 'Description',
            'total_amount' => 'Total Amount',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountRegister()
    {
        return $this->hasOne(AccountRegister::className(), ['account_register_id' => 'account_register_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(Branches::className(), ['branch_id' => 'branch_id']);
    }
}
