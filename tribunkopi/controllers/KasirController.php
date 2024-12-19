<?php

namespace app\controllers;
use Yii;
use app\models\User;
use app\models\Kasir;
use yii\filters\AccessControl;
use app\models\KasirSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * KasirController implements the CRUD actions for Kasir model.
 */
class KasirController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()  
    {  
        return array_merge(  
            parent::behaviors(),  
            [  
                'access' => [  
                    'class' => AccessControl::class,  
                    'rules' => [  
                        [  
                            'actions' => ['index', 'view', 'create', 'update', 'delete'], // Aksi untuk owner  
                            'allow' => true,  
                            'roles' => ['@'],  
                            'matchCallback' => function ($rule, $action) {  
                                $user = User::findOne(Yii::$app->user->id);  
                                return $user && $user->status === 'owner'; // Owner bisa akses semua  
                            },  
                        ],  
                        [  
                            'actions' => ['index', 'view'], // Akses untuk kasir  
                            'allow' => true,  
                            'roles' => ['@'],  
                            'matchCallback' => function ($rule, $action) {  
                                $user = User::findOne(Yii::$app->user->id);  
                                return $user && $user->status === 'kasir'; // Kasir bisa hanya aksi tertentu  
                            },  
                        ],  
                        [  
                            'actions' => ['update', 'delete'], // Kasir tidak dapat melakukan ini  
                            'allow' => false,  
                        ],  
                        [  
                            'allow' => false, // Semua akses lain ditolak  
                        ],  
                    ],  
                ],  
                'verbs' => [  
                    'class' => VerbFilter::class,  
                    'actions' => [  
                        'delete' => ['POST'], // Tetap mempertahankan kontrol HTTP  
                    ],  
                ],  
            ]  
        );  
    }

    /**
     * Lists all Kasir models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new KasirSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Kasir model.
     * @param int $id_kasir Id Kasir
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_kasir)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_kasir),
        ]);
    }

    /**
     * Creates a new Kasir model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Kasir();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_kasir' => $model->id_kasir]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Kasir model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_kasir Id Kasir
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_kasir)
    {
        $model = $this->findModel($id_kasir);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_kasir' => $model->id_kasir]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Kasir model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_kasir Id Kasir
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_kasir)
    {
        $this->findModel($id_kasir)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Kasir model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_kasir Id Kasir
     * @return Kasir the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_kasir)
    {
        if (($model = Kasir::findOne(['id_kasir' => $id_kasir])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
