<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "marks_weightage_type".
 *
 * @property int $weightage_type_id
 * @property string $weightage_type_name
 * @property string $weightage_type_description
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property MarksWeightage[] $marksWeightages
 */
class MarksWeightageType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'marks_weightage_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['weightage_type_name'], 'required'],
            [['weightage_type_description', 'created_at', 'updated_at','created_by', 'updated_by'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
            [['weightage_type_name'], 'string', 'max' => 30],
            [['weightage_type_description'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'weightage_type_id' => 'Weightage Type ID',
            'weightage_type_name' => 'Weightage Type Name',
            'weightage_type_description' => 'Weightage Type Description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMarksWeightages()
    {
        return $this->hasMany(MarksWeightage::className(), ['weightage_type_id' => 'weightage_type_id']);
    }
}
