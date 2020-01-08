<?php

namespace app\controllers;

use app\models\IComments;
use app\models\LoginReg;
use app\models\modelNews;
use app\models\Project;
use app\models\PrTasks;
use app\models\TaskMan;
use app\models\User;
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

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }


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
        $this->layout='authmain';

        if(Yii::$app->request->isAjax){
            return $_POST["do"];
        }

        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {

        $this->layout='authmain';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $this->layout='main';
            return $this->render('news', [
                'model' => $model
                ]);
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
        $this->layout='authmain';

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

    public function actionProject()
    {
        $this->layout='authmain';



            $model = new Project();
        if ($model->load(Yii::$app->request->post())) {

            $model->id_user=Yii::$app->user->identity->id;
            $model->date=date('Y-m-d H:m:s');
            $model->id_company= Yii::$app->user->identity->id_company;
            if($model->save()) {
                $this->layout='main';

                Yii::$app->session->setFlash('contactFormSubmitted');
                return $this->render('profile', [
                    'model' => $model,
                ]);
            }
        }
        return $this->render('project', [
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

    public function actionRating()
    {
        return $this->render('rating');
    }


    public function actionNews()
    {
                $model = new modelNews();
                if ($model->load(Yii::$app->request->post())) {
                    $model->name = $_POST["modelNews"]["name"];
                    $model->content = $_POST["modelNews"]["content"];
                    $model->date = date('Y-m-d H:m');
                    $model->id_who = Yii::$app->user->identity->id;
                    $model->id_company = Yii::$app->user->identity->id_company;
                    $file = UploadedFile::getInstance($model, 'img');
                    if($file!=null){
                        $file->saveAs(Yii::getAlias('@webroot').'/uploads/'.$file->name);
                        $model->img = $file->name;
                    }
                    else{
                        $model->img ='';
                    }
                    if($model->addNews()) {
                        Yii::$app->session->setFlash('News created');
                        return $this->refresh();
                    }
                }

        return $this->render('news', ['model'=>$model]);
    }


    public function actionCalendar()
    {
        if (Yii::$app->request->get()) {
            return $this->render('calendar', ['week'=>Yii::$app->request->get('week')]);
        }

        return $this->render('calendar');
    }
    public function actionCalendar1()
    {
       if (Yii::$app->request->get()) {

            return $this->render('calendar1', ['ym'=>Yii::$app->request->get('ym'), 'id'=>Yii::$app->request->get('id')]);

       }
            return $this->render('calendar1', ['id'=>Yii::$app->request->get('id')]);
    }


    public function actionProfile()
    {
        if(Yii::$app->request->isAjax) {

            if(isset($_POST["id_us"])){
                $pr = Project::find()->where(['id'=>$_POST["id_pr"]])->one();
                $users = $pr["us_access"];
                $users.=','.$_POST["id_us"];
                Yii::$app->db->createCommand('update i_project set us_access=:us WHERE id=:id')
                    ->bindValues(['id'=>intval($_POST["id_pr"]), 'us'=>$users])
                    ->execute();
                return 'success';
            }
        }


        return $this->render('profile');
    }


    public function actionTasks()
    {
        $this->layout='main';

        if(Yii::$app->request->isAjax){


            if($_POST["do"]=='add_task') {
                $ajax = new TaskMan();
                $ajax->id_pr = intval($_POST["id_pr"]);
                $ajax->name = $_POST["name"];
                $ajax->description = $_POST["description"];
                $ajax->id_user = Yii::$app->user->identity->id;
//              $ajax->date_start = date("Y-m-d H:m:s");
//              $ajax->date_end = date("Y-m-d H:m:s");
                $ajax->date_start = date("Y-m-d H:m:s", strtotime($_POST["date_start"] . ':00'));
                $ajax->date_end = date("Y-m-d H:m:s", strtotime($_POST["date_end"] . ':00'));
                $ajax->content = $_POST["content"];
                $ajax->id_who = $_POST["id_wh"];
                $vr = explode(' ', $_POST["date_end"]);
                if ($ajax->addTask()) {
                    $result = '<div class="rowN task-block" style="background-color: #ffe066;">
                <div class="task-left-block">
                    <h2>' . $_POST["name"] . '<h2>
                            <p class="priority">priority</p>
                            <p class="task-text">' . $_POST["content"] . '</p>
                            <data>до <time>' . $vr[0] . '<time></data>
                </div>
                <div class="task-right-block">
                    <p class="due-days">осталось 3 дня</p>
                    <div class="btn-group button-right-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-secondary">Complete</button>
                        <button type="button" class="btn btn-secondary">Edit</button>
                        <button type="button" class="btn btn-secondary">Delete</button>
                    </div>
                </div>
            </div>';

                    return $result;
                } else
                    return "error";
            }
            if($_POST["do"]=='delete'){
                Yii::$app->db->createCommand('delete from pr_tasks WHERE id=:id')
                    ->bindValues(['id'=>intval($_POST["id"])])
                    ->execute();
            }
            if($_POST["do"]=='complete'){
                Yii::$app->db->createCommand('update pr_tasks set complete=1 WHERE id=:id')
                    ->bindValues(['id'=>intval($_POST["id"])])
                    ->execute();
            }
            if($_POST["do"]=='uncomplete'){
                Yii::$app->db->createCommand('update pr_tasks set complete=0 WHERE id=:id')
                    ->bindValues(['id'=>intval($_POST["id"])])
                    ->execute();
            }
            if($_POST["do"]=='grade'){
                Yii::$app->db->createCommand('update pr_tasks set complete=2, grade=:gr WHERE id=:id')
                    ->bindValues(['id'=>intval($_POST["id"]), 'gr'=>intval($_POST["grade"])])
                    ->execute();
            }
            if($_POST["do"]=='edit_show'){

                $res = PrTasks::find()->where(['id'=>intval($_POST["id"])])->asArray()->one();
                return json_encode($res);
            }

            if($_POST["do"]=='edit_task'){
                Yii::$app->db->createCommand('update pr_tasks set name=:name, description=:desc, content=:con, date_start=:start, date_end=:end WHERE id=:id')
                    ->bindValues([':id'=>intval($_POST["id_pr"]), ':name'=>$_POST["name"], ':desc'=>$_POST["description"], ':con'=>$_POST["content"],
                    ':start'=>$_POST["date_start"], ':end'=>$_POST["date_end"]])
                    ->execute();
            }
            }

        return $this->render('tasks');
    }

    public function actionOwnprof()
    {
        if(Yii::$app->request->isAjax){

            if($_POST["do"]=='add_comment'){

                $com = new IComments();
                $com->id_who = $_POST["id_w"];
                $com->id_place = $_POST["id_pl"];
                $com->date = date('Y-m-d H:m');
                $com->content= $_POST["content"];
                $com->place = $_POST["place"];
                $styl = $_POST["place"]=='task'?'style="display: block; padding: 2px; margin-bottom: 20px; width: 75%; line-height: 1.22857143; background-color: #fff; border: 1px solid #ddd; border-radius: 4px;"':'';
                $styl1 = $_POST["place"]=='task'?'style="margin-left: 7%; max-width: 85%; height: auto;"':'';
                $com->create();
                $html ='<div class="combl">
                                <div class="col-sm-1" '.$styl.'>
                                    <div class="thumbnail">
                                        <img class="img-responsive user-photo" src="/basic/web/uploads/'.Yii::$app->user->identity->image.'" '.$styl1.'>
                                    </div>
                                </div>

                                <div class="col-sm-11">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <strong>'.Yii::$app->user->identity->name.'</strong> <span class="text-muted">'.date('Y-m-d H:m').'</span>
                                        </div>
                                        <div class="panel-body">
                                           '.$_POST["content"].'
                                        </div>
                                    </div>
                                </div>
                            </div>';
                return $html;
            }

            return 'Запрос принят!';
        }

        return $this->render('ownprof');
    }

    public function actionCompany()
    {
        if(Yii::$app->request->isAjax){

            if($_POST["do"]=="edit_pos"){
                Yii::$app->db->createCommand('update user set idAdmin=:pos WHERE id=:id')
                    ->bindValues(['id'=>intval($_POST["id_us"]), 'pos'=>intval($_POST["pos"])])
                    ->execute();
            }

            return 'Запрос принят!';
        }

        return $this->render('company');
    }



    public function actionRegistr()
    {
        $this->layout='authmain';


        $model = new LoginReg();

        if ($model->load(Yii::$app->request->post())) {
            if($model->logreg()) {
                Yii::$app->session->setFlash('Registred');
                return $this->goBack();
            }
        }

        return $this->render('registr', [
            'model' => $model,
        ]);
    }


}
