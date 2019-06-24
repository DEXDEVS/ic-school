<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "std_subjects".
 *
 * @property int $std_subject_id
 * @property string $std_subject_name
 */
class StdSubjects extends \yii\db\ActiveRecord
{
    public $subId;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'std_subjects';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['subId','class_id'], 'required'],
            [['std_subject_name'], 'safe'],
            [['class_id'], 'integer'],
            [['std_subject_name'], 'string', 'max' => 200],
            [['class_id'], 'exist', 'skipOnError' => true, 'targetClass' => StdClassName::className(), 'targetAttribute' => ['class_id' => 'class_name_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'std_subject_id' => 'Std Subject ID',
            'class_id' => 'Class',
            'std_subject_name' => 'Subject Name',
            'subId'=> 'Subject Name',
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStdAcademicInfos()
    {
        return $this->hasMany(StdAcademicInfo::className(), ['subject_combination' => 'std_subject_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStdSections()
    {
        return $this->hasMany(StdSections::className(), ['section_subjects' => 'std_subject_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClass()
    {
        return $this->hasOne(StdClassName::className(), ['class_name_id' => 'class_id']);
    }
}
