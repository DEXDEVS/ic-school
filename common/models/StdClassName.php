<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "std_class_name".
 *
 * @property int $class_name_id
 * @property int $branch_id
 * @property string $class_name
 * @property string $class_name_description
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property Branches $branch
 * @property StdEnrollmentHead[] $stdEnrollmentHeads
 * @property StdFeePkg[] $stdFeePkgs
 * @property StdSubjects[] $stdSubjects
 */
class StdClassName extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'std_class_name';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['branch_id', 'class_name', 'class_name_description', 'status','class_type'], 'required'],
            [['branch_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at','created_by', 'updated_by'], 'safe'],
            [['class_name'], 'string', 'max' => 120],
            [['class_name_description'], 'string', 'max' => 255],
            [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branches::className(), 'targetAttribute' => ['branch_id' => 'branch_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'class_name_id' => 'Class Name ID',
            'branch_id' => 'Branch Name',
            'class_name' => 'Class Name',
            'class_name_description' => 'Class Name Description',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(Branches::className(), ['branch_id' => 'branch_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStdEnrollmentHeads()
    {
        return $this->hasMany(StdEnrollmentHead::className(), ['class_name_id' => 'class_name_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStdFeePkgs()
    {
        return $this->hasMany(StdFeePkg::className(), ['class_id' => 'class_name_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStdSubjects()
    {
        return $this->hasMany(StdSubjects::className(), ['class_id' => 'class_name_id']);
    }
}
