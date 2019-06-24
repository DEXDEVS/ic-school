<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\AccountNature */
?>
<div class="account-nature-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'account_nature_id',
            'account_no',
            'account_nature_name',
            'account_nature_status',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
