<?php

namespace backend\controllers;

use Yii;
use app\models\ClientGroup;
use app\models\ClientGroupSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ClientGroupController implements the CRUD actions for ClientGroup model.
 */
class ClientGroupController extends Controller
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
     * Lists all ClientGroup models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ClientGroupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ClientGroup model.
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
     * Creates a new ClientGroup model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ClientGroup();

        if ($model->load(Yii::$app->request->post())) {
           
            $model->group_image =UploadedFile::getInstance($model,'group_image');
            if($model->group_image != '')
            {
                $imageName = time().'.'.$model->group_image->extension;
                $model->group_image->saveAs('group_logo/'.$imageName);
                $model->group_image = $imageName;
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ClientGroup model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $model->group_image =UploadedFile::getInstance($model,'group_image');
           /* print_r(UploadedFile::getInstance($model,'group_image'));
            exit;*/
            if($model->group_image != '')
            {
               
                $imageName = time().'.'.$model->group_image->extension;
                $model->group_image->saveAs('group_logo/'.$imageName);
                $model->group_image = $imageName;
            }
            $model->save();
           /* else
            {
                $model->group_image = $model->group_image;
            }*/
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
     public function actionDeletephoto($id)
    {
        $group_image=Client_Group::find()->where(['id'=>$id])->one()->group_image;
        if($group_image){
            @unlink('group_logo/'.$group_image);
        }
        $connection = Yii::$app->db;
        $connection->createCommand()->update('client_group', ['group_image' => ''], 'id = '.$id)->execute();

        /*  $User=User::findOne($id);
         print_r($User); exit;
        $photo->photo=NULL;
        $photo->update();*/

        return $this->redirect(['update','id'=>$id]);
    }
    /**
     * Deletes an existing ClientGroup model.
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
     * Finds the ClientGroup model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ClientGroup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ClientGroup::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
