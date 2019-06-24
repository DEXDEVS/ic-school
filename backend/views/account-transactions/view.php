<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\AccountTransactions */
?>
<div class="account-transactions-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'trans_id',
            //'branch_id',
            'branch.branch_name',
            'account_nature',
            'accountRegister.account_name',
            'date',
            'description',
            'total_amount',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
