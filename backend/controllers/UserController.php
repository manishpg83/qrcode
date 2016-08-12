<?php

namespace backend\controllers;

use Yii;
use app\models\User;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        /*echo "<pre>";
        print_r($_REQUEST);
        exit;*/
        if ($model->load(Yii::$app->request->post())) {
          

            $imageName = $model->user_name;
            $model->file =UploadedFile::getInstance($model,'file');
            if($model->file != '')
            {
                $imageName = time().'.'.$model->file->extension;
                $model->file->saveAs('upload/'.$imageName);
                $model->photo = $imageName;
            }
            $model->username = $model->email;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    
    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {
            $imageName = $model->user_name;
            $model->file =UploadedFile::getInstance($model,'file');
            if($model->file != '')
            {
                $imageName = time().'.'.$model->file->extension;
                $model->file->saveAs('upload/'.$imageName);
                $model->photo = $imageName;
            }
           /* else
            {
                $model->photo = $model->photo;
            }*/
            $model->username = $model->email;
            $model->save();
            /* $mt = $model->getErrors();
            print_r($mt);
            exit;*/
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    public function actionDeletephoto($id)
    {
        $photo=User::find()->where(['id'=>$id])->one()->photo;
        if($photo){
            @unlink('upload/'.$photo);
        }
        $connection = Yii::$app->db;
        $connection->createCommand()->update('user', ['photo' => ''], 'id = '.$id)->execute();

        /*  $User=User::findOne($id);
         print_r($User); exit;
        $photo->photo=NULL;
        $photo->update();*/

        return $this->redirect(['update','id'=>$id]);
    }
    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}