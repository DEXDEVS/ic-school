<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "visitors".
 *
 * @property int $visitor_id
 * @property string $visitor_name
 * @property string $visitor_contact_no
 * @property string $visitor_photo
 * @property string $visitor_cnic
 * @property string $date_time
 * @property string $visit_purpose
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class Visitors extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'visitors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['visitor_name', 'visitor_contact_no','visitor_cnic', 'date_time', 'visit_purpose'], 'required'],
            [[ 'visitor_photo', 'date_time', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
            [['visitor_name'], 'string', 'max' => 30],
            [['visitor_contact_no', 'visitor_cnic'], 'string', 'max' => 30],
            [['visitor_photo'], 'string', 'max' => 200],
            [['visit_purpose'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'visitor_id' => 'Visitor ID',
            'visitor_name' => 'Visitor Name',
            'visitor_contact_no' => 'Visitor Contact No',
            'visitor_photo' => 'Visitor Photo',
            'visitor_cnic' => 'Visitor Cnic',
            'date_time' => 'Date Time',
            'visit_purpose' => 'Visit Purpose',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
