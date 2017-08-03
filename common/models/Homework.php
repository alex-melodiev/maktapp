<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "homework".
 *
 * @property integer $id
 * @property integer $lesson_id
 * @property string $note
 * @property string $deadline
 */
class Homework extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'homework';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lesson_id', 'note', 'deadline'], 'required'],
            [['lesson_id'], 'integer'],
            [['note'], 'string'],
            [['deadline'], 'safe'],
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
            'note' => Yii::t('app', 'Note'),
            'deadline' => Yii::t('app', 'Deadline'),
        ];
    }
}
