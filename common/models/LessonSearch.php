<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Lesson;

/**
 * LessonSearch represents the model behind the search form about `common\models\Lesson`.
 */
class LessonSearch extends Lesson
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','parent_lesson_id', 'academic_year_id', 'subject_id', 'status', 'class_id', 'quarter_id', 'timing_id', 'teacher_id', 'school_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Lesson::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //var_dump($params); die();

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'parent_lesson_id' => $this->parent_lesson_id,
            'academic_year_id' => $this->academic_year_id,
            'subject_id' => $this->subject_id,
            'status' => $this->status,
            'class_id' => $this->class_id,
            'quarter_id' => $this->quarter_id,
            'timing_id' => $this->timing_id,
            'teacher_id' => $this->teacher_id,
            'school_id' => $this->school_id,
        ]);

        return $dataProvider;
    }
}
