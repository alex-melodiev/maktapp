<?php

namespace common\models;

use Yii;
use yii\filters\AccessControl;

/**
 * This is the model class for table "subject".
 *
 * @property integer $id
 * @property string $name
 */
class Subject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subject';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 50],
//            [
//                'allow' => false,
//                'roles' => ['*']
//                //'actions' => ['create', 'update']
//            ],
//            [
//                'allow' => true,
//                'actions' => ['index'],
//                'roles' => ['teacher']
//            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }
}
