<?php

namespace frontend\controllers;

use common\models\AcademicYear;
use common\models\Quarter;
use common\models\StudentsClass;
use common\models\Subject;
use common\models\TeacherSearch;
use common\models\TimingType;
use common\models\User;
use Yii;
use common\models\Lesson;
use common\models\LessonSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
            'prevLesson' => $model->getPrevLesson(),
            'nextLesson' => $model->getNextLesson(),
        ]);
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
        if($loadedflag){
            $model->school_id = User::findIdentity(Yii::$app->user->id)->school_id;
            $model->status = Lesson::PENDING;
        }
        if ($loadedflag && $model->save()) {
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

    public function actionStartLesson($id)
    {
        $model = $this->findModel($id);
        $model->status = Lesson::CURRENT;
        $model->save();

        return $this->redirect(['lesson/'.$model->id]);
    }

    public function actionEndLesson($id)
    {
        $model = $this->findModel($id);
        $model->status = Lesson::PASSED;
        $model->save();

        return $this->redirect(['lesson/'.$model->getNextLesson()->id]);
    }

    //TODO create startLesson, endLesson actions

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
