<?php

namespace app\controllers;
use Yii;
use app\models\User;
use app\models\Owner;
use yii\filters\AccessControl;
use app\models\OwnerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OwnerController implements the CRUD actions for Owner model.
 */
class OwnerController extends Controller
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
     * Lists all Owner models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new OwnerSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Owner model.
     * @param int $id_owner Id Owner
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_owner)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_owner),
        ]);
    }

    /**
     * Creates a new Owner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Owner();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_owner' => $model->id_owner]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Owner model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_owner Id Owner
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_owner)
    {
        $model = $this->findModel($id_owner);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_owner' => $model->id_owner]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Owner model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_owner Id Owner
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_owner)
    {
        $this->findModel($id_owner)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Owner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_owner Id Owner
     * @return Owner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_owner)
    {
        if (($model = Owner::findOne(['id_owner' => $id_owner])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
