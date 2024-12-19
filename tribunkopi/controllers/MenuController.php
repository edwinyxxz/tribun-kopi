<?php

namespace app\controllers;
use Yii;
use app\models\User;
use app\models\Menu;
use yii\filters\AccessControl;
use app\models\MenuSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MenuController implements the CRUD actions for Menu model.
 */
class MenuController extends Controller
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
     * Lists all Menu models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new MenuSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Menu model.
     * @param int $id_menu Id Menu
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_menu)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_menu),
        ]);
    }

    /**
     * Creates a new Menu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Menu();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_menu' => $model->id_menu]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Menu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_menu Id Menu
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_menu)
    {
        $model = $this->findModel($id_menu);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_menu' => $model->id_menu]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Menu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_menu Id Menu
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_menu)
    {
        $this->findModel($id_menu)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Menu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_menu Id Menu
     * @return Menu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_menu)
    {
        if (($model = Menu::findOne(['id_menu' => $id_menu])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
