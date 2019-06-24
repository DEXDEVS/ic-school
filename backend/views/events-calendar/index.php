<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel common\models\EventsCalendarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Events Calendars';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<div class="events-calendar-index">
    <div id="ajaxCrudDatatable">
        <?= \yii2fullcalendar\yii2fullcalendar::widget(array(
      'events'=> $events,
        ));
        ?> 
    </div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>
