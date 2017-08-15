<?php

namespace frontend\controllers;

use common\models\Lesson;
use common\models\LessonData;
use common\models\Subject;
use common\models\User;
use Yii;
use common\models\StudentsClass;
use common\models\StudentSearch;
use common\models\StudentsClassSearch;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StudentsClassController implements the CRUD actions for StudentsClass model.
 */
class StudentsClassController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    // deny all POST requests
//                    [
//                        'allow' => false,
//                        'actions' => ['create', 'update']
//                    ],
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['teacher'],
                    ],
                    // everything else is denied
                ],
            ],
        ];
    }

    /**
     * Lists all StudentsClass models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StudentsClassSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $curatorClasses = StudentsClass::getCuratorClasses();

        return $this->render('index', [
            'curatorClasses' => $curatorClasses,
        ]);
    }

    /**
     * Displays a single StudentsClass model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id, $subj_id = null)
    {
        $curatorClasses = StudentsClass::getCuratorClasses();

        //$lessonsData = LessonData::find()->where(['class_id' => $id])->all();
        $subject_ids = Lesson::find()->select('subject_id')->where(['class_id' => $id, 'parent_lesson_id' => null, 'teacher_id' => Yii::$app->user->id])->all();

        // говнокодище, простите
        $ids = [];
        foreach ($subject_ids as $subject) {
            $ids[] = $subject->subject_id;
        }

        $subjects = [];
        if(count($ids) > 0) {
            $subjects = Subject::find()->where('id IN (' . implode(',', $ids) . ')')->all();
        }

        $lessons = [];
        $students = [];
        //$lessonsData = [];
        if($subj_id){
            $lessons = Lesson::find()
                ->andWhere(['class_id' => $id])
                ->andWhere(['teacher_id' => Yii::$app->user->id])
                ->andWhere(['subject_id' => $subj_id])
                //->andWhere(['<>', 'parent_lesson_id', null])
                ->all();

            $students = StudentSearch::find()->where(['class_id' => $id])->orderBy("username")->all();
        }



        return $this->render('view', [
            'model' => $this->findModel($id),
            'curatorClasses' => $curatorClasses,
            //'lessonData' => $lessonsData
            //'subject_ids' => ArrayHelper::map($subject_ids, 'subject_id', 'id')
            'subjects' => $subjects,
            'lessons' => $lessons,
            'students' => $students,
        ]);
    }



    /**
     * Displays Student List for selected Class by Ajax.
     * @return mixed
     */
    public function actionStudents()
    {
        if(Yii::$app->request->isAjax){

            $classId = Yii::$app->request->post("class_id");
            if(isset($classId)){


                $students = StudentSearch::find()->
                andFilterWhere(['class_id' => $classId])->all();

                return $this->renderAjax("partial-index", [
                        'students' => $students,
                    ]);

            }

        }
    }



    /**
     * Creates a new StudentsClass model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StudentsClass();
        $loadedFlag = $model->load(Yii::$app->request->post());
        $us = User::find()->where(['id' =>  Yii::$app->user->id])->one();

        if($loadedFlag){
            $model->curator_id = Yii::$app->user->id;

            $model->school_id =$us->school_id;
        }


        if ($loadedFlag && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {

            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing StudentsClass model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing StudentsClass model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the StudentsClass model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StudentsClass the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StudentsClass::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
