<?php


namespace app\controllers;


use app\models\CompamyMod;
use app\models\LoginForm;
use app\models\LoginReg;
use app\models\Project;
use app\models\User;
use Yii;
use yii\db\Exception;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\UploadedFile;

class AuthController extends Controller
{

    public function actionLogin()
    {

        $this->layout='authmain';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $this->layout='main';

            Yii::$app->response->redirect('index.php?r=site%2Fownprof');
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionRegcompany()
    {
        $this->layout='authmain';

        $model = new CompamyMod();

        if ($model->load(Yii::$app->request->post())) {
            $model->date=date('Y-m-d H:m:s');
            $model->id_admin=Yii::$app->user->identity->id;
            $file = UploadedFile::getInstance($model, 'logo');

            if($file!=null){
                $file->saveAs(Yii::getAlias('@webroot').'/uploads/'.$file->name);
            }
            if($model->saveCom($file)) {


                    $post = Yii::$app->db->createCommand('SELECT * FROM i_company WHERE id_admin=:id')
                        ->bindValue(':id', Yii::$app->user->identity->id)
                        ->queryOne();



                    Yii::$app->db->createCommand('UPDATE user SET id_company=:id_com WHERE id=:id')
                        ->bindValues(['id_com'=>$post["id"], 'id'=>Yii::$app->user->identity->id])
                        ->execute();


                Yii::$app->session->setFlash('Registred');
                Yii::$app->response->redirect('index.php?r=site%2Fcompany');

            }
        }


        return $this->render('regcompany', [
            'model' => $model,
        ]);

    }

    public function actionLogout()
    {
        $this->layout='authmain';

        Yii::$app->user->logout();

        return $this->goHome();
    }


    public function actionRegistr()
    {
        $this->layout='authmain';


        $model = new LoginReg();

        if ($model->load(Yii::$app->request->post())) {
            $model->idAdmin=$_POST["LoginReg"]["idAdmin"]=='1'?1:0;
            $model->id_company=$_POST["LoginReg"]["id_company"]!=''?intval($_POST["LoginReg"]["id_company"]):0;
            if($model->logreg()) {


                Yii::$app->session->setFlash('Registred');
                if($_POST["LoginReg"]["id_company"]=='')
                return $this->goHome();
                else
                Yii::$app->response->redirect('index.php?r=site%2Fcompany');

            }
        }

        return $this->render('registr', [
            'model' => $model,
        ]);
    }


    public function actionEditprof(){

        $this->layout='empty';

        $model= new LoginReg();

        $user = User::findOne(Yii::$app->user->identity->id);
        if ($model->load(Yii::$app->request->post())) {
//            var_dump(Yii::$app->request->post());
            $file = UploadedFile::getInstance($model, 'image');

        if($file!=null){
            $file->saveAs(Yii::getAlias('@webroot').'/uploads/'.$file->name);
        }
            if($user->editProfile($model, $file)) {
                Yii::$app->session->setFlash('Changed');
                return $this->refresh();
            }
        }


        return $this->render('editprof', ['model' => $model]);

    }




}