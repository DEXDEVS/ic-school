<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "std_atten_incharge".
 *
 * @property int $atten_id
 * @property int $branch_id
 * @property int $teacher_id
 * @property int $class_name_id
 * @property int $session_id
 * @property int $section_id
 * @property string $date
 * @property int $std_id
 * @property string $attendance
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Branches $branch
 * @property TeacherSubjectAssignHead $teacher
 * @property StdClassName $className
 * @property StdSessions $session
 * @property StdSections $section
 * @property StdPersonalInfo $std
 */
class StdAttenIncharge extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'std_atten_incharge';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['branch_id', 'teacher_id', 'class_name_id', 'session_id', 'section_id', 'date', 'std_id', 'attendance', 'created_by', 'updated_by'], 'required'],
            [['branch_id', 'teacher_id', 'class_name_id', 'session_id', 'section_id', 'std_id', 'created_by', 'updated_by'], 'integer'],
            [['date', 'created_at', 'updated_at'], 'safe'],
            [['attendance'], 'string', 'max' => 2],
            [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branches::className(), 'targetAttribute' => ['branch_id' => 'branch_id']],
            [['teacher_id'], 'exist', 'skipOnError' => true, 'targetClass' => TeacherSubjectAssignHead::className(), 'targetAttribute' => ['teacher_id' => 'teacher_subject_assign_head_id']],
            [['class_name_id'], 'exist', 'skipOnError' => true, 'targetClass' => StdClassName::className(), 'targetAttribute' => ['class_name_id' => 'class_name_id']],
            [['session_id'], 'exist', 'skipOnError' => true, 'targetClass' => StdSessions::className(), 'targetAttribute' => ['session_id' => 'session_id']],
            [['section_id'], 'exist', 'skipOnError' => true, 'targetClass' => StdSections::className(), 'targetAttribute' => ['section_id' => 'section_id']],
            [['std_id'], 'exist', 'skipOnError' => true, 'targetClass' => StdPersonalInfo::className(), 'targetAttribute' => ['std_id' => 'std_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'atten_id' => 'Atten ID',
            'branch_id' => 'Branch ID',
            'teacher_id' => 'Teacher ID',
            'class_name_id' => 'Class Name ID',
            'session_id' => 'Session ID',
            'section_id' => 'Section ID',
            'date' => 'Date',
            'std_id' => 'Std ID',
            'attendance' => 'Attendance',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
    public function getTeacher()
    {
        return $this->hasOne(TeacherSubjectAssignHead::className(), ['teacher_subject_assign_head_id' => 'teacher_id']);
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
    public function getStd()
    {
        return $this->hasOne(StdPersonalInfo::className(), ['std_id' => 'std_id']);
    }
}
