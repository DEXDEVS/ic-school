<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "marks_head".
 *
 * @property int $marks_head_id
 * @property int $exam_category_id
 * @property int $class_head_id
 * @property int $std_id
 * @property double $grand_total
 * @property string $percentage
 * @property string $grade
 * @property string $exam_status
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property MarksDetails[] $marksDetails
 * @property ExamsCategory $examCategory
 * @property StdEnrollmentHead $classHead
 * @property StdPersonalInfo $std
 */
class MarksHead extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'marks_head';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['exam_category_id', 'class_head_id', 'std_id', 'created_by', 'updated_by'], 'required'],
            [['exam_category_id', 'class_head_id', 'std_id', 'created_by', 'updated_by'], 'integer'],
            [['grand_total', 'percentage', 'grade', 'exam_status'], 'safe'],
            [['grand_total'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['percentage'], 'string', 'max' => 10],
            [['grade'], 'string', 'max' => 3],
            [['exam_status'], 'string', 'max' => 6],
            [['exam_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ExamsCategory::className(), 'targetAttribute' => ['exam_category_id' => 'exam_category_id']],
            [['class_head_id'], 'exist', 'skipOnError' => true, 'targetClass' => StdEnrollmentHead::className(), 'targetAttribute' => ['class_head_id' => 'std_enroll_head_id']],
            [['std_id'], 'exist', 'skipOnError' => true, 'targetClass' => StdPersonalInfo::className(), 'targetAttribute' => ['std_id' => 'std_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'marks_head_id' => 'Marks Head ID',
            'exam_category_id' => 'Exam Category ID',
            'class_head_id' => 'Class Head ID',
            'std_id' => 'Std ID',
            'grand_total' => 'Grand Total',
            'percentage' => 'Percentage',
            'grade' => 'Grade',
            'exam_status' => 'Exam Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMarksDetails()
    {
        return $this->hasMany(MarksDetails::className(), ['marks_head_id' => 'marks_head_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExamCategory()
    {
        return $this->hasOne(ExamsCategory::className(), ['exam_category_id' => 'exam_category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClassHead()
    {
        return $this->hasOne(StdEnrollmentHead::className(), ['std_enroll_head_id' => 'class_head_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStd()
    {
        return $this->hasOne(StdPersonalInfo::className(), ['std_id' => 'std_id']);
    }
}
