<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "lesson_data".
 *
 * @property integer $id
 * @property integer $student_id
 * @property integer $lesson_id
 * @property integer $presence
 * @property integer $homework_mark
 * @property string $homework_note
 * @property integer $additional_mark
 * @property string $additional_note
 */
class LessonData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lesson_data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_id', 'lesson_id'], 'required'],
            [['homework_mark', 'homework_note', 'additional_mark', 'additional_note', 'presence'], 'safe'],
            [['student_id', 'lesson_id', 'homework_mark', 'additional_mark'], 'integer'],
            [['homework_note', 'additional_note'], 'string'],
            [['presence'], 'boolean']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'student_id' => Yii::t('common', 'Student ID'),
            'lesson_id' => Yii::t('common', 'Lesson ID'),
            'presence' => Yii::t('common', 'Presence'),
            'homework_mark' => Yii::t('common', 'Homework Mark'),
            'homework_note' => Yii::t('common', 'Homework Note'),
            'additional_mark' => Yii::t('common', 'Additional Mark'),
            'additional_note' => Yii::t('common', 'Additional Note'),
        ];
    }

    public function getname()
    {
        return User::findIdentity($this->student_id)->getfullName();
    }
}
