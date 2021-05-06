<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\UploadedFile;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionPrediksi(){
        
        return $this->render('prediksi');
    }
    public function actionAnalisis(){
        
        return $this->render('analisis');
    }
    public function actionUploadfile(){
        $session = Yii::$app->session;
        $files=UploadedFile::getInstanceByName('filecsv');
        $uploadpath=Yii::$app->basePath."/file/";
        $filename='predik'.'_'.date('Y-m-d_h-i-s');
        if(!file_exists($uploadpath.$filename)){
            $files->saveAs($uploadpath.$filename);

            if (!($fp = fopen($uploadpath.$filename, 'r'))) {
                die("Can't open file...");
            }
            //read csv headers
            $key = fgetcsv($fp,"1024",",");
    
            // parse csv rows into array
            $csvdata = array();
            while ($row = fgetcsv($fp,"1024",",")) {
                $csvdata[] = array_combine($key, $row);
            }
            // release file handle
            fclose($fp);
    
            // encode array to json
            $json=json_encode($csvdata);
            $session->open();
            $session->set('csvdata', $csvdata);
            $session->close();
            //return $csvdata;
            echo 'Upload Lampiran '.$filename.' Berhasil';
        }
        else{
            echo 'UPLOAD GAGAL. Nama file tersebut sudah ada, rename terlabih dahulu file yang akan diupload';
        }
    }
    public function actionDownloadfile(){
        $uploadPath = Yii::$app->basePath . "/web/example_test_file.csv";
        Yii::$app->response->sendFile($uploadPath);
    }
}
