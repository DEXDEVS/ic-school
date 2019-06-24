<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\EmpInfo */
?>
<div class="emp-info-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'emp_id',
            'emp_branch_id',
            'emp_reg_no',
            'emp_name',
            'emp_father_name',
            'emp_cnic',
            'emp_contact_no',
            'emp_date_of_birth',
            'emp_perm_address',
            'emp_temp_address',
            'emp_marital_status',
            'emp_fb_ID',
            'emp_gender',
            'emp_photo',
            'emp_dept_id',
            'emp_salary_type',
            'emp_email:email',
            'emp_qualification',
            'emp_passing_year',
            'emp_institute_name',
            'degree_scan_copy',
            'emp_religion',
            'emp_domicile',
            'emp_cv',
            'emp_status',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
            'delete_status',
        ],
    ]) ?>

</div>
