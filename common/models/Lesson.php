<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "lesson".
 *
 * @property integer $id
 * @property integer $academic_year_id
 * @property integer $subject_id
 * @property integer $status
 * @property integer $class_id
 * @property integer $quarter_id
 * @property integer $timing_id
 * @property integer $teacher_id
 * @property integer $school_id
 */
class Lesson extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lesson';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['academic_year_id', 'subject_id', 'status', 'class_id', 'quarter_id', 'timing_id', 'teacher_id', 'school_id'], 'required'],
            [['academic_year_id', 'subject_id', 'status', 'class_id', 'quarter_id', 'timing_id', 'teacher_id', 'school_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'academic_year_id' => Yii::t('app', 'Academic Year ID'),
            'subject_id' => Yii::t('app', 'Subject ID'),
            'status' => Yii::t('app', 'Status'),
            'class_id' => Yii::t('app', 'Class ID'),
            'quarter_id' => Yii::t('app', 'Quarter ID'),
            'timing_id' => Yii::t('app', 'Timing ID'),
            'teacher_id' => Yii::t('app', 'Teacher ID'),
            'school_id' => Yii::t('app', 'School ID'),
        ];
    }
}
