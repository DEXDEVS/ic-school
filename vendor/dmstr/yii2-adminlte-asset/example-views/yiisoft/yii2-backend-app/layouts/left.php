<?php 

    $userID = Yii::$app->user->id;
    $user = Yii::$app->db->createCommand("SELECT user_photo FROM user WHERE id = '$userID'")->queryAll();
    // Student Photo...
    $userPhoto = $user[0]['user_photo'];
?>
<style type="text/css">
    .main-sidebar{
        color: #ECF0F5;
        background-color: #001F3F;
    }
    .main-sidebar a{
        color: #ECF0F5;
    }
    .sidebar a:hover{
        font-weight: bold;
        background-color: #000000;
        color: #ffffff;
    }
</style>
<aside class="main-sidebar">

    <section class="sidebar" style="overflow-y: visible; ">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo '../frontend/web/'.$userPhoto; ?>" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>
                    <?= Yii::$app->user->identity->username ?>
                    <!--  -->
                </p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <!-- <div class="input-group">
                <input type="text" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div> -->
        </form>
        <!-- /.search form -->
        <?php if(Yii::$app->user->can('navigation')){ ?>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    // ['label' => 'Menus', 'options' => ['class' => 'header center']],
                    ['label' => 'Home', 'icon' => 'dashboard', 'url' => "./home"],
                    //['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    ['label' => 'Login', 'url' => ["../login"], 'visible' => Yii::$app->user->isGuest],

                    // ------------------------------------------------
                    // Student Module start...
                    [
                        'label' => 'Students',
                        'icon' => 'graduation-cap',
                        'url' => '#',
                        'items' => [
                            // ['label' => 'Inquiry', 'icon' => 'caret-right', 'url' => ["/std-inquiry"],],
                            ['label' => 'Registration', 'icon' => 'caret-right', 'url' => ["/std-personal-info"],],
                            ['label' => 'Enrollment', 'icon' => 'caret-right', 'url' => ["/std-enrollment-head"],],
                            ['label' => 'Promotion/Demotion', 'icon' => 'caret-right', 'url' => ["./premium-version"],],
                            ['label' => 'ID Cards', 'icon' => 'caret-right', 'url' => ["./premium-version"],],
                            ['label' => 'Attendance System', 'icon' => 'caret-right', 'url' => ["./premium-version"],],
                            [
                                'label' => 'Online Admission',
                                'icon' => 'caret-right',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Announcment', 'icon' => 'chevron-right', 'url' => './premium-version',],
                                    ['label' => 'Merit Module', 'icon' => 'chevron-right', 'url' => './premium-version',],
                                    ['label' => 'Scholarship', 'icon' => 'chevron-right', 'url' => './premium-version',],
                                    ['label' => 'Entry Test', 'icon' => 'chevron-right', 'url' => './premium-version',],
                                ],
                            ],
                            //['label' => 'Promotion/Demotion', 'icon' => 'caret-right', 'url' => ["./std-promote"],],
                            
                            //['label' => 'Class', 'icon' => 'caret-right', 'url' => ["/std-class"],],
                            // ['label' => 'Students Enrolment', 'icon' => 'caret-right', 'url' => ["/std-enrollment-head"],],
                            // ['label' => 'Assign Teacher', 'icon' => 'caret-right', 'url' => ["/teacher-subject-assign-head"],],
                        ],
                    ],
                    
                    // ------------------------------------------------
                    // ------------------------------------------------
                    // Fee Module start...
                    [
                        'label' => 'Fee',
                        'icon' => 'credit-card',
                        'url' => '#',
                        'items' => [
                            [
                                'label' => 'Class Account',
                                'icon' => 'caret-right',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Manage Accounts', 'icon' => 'chevron-right', 'url' => './class-account',],
                                    ['label' => 'Generate Vouchers', 'icon' => 'chevron-right', 'url' => './fee-transaction-detail-fee-voucher',],
                                ],
                            ],
                            [
                                'label' => 'Student Account',
                                'icon' => 'caret-right',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Manage Account', 'icon' => 'chevron-right', 'url' => './student-account',],
                                    ['label' => 'Generate Voucher', 'icon' => 'chevron-right', 'url' => './fee-transaction-detail-student-voucher',],
                                ],
                            ],
                            [
                                'label' => 'Vouchers Collection',
                                'icon' => 'caret-right',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Collect Voucher', 'icon' => 'chevron-right', 'url' => './fee-transaction-detail-collect-voucher',],
                                    //['label' => 'Monthly Collection', 'icon' => 'caret-right', 'url' => "./monthly-voucher"],
                                    ['label' => 'Student Account Detail', 'icon' => 'chevron-right', 'url' => "./yearly-voucher"],
                                ],
                            ],
                            ['label' => 'Class Fee Report', 'icon' => 'chevron-right', 'url' => './fee-transaction-detail-class-account-fee-report',],
                        ],
                    ],
                    // ------------------------------------------------
                    // Fee Module close...
                    // ------------------------------------------------
                    // Exams module start here
                    [
                        'label' => 'Examination',
                        'icon' => 'book',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Grades', 'icon' => 'caret-right', 'url' => ["/grades"],],
                            ['label' => 'Exams Category', 'icon' => 'caret-right', 'url' => ["/exams-category"],],
                            ['label' => 'Marks Weightage Type', 'icon' => 'caret-right', 'url' => ["/marks-weightage-type"],],
                            ['label' => 'Marks Weightage', 'icon' => 'caret-right', 'url' => ["/marks-weightage-head"],],
                            // ['label' => 'Exams Criteria', 'icon' => 'caret-right', 'url' => ["/exams-criteria"],],
                            // ['label' => 'Exams Schedule', 'icon' => 'caret-right', 'url' => ["/exams-schedule"],],
                            ['label' => 'Manage Exams', 'icon' => 'caret-right', 'url' => ["/exams-schedule/manage-exams"],],
                            ['label' => 'Invigilator Attendance', 'icon' => 'caret-right', 'url' => ["./emp-exam-attendance"],],
                            ['label' => 'View Marks Sheet', 'icon' => 'caret-right', 'url' => ["/view-marks-sheet "],],
                            ['label' => 'Roll # Slip', 'icon' => 'caret-right', 'url' => ["./premium-version"],],
                            ['label' => 'Result Card', 'icon' => 'caret-right', 'url' => ["./premium-version"],],
                            ['label' => 'Quiz System', 'icon' => 'caret-right', 'url' => ["./premium-version"],],
                            ['label' => 'Examination Controller', 'icon' => 'caret-right', 'url' => ["./premium-version"],],
                            // ['label' => 'Result cards', 'icon' => 'caret-right', 'url' => ["/view-result-cards "],],
                            
                        ],
                    ],
                    // ------------------------------------------------
                    // Exams module close ...
                    // ------------------------------------------------
                    // Employee Module start...
                    [
                        'label' => 'Employees',
                        'icon' => 'users',
                        'url' => [""],
                        'items' => [
                            ['label' => 'Employee Registration', 'icon' => 'caret-right', 'url' => './emp-info',],
                            ['label' => 'Assign Teacher', 'icon' => 'caret-right', 'url' => './teacher-subject-assign-head',],
                            [
                                'label' => 'Attendance Management',
                                'icon' => 'cancel',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Manage Attendance', 'icon' => 'chevron-right', 'url' => './emp-attendance',],
                                     ['label' => 'Final Attendance', 'icon' => 'chevron-right', 'url' => './final-attendance',],
                                    [
                                    'label' => 'Attendance Report',
                                    'icon' => 'list',
                                    'url' => '#',
                                    'items' => [
                                            ['label' => 'Single Employee', 'icon' => 'chevron-right', 'url' => './emp-att-report',],
                                            ['label' => 'All Employees', 'icon' => 'chevron-right', 'url' => './employess-att-report',],
                                        ],
                                    ],  
                                ],
                            ],
                            [
                                'label' => 'Leave Management',
                                'icon' => 'cancel',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Manage Leave', 'icon' => 'chevron-right', 'url' => './emp-leave',],
                                    ['label' => 'Leave Report', 'icon' => 'chevron-right', 'url' => './premium-version',],
                                ],
                            ],

                            ['label' => 'Payroll System', 'icon' => 'caret-right', 'url' => './premium-version',],
                            ['label' => 'ID Cards', 'icon' => 'caret-right', 'url' => './premium-version',],
                            ['label' => 'Promotion/Demotion', 'icon' => 'caret-right', 'url' => './emp-designation',],
                            ['label' => 'Announce Jobs', 'icon' => 'caret-right', 'url' => './premium-version',],
                        ],
                    ],
                    // ------------------------------------------------
                    // Employee Module close...
                    // Account Module start...
                    [
                        'label' => 'Accounting System',
                        'icon' => 'credit-card',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Account Nature', 'icon' => 'caret-right', 'url' => "./account-nature"],
                            ['label' => 'Account Head', 'icon' => 'caret-right', 'url' => "./account-register"],
                            ['label' => 'Account Transaction', 'icon' => 'caret-right', 'url' => "./account-transactions"],
                            ['label' => 'Balance Sheet', 'icon' => 'caret-right', 'url' => ["./balance-sheet"],],
                            ['label' => 'Capital', 'icon' => 'caret-right', 'url' => ["./premium-version"],],
                            ['label' => 'Assets', 'icon' => 'caret-right', 'url' => ["./premium-version"],],
                            ['label' => 'Liabilities', 'icon' => 'caret-right', 'url' => ["./premium-version"],],
                            ['label' => 'Revenue', 'icon' => 'caret-right', 'url' => ["./premium-version"],],
                            ['label' => 'Trial Balance', 'icon' => 'caret-right', 'url' => ["./premium-version"],],
                            ['label' => 'Income Statement', 'icon' => 'caret-right', 'url' => ["./premium-version"],],
                            ['label' => 'Yearly Charts', 'icon' => 'caret-right', 'url' => ["./premium-version"],],

                            ['label' => 'Transaction Logs', 'icon' => 'caret-right', 'url' => ["./premium-version"],]

                        ],
                    ],
                    // ------------------------------------------------
                    // Account Module close...
                    // ------------------------------------------------
                    // Msg of Day start...
                    [
                        'label' => 'Communications',
                        'icon' => 'comments',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Message of the Day', 'icon' => 'caret-right', 'url' => "./msg-of-day"],
                            ['label' => 'Events Management', 'icon' => 'caret-right', 'url' => "./events"],
                            ['label' => 'Notice Management', 'icon' => 'caret-right', 'url' => "./notice"],
                            ['label' => 'Complaint Box', 'icon' => 'caret-right','url' =>"./premium-version"]
                        ],
                    ],
                    // ------------------------------------------------
                    // Msg of Day close...
                    // ------------------------------------------------
                    // SMS start...
                    [
                        'label' => 'SMS',
                        'icon' => 'comments-o',
                        'url' => '#',
                        'items' => [
                            ['label' => 'SMS Templates', 'icon' => 'caret-right', 'url' => "./premium-version",],
                            ['label' => 'Custom SMS', 'icon' => 'caret-right', 'url' => "./premium-version",],
                            //['label' => 'SMS Templates', 'icon' => 'caret-right', 'url' => "./sms",],
                            //['label' => 'Absent Students SMS', 'icon' => 'caret-right', 'url' => "./absent-sms",],
                            //['label' => 'Custom SMS', 'icon' => 'caret-right', 'url' => "./custom-sms",],
                            // ['label' => 'Fee Transaction Details', 'icon' => 'caret-right', 'url' => 'index.php?r=fee-transaction-detail',]
                        ],
                    ],
                    // ------------------------------------------------
                    // SMS close...
                    // ------------------------------------------------
                    // Email start...
                    ['label' => 'Email', 'icon' => 'envelope-o', 'url' => ["/emails"],],
                    // ------------------------------------------------
                    // Email close...
                    // ------------------------------------------------
                    // E-Learning start...
                    ['label' => 'E-Learning', 'icon' => 'etsy', 'url' => ["./premium-version"],],
                    // ------------------------------------------------
                    // E-Learning  close...
                    // ------------------------------------------------
                    // Time Table Generator start...
                    [
                        'label' => 'Time Table',
                        'icon' => 'comments-o',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Generate', 'icon' => 'caret-right', 'url' => "./time-table",],
                             ['label' => 'View', 'icon' => 'caret-right', 'url' => "./time-table-view",],
                            //['label' => 'SMS Templates', 'icon' => 'caret-right', 'url' => "./sms",],
                            //['label' => 'Absent Students SMS', 'icon' => 'caret-right', 'url' => "./absent-sms",],
                            //['label' => 'Custom SMS', 'icon' => 'caret-right', 'url' => "./custom-sms",],
                            // ['label' => 'Fee Transaction Details', 'icon' => 'caret-right', 'url' => 'index.php?r=fee-transaction-detail',]
                        ],
                    ],
                    // ------------------------------------------------
                    // Time Table Generator  close...
                    // ------------------------------------------------
                    // Data Visualization start...
                    [
                        'label' => 'Data Visualization',
                        'icon' => 'bar-chart',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Income & Expense', 'icon' => 'caret-right', 'url' => './income-expense',],
                            [
                                'label' => 'Main Branch',
                                'icon' => 'caret-right',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Income/Expence', 'icon' => 'chevron-right', 'url' => './income-expense-main',],
                                    ['label' => 'Fee Statistics', 'icon' => 'chevron-right', 'url' => './fee-statistics-main',],
                                ],
                            ],
                            [
                                'label' => 'Sub Branch',
                                'icon' => 'caret-right',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Income/Expence', 'icon' => 'chevron-right', 'url' => './income-expense-sub',],
                                    ['label' => 'Fee Statistics', 'icon' => 'chevron-right', 'url' => './fee-statistics-sub',],
                                ],
                            ],
                        ],
                    ],
                    // ------------------------------------------------
                    // Data Visualization  close...
                    // ------------------------------------------------
                    // Visitor Management start...
                    ['label' => 'Visitor Record', 'icon' => 'book', 'url' => ["./visitors"],],
                    // ------------------------------------------------
                    // Visitor Management  close...
                    // ------------------------------------------------
                    // Library Management start...
                    ['label' => 'Library Management', 'icon' => 'book', 'url' => ["./premium-version"],],
                    // ------------------------------------------------
                    // Library Management  close...
                    // ------------------------------------------------
                    // Hostel Management start...
                    ['label' => 'Hostel Management', 'icon' => 'home', 'url' => ["./premium-version"],],
                    // ------------------------------------------------
                    // Hostel Management close...
                    // ------------------------------------------------
                    // Canteen Management start...
                    ['label' => 'Canteen Management', 'icon' => 'cutlery', 'url' => ["./premium-version"],],
                    // ------------------------------------------------
                    // Canteen Management close...
                    // ------------------------------------------------
                    // Stock/Inventory start...
                    ['label' => 'Stock/Inventory', 'icon' => 'line-chart', 'url' => ["./premium-version"],],
                    // ------------------------------------------------
                    // Stock/Inventory close...
                    // ------------------------------------------------
                    // Transportation Management start...
                    ['label' => 'Transportation Management', 'icon' => 'bus', 'url' => ["./premium-version"],],
                    // ------------------------------------------------
                    // Transportation Management close...
                    // ------------------------------------------------
                    // System Audits start...
                    ['label' => 'System Audits', 'icon' => 'search-plus', 'url' => ["./premium-version"],],
                    // ------------------------------------------------
                    // System Audits close...
                    // ------------------------------------------------
                    // Alumni start...
                    ['label' => 'Alumni', 'icon' => 'recycle', 'url' => ["./premium-version"],],
                    // ------------------------------------------------
                    // Alumni close... 
                    // ------------------------------------------------
                    // Backup start...
                    // ------------------------------------------------                   

                    ['label' => 'Backup', 'icon' => 'recycle', 'url' => ["./backup"],],
                    // ------------------------------------------------
                    // Backup start...
                    // ------------------------------------------------                   

                     
                    // ------------------------------------------------
                    
                    // System Settings start...
                    [
                        'label' => 'System Settings',
                        'icon' => 'cogs',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Institute', 'icon' => 'caret-right', 'url' => ["/institute"],],
                            ['label' => 'Branches', 'icon' => 'caret-right', 'url' => ["/branches"],],
                            //['label' => 'Departments', 'icon' => 'caret-right', 'url' => ["/departments"],],
                            ['label' => 'Sessions', 'icon' => 'caret-right', 'url' => ["/std-sessions"],],
                            ['label' => 'Classes', 'icon' => 'caret-right', 'url' => ["/std-class-name"],],
                            ['label' => 'Sections', 'icon' => 'caret-right', 'url' => ["/std-sections"],],
                            
                            [
                                'label' => 'Subjects',
                                'icon' => 'caret-right',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Subjects List', 'icon' => 'chevron-right', 'url' => './subjects',],
                                    ['label' => 'Subject Combination', 'icon' => 'chevron-right', 'url' => './std-subjects',],
                                ],
                            ],
                            [
                                'label' => 'Employees',
                                'icon' => 'caret-right',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Employee Type', 'icon' => 'chevron-right', 'url' => './emp-type',],
                                    ['label' => 'Employee Designation', 'icon' => 'chevron-right', 'url' => './designation',],
                                ],
                            ],
                            [
                                'label' => 'Fee',
                                'icon' => 'caret-right',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Fee Types', 'icon' => 'chevron-right', 'url' => './fee-type',],
                                    ['label' => 'Fee Packages', 'icon' => 'chevron-right', 'url' => './std-fee-pkg',],
                                ],
                            ],
                        ],
                    ],
                    // System Settings close...
                    // ------------------------------------------------

                    // ------------------------------------------------
                    // Multilevel Dropdown....!
                    // [
                    //     'label' => 'Some tools',
                    //     'icon' => 'share',
                    //     'url' => '#',
                    //     'items' => [
                    //         ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                    //         ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                    //         [
                    //             'label' => 'Level One',
                    //             'icon' => 'circle-o',
                    //             'url' => '#',
                    //             'items' => [
                    //                 ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                    //                 [
                    //                     'label' => 'Level Two',
                    //                     'icon' => 'circle-o',
                    //                     'url' => '#',
                    //                     'items' => [
                    //                         ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                    //                         ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                    //                     ],
                    //                 ],
                    //             ],
                    //         ],
                    //     ],
                    // ],
                ],
            ]
        ) ?>
        <?php } ?>

        <!-- Inquiry Nav Start -->
        <?php if(Yii::$app->user->can('inquiry-nav')){ ?>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Menus', 'options' => ['class' => 'header center']],
                    ['label' => 'Home', 'icon' => 'dashboard', 'url' => "./home"],
                    //['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    ['label' => 'Login', 'url' => ["../login"], 'visible' => Yii::$app->user->isGuest],

                    // ------------------------------------------------
                    // Student Module start...
                    [
                        'label' => 'Student Module',
                        'icon' => 'users',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Student Inquiry', 'icon' => 'caret-right', 'url' => ["/std-inquiry"],],
                            //['label' => 'Student Registration', 'icon' => 'caret-right', 'url' => ["/std-personal-info"],],
                            //['label' => 'Student Enrollment', 'icon' => 'caret-right', 'url' => ["/std-enrollment-head"],],
                            //['label' => 'Student Promotion', 'icon' => 'caret-right', 'url' => ["./std-promote"],],
                        ],
                    ],
                    
                    // ------------------------------------------------
                    
                ],
            ]
        ) ?>
        <?php } ?>
        <!-- Inquiry Nav end -->

    </section>

</aside>
