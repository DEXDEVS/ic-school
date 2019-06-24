<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "emp_info".
 *
 * @property int $emp_id
 * @property int $emp_branch_id
 * @property string $emp_reg_no
 * @property string $emp_name
 * @property string $emp_father_name
 * @property string $emp_cnic
 * @property string $emp_contact_no
 * @property string $emp_date_of_birth
 * @property string $emp_perm_address
 * @property string $emp_temp_address
 * @property string $emp_marital_status
 * @property string $emp_fb_ID
 * @property string $emp_gender
 * @property string $emp_photo
 * @property int $emp_dept_id
 * @property string $emp_salary_type
 * @property string $emp_email
 * @property string $emp_qualification
 * @property int $emp_passing_year
 * @property string $emp_institute_name
 * @property string $degree_scan_copy
 * @property string $emp_cv 
 * @property string $emp_religion
 * @property string $emp_domicile
 * @property string $emp_status
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property EmpAttendance[] $empAttendances
 * @property EmpDepartments[] $empDepartments
 * @property EmpDesignation[] $empDesignations
 * @property EmpDocuments[] $empDocuments
 * @property Branches $empBranch
 * @property Departments $empDept
 * @property EmpLeave[] $empLeaves
 * @property EmpReference[] $empReferences
 * @property ExamsSchedule[] $examsSchedules
 * @property StdAttendance[] $stdAttendances
 * @property TeacherSubjectAssignHead[] $teacherSubjectAssignHeads
 */
class EmpInfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'emp_info';
    }

    public $reference; 

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['emp_branch_id', 'emp_reg_no', 'emp_name', 'emp_father_name', 'emp_cnic', 'emp_contact_no', 'emp_perm_address', 'emp_marital_status', 'emp_gender', 'emp_dept_id', 'emp_email', 'emp_qualification', 'emp_passing_year', 'emp_institute_name'], 'required'],
            [['emp_branch_id', 'emp_dept_id', 'emp_passing_year', 'created_by', 'updated_by'], 'integer'],
            [['emp_marital_status', 'emp_gender', 'emp_status'], 'string'],
            [['created_at', 'updated_at', 'emp_status', 'created_by', 'updated_by', 'degree_scan_copy', 'emp_cv', 'emp_photo', 'emp_salary_type','barcode','emp_fb_ID','emp_date_of_birth',
               'emp_religion','emp_domicile', 'emp_temp_address'], 'safe'],
            [['emp_reg_no', 'emp_name', 'emp_father_name', 'emp_qualification', 'emp_institute_name','emp_fb_ID'], 'string', 'max' => 50],
            [['emp_cnic', 'emp_contact_no','emp_religion'], 'string', 'max' => 15],
            [['emp_domicile'], 'string', 'max' => 30],
            [['emp_perm_address', 'emp_temp_address', 'emp_photo', 'degree_scan_copy', 'emp_cv'], 'string', 'max' => 200],
            [['emp_email'], 'string', 'max' => 84],
            [['emp_branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branches::className(), 'targetAttribute' => ['emp_branch_id' => 'branch_id']],
            [['emp_dept_id'], 'exist', 'skipOnError' => true, 'targetClass' => Departments::className(), 'targetAttribute' => ['emp_dept_id' => 'department_id']],
            [['emp_photo', 'degree_scan_copy','emp_cv'], 'file', 'extensions' => 'jpg'],
            [['emp_email'],'email'],
            [['reference'],'string', 'max' => 84],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'emp_id' => 'Employee ID',
            'emp_branch_id' => 'Branch Name',
            'emp_reg_no' => 'Reg No',
            'emp_name' => 'Name',
            'emp_father_name' => 'Father Name',
            'emp_cnic' => 'CNIC',
            'emp_contact_no' => 'Contact No',
            'emp_perm_address' => 'Permanent Address',
            'emp_temp_address' => 'Temporary Address',
            'emp_marital_status' => 'Marital Status',
            'emp_fb_ID' => 'Facebook ID',
            'emp_gender' => 'Gender',
            'emp_photo' => 'Photo',
            'emp_dept_id' => 'Department Name',
            'emp_salary_type' => 'Salary Type',
            'emp_email' => 'Email',
            'emp_qualification' => 'Qualification',
            'emp_passing_year' => 'Passing Year',
            'emp_institute_name' => 'Institute Name',
            'degree_scan_copy' => 'Degree Scan Copy',
            'emp_cv' => 'CV',
            'emp_date_of_birth'=> 'DOB',
            'emp_religion' => 'Religion',
            'emp_domicile' => 'Domicile',
            'emp_status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpAttendances()
    {
        return $this->hasMany(EmpAttendance::className(), ['emp_id' => 'emp_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpDepartments()
    {
        return $this->hasMany(EmpDepartments::className(), ['emp_id' => 'emp_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpDesignations()
    {
        return $this->hasMany(EmpDesignation::className(), ['emp_id' => 'emp_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpDocuments()
    {
        return $this->hasMany(EmpDocuments::className(), ['emp_info_id' => 'emp_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpBranch()
    {
        return $this->hasOne(Branches::className(), ['branch_id' => 'emp_branch_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpDept()
    {
        return $this->hasOne(Departments::className(), ['department_id' => 'emp_dept_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpLeaves()
    {
        return $this->hasMany(EmpLeave::className(), ['emp_id' => 'emp_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpReferences()
    {
        return $this->hasMany(EmpReference::className(), ['emp_id' => 'emp_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExamsSchedules()
    {
        return $this->hasMany(ExamsSchedule::className(), ['emp_id' => 'emp_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStdAttendances()
    {
        return $this->hasMany(StdAttendance::className(), ['teacher_id' => 'emp_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeacherSubjectAssignHeads()
    {
        return $this->hasMany(TeacherSubjectAssignHead::className(), ['teacher_id' => 'emp_id']);
    }


public function getPhotoInfo(){
        $path = Url::to('@web/uploads/');
        $url = Url::to('@web/uploads/');
        $filename = $this->emp_name.'_emp_photo'.'.jpg';
        $alt = $this->emp_name."'s image not exist!";

        $imageInfo = ['alt'=>$alt];

        if(file_exists($path.$filename)){
            $imageInfo['url'] = $url.'default.jpg';
        }  else {
            $imageInfo['url'] = $url.$filename; 
        }
        return $imageInfo;
    }

    public function getDegreeInfo(){
        $path = Url::to('@web/uploads/');
        $url = Url::to('@web/uploads/');
        $filename = $this->emp_name.'_degree_scan_copy'.'.jpg';
        $alt = $this->emp_name."'s image not exist!";

        $imageInfo = ['alt'=>$alt];

        if(file_exists($path.$filename)){
            $imageInfo['url'] = $url.'default.jpg';
        }  else {
            $imageInfo['url'] = $url.$filename; 
        }
        return $imageInfo;
    }
    public function getCvInfo(){
        $path = Url::to('@web/uploads/');
        $url = Url::to('@web/uploads/');
        $filename = $this->emp_name.'emp_cv'.'.jpg';
        $alt = $this->emp_name."'s image not exist!";

        $imageInfo = ['alt'=>$alt];

        if(file_exists($path.$filename)){
            $imageInfo['url'] = $url.'default.jpg';
        }  else {
            $imageInfo['url'] = $url.$filename; 
        }
        return $imageInfo;
    }
}
