<?php
use yii\helpers\Url;
use yii\helpers\Html;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    // [
    //     'class' => 'kartik\grid\SerialColumn',
    //     'width' => '30px',
    // ],
        [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'std_id',
        'width' => '20px',
        'headerOptions' => [
            // this should be on a CSS file as class instead of a inline style attribute...
            'style' => 'text-align: center !important;vertical-align: middle !important'
        ],
        'format' => 'raw',
        'value' => function($model, $key, $index, $column) {
                        if (empty($model->std_id) || empty($model->std_id)) {
                            return;
                        }
                        return Html::a($model->std_id, [ './std-personal-info-view','id' => $model->std_id ], ['title' => 'std_id','id' => $model->std_id , 'target' => '_blank', 'data' => ['pjax' => 0]] );
                    },
        'contentOptions' => function ($model, $key, $index, $column) {
        return ['class' => 'text-center','style' => 'background-color:' 
            . (!empty($model->std_id) && $model->std_id / $model->std_id < 2
                ? '#c1efba' : 'black')];
        },
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'std_name',
        'format' => 'raw',
        'value' => function($model, $key, $index, $column) {
                        if (empty($model->std_name) || empty($model->std_name)) {
                            return;
                        }
                        return Html::a($model->std_name, [ './std-personal-info-view','id' => $model->std_id ], ['title' => 'std_id','id' => $model->std_id , 'target' => '_blank', 'data' => ['pjax' => 0]] );
                    },
    ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'branch_id',
    //     'value'=>'branch.branch_name',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'std_father_name',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'std_contact_no',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'std_DOB',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'std_gender',
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'std_permanent_address',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'std_temporary_address',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'std_email',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'status',
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'std_photo',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'std_b_form',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'std_district',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'std_religion',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'std_nationality',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'std_tehseel',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'admission_date',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'std_cast',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'created_at',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'updated_at',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'created_by',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'updated_by',
    // ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        /*'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },*/
        'viewOptions'=>['role'=>'','title'=>'View','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item'], 
    ],

];   