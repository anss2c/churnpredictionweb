<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Tabs;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use dosamigos\chartjs\ChartJs;


$this->title = 'Variabel Analysis';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<div class="body-content">

        <div class="row">
                <h2>Most Variabel in Customer Churn</h2>
                    <?= ChartJs::widget([
                            'type' => 'bar',
                            'options' => [
                                'height' => 250,
                                'width' => 400,
                                'indexAxis'=> 'y',
                            ],
                            'data' => [
                                'axis'=> 'x',
                                'labels' => ["total_day_minutes", "total_eve_minutes", "total_intl_minutes", "total_night_minutes", "total_night_calls", "account_length", "total_day_calls",
                                            "total_eve_calls","state","total_intl_calls","number_customer_service_calls", "total_eve_charge","voice_mail_plan","number_vmail_message",
                                            "total_night_charge", "area_code","international_plan"],
                                'datasets' => [
                                    [
                                        'label'=>'Impotance value',
                                        'backgroundColor' => "rgba(179,67,78,0.2)",
                                        'borderColor' => "rgba(179,178,198,1)",
                                        'pointBackgroundColor' => "rgba(179,178,198,1)",
                                        'pointBorderColor' => "#fff",
                                        'pointHoverBackgroundColor' => "#fff",
                                        'pointHoverBorderColor' => "rgba(179,181,198,1)",
                                        'data' => [1780, 1375, 1166, 1116, 929,874,871,851,816,524,451,244,199,172,159, 147,126]
                                    ],
                                    
                                ]
                            ]
                        ]);
                    ?>
        </div>

    </div>
