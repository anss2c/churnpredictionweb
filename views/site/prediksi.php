<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Tabs;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;


$this->registerJs(
            '       
                $(document).ready(function (e) {
                    $("#tablepredict").DataTable();
                    $("#progress").hide();                   
                    $("#formLampiran").on("submit",(function(e) {
                        e.preventDefault();
                        $("#progress").show();
                        $.ajax({
                            url: "'.Yii::$app->urlManager->createUrl(['site/uploadfile']).'", 
                            type: "POST",             
                            data: new FormData(this),
                            contentType: false,       
                            cache: false,             
                            processData:false, 
                            beforeSend: function (request, xhr) {
                                $("#progressBar").css("width","0%");
                            },                            
                            success: function(data)   
                            {
                                
                                 $("#progress").hide();
                            },
                            xhr: function(){
                     
                                 var xhr = $.ajaxSettings.xhr() ;
                                 xhr.upload.onprogress = function(data){
                                    var perc = Math.round((data.loaded/data.total) * 100);
                                    $("#progressBar").text(perc + "%");
                                    $("#progressBar").css("width",perc + "%");
                                 };
                                 return xhr ;
                            },
                            resetForm: true
                        });
                    }));
                });


            ',
            \yii\web\View::POS_READY
        );
$this->title = 'Prediksi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="body-content">
    <h1><?= Html::encode($this->title) ?></h1>
    <div id="coba"></div>
    <div class="row"> 
        <table>
            <?= Html::beginForm('', 'post', array('enctype' => 'multipart/form-data', 'id'=>'formLampiran'));?>
            <tr>
                <td style="width:150px">Upload File Excel :</td>
                <td style="width:400px"><?=  Html::fileInput('filecsv','',['id'=>'filecsv','accept'=>'.csv']); ?></td>
                <td style="width:300px"><?= Html::submitButton('Upload',['class'=>'btn btn-success']); ?></td>
                <td style="width:100px"><?= Html::a(Html::img('@web/excel.png', ['alt'=>'Download Excel Template', 'style'=>'width:50px; height:50px']), ['downloadfile']) ?></td>
            </tr>
             <?= Html::endForm();  ?>
        </table>
        <div class="progress" id="progress">';
        <div id="progressBar" class="progress-bar progress-bar-striped" role="progressbar" style="width: 0%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <br>
    <hr>
    <div class="row">
        <table id="tablepredict" class="display">
            <thead>
                <tr>
                    <th>Id</th>,
                    <th>State</th>,
                    <th>Area Code</th>
                    <th>Length of Join</th>
                    <th>International Plan</th>
                    <th>Total Day Calls (Minutes)</th>
                    <th>Total Eve Calls (Minutes)</th>
                    <th>Total Night Call (Minutes)</th>
                    <th>Total International Calls (Minutes)</th>
                    <th>Number CS Calls</th>
                    <th>Churn prediction</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $session = Yii::$app->session;
                    $data= $session['csvdata'];
                    if(isset($session['csvdata'])){
                        $i=1;
                        foreach($data as $raw){
                            echo '<tr>';
                            echo '<td style="text-align:center">'.$i.'</td>';
                            echo '<td style="text-align:center">'.$raw['state'].'</td>';
                            echo '<td style="text-align:center">'.substr($raw['area_code'],-3).'</td>';
                            echo '<td style="text-align:center">'.$raw['account_length'].'</td>';
                            echo '<td style="text-align:center">'.$raw['international_plan'].'</td>';
                            echo '<td style="text-align:center">'.$raw['total_day_calls'].'</td>';
                            echo '<td style="text-align:center">'.$raw['total_eve_calls'].'</td>';
                            echo '<td style="text-align:center">'.$raw['total_night_calls'].'</td>';
                            echo '<td style="text-align:center">'.$raw['total_intl_calls'].'</td>';
                            echo '<td style="text-align:center">'.$raw['number_customer_service_calls'].'</td>';
                            if($raw['churn']==0){
                                echo '<td style="text-align:center">Non churn custemer</td>';
                            }
                            if($raw['churn']==1){
                                echo '<td style="text-align:center">Churn custemer</td>';
                            }
                            echo '</tr>';
                            $i++;
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
		

		

