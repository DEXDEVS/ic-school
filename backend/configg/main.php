<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'name' => 'IC - Institute on Cloud',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'language' => 'ur',
    'sourceLanguage' => 'en',
    'modules' => [
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ],
        'backup' => [
            'class' => 'spanjeta\modules\backup\Module',
        ], 
    ],
    'components' => [
        'request' => [
            'class' => 'common\components\Request',
            'web'=> '/backend/web',
            'adminUrl' => '/admin',
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                //site
                'admin' => 'admin',
                'user' => 'admin/user/index',
                'login' => 'site/login',
                'logout' => 'site/login',
                'home' => 'site/index',
                'passwords' => 'site/passwords',
                'user-profile' => 'site/user-profile',
                'update-profile' => 'site/update-profile',
                'premium-version' => 'site/premium-version',
                'income-expense' => 'site/income-expense',
                'income-expense-sub' => 'site/income-expense-sub',
                'fee-statistics-main' => 'site/fee-statistics-main',
                'fee-statistics-sub' => 'site/fee-statistics-sub',
                //-------------------------------------------
                //institute
                'institute' => 'institute/index',
                //-------------------------------------------
                //branches
                'branches' => 'branches/index',
                'branches-view' => 'branches/view',
                //-------------------------------------------
                //system-configuration
                'departments-view' => 'departments/view',
                'std-sessions' => 'std-sessions/index',
                'std-sections' => 'std-sections/index',
                'std-class-name' => 'std-class-name/index',
                'subjects' => 'subjects/index',
                'std-subjects' => 'std-subjects/index',
                'fee-type' => 'fee-type/index',
                'std-fee-pkg' => 'std-fee-pkg/index',
                //-------------------------------------------
                //std_inquiry
                'std-inquiry' => 'std-inquiry/index',
                'inquiry-report' => 'std-inquiry/inquiry-report',
                'inquiry-report-detail' => 'std-inquiry/inquiry-report-detail',
                //std-info
                'std-personal-info' => 'std-personal-info/index',
                'std-personal-info-view' => 'std-personal-info/view',
                'std-registration' => 'std-registration/create',
                'std-personal-info-update' => 'std-personal-info/update',
                'std-personal-info-std-photo' => 'std-personal-info/std-photo',
                'std-guardian-info-update' => 'std-guardian-info/update',
                'std-ice-info-update' => 'std-ice-info/update',
                'std-academic-info' => 'std-academic-info/index',
                'std-academic-info-update' => 'std-academic-info/update',
                'std-fee-details-update' => 'std-fee-details/update',
                //-------------------------------------------
                //emp-info
                'emp-info' => 'emp-info/index',
                'emp-info-create' => 'emp-info/create',
                'emp-info-view' => 'emp-info/view',
                'emp-info-update' => 'emp-info/update',
                'emp-reference-update' => 'emp-reference/update',
                'emp-documents-create' => 'emp-documents/create',
                'emp-delete-doc' => 'emp-documents/delete-doc',
                'emp-download-doc' => 'emp-documents/download-doc',
                'emp-type' => 'emp-type/index',
                'emp-designation' => 'emp-designation/index',
                'print-id-card' => 'emp-info/print-id-card',
                //-------------------------------------------
                //fee-transaction
                'class-account' => 'fee-transaction-detail/class-account',
                'fee-transaction-detail-fee-voucher' => 'fee-transaction-detail/fee-voucher',
                'fee-transaction-detail-collect-voucher' => 'fee-transaction-detail/collect-voucher',
                'fee-transaction-detail-class-account-fee-report' => 'fee-transaction-detail/class-account-fee-report',
                'class-fee-report-detail' => 'fee-transaction-detail/class-fee-report-detail',
                'fee-transaction-detail-class-account-info' => 'fee-transaction-detail/class-account-info',
                'voucher' => 'fee-transaction-detail/voucher',
                'partial-voucher-detail' => 'fee-transaction-detail/partial-voucher-detail',
                'partial-voucher-head' => 'fee-transaction-detail/partial-voucher-head',
                'monthly-voucher' => 'fee-transaction-detail/monthly-voucher',
                'yearly-voucher' => 'fee-transaction-detail/yearly-voucher',
                'student-account' => 'fee-transaction-detail/student-account',
                'student-account-info' => 'fee-transaction-detail/student-account-info',
                'monthly-fee-report' =>'fee-transaction-detail/monthly-fee-report',
                'monthly-report-head' =>'fee-transaction-detail/monthly-report-head',
                'monthly-report-detail' => 'fee-transaction-detail/monthly-report-detail',
                //-------------------------------------------
                //std-enrollment
                'std-enrollment-head-view' => 'std-enrollment-head/view',
                'std-enrollment-head' => 'std-enrollment-head/index',
                //'std-enrollment-head-view' => 'std-enrollment-head/view',
                'std-promote' => 'std-enrollment-head/std-promote',
                //-------------------------------------------
                // teacher-details
                'teacher-subject-assign-head' => 'teacher-subject-assign-head/index',
                'teacher-subject-assign-head-view' => 'teacher-subject-assign-head/view',
                //-------------------------------------------
                //comunication
                'emails' => 'emails/index',
                'emails-create' => 'emails/create',
                'notice' => 'notice/index',
                'sms' => 'sms/index',
                'absent-sms' => 'sms/absent-sms',
                'custom-sms' => 'custom-sms/index',
                'msg-of-day' => 'msg-of-day/index',
                'events' => 'events/index',
                //-------------------------------------------
                //exams-category
                'exams-category' => 'exams-category/index',
                'exam-lists' => 'exams-category/exam-lists',
                'view-datesheet' => 'exams-category/view-datesheet',
                'update-datesheet' => 'exams-category/update-datesheet',
                'view-result-cards' => 'exams-category/view-result-cards',
                'exams-category-view' => 'exams-category/view',
                'emp-exam-attendance' => 'exams-category/emp-exam-attendance',
                'exam-cateogry-details' => 'exams-category/exam-cateogry-details',
                'view-marks-weightage' => 'exams-category/view-marks-weightage',
                'view-marks-sheet' => 'exams-category/view-marks-sheet',
                'view-sections' => 'exams-category/view-sections',
                //-------------------------------------------
                //marks-details
                'grades' => 'grades/index',
                'manage-marks-sheet' => 'marks-details/manage-marks-sheet',
                //'view-marks-sheet' => 'marks-details/view-marks-sheet',
                'update-marks' => 'marks-details/update-marks',
                'marks-weitage' => 'marks-weitage/index',
                'manage-exams' => 'exams-schedule/manage-exams',
                'manage-exam-sections' => 'exams-schedule/manage-exam-sections',
                'fetch-sections' => 'exams-schedule/fetch-sections',
                'marks-weightage-head' => 'marks-weightage-head/index',
                //'marks-weightage-view' => 'marks-weightage-head/view',
                //-------------------------------------------
                // emp attendance report
                'emp-att-report' => 'emp-attendance/emp-att-report',
                'employess-att-report' => 'emp-attendance/employess-att-report',
                'final-attendance' => 'emp-attendance/final-attendance',
                'emp-attendance' => 'emp-attendance/index',
                'emp-attendance-create' => 'emp-attendance/create',
                'emp-leave' => 'emp-leave/index',
                //-------------------------------------------
                // account-transactions
                'account-transactions' => 'account-transactions/index',
                'balance-sheet' => 'account-transactions/balance-sheet',
                //-------------------------------------------
                //timeTable
                'fetch-subjects' => 'time-table-head/fetch-subjects',
                'time-table-view' => 'time-table-head/time-table-view',
                'class-time-table' => 'time-table-head/class-time-table',
                'time-table' => 'site/time-table',
                'time-table-update' => 'time-table-head/time-table-update',
                //-------------------------------------------
                //Backup
                'backup' => 'backup',
                'backup-index' => 'backup/default/index',
                'backup-create' => 'backup/default/create',
                'backup-restore' => 'backup/default/restore',

            ],
        ],
    ],
    'params' => $params,
];


