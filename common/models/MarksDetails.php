<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "marks_details".
 *
 * @property int $marks_detail_id
 * @property int $marks_head_id
 * @property int $subject_id
 * @property int $obtained_marks
 * @property string $exam_attendance
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property MarksHead $marksHead
 * @property Subjects $subject
 */
class MarksDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'marks_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['marks_head_id', 'subject_id', 'obtained_marks', 'exam_attendance', 'created_by', 'updated_by'], 'required'],
            [['marks_head_id', 'subject_id', 'obtained_marks', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['exam_attendance'], 'string', 'max' => 8],
            [['marks_head_id'], 'exist', 'skipOnError' => true, 'targetClass' => MarksHead::className(), 'targetAttribute' => ['marks_head_id' => 'marks_head_id']],
            [['subject_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subjects::className(), 'targetAttribute' => ['subject_id' => 'subject_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'marks_detail_id' => 'Marks Detail ID',
            'marks_head_id' => 'Marks Head ID',
            'subject_id' => 'Subject ID',
            'obtained_marks' => 'Obtained Marks',
            'exam_attendance' => 'Exam Attendance',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMarksHead()
    {
        return $this->hasOne(MarksHead::className(), ['marks_head_id' => 'marks_head_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Subjects::className(), ['subject_id' => 'subject_id']);
    }
}
