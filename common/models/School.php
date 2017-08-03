<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "school".
 *
 * @property integer $id
 * @property string $name
 * @property string $region
 * @property string $city
 * @property string $area
 * @property string $address
 */
class School extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'school';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'region', 'city', 'area', 'address'], 'required'],
            [['name'], 'string', 'max' => 100],
            [['region', 'area'], 'string', 'max' => 50],
            [['city'], 'string', 'max' => 20],
            [['address'], 'string', 'max' => 120],
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
            'region' => Yii::t('app', 'Region'),
            'city' => Yii::t('app', 'City'),
            'area' => Yii::t('app', 'Area'),
            'address' => Yii::t('app', 'Address'),
        ];
    }
}
