<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel common\models\StdPersonalInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Student\'s Information');
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<style type="text/css">
    .panel-heading{
        background-color: #001F3F;
        color: white;
    }
</style>
<?php Pjax::begin(['id'=>'stdPersonal']); ?>
<div class="std-personal-info-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax' => true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['/std-registration'],
                    ['role'=>'','title'=> 'Create new Std Personal Infos','class'=>'btn btn-success']).
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
                    ['data-pjax'=>1, 'class'=>'btn btn-warning', 'title'=>'Reset Grid']).
                    '{toggleData}'
                    //'{export}'
                ],
                $gridColumns = [
                    'std_id',
                    'std_name',
                    'std_father_name',
                    'std_contact_no',
                    'std_DOB',
                    'std_gender',
                    'std_permanent_address',
                    'std_temporary_address',
                    'std_email:email',
                    'std_photo',
                    'std_b_form',
                    'std_district',
                    'std_religion',
                    'std_nationality',
                    'std_tehseel',
                ],
                //Reader a export dropdown menu
                ExportMenu::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => $gridColumns
                ]),
            ],          
            'striped' => true,
            'condensed' => true,
            'responsive' => true,          
            'panel' => [
                'type' => '', 
                'heading' => '<i class="glyphicon glyphicon-list"></i> Student Personal Information',
                //'before'=>'<em>* Resize table columns just like a spreadsheet by dragging the column edges.</em>',
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
            ]
        ])?>
    </div>
</div>
<?php Pjax::end(); ?>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "size"=>"modal-lg",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>
