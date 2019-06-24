<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "time_table_head".
 *
 * @property int $time_table_h_id
 * @property int $class_id
 * @property string $days
 * @property string $status
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property TimeTableDetail[] $timeTableDetails
 * @property StdEnrollmentHead $class
 */
class TimeTableHead extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'time_table_head';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['class_id'], 'required'],
            [['class_id', 'created_by', 'updated_by'], 'integer'],
            [['status'], 'string'],
            [['created_at', 'updated_at', 'status', 'created_by', 'updated_by', 'days'], 'safe'],
            //[['days'], 'string', 'max' => 200],
            [['class_id'], 'exist', 'skipOnError' => true, 'targetClass' => StdEnrollmentHead::className(), 'targetAttribute' => ['class_id' => 'std_enroll_head_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'time_table_h_id' => 'Time Table H ID',
            'class_id' => 'Class Name',
            'days' => 'Days',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTimeTableDetails()
    {
        return $this->hasMany(TimeTableDetail::className(), ['time_table_h_id' => 'time_table_h_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClass()
    {
        return $this->hasOne(StdEnrollmentHead::className(), ['std_enroll_head_id' => 'class_id']);
    }
}
