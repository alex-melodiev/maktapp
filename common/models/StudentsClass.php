<?php

namespace common\models;

use Yii;
use yii\web\User;

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

    public static function findAllBySchool($school_id = null){
        if($school_id){
            return static::find()
                ->andWhere(['school_id' => $school_id])
                ->all();
        } else {
            return static::find()
                ->andWhere(['school_id' => User::findIdentity(Yii::$app->user->id)->school_id])
                ->all();
        }
    }

    public function getfullName()
    {
        return $this->number.$this->register;
    }

    public static function getCuratorClasses($teacher_id = null)
    {
        if($teacher_id){
            return static::find()
                ->andWhere(['curator_id' => $teacher_id])
                ->all();
        } else {
            return static::find()
                ->andWhere(['curator_id' => Yii::$app->user->id])
                ->all();
        }
    }

    public static function getStudyClasses($teacher_id = null)
    {
        if($teacher_id){
            return static::find()
                ->where(['school_id' => \common\models\User::findIdentity(Yii::$app->user->id)->school_id])
                ->join("LEFT JOIN", "lessons", "lesson.teacher_id=",$teacher_id)
                ->all();
        } else {
            return static::find()
                ->leftJoin("lesson", "lesson.teacher_id=".Yii::$app->user->id)
                ->andWhere(['class.school_id' => \common\models\User::findIdentity(Yii::$app->user->id)->school_id])
                ->andWhere(['<>' ,'class.curator_id', Yii::$app->user->id])
                ->all();
        }
    }
}
