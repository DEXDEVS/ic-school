<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel common\models\StdAcademicInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Std Academic Infos';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<div class="std-academic-info-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>
                    // Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'],
                    // ['role'=>'modal-remote','title'=> 'Create new Std Academic Infos','class'=>'btn btn-success']).
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
                    ['data-pjax'=>1, 'class'=>'btn btn-warning', 'title'=>'Reset Grid']).
                    '{toggleData}'
                    //'{export}'
                ],
            ],          
            'striped' => true,
            'condensed' => true,
            'responsive' => true,          
            'panel' => [
                'type' => 'primary', 
                'heading' => '<i class="glyphicon glyphicon-list"></i> Std Academic Infos listing',
<<<<<<< HEAD
                // 'before'=>'<em>* Resize table columns just like a spreadsheet by dragging the column edges.</em>',
                // 'after'=>BulkButtonWidget::widget([
                //             'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Delete All',
                //                 ["bulk-delete"] ,
                //                 [
                //                     "class"=>"btn btn-danger btn-xs",
                //                     'role'=>'modal-remote-bulk',
                //                     'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                //                     'data-request-method'=>'post',
                //                     'data-confirm-title'=>'Are you sure?',
                //                     'data-confirm-message'=>'Are you sure want to delete this item'
                //                 ]),
                //         ]).                        
                //         '<div class="clearfix"></div>',
=======
                'before'=>'<em>* Resize table columns just like a spreadsheet by dragging the column edges.</em>',
                'after'=>BulkButtonWidget::widget([
                    // 'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Delete All',
                    //     ["bulk-delete"] ,
                    //     [
                    //         "class"=>"btn btn-danger btn-xs",
                    //         'role'=>'modal-remote-bulk',
                    //         'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                    //         'data-request-method'=>'post',
                    //         'data-confirm-title'=>'Are you sure?',
                    //         'data-confirm-message'=>'Are you sure want to delete this item'
                    //     ]),
                    'buttons'=>Html::a('<i class="fa fa-comments-o"></i>&nbsp; Send SMS',
                        ["bulk-sms"] ,
                        [
                            "class"=>"btn btn-success btn-xs btn-flat",
                            'role'=>'modal-remote-bulk',
                            'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                            'data-request-method'=> 'post',
                            'data-confirm-title'=> 'SMS',
                            'data-confirm-message'=>'<textarea name="message" class="form-control" rows="5" placeholder="Type message here"></textarea>'
                        ]),
                ]).                        
                '<div class="clearfix"></div>',
>>>>>>> dcd5cf70403927dd661e311e5e3237e7776e06b6
            ]
        ])?>
    </div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>
