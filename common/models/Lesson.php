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
    const WEEK_EVEN = 1;
    const WEEK_ODD = 2;

    const MONDAY = 1;
    const TUESDAY = 2;
    const WEDNESDAY = 3;
    const THURSDAY = 4;
    const FRIDAY = 5;
    const SATURDAY = 6;

    const PENDING = 0;
    const CURRENT = 1;
    const PASSED = 2;
    const MISSED = 3;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['academic_year_id', 'subject_id', 'class_id', 'quarter_id', 'timing_id', 'teacher_id', 'school_id', 'week_type', 'day', 'academic_hours'], 'required'],
            [['academic_year_id', 'subject_id', 'status', 'class_id', 'quarter_id', 'timing_id', 'teacher_id', 'school_id', 'parent_lesson_id', 'academic_hours'], 'integer'],
            [['status', 'school_id', 'homework', 'parent_id', 'lesson_date'], 'safe'],
            [['week_type', 'day', 'homework'], 'string'],
           // [['lesson_date'], 'date'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'parent_lesson_id' => Yii::t('app', 'Parent Lesson'),
            'lesson_date' => Yii::t('app', 'Lesson Date'),
            'academic_hours' => Yii::t('app', 'Academic Hours'),
            'academic_year_id' => Yii::t('app', 'Academic Year ID'),
            'subject_id' => Yii::t('app', 'Subject ID'),
            'status' => Yii::t('app', 'Status'),
            'class_id' => Yii::t('app', 'Class ID'),
            'quarter_id' => Yii::t('app', 'Quarter ID'),
            'timing_id' => Yii::t('app', 'Timing ID'),
            'teacher_id' => Yii::t('app', 'Teacher ID'),
            'school_id' => Yii::t('app', 'School ID'),
            'week_type' => Yii::t('app', 'Week Type'),
            'day' => Yii::t('app', 'Day'),
            'homework' => Yii::t('app', 'Homework')
        ];
    }

    public static function days()
    {
        return [
            self::MONDAY => Yii::t('app', 'Monday'),
            self::TUESDAY => Yii::t('app', 'Tuesday'),
            self::WEDNESDAY => Yii::t('app', 'Wednesday'),
            self::THURSDAY => Yii::t('app', 'Thursday'),
            self::FRIDAY => Yii::t('app', 'Friday'),
            self::SATURDAY => Yii::t('app', 'Saturday'),
        ];
    }

    public static function weeks()
    {
        return[
            self::WEEK_EVEN => Yii::t('app', 'Even Week'),
            self::WEEK_ODD => Yii::t('app', 'Odd Week')
        ];
    }

    public static function statuses()
    {
        return [
            self::PENDING  => Yii::t('app', 'Pending'),
            self::CURRENT  => Yii::t('app', 'Current Active'),
            self::PASSED  => Yii::t('app', 'Passed'),
            self::MISSED  => Yii::t('app', 'Missed'),
        ];
    }

    public function getclassName()
    {
        $class = StudentsClass::findOne(['id' => $this->class_id]);

        return $class->getfullName();
    }

    public function getDay()
    {
        $days = self::days();

        return $days[$this->day];
    }

    public function getSubjectName()
    {
        return Subject::find()->where(['id' => $this->subject_id])->one()->name;
    }

    public function getNextLesson()
    {
        return Lesson::find()
            ->andFilterWhere(['teacher_id' => $this->teacher_id])
            ->andFilterWhere(['academic_year_id' => $this->academic_year_id])
            ->andFilterWhere(['status' => self::PENDING])
            ->andFilterWhere(['quarter_id' => $this->quarter_id])
            ->andFilterWhere(['week_type' => $this->week_type])
            ->andFilterWhere(['day' => $this->day])
            ->andFilterWhere(['>', 'timing_id' , $this->timing_id])
            ->one();
        //TODO add sort by timing
    }

    public function getPrevLesson()
    {
        return Lesson::find()
            ->andFilterWhere(['teacher_id' => $this->teacher_id])
            ->andFilterWhere(['academic_year_id' => $this->academic_year_id])
            //->andFilterWhere(['status' => self::PASSED]) //TODO or missed
            ->andFilterWhere(['quarter_id' => $this->quarter_id])
            ->andFilterWhere(['week_type' => $this->week_type])
            ->andFilterWhere(['day' => $this->day])
            ->andFilterWhere(['<', 'timing_id' , $this->timing_id])
            ->one();
        //TODO add sort by timing
    }

    public function getLessonData($student_id = null)
    {
        if($student_id)
        {
            return LessonData::find()->andFilterWhere(['lesson_id' => $this->id])->andFilterWhere(['student_id' => $student_id])->one();
        }
        else
        {
            return LessonData::find()->andFilterWhere(['lesson_id' => $this->id])->all();
        }
    }
}
