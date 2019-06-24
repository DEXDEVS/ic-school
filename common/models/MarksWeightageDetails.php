<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "marks_weightage_details".
 *
 * @property int $weightage_detail_id
 * @property int $weightage_head_id
 * @property int $weightage_type_id
 * @property double $marks
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property MarksWeightageHead $weightageHead
 * @property MarksWeightageType $weightageType
 */
class MarksWeightageDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'marks_weightage_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['weightage_type_id', 'marks'], 'required'],
            [['weightage_type_id', 'created_by', 'updated_by'], 'integer'],
            [['marks'], 'number'],
            [['weightage_head_id','created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
            [['weightage_head_id'], 'exist', 'skipOnError' => true, 'targetClass' => MarksWeightageHead::className(), 'targetAttribute' => ['weightage_head_id' => 'marks_weightage_id']],
            [['weightage_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => MarksWeightageType::className(), 'targetAttribute' => ['weightage_type_id' => 'weightage_type_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'weightage_detail_id' => 'Weightage Detail ID',
            'weightage_head_id' => 'Weightage Head ID',
            'weightage_type_id' => 'Weightage Type',
            'marks' => 'Marks',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeightageHead()
    {
        return $this->hasOne(MarksWeightageHead::className(), ['marks_weightage_id' => 'weightage_head_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeightageType()
    {
        return $this->hasOne(MarksWeightageType::className(), ['weightage_type_id' => 'weightage_type_id']);
    }
}
