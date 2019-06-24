<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "std_enrollment_head".
 *
 * @property int $std_enroll_head_id
 * @property int $branch_id
 * @property int $class_name_id
 * @property int $session_id
 * @property int $section_id
 * @property string $std_enroll_head_name
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property ExamsCriteria[] $examsCriterias
 * @property MarksWeitage[] $marksWeitages
 * @property StdClassName $className
 * @property StdSessions $session
 * @property StdSections $section
 * @property Branches $branch
 */
class StdEnrollmentHead extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'std_enrollment_head';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['class_name_id', 'session_id', 'section_id', 'std_enroll_head_name'], 'required'],
            [['branch_id', 'class_name_id', 'session_id', 'section_id', 'created_by', 'updated_by'], 'integer'],
            [['branch_id','created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
            [['std_enroll_head_name'], 'string', 'max' => 255],
            [['class_name_id'], 'exist', 'skipOnError' => true, 'targetClass' => StdClassName::className(), 'targetAttribute' => ['class_name_id' => 'class_name_id']],
            [['session_id'], 'exist', 'skipOnError' => true, 'targetClass' => StdSessions::className(), 'targetAttribute' => ['session_id' => 'session_id']],
            [['section_id'], 'exist', 'skipOnError' => true, 'targetClass' => StdSections::className(), 'targetAttribute' => ['section_id' => 'section_id']],
            [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branches::className(), 'targetAttribute' => ['branch_id' => 'branch_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'std_enroll_head_id' => 'Std Enroll Head ID',
            'branch_id' => 'Branch Name',
            'class_name_id' => 'Class Name ID',
            'session_id' => 'Session ID',
            'section_id' => 'Section ID',
            'std_enroll_head_name' => 'Std Enroll Head Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExamsCriterias()
    {
        return $this->hasMany(ExamsCriteria::className(), ['std_enroll_head_id' => 'std_enroll_head_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMarksWeitages()
    {
        return $this->hasMany(MarksWeitage::className(), ['std_enroll_head_id' => 'std_enroll_head_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClassName()
    {
        return $this->hasOne(StdClassName::className(), ['class_name_id' => 'class_name_id']);
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
    public function getSection()
    {
        return $this->hasOne(StdSections::className(), ['section_id' => 'section_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(Branches::className(), ['branch_id' => 'branch_id']);
    }
}
