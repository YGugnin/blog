<?php

namespace app\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\filters\auth\QueryParamAuth;
use yii\web\Response;
use app\models\PostSearch;
use app\models\Post;
use yii\web\UnauthorizedHttpException;

class ApiController extends ActiveController
{

    public $modelClass = 'app\models\Post';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
            'except' => ['index', 'view'],
        ];
        return $behaviors;
    }

    /**
     * remove current actions
     * @return array
     */
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index'], $actions['create'], $actions['update'], $actions['delete']);
        return $actions;
    }

    public function init()
    {
        parent::init();
        Yii::$app->user->enableSession = false;
    }
    /**
    * Lists all Post models. (Not standart method for using filter and sorting example: api?expand=user&PostSearch[description]=Posts)
    * @return mixed
    */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $dataProvider;
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();
        $model->setAttributes(Yii::$app->getRequest()->getBodyParams());
        $model->user_id = Yii::$app->user->identity->id;
        $model->save();
        return $model;
    }

    /**
    * Updates an existing Post model.
    * If update is successful, the browser will be redirected to the 'view' page.
    * @param string $id
    * @return mixed
    */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if($model->user_id != Yii::$app->user->identity->id){
            throw new UnauthorizedHttpException('You are requesting with an invalid credential.');
        }
        $model->scenario = 'update';
        $model->setAttributes(Yii::$app->getRequest()->getBodyParams());

        $model->save();

        return $model;
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if($model->user_id != Yii::$app->user->identity->id){
            throw new UnauthorizedHttpException('You are requesting with an invalid credential.');
        } else {
            $model->active = 0;
            $model->save();

            Yii::$app->getResponse()->setStatusCode(204);
        }
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne(['id' => $id, 'active' => 1])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }

}