<?php
namespace frontend\models;

use common\models\User;
use common\models\UserProfile;
use yii\base\Exception;
use yii\base\Model;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * Create user form
 */
class StudentForm extends Model
{
    public $username;
    public $email;
    public $password;

    public $phone; //*
    public $firstname; //*
    public $middlename;//*
    public $lastname;//*
    public $class_id;//*
    public $school_id;//*

    public $status;
    public $roles;

    public $parentName;//*
    public $parentEmail;//*
    public $parentPhone;//*

    private $model;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            [['firstname', 'middlename', 'lastname', 'phone'], 'string'],
            [['class_id', 'school_id'], 'integer'],

            ['username', 'unique', 'targetClass' => User::className(), 'filter' => function ($query) {
                if (!$this->getModel()->isNewRecord) {
                    $query->andWhere(['not', ['id'=>$this->getModel()->id]]);
                }
            }],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass'=> User::className(), 'filter' => function ($query) {
                if (!$this->getModel()->isNewRecord) {
                    $query->andWhere(['not', ['id'=>$this->getModel()->id]]);
                }
            }],

            ['password', 'required', 'on' => 'create'],
            ['password', 'string', 'min' => 6],

            [['status'], 'integer'],
            [['roles'], 'each',
                'rule' => ['in', 'range' => ArrayHelper::getColumn(
                    Yii::$app->authManager->getRoles(),
                    'name'
                )]
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('common', 'Username'),
            'email' => Yii::t('common', 'Email'),
            'status' => Yii::t('common', 'Status'),
            'password' => Yii::t('common', 'Password'),
            'roles' => Yii::t('common', 'Roles'),
            'firstname' => Yii::t('common', 'First Name'),
            'middlename' => Yii::t('common', 'Middle Name'),
            'lastname' => Yii::t('common', 'Last Name'),
        ];
    }

    /**
     * @param User $model
     * @return mixed
     */
    public function setModel($model)
    {
        $this->username = $model->username;
        $this->email = $model->email;
        $this->status = $model->status;
        $this->school_id = User::findCurrentUser()->school_id;
        $this->class_id = $model->class_id;
        $this->firstname = $model->userProfile->firstname;
        $this->middlename = $model->userProfile->middlename;
        $this->lastname = $model->userProfile->lastname;
        $this->phone = $model->userProfile->phone;
        $this->model = $model;
        $this->roles = ArrayHelper::getColumn(
            Yii::$app->authManager->getRolesByUser($model->getId()),
            'name'
        );
        return $this->model;
    }

    /**
     * @return User
     */
    public function getModel()
    {
        if (!$this->model) {
            $this->model = new User();
        }
        return $this->model;
    }

    /**
     * Signs user up.
     * @return User|null the saved model or null if saving fails
     * @throws Exception
     */
    public function save()
    {
        if ($this->validate()) {
            $model = $this->getModel();
            $isNewRecord = $model->getIsNewRecord();
            $model->username = $this->username;
            $model->email = $this->email;
            $model->status = $this->status;
            $model->class_id = $this->class_id;
            $model->school_id = User::findCurrentUser()->school_id;



            $profileData = [
                'firstname' => $this->firstname,
                'lastname' => $this->lastname,
                'middlename' => $this->middlename,
                'phone' => $this->phone,
            ];

            if(!$isNewRecord) {
                $prof = UserProfile::findOne(['user_id' => $model->id]);
                $prof->firstname = $this->firstname;
                $prof->lastname = $this->lastname;
                $prof->middlename = $this->middlename;
                $prof->phone = $this->phone;

                $prof->save();
            }



            if ($this->password) {
                $model->setPassword($this->password);
            }
            if (!$model->save()) {
                throw new Exception('Model not saved');
            }
            if ($isNewRecord) {

                $model->afterSignup($profileData);
            }
            $auth = Yii::$app->authManager;
            $auth->revokeAll($model->getId());

            $auth = Yii::$app->authManager;
            $auth->assign($auth->getRole(User::ROLE_STUDENT), $model->getId());

//            if ($this->roles && is_array($this->roles)) {
//                foreach ($this->roles as $role) {
//                    $auth->assign($auth->getRole($role), $model->getId());
//                }
//            }

            return !$model->hasErrors();
        }
        return null;
    }
}
