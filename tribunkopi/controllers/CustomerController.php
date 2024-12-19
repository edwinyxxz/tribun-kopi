<?php

namespace app\controllers;
use Yii;
use app\models\User;
use app\models\Orders;
use yii\filters\AccessControl;
use app\models\Customer;
use app\models\CustomerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CustomerController implements the CRUD actions for Customer model.
 */
class CustomerController extends Controller
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
     * Lists all Customer models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CustomerSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Customer model.
     * @param int $id_customer Id Customer
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_customer)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_customer),
        ]);
    }

    /**
     * Creates a new Customer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Customer();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_customer' => $model->id_customer]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Customer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_customer Id Customer
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_customer)
    {
        $model = $this->findModel($id_customer);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_customer' => $model->id_customer]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Customer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_customer Id Customer
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_customer)
    {
        $orders= Orders::findAll(["id_customer"=>$id_customer]);
        foreach ($orders as $value) {
            $value->delete();
        };
        $this->findModel($id_customer)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Customer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_customer Id Customer
     * @return Customer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_customer)
    {
        if (($model = Customer::findOne(['id_customer' => $id_customer])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
