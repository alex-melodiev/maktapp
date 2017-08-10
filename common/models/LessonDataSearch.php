<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\LessonData;

/**
 * LessonDataSearch represents the model behind the search form about `common\models\LessonData`.
 */
class LessonDataSearch extends LessonData
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'student_id', 'lesson_id', 'presence', 'homework_mark', 'additional_mark'], 'integer'],
            [['homework_note', 'additional_note'], 'safe'],
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
        $query = LessonData::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'student_id' => $this->student_id,
            'lesson_id' => $this->lesson_id,
            'presence' => $this->presence,
            'homework_mark' => $this->homework_mark,
            'additional_mark' => $this->additional_mark,
        ]);

        $query->andFilterWhere(['like', 'homework_note', $this->homework_note])
            ->andFilterWhere(['like', 'additional_note', $this->additional_note]);

        return $dataProvider;
    }
}
