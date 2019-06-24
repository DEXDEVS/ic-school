<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'system-settings', 
                            'system-configuration', 'students', 'employees', 
                            'communication', 'fee','premium-version', 'income-expense', 'income-expense-sub', 'fee-statistics-main' , 'fee-statistics-sub','passwords','user-profile', 'request-password-reset'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        //throw new NotFoundHttpException("Something unexpected happened");
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
     public function actionPasswords()
    {
        return $this->render('passwords');
    }
     public function actionUserProfile()
    {
        return $this->render('user-profile');
    }

    /**
     * Login action.
     *
     * @return string
     */

    public function actionLogin()
    {
        // if (!Yii::$app->user->isGuest) {
        // return $this->goHome();
        // }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if (\Yii::$app->user->can('login')){
                // yes he is Admin, so redirect page 
                Yii::$app->session->setFlash('success', 'Dear '.$model->username.', Wellcome to Admin Panel.');
                return $this->goBack();
            }
            else { // if he is not an Admin then what :P
                   // put him out :P Automatically logout. 
                //Yii::$app->user->logout();
                // set error on login page. 
                Yii::$app->session->setFlash('error', 'You are not authorized to login Admin\'s penal.<br /> Please use valid Username & Password.<br />Please contact Administrator for details.');
                //redirect again page to login form.
                return $this->redirect(['login']);
                }  
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    // actionSendSms.....
    public function actionSendSms()
    {
        return $this->render('send-sms');
    }
    public function actionPremiumVersion()
    {
        return $this->render('premium-version');
    }
    //  actionSystemSettings.... 
    public function actionSystemSettings()
    {
        return $this->render('system-settings');
    }
    // actionSystemConfiguration
    public function actionSystemConfiguration()
    {
        return $this->render('system-configuration');
    }
    // actionStudents...
    public function actionStudents()
    {
        return $this->render('students');
    }
    // actionEmployee
    public function actionEmployees()
    {
        return $this->render('employees');
    }
    // actionCommunication...
    public function actionCommunication()
    {
        return $this->render('communication');
    }
    // actionFee...
    public function actionFee()
    {
        return $this->render('fee');
    }
    // Data Visulization routes...
    // income-expense-main
    public function actionIncomeExpense()
    {
        return $this->render('income-expense');
    }
    // income-expense-sub
    public function actionIncomeExpenseSub()
    {
        return $this->render('income-expense-sub');
    }
    // fee-statistics-main
    public function actionFeeStatisticsMain()
    {
        return $this->render('fee-statistics-main');
    }
    // fee-statistics-main
    public function actionFeeStatisticsSub()
    {
        return $this->render('fee-statistics-sub');
    }  

}