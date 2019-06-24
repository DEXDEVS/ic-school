<?php

namespace backend\controllers;

use Yii;
use common\models\EmpInfo;
use common\models\EmpReference;
use common\models\EmpDesignation;
use common\models\EmpInfoSearch;
use common\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use \yii\web\Response;
use yii\helpers\Html;
use yii\web\UploadedFile;

/**
 * EmpInfoController implements the CRUD actions for EmpInfo model.
 */
class EmpInfoController extends Controller
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
                        'actions' => ['logout', 'index', 'create', 'view', 'update', 'delete', 'bulk-delete','emp-details', 'print-id-card' ,'bulk-sms'],
                        'allow' => true,
                        'roles' => ['@','view'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'bulk-delete' => ['post'],
                    'bulk-sms' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all EmpInfo models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new EmpInfoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single EmpInfo model.
     * @param integer $id
     * @return mixed
     */
    // public function actionView($id)
    // {   
    //     $request = Yii::$app->request;
    //     if($request->isAjax){
    //         Yii::$app->response->format = Response::FORMAT_JSON;
    //         return [
    //                 'title'=> "EmpInfo #".$id,
    //                 'content'=>$this->renderAjax('view', [
    //                     'model' => $this->findModel($id),
    //                 ]),
    //                 'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
    //                         Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
    //             ];    
    //     }else{
    //         return $this->render('view', [
    //             'model' => $this->findModel($id),
    //         ]);
    //     }
    // }

    public function actionView($id)
    {
       return $this->render('emp-details'); 
    }

    public function actionPrintIdCard($id)
    {
       return $this->render('print-id-card'); 
    }

   
    /**
     * Creates a new EmpInfo model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new EmpInfo();  
        $empDesignation = new EmpDesignation();
        $empRefModel = new EmpReference();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create new EmpInfo",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'empDesignation' => $empDesignation,
                        'empRefModel' => $empRefModel,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $empDesignation->load($request->post()) && $empRefModel->load($request->post()) ){
                    $transaction = \Yii::$app->db->beginTransaction();
                    try {
                        var_dump($model->emp_name);
                        die();
                        $model->emp_photo = UploadedFile::getInstance($model,'emp_photo');
                        if(!empty($model->emp_photo)){
                            $imageName = $model->emp_name.'_emp_photo'; 
                            $model->emp_photo->saveAs('uploads/'.$imageName.'.'.$model->emp_photo->extension);
                            //save the path in the db column
                            $model->emp_photo = 'uploads/'.$imageName.'.'.$model->emp_photo->extension;
                        } else {
                           $model->emp_photo = '0'; 
                        }
                        $model->degree_scan_copy = UploadedFile::getInstance($model,'degree_scan_copy');
                        if(!empty($model->degree_scan_copy)){
                            $imageName = $model->emp_name.'_degree_scan_copy'; 
                            $model->degree_scan_copy->saveAs('uploads/'.$imageName.'.'.$model->degree_scan_copy->extension);
                            //save the path in the db column
                            $model->degree_scan_copy = 'uploads/'.$imageName.'.'.$model->degree_scan_copy->extension;
                        } else {
                           $model->degree_scan_copy = '0'; 
                        }
                        $model->emp_cv = UploadedFile::getInstance($model,'emp_cv');
                        if(!empty($model->emp_cv)){
                            $imageName = $model->emp_name.'_emp_cv'; 
                            $model->emp_cv->saveAs('uploads/'.$imageName.'.'.$model->emp_cv->extension);
                            //save the path in the db column
                            $model->emp_cv = 'uploads/'.$imageName.'.'.$model->emp_cv->extension;
                        } else {
                           $model->emp_cv = '0'; 
                        }
                        $branch_id = Yii::$app->user->identity->branch_id;
                        $model->emp_branch_id = $branch_id;
                        $model->emp_status = 'Active';
                        $model->created_by = Yii::$app->user->identity->id; 
                        $model->created_at = new \yii\db\Expression('NOW()');
                        $model->updated_by = '0';
                        $model->updated_at = '0';
                        $model->save();

                        $empDesignation->emp_id = $model->emp_id;
                        $empDesignation->status = 'Active';
                        $empDesignation->created_by = Yii::$app->user->identity->id; 
                        $empDesignation->created_at = new \yii\db\Expression('NOW()');
                        $empDesignation->updated_by = '0';
                        $empDesignation->updated_at = '0';
                        $empDesignation->save();

                        $empRefModel->emp_id = $model->emp_id;
                        $empRefModel->save();

                        $user = new User();
                        $empPassword = rand(1000, 10000);
                        $user->branch_id = $model->emp_branch_id;
                        $user->username = $model->emp_cnic;
                        $user->email = $model->emp_email;
                        $user->user_photo = $model->emp_photo;
                        if($empDesignation->group_by == 'Faculty'){
                            $user->user_type = 'Teacher';
                        } else {
                            $user->user_type = 'Employee';
                        }
                        $user->setPassword($empPassword);
                        $user->generateAuthKey();
                        $user->save();
                        $transaction->commit();

                        // SMS....
                        $contact = $model->emp_contact_no;
                        $num = str_replace('-', '', $contact);
                        $to = str_replace('+', '', $num);
                        $message = "AOA! \nCongratulations! You have become a part of our family. \n\nYour Login credentials (username :".$model->emp_cnic.", Password: ".$empPassword.") ";
                        $sms = SmsController::sendSMS($to, $message);
                        return $this->redirect(['index']);

                        Yii::$app->session->setFlash('success', "You have successfully add employee...!");
                    } catch (Exception $e) {
                        $transaction->rollBack();
                        Yii::$app->session->setFlash('error', "Transaction Failed, Try Again...!");
                    }

                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Create new EmpInfo",
                    'content'=>'<span class="text-success">Create EmpInfo success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Create new EmpInfo",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'empDesignation' => $empDesignation,
                        'empRefModel' => $empRefModel,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $empDesignation->load($request->post()) && $empRefModel->load($request->post())) {
                $transaction = \Yii::$app->db->beginTransaction();
                    try {
                        $model->emp_photo = UploadedFile::getInstance($model,'emp_photo');
                        if(!empty($model->emp_photo)){
                            $imageName = $model->emp_name.'_emp_photo'; 
                            $model->emp_photo->saveAs('uploads/'.$imageName.'.'.$model->emp_photo->extension);
                            //save the path in the db column
                            $model->emp_photo = 'uploads/'.$imageName.'.'.$model->emp_photo->extension;
                        } else {
                           $model->emp_photo = '0'; 
                        }
                        $model->degree_scan_copy = UploadedFile::getInstance($model,'degree_scan_copy');
                        if(!empty($model->degree_scan_copy)){
                            $imageName = $model->emp_name.'_degree_scan_copy'; 
                            $model->degree_scan_copy->saveAs('uploads/'.$imageName.'.'.$model->degree_scan_copy->extension);
                            //save the path in the db column
                            $model->degree_scan_copy = 'uploads/'.$imageName.'.'.$model->degree_scan_copy->extension;
                        } else {
                           $model->degree_scan_copy = '0'; 
                        }
                        $model->emp_cv = UploadedFile::getInstance($model,'emp_cv');
                        if(!empty($model->emp_cv)){
                            $imageName = $model->emp_name.'_emp_cv'; 
                            $model->emp_cv->saveAs('uploads/'.$imageName.'.'.$model->emp_cv->extension);
                            //save the path in the db column
                            $model->emp_cv = 'uploads/'.$imageName.'.'.$model->emp_cv->extension;
                        } else {
                           $model->emp_cv = '0'; 
                        }
                        $branch_id = Yii::$app->user->identity->branch_id;
                        $model->emp_branch_id = $branch_id;
                        $model->emp_status = 'Active';
                        $model->created_by = Yii::$app->user->identity->id; 
                        $model->created_at = new \yii\db\Expression('NOW()');
                        $model->updated_by = '0';
                        $model->updated_at = '0';
                        $model->save();

                        $empDesignation->emp_id = $model->emp_id;
                        $empDesignation->status = 'Active';
                        $empDesignation->created_by = Yii::$app->user->identity->id; 
                        $empDesignation->created_at = new \yii\db\Expression('NOW()');
                        $empDesignation->updated_by = '0';
                        $empDesignation->updated_at = '0';
                        $empDesignation->save();

                        $empRefModel->emp_id = $model->emp_id;
                        $empRefModel->save();

                        $user = new User();
                        $empPassword = rand(1000, 10000);
                        $user->branch_id = $model->emp_branch_id;
                        $user->username = $model->emp_cnic;
                        $user->email = $model->emp_email;
                        $user->user_photo = $model->emp_photo;
                        if($empDesignation->group_by == 'Faculty'){
                            $user->user_type = 'Teacher';
                        } else {
                            $user->user_type = 'Employee';
                        }
                        $user->setPassword($empPassword);
                        $user->generateAuthKey();
                        $user->save();
                        $transaction->commit();

                        // SMS....
                        $contact = $model->emp_contact_no;
                        $num = str_replace('-', '', $contact);
                        $to = str_replace('+', '', $num);
                        $message = "AOA! \nCongratulations! You have become a part of Brookfield Family. \n\nYour Login credentials (username :".$model->emp_cnic.", Password: ".$empPassword.") ";
                        $sms = SmsController::sendSMS($to, $message);
                        return $this->redirect(['index']);

                        Yii::$app->session->setFlash('success', "You have successfully add employee...!");
                    } catch (Exception $e) {
                        $transaction->rollBack();
                        Yii::$app->session->setFlash('error', "Transaction Failed, Try Again...!");
                    }

                //return $this->redirect(['view', 'id' => $model->emp_id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'empDesignation' => $empDesignation,
                    'empRefModel' => $empRefModel,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing EmpInfo model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id); 
        $emp_info = Yii::$app->db->createCommand("SELECT emp_photo, degree_scan_copy,emp_cv FROM emp_info where emp_id = $id")->queryAll();      

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update EmpInfo #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post())){
                    $transaction = \Yii::$app->db->beginTransaction();
                    try {
                        $model->emp_photo = UploadedFile::getInstance($model,'emp_photo');
                        if(!empty($model->emp_photo)){
                            $imageName = $model->emp_name.'_emp_photo'; 
                            $model->emp_photo->saveAs('uploads/'.$imageName.'.'.$model->emp_photo->extension);
                            //save the path in the db column
                            $model->emp_photo = 'uploads/'.$imageName.'.'.$model->emp_photo->extension;
                        } else {
                           $model->emp_photo = $emp_info[0]['emp_photo'];  
                        }
                        $model->degree_scan_copy = UploadedFile::getInstance($model,'degree_scan_copy');
                        if(!empty($model->degree_scan_copy)){
                            $imageName = $model->emp_name.'_degree_scan_copy'; 
                            $model->degree_scan_copy->saveAs('uploads/'.$imageName.'.'.$model->degree_scan_copy->extension);
                            //save the path in the db column
                            $model->degree_scan_copy = 'uploads/'.$imageName.'.'.$model->degree_scan_copy->extension;
                        } else {
                           $model->degree_scan_copy = $emp_info[0]['degree_scan_copy'];  
                        }
                        $model->emp_cv = UploadedFile::getInstance($model,'emp_cv');
                        if(!empty($model->emp_cv)){
                            $imageName = $model->emp_name.'_emp_cv'; 
                            $model->emp_cv->saveAs('uploads/'.$imageName.'.'.$model->emp_cv->extension);
                            //save the path in the db column
                            $model->emp_cv = 'uploads/'.$imageName.'.'.$model->emp_cv->extension;
                        } else {
                           $model->emp_cv = $emp_info[0]['emp_cv'];  
                        }
                        $model->updated_by = Yii::$app->user->identity->id;
                        $model->updated_at = new \yii\db\Expression('NOW()');
                        $model->created_by = $model->created_by;
                        $model->created_at = $model->created_at;
                        $model->save();

                        $transaction->commit();
                        Yii::$app->session->setFlash('warning', "You have successfully update employee Info...!");
                    } catch (Exception $e) {
                        $transaction->rollBack();
                        Yii::$app->session->setFlash('error', "Transaction Failed, Try Again...!");
                    }
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "EmpInfo #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Update EmpInfo #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];        
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post())) {
                $transaction = \Yii::$app->db->beginTransaction();
                    try {
                        $model->emp_photo = UploadedFile::getInstance($model,'emp_photo');
                        if(!empty($model->emp_photo)){
                            $imageName = $model->emp_name.'_emp_photo'; 
                            $model->emp_photo->saveAs('uploads/'.$imageName.'.'.$model->emp_photo->extension);
                            //save the path in the db column
                            $model->emp_photo = 'uploads/'.$imageName.'.'.$model->emp_photo->extension;
                        } else {
                           $model->emp_photo = $emp_info[0]['emp_photo'];  
                        }
                        $model->degree_scan_copy = UploadedFile::getInstance($model,'degree_scan_copy');
                        if(!empty($model->degree_scan_copy)){
                            $imageName = $model->emp_name.'_degree_scan_copy'; 
                            $model->degree_scan_copy->saveAs('uploads/'.$imageName.'.'.$model->degree_scan_copy->extension);
                            //save the path in the db column
                            $model->degree_scan_copy = 'uploads/'.$imageName.'.'.$model->degree_scan_copy->extension;
                        } else {
                           $model->degree_scan_copy = $emp_info[0]['degree_scan_copy'];  
                        }
                        $model->emp_cv = UploadedFile::getInstance($model,'emp_cv');
                        if(!empty($model->emp_cv)){
                            $imageName = $model->emp_name.'_emp_cv'; 
                            $model->emp_cv->saveAs('uploads/'.$imageName.'.'.$model->emp_cv->extension);
                            //save the path in the db column
                            $model->emp_cv = 'uploads/'.$imageName.'.'.$model->emp_cv->extension;
                        } else {
                           $model->emp_cv = $emp_info[0]['emp_cv'];  
                        }
                        $model->updated_by = Yii::$app->user->identity->id;
                        $model->updated_at = new \yii\db\Expression('NOW()');
                        $model->created_by = $model->created_by;
                        $model->created_at = $model->created_at;
                        $model->save();

                        $transaction->commit();
                        Yii::$app->session->setFlash('warning', "You have successfully update employee Info...!");
                        return $this->redirect(['view', 'id' => $model->emp_id]);
                    } catch (Exception $e) {
                        $transaction->rollBack();
                        Yii::$app->session->setFlash('error', "Transaction Failed, Try Again...!");
                    }
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing EmpInfo model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }

     /**
     * Delete multiple existing EmpInfo model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkDelete()
    {        
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);
            $model->delete();
        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
       
    }


    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionBulkSms()
    {      
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        $array = array();
        foreach ( $pks as $pk ) {
            $empNumbers = Yii::$app->db->createCommand("SELECT emp_contact_no FROM emp_info WHERE emp_id = '$pk'")->queryAll();
            $number = $empNumbers[0]['emp_contact_no'];
            $numb = str_replace('-', '', $number);
            $num = str_replace('+', '', $numb);
            $array[] = $num;
        }

        $to = implode(',', $array);

        if (isset($_POST['message'])) {
            $message = $_POST['message'];

            $sms = SmsController::sendSMS($to, $message);
        }
        return $this->redirect(['./emp-info']);
    }

    /**
     * Finds the EmpInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EmpInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EmpInfo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
