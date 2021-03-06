<?php

namespace backend\controllers;

use common\models\MusicType;
use common\models\Singer;
use Yii;
use common\models\Album;
use common\models\AlbumSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

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
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index','view','create','update','delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
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
//        var_dump($dataProvider);

        $type = new MusicType();
        $type_lists = $type->type_array();
//        var_dump($type_lists);
//        $type_lists = ArrayHelper::map($type_lists,'id','type_name');


//        die();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'type_lists' => $type_lists,
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
        $singer = Singer::find()->select("singer_name,id")->orderBy("singer_name")->asArray()->asArray()->all();
        $singers = ArrayHelper::map($singer,'id','singer_name');

        if ($model->load(Yii::$app->request->post())) {

            if(isset($_FILES['albumImg']) && ($_FILES['albumImg']['type']=='image/gif'||$_FILES['albumImg']['type']=='image/jpeg'||$_FILES['albumImg']['type']=='image/png')&&$_FILES['albumImg']['size']<2000000)
            {
                if($_FILES["albumImg"]["error"]>0)
                {
                    die("img-error");
                }
                else
                {
                    if(file_exists(Yii::getAlias("@frontend/web/images/albums/").$_FILES["albumImg"]['name']))
                    {
                        $model->img = $_FILES["albumImg"]['name'];
                    }
                    else
                    {
                        move_uploaded_file($_FILES["albumImg"]['tmp_name'],Yii::getAlias("@frontend/web/images/albums/").$_FILES["albumImg"]['name']);
                        $model->img = $_FILES["albumImg"]['name'];
                    }
                }
            }
            else
            {
                die("图片规格有问题");
            }
            $model->add_time = $model->update_time = time();
            $model->publish_time = strtotime($model->publish_time);
            $model->type = implode(",",$model->type);
            $model->singer = $singers[$model->singer_id];

            if($model->save())
            {
                return $this->redirect(['view', 'id' => $model->id]);
            }
            else
            {
//                return $this->render('create', [
//                    'model' => $model,
//                    'types' => $types,
//                ]);
                return $this->render("/site/error",['name'=>'error','message'=>'保存失败']);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'types' => $types,
                'singers' => $singers,
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
        $singer = Singer::find()->select("singer_name,id")->orderBy("singer_name")->asArray()->asArray()->all();
        $singers = ArrayHelper::map($singer,'id','name');
        if ($model->load(Yii::$app->request->post())) {

            if(isset($_FILES['albumImg']) && ($_FILES['albumImg']['type']=='image/gif'||$_FILES['albumImg']['type']=='image/jpeg'||$_FILES['albumImg']['type']=='image/png')&&$_FILES['albumImg']['size']<2000000)
            {
                if($_FILES["albumImg"]["error"]>0)
                {
                    die("img-error");
                }
                else
                {
                    if(file_exists(Yii::getAlias("@frontend/web/images/albums/").$_FILES["albumImg"]['name']))
                    {
                        $model->img = $_FILES["albumImg"]['name'];
                    }
                    else
                    {
                        move_uploaded_file($_FILES["albumImg"]['tmp_name'],Yii::getAlias("@frontend/web/images/albums/").$_FILES["albumImg"]['name']);
                        $model->img = $_FILES["albumImg"]['name'];
                    }
                }
            }
            else
            {
                die("图片规格有问题");
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
            'singers' => $singers,
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
