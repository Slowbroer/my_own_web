<?php

namespace backend\controllers;

use Yii;
use common\models\Game;
use backend\models\GameSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\GameScore;

/**
 * GameController implements the CRUD actions for Game model.
 */
class GameController extends Controller
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
     * Lists all Game models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GameSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Game model.
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
     * Creates a new Game model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Game();

        if ($model->load(Yii::$app->request->post())) {
            if(!empty($model->score))
            {
                $score = GameScore::findOne(['id'=>$model->score]);
                $model->score = $score->score;
            }
            if($model->save())
            {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        $scores = GameScore::find()->select("title,id")->asArray()->all();

        $game_scores = ArrayHelper::map($scores,'id','title');

        return $this->render('create', [
            'model' => $model,
            'game_scores' => $game_scores
        ]);
    }

    /**
     * Updates an existing Game model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if(!empty($model->score))
            {
                $score = GameScore::findOne(['id'=>$model->score]);
                $model->score = $score->score;
            }
            if($model->save())
            {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }


        $scores = GameScore::find()->select("title,id")->asArray()->all();

        $game_scores = ArrayHelper::map($scores,'id','title');

        return $this->render('update', [
            'model' => $model,
            'game_scores' => $game_scores
        ]);
    }

    /**
     * Deletes an existing Game model.
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
     * Finds the Game model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Game the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Game::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
