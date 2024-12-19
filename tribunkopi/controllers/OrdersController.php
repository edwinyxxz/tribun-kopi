<?php

namespace app\controllers;

use Yii;
use app\models\Orders;
use app\models\User;
use yii\filters\AccessControl;
use app\models\OrdersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends Controller
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
                        'actions' => ['index', 'view', 'create'], // Akses untuk kasir  
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
     * Lists all Orders models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new OrdersSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Orders model.
     * @param int $id_transaksi Id Transaksi
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_transaksi)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_transaksi),
        ]);
    }

    /**
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Orders();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_transaksi' => $model->id_transaksi]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Orders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_transaksi Id Transaksi
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_transaksi)
    {
        $model = $this->findModel($id_transaksi);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_transaksi' => $model->id_transaksi]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Orders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_transaksi Id Transaksi
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_transaksi)
    {
        $this->findModel($id_transaksi)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_transaksi Id Transaksi
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_transaksi)
    {
        if (($model = Orders::findOne(['id_transaksi' => $id_transaksi])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
