<?php

namespace frontend\controllers;

use common\models\StudentsClass;
use frontend\models\StudentForm;
use Yii;
use common\models\User;
use common\models\StudentSearch;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StudentController implements the CRUD actions for User model.
 */
class StudentController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StudentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StudentForm();
        $model->setScenario('create');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        $us = User::findCurrentUser();
        $classes = StudentsClass::find()->where(['school_id' => $us->school_id])->all();
        $classesArray = [];
        $i = 0;
        foreach($classes as $cl){
            $classesArray[$i] = $cl->number.$cl->register;
            $i++;
        }


        return $this->render('create', [
            'model' => $model,
            //'roles' => ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'name')
            'classes' => $classesArray,
        ]);
    }



    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = new StudentForm();
        $model->setModel($this->findModel($id));
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        $us = User::findCurrentUser();
        $classes = StudentsClass::find()->where(['school_id' => $us->school_id])->all();
        $classesArray = [];

        foreach($classes as $cl){
            $classesArray[$cl->id] = $cl->number.$cl->register;

        }

        return $this->render('update', [
            'model' => $model,
            'classes' => $classesArray
            //'roles' => ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'name')
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        Yii::$app->authManager->revokeAll($id);
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
