<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\userSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\models\LoginForm;
use yii\imagine\Image;

/**
 * UserController implements the CRUD actions for user model.
 */
class UserController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'logout' => ['post'],
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['logout', 'profile'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['login', 'registration'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['view', 'index'],
                        'allow' => true,
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all user models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new userSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single user model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Registers new user model.
     * If registrationon is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionRegistration()
    {
        $model = new User();
        $model->access_token = md5(strrev(Yii::$app->request->post('User')['email']) . Yii::$app->params['salt']);

        if ($model->load(array_merge(Yii::$app->request->post())) && $model->save()) {
            $this->uploadAvatar($model);
            Yii::$app->getSession()->setFlash('message', 'Success. Please login');
            return $this->redirect(['login']);
        } else {
            $model->password = '';
            return $this->render('registration', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing user model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionProfile()
    {
        $id = Yii::$app->user->identity->id;
        $model = $this->findModel($id);
        $avatar = $model->avatar;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->uploadAvatar($model, $avatar);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $model->password = '';
            return $this->render('profile', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the user model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return user the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = user::findOne(['id' => $id, 'active' => 1])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Upload file
     * @param $model
     * @param $old_image
     */
    private function uploadAvatar($model, $old_image = ''){
        unset($model->password);
        if($image = UploadedFile::getInstance($model, 'avatar')){
            $name = $image->getBaseName();
            $model->avatar = $name;
            $ext = $image->extension;
            $path = Yii::getAlias(Yii::$app->params['uploadPath'] . $model->id) . DIRECTORY_SEPARATOR . $name;
            if(!file_exists(Yii::getAlias(Yii::$app->params['uploadPath'] . $model->id))){
                mkdir(Yii::getAlias(Yii::$app->params['uploadPath'] . $model->id), 766);
            }
            if($image->saveAs($path . '_src.jpg')){
                $avatars = Yii::$app->params['avatars'];
                foreach($avatars as $postfix => $avatar){
                    Image::thumbnail($path . '_src.' . $ext, (int)$avatar[0], (int)$avatar[1])->save(Yii::getAlias($path . '_'.$postfix.'.jpg', ['quality' => 80]));
                }
                if($name != $old_image && $old_image){
                    $path = Yii::getAlias(Yii::$app->params['uploadPath'] . $model->id) . DIRECTORY_SEPARATOR . $old_image;
                    @unlink($path . '_src.jpg');
                    foreach($avatars as $postfix => $avatar){
                        @unlink($path . '_'.$postfix.'.jpg');
                    }
                }

                $model->save(false);
            }
        } else {
            if($old_image){
                $model->avatar = $old_image;
                $model->save(false);
            }
        }
    }
}
