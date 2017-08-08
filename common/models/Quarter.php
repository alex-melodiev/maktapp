<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "quarter".
 *
 * @property integer $id
 * @property string $start_date
 * @property string $end_date
 * @property integer $academic_year_id
 * @property integer $number
 */
class Quarter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'quarter';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start_date', 'end_date'], 'safe'],
            [['academic_year_id', 'number'], 'required'],
            [['academic_year_id', 'number'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'start_date' => Yii::t('app', 'Start Date'),
            'end_date' => Yii::t('app', 'End Date'),
            'academic_year_id' => Yii::t('app', 'Academic Year'),
            'number' => Yii::t('app', 'Number'),
        ];
    }
}
