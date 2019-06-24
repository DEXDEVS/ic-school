<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "designation".
 *
 * @property int $designation_id
 * @property string $designation
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property EmpInfo[] $empInfos
 */
class Designation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'designation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['designation'], 'required'],
            [['created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
            [['designation'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'designation_id' => 'Designation ID',
            'designation' => 'Designation',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpInfos()
    {
        return $this->hasMany(EmpInfo::className(), ['emp_designation_id' => 'designation_id']);
    }
}
