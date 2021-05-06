<?php
use dosamigos\chartjs\ChartJs;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Costumer Churn Prediction</h1>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-16">
                <h2>Customer Churn By State Diagram</h2>
                    <?= ChartJs::widget([
                            'type' => 'bar',
                            'options' => [
                                'height' =>200,
                                'width' => 800
                            ],
                            'data' => [
                                'labels' => ["AK","AL","AR","AZ","CA","CO","CT","DC","DE","FL","GA","HI","IA","ID","IL","IN","KS","KY","LA","MA","MD","ME","MI","MN","MO","MS","MT","NC","ND","NE","NH","NJ","NM","NV","NY","OH","OK","OR","PA","RI","SC","SD","TN","TX","UT","VA","VT","WA","WI","WV","WY"],
                                'datasets' => [
                                    [
                                        'label'=>'Number of Customer',
                                        'backgroundColor' => "rgba(179,120,198,0.2)",
                                        'borderColor' => "rgba(179,181,198,1)",
                                        'pointBackgroundColor' => "rgba(179,181,198,1)",
                                        'pointBorderColor' => "#fff",
                                        'pointHoverBackgroundColor' => "#fff",
                                        'pointHoverBorderColor' => "rgba(179,181,198,1)",
                                        'data' => [61,101,71,77,39,80,88,72,80,76,64,77,62,106,79,83,87,85,69,89,86,89,87,108,80,82,80,80,67,73,78,96,78,83,96,95,78,99,67,87,72,75,79,98,97,100,86,80,94,139,95]
                                    ],
                                ]
                            ]
                        ]);
                    ?>
            </div>
        </div>
        <div class="row">
             <div class="col-lg-4">
             </div>
            <div class="col-lg-4">
                <h2>Total Customer Churn</h2>
                <?php
                    echo ChartJs::widget([
                'type' => 'pie',
                'id' => 'structurePie',
                'options' => [
                    'height' => 400,
                    'width' => 400,
                ],
                'data' => [
                    'radius' =>  "90%",
                    'labels' => ['churn', 'non churn'], // Your labels
                    'datasets' => [
                        [
                            'data' => ['85.93', '14.07'], // Your dataset
                            'label' => '',
                            'backgroundColor' => [
                                    '#ADC3FF',
                                    '#FF9A9A',
                                'rgba(190, 124, 145, 0.8)'
                            ],
                            'borderColor' =>  [
                                    '#fff',
                                    '#fff',
                                    '#fff'
                            ],
                            'borderWidth' => 1,
                            'hoverBorderColor'=>["#999","#999","#999"],                
                        ]
                    ]
                ],
                'clientOptions' => [
                    'legend' => [
                        'display' => false,
                        'position' => 'bottom',
                        'labels' => [
                            'fontSize' => 14,
                            'fontColor' => "#425062",
                        ]
                    ],
                    'tooltips' => [
                        'enabled' => true,
                        'intersect' => true
                    ],
                    'hover' => [
                        'mode' => false
                    ],
  

                ],
                
            ])  
                ?>
            </div>
            <div class="col-lg-4">
             </div>
        </div>

    </div>
</div>
