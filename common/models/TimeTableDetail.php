<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "time_table_detail".
 *
 * @property int $time_table_d_id
 * @property int $time_table_h_id
 * @property int $subject_id
 * @property string $start_time
 * @property string $end_time
 * @property string $room
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property TimeTableHead $timeTableH
 * @property Subjects $subject
 */
class TimeTableDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'time_table_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['subject_id', 'start_time', 'end_time', 'room'], 'required'],
            [['time_table_h_id', 'subject_id', 'created_by', 'updated_by'], 'integer'],
            [['time_table_h_id', 'start_time', 'end_time', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
            [['room'], 'string', 'max' => 10],
            [['time_table_h_id'], 'exist', 'skipOnError' => true, 'targetClass' => TimeTableHead::className(), 'targetAttribute' => ['time_table_h_id' => 'time_table_h_id']],
            [['subject_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subjects::className(), 'targetAttribute' => ['subject_id' => 'subject_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'time_table_d_id' => 'Time Table D ID',
            'time_table_h_id' => 'Time Table H ID',
            'subject_id' => 'Subject Name',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'room' => 'Room',
            'created_by' => 'Created By',
            'updated_by' => 'Update By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTimeTableH()
    {
        return $this->hasOne(TimeTableHead::className(), ['time_table_h_id' => 'time_table_h_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Subjects::className(), ['subject_id' => 'subject_id']);
    }
}
