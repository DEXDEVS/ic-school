<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "fee_transaction_head".
 *
 * @property int $fee_trans_id
 * @property int $branch_id
 * @property int $class_name_id
 * @property int $session_id
 * @property int $section_id
 * @property int $std_id
 * @property string $std_name
 * @property string $month
 * @property string $transaction_date
 * @property double $total_amount
 * @property double $total_discount
 * @property double $paid_amount
 * @property double $remaining
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property Branches $branch
 * @property StdSessions $session
 * @property StdPersonalInfo $std
 * @property StdSections $section
 */
class FeeTransactionHead extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fee_transaction_head';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['branch_id', 'class_name_id', 'session_id', 'section_id', 'std_id', 'std_name', 'month', 'transaction_date', 'total_amount', 'total_discount', 'paid_amount', 'remaining', 'status', 'created_by', 'updated_by'], 'required'],
            [['branch_id', 'class_name_id', 'session_id', 'section_id', 'std_id', 'created_by', 'updated_by'], 'integer'],
            [['transaction_date', 'created_at', 'updated_at'], 'safe'],
            [['total_amount', 'total_discount', 'paid_amount', 'remaining'], 'number'],
            [['status'], 'string'],
            [['std_name'], 'string', 'max' => 75],
            [['month'], 'string', 'max' => 20],
            [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branches::className(), 'targetAttribute' => ['branch_id' => 'branch_id']],
            [['session_id'], 'exist', 'skipOnError' => true, 'targetClass' => StdSessions::className(), 'targetAttribute' => ['session_id' => 'session_id']],
            [['std_id'], 'exist', 'skipOnError' => true, 'targetClass' => StdPersonalInfo::className(), 'targetAttribute' => ['std_id' => 'std_id']],
            [['section_id'], 'exist', 'skipOnError' => true, 'targetClass' => StdSections::className(), 'targetAttribute' => ['section_id' => 'section_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fee_trans_id' => 'Fee Trans ID',
            'branch_id' => 'Branch Name',
            'class_name_id' => 'Class Name',
            'session_id' => 'Session Name',
            'section_id' => 'Section Name',
            'std_id' => 'Student ID',
            'std_name' => 'Student Name',
            'month' => 'Month',
            'transaction_date' => 'Transaction Date',
            'total_amount' => 'Total Amount',
            'total_discount' => 'Total Discount',
            'paid_amount' => 'Paid Amount',
            'remaining' => 'Remaining',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(Branches::className(), ['branch_id' => 'branch_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSession()
    {
        return $this->hasOne(StdSessions::className(), ['session_id' => 'session_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStd()
    {
        return $this->hasOne(StdPersonalInfo::className(), ['std_id' => 'std_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSection()
    {
        return $this->hasOne(StdSections::className(), ['section_id' => 'section_id']);
    }
}
