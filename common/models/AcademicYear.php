<?php

namespace common\models;

use Yii;
use yii\filters\AccessControl;

/**
 * This is the model class for table "academic_year".
 *
 * @property integer $id
 * @property integer $start_year
 * @property integer $end_year
 * @property integer $active
 */
class AcademicYear extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'academic_year';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start_year', 'end_year', 'active'], 'required'],
            [['start_year', 'end_year', 'active'], 'integer'],
        ];
    }
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    // deny all POST requests
                    [
                        'allow' => false,
                        'actions' => ['create', 'update']
                    ],
                    // allow authenticated users
                    [
                        'allow' => true,
                        'actions' => ['index', 'view'],
                        'roles' => ['teacher'],
                    ],
                    // everything else is denied
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'start_year' => Yii::t('app', 'Start Year'),
            'end_year' => Yii::t('app', 'End Year'),
            'active' => Yii::t('app', 'Active'),
        ];
    }
}
