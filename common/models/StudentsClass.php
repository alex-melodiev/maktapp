<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "class".
 *
 * @property integer $id
 * @property integer $number
 * @property string $register
 * @property integer $curator_id
 * @property integer $school_id
 */
class StudentsClass extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'class';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number', 'register', 'curator_id', 'school_id'], 'required'],
            [['number', 'curator_id', 'school_id'], 'integer'],
            [['register'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'number' => Yii::t('app', 'Number'),
            'register' => Yii::t('app', 'Register'),
            'curator_id' => Yii::t('app', 'Curator ID'),
            'school_id' => Yii::t('app', 'School ID'),
        ];
    }

    /**
     * @inheritdoc
     * @return ClassQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ClassQuery(get_called_class());
    }
}
