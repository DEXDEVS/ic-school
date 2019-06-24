<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rooms".
 *
 * @property int $room_id
 * @property string $room_name
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class Rooms extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rooms';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['room_name'], 'required'],
            [['created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
            [['room_name'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'room_id' => 'Room ID',
            'room_name' => 'Room Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
