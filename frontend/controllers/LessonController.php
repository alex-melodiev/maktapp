<?php

namespace frontend\controllers;

use common\models\AcademicYear;
use common\models\LessonData;
use common\models\LessonDataSearch;
use common\models\Quarter;
use common\models\StudentsClass;
use common\models\StudentSearch;
use common\models\Subject;
use common\models\TeacherSearch;
use common\models\TimingType;
use common\models\User;
use Yii;
use common\models\Lesson;
use common\models\LessonSearch;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * LessonController implements the CRUD actions for Lesson model.
 */
class LessonController extends Controller
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
     * Lists all Lesson models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LessonSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Lesson model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        //$lessonData = LessonData::find()->where(['lesson_id' => $id]);
        $lessonDataSearch = new LessonDataSearch();
        //[$search->formName()=>['att3'=>3]]

        $lessonData = $lessonDataSearch->search([$lessonDataSearch->formName() => ['lesson_id' => $id]]);

        $model = $this->findModel($id);
        $students = StudentSearch::find()->where(['class_id' => $model->class_id]);

        // если запрос идет от Editable datagrid
        if(Yii::$app->request->isAjax){


            foreach (Yii::$app->request->post() as $key => $value) {
                if($model->hasAttribute($key)) $model->setAttribute($key, $value);
            }

            if( $model->save()){
                Yii::trace("update lesson", 'trace');
            }

            // Если правили данные в гриде
            if(null !== Yii::$app->request->post("editableKey")) {
                $datamodel = LessonData::find()->where(['id' => Yii::$app->request->post("editableKey")])->one();

                //$model = $this->findModel($id);


                //Yii::trace($datamodel->cla.'qweqwe', 'trace');

                if (null !== Yii::$app->request->post("LessonData")) {
                    $val = ArrayHelper::toArray(Yii::$app->request->post("LessonData"));
                    foreach ($val as $k => $v) {
                        $datamodel->setAttribute(Yii::$app->request->post("editableAttribute"), $v[Yii::$app->request->post("editableAttribute")]);
                    }

                    //$datamodel->setAttribute(Yii::$app->request->post("editableAttribute"), $val[0][Yii::$app->request->post("editableAttribute")]);
                }


                if ($datamodel->save()) {
                    // return $this->redirect(['view', 'id' => $model->id]);
                    $lessonDataSearch = new LessonDataSearch();
                    $lessonData = $lessonDataSearch->search(['lesson_id' => $id]);
                    Yii::trace('update model' . Yii::$app->request->post("editableAttribute"), 'trace');
                }
            }


            Yii::$app->response->format = Response::FORMAT_JSON;
            return $this->renderAjax('view', [
                'model' => $model,
                'prevLesson' => $model->getPrevLesson(),
                'nextLesson' => $model->getNextLesson(),
                'students' => $students,
                'lessonData' => $lessonData,
            ]);


        } else {
            if($model->status === Lesson::PASSED){
                return $this->render('over', [
                    'model' => $model,
                    'nextlesson' => $model->getNextLesson()
                ]);
            } else {
                return $this->render('view', [
                    'model' => $model,
                    'prevLesson' => $model->getPrevLesson(),
                    'nextLesson' => $model->getNextLesson(),
                    'students' => $students,
                    'lessonData' => $lessonData,
                ]);
            }
        }
    }

    /**
     * Creates a new Lesson model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Lesson();

        $years = AcademicYear::find()->all();

        // TODO сделать привязку к языку класса
        $subjects = Subject::find()->all();

        $classes = StudentsClass::findAllBySchool();

        $weeks = Lesson::weeks();

        $days = Lesson::days();

        $quarters = Quarter::find()->all();

        $timingtypes = TimingType::find()->all();

        $teachers = TeacherSearch::getTeachersBySchool();




        $loadedflag = $model->load(Yii::$app->request->post());
       // $model->lesson_date = strtotime(Yii::$app->request->post('lesson_date'));
        if($loadedflag){
            $model->school_id = User::findIdentity(Yii::$app->user->id)->school_id;
            $model->status = Lesson::PENDING;

            // Creating lesson data
            $students = StudentSearch::find()->where(['class_id' => $model->class_id])->all();

            Yii::trace(count($students), "trace");


        }
        if ($loadedflag && $model->save()) {

            $hours_count = $model->academic_hours;

            for($i = 0; $i< $hours_count; $i++){
                $lesson = new Lesson();
                $lesson->load(Yii::$app->request->post());

                $lesson->academic_hours = 1;
                $lesson->parent_lesson_id = $model->id;
                $date = strtotime($model->lesson_date);
                $date = strtotime("+".($i * 7)." day", $date);
                $lesson->lesson_date = date('Y-m-d',$date);
                $lesson->school_id = User::findIdentity(Yii::$app->user->id)->school_id;
                $lesson->status = Lesson::PENDING;
                if(!$lesson->save()) { print_r($lesson->getErrors()); die(); }



                foreach ($students as $student) {

                    $lessonData = new LessonData();
                    $lessonData->lesson_id = $lesson->id;
                    $lessonData->student_id = $student->id;
                    if(!$lessonData->save()) {print_r($lessonData->getErrors()); print_r($date); die();}
                }
            }



            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'years' => $years,
                'subjects' => $subjects,
                'classes' => $classes,
                'weeks' => $weeks,
                'days' => $days,
                'quarters' => $quarters,
                'timingtypes' => $timingtypes,
                'teachers' => $teachers,
            ]);
        }
    }

    /**
     * Updates an existing Lesson model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $years = AcademicYear::find()->all();

        // TODO сделать привязку к языку класса
        $subjects = Subject::find()->all();

        $classes = StudentsClass::findAllBySchool();

        $weeks = Lesson::weeks();

        $days = Lesson::days();

        $quarters = Quarter::find()->all();

        $timingtypes = TimingType::find()->all();

        $teachers = TeacherSearch::getTeachersBySchool();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'years' => $years,
                'subjects' => $subjects,
                'classes' => $classes,
                'weeks' => $weeks,
                'days' => $days,
                'quarters' => $quarters,
                'timingtypes' => $timingtypes,
                'teachers' => $teachers,
            ]);
        }
    }

    public function actionUpdateDatetime($id)
    {
        $model = $this->findModel($id);

        $years = AcademicYear::find()->all();

        // TODO сделать привязку к языку класса
        $subjects = Subject::find()->all();

        $classes = StudentsClass::findAllBySchool();

        $weeks = Lesson::weeks();

        $days = Lesson::days();

        $quarters = Quarter::find()->all();

        $timingtypes = TimingType::find()->all();

        $teachers = TeacherSearch::getTeachersBySchool();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['schedule']);
        } else {
            return $this->render('update-datetime', [
                'model' => $model,
                'years' => $years,
                'subjects' => $subjects,
                'classes' => $classes,
                'weeks' => $weeks,
                'days' => $days,
                'quarters' => $quarters,
                'timingtypes' => $timingtypes,
                'teachers' => $teachers,
            ]);
        }
    }

    public function actionStart($id)
    {
        $model = $this->findModel($id);
        $model->status = Lesson::CURRENT;
        $model->save();
//
//        $students = StudentSearch::find()->where(['class_id' => $model->class_id])->all();
//
//        Yii::trace(count($students), "trace");
//
//        foreach ($students as $student) {
//            $lessonData = new LessonData();
//            $lessonData->lesson_id = $id;
//            $lessonData->student_id = $student->id;
//            if(!$lessonData->save()) {print_r($lessonData->getErrors()); die();}
//        }

        $model->save();


        return $this->redirect(['lesson/'.$model->id]);
    }

    public function actionEnd($id)
    {
        $model = $this->findModel($id);
        $model->status = Lesson::PASSED;


        if($model->save()) {
            //return $this->redirect(['lesson/over/' . $model->getNextLesson()->id]);
            return $this->render('over', [
                'model' => $model,
                'nextlesson' => $model->getNextLesson()
            ]);
        } else {
            return $this->redirect(['lesson/' . $model->id]);
        }
    }

    /**
     * Deletes an existing Lesson model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionSchedule($monday_date = 0)
    {
        //$monday_date = Yii::$app->request->get('monday_date');
        //$lessons = Lesson::find()->where(["teacher_id" => Yii::$app->user->id, ''])

        if($monday_date === 0) {
            $monday_date = time();
        }

        $timings = TimingType::find()->all();
        $days = Lesson::days();
        return $this->render('schedule',[
            'timings' => $timings,
            'days' => $days,
            'monday_date' => $monday_date
        ]);

    }

    /**
     * Finds the Lesson model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Lesson the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Lesson::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}
