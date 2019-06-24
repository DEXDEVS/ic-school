<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "std_sections".
 *
 * @property int $section_id
 * @property int $class_id
 * @property int $branch_id
 * @property int $session_id
 * @property string $section_name
 * @property string $section_description
 * @property int $section_intake
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property int $delete_status
 *
 * @property FeeTransactionHead[] $feeTransactionHeads
 * @property StdAttendance[] $stdAttendances
 * @property StdEnrollmentHead[] $stdEnrollmentHeads
 * @property Branches $branch
 * @property StdSessions $session
 * @property StdClassName $class
 */
class StdSections extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'std_sections';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['class_id', 'branch_id', 'session_id', 'section_name', 'section_description', 'section_intake', 'created_by', 'updated_by'], 'required'],
            [['class_id', 'branch_id', 'session_id', 'section_intake', 'created_by', 'updated_by', 'delete_status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['section_name'], 'string', 'max' => 50],
            [['section_description'], 'string', 'max' => 100],
            [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branches::className(), 'targetAttribute' => ['branch_id' => 'branch_id']],
            [['session_id'], 'exist', 'skipOnError' => true, 'targetClass' => StdSessions::className(), 'targetAttribute' => ['session_id' => 'session_id']],
            [['class_id'], 'exist', 'skipOnError' => true, 'targetClass' => StdClassName::className(), 'targetAttribute' => ['class_id' => 'class_name_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'section_id' => 'Section ID',
            'class_id' => 'Class Name',
            'branch_id' => 'Branch Name',
            'session_id' => 'Session Name',
            'section_name' => 'Section Name',
            'section_description' => 'Section Description',
            'section_intake' => 'Section Intake',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'delete_status' => 'Delete Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeeTransactionHeads()
    {
        return $this->hasMany(FeeTransactionHead::className(), ['section_id' => 'section_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStdAttendances()
    {
        return $this->hasMany(StdAttendance::className(), ['section_id' => 'section_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStdEnrollmentHeads()
    {
        return $this->hasMany(StdEnrollmentHead::className(), ['section_id' => 'section_id']);
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
    public function getClass()
    {
        return $this->hasOne(StdClassName::className(), ['class_name_id' => 'class_id']);
    }
}
