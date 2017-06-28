<?php

namespace backend\controllers;

use common\models\MusicType;
use Yii;
use common\models\Album;
use common\models\AlbumSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AlbumController implements the CRUD actions for Album model.
 */
class AlbumController extends Controller
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
     * Lists all Album models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AlbumSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Album model.
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
     * Creates a new Album model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Album();
        $types = MusicType::find()->where(['<>','type_name',''])->asArray()->all();//这里只是用来练习where的使用，这里其实可以到源码里面进行查看
//        $types = MusicType::findOne(['<>','type_name','']);
//        var_dump($types);
//        die();

        if ($model->load(Yii::$app->request->post())) {
            if(isset($_FILES['albumImg']) && ($_FILES['albumImg']['type']=='image/gif'||$_FILES['albumImg']['type']=='image/jpeg'||$_FILES['albumImg']['type']=='image/png')&&$_FILES['albumImg']['size']<200000)
            {
                if($_FILES["albumImg"]["error"]>0)
                {
                    die("img-error");
                }
                else
                {
                    if(file_exists(Yii::getAlias("@frontend/web/images/albums/").$_FILES["albumImg"]['name']))
                    {
                        $model->img = "@frontend/web/images/albums/".$_FILES["albumImg"]['name'];
                    }
                    else
                    {
                        move_uploaded_file($_FILES["albumImg"]['tmp_name'],Yii::getAlias("@frontend/web/images/albums/").$_FILES["albumImg"]['name']);
                        $model->img = time().$_FILES["albumImg"]['name'];
                    }
                }
            }
            $model->add_time = $model->update_time = time();
            $model->publish_time = strtotime($model->publish_time);
            $model->type = implode(",",$model->type);

            if($model->save())
            {
                return $this->redirect(['view', 'id' => $model->id]);
            }
            else
            {
                return $this->render('create', [
                    'model' => $model,
                    'types' => $types,
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'types' => $types,
            ]);
        }
    }

    /**
     * Updates an existing Album model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $types = MusicType::find()->where(['<>','type_name',''])->asArray()->all();//这里只是用来练习where的使用，这里其实可以到源码里面进行查看

        if ($model->load(Yii::$app->request->post())) {

            if(isset($_FILES['albumImg']) && ($_FILES['albumImg']['type']=='image/gif'||$_FILES['albumImg']['type']=='image/jpeg'||$_FILES['albumImg']['type']=='image/png')&&$_FILES['albumImg']['size']<200000)
            {
                if($_FILES["albumImg"]["error"]>0)
                {
                    die("img-error");
                }
                else
                {
                    if(file_exists(Yii::getAlias("@frontend/web/images/albums/").$_FILES["albumImg"]['name']))
                    {
                        $model->img = "@frontend/web/images/albums/".$_FILES["albumImg"]['name'];
                    }
                    else
                    {
                        move_uploaded_file($_FILES["albumImg"]['tmp_name'],Yii::getAlias("@frontend/web/images/albums/").$_FILES["albumImg"]['name']);
                        $model->img = time().$_FILES["albumImg"]['name'];
                    }
                }
            }


            $model->publish_time = strtotime($model->publish_time);
            $model->type = implode(",",$model->type);
            $model->update_time = time();

            if($model->save())
            {
                return $this->redirect(['view', 'id' => $model->id]);
            }


        }
        $model->publish_time = date('m/d/Y',$model->publish_time);
        return $this->render('update', [
            'model' => $model,
            'types' => $types,
        ]);
    }

    /**
     * Deletes an existing Album model.
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
     * Finds the Album model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Album the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Album::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
