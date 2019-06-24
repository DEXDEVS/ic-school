<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "emp_designation".
 *
 * @property int $emp_designation_id
 * @property int $emp_id
 * @property int $designation_id
 * @property int $emp_type_id
 * @property string $group_by
 * @property double $emp_salary
 * @property string $designation_status
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property EmpInfo $emp
 * @property Designation $designation
 * @property EmpType $empType
 */
class EmpDesignation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'emp_designation';
    }

    public $updateDesignation_id;
    public $updateEmp_type_id;
    public $updateGroup_by;
    public $updateEmp_salary;
    public $updateDesignation_status;
    public $updateStatus;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['emp_id', 'designation_id', 'emp_type_id', 'group_by', 'emp_salary'], 'required'],
            [['emp_id', 'designation_id', 'emp_type_id', 'created_by', 'updated_by'], 'integer'],
            [['group_by', 'designation_status', 'status'], 'string'],
            [['emp_salary'], 'number'],
            [['created_at', 'updated_at', 'created_by', 'updated_by', 'designation_status', 'status','updateStatus','updateDesignation_status','updateEmp_salary','updateGroup_by','updateEmp_type_id','updateDesignation_id'], 'safe'],
            [['emp_id'], 'exist', 'skipOnError' => true, 'targetClass' => EmpInfo::className(), 'targetAttribute' => ['emp_id' => 'emp_id']],
            [['designation_id'], 'exist', 'skipOnError' => true, 'targetClass' => Designation::className(), 'targetAttribute' => ['designation_id' => 'designation_id']],
            [['emp_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => EmpType::className(), 'targetAttribute' => ['emp_type_id' => 'emp_type_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'emp_designation_id' => 'Designation ID',
            'emp_id' => 'ID',
            'designation_id' => 'Designation',
            'emp_type_id' => 'Employee Type',
            'group_by' => 'Group By',
            'emp_salary' => 'Salary',
            'designation_status' => 'Designation Status',
            'status' => 'Status',

            'updateDesignation_id' => 'Employee Designation',
            'updateEmp_type_id' => 'Employee Type',
            'updateGroup_by' => 'Group By',
            'updateEmp_salary' => 'Employee Salary',
            'updateDesignation_status' => 'Designation Status',
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
    public function getEmp()
    {
        return $this->hasOne(EmpInfo::className(), ['emp_id' => 'emp_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDesignation()
    {
        return $this->hasOne(Designation::className(), ['designation_id' => 'designation_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpType()
    {
        return $this->hasOne(EmpType::className(), ['emp_type_id' => 'emp_type_id']);
    }
}
