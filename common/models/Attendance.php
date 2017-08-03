<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "attendance".
 *
 * @property integer $id
 * @property integer $lesson_id
 * @property integer $student_id
 * @property integer $value
 * @property string $note
 */
class Attendance extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'attendance';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'lesson_id', 'student_id', 'value', 'note'], 'required'],
            [['id', 'lesson_id', 'student_id', 'value'], 'integer'],
            [['note'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'lesson_id' => Yii::t('app', 'Lesson ID'),
            'student_id' => Yii::t('app', 'Student ID'),
            'value' => Yii::t('app', 'Value'),
            'note' => Yii::t('app', 'Note'),
        ];
    }
}
