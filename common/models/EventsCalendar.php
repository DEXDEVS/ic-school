<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "events_calendar".
 *
 * @property int $calendar_id
 * @property string $title
 * @property string $description
 * @property string $date
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class EventsCalendar extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'events_calendar';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'date', 'created_by', 'updated_by'], 'required'],
            [['date', 'created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
            [['title'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'calendar_id' => 'Calendar ID',
            'title' => 'Title',
            'description' => 'Description',
            'date' => 'Date',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
