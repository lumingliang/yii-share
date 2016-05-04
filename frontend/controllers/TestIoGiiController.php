<?php

namespace frontend\controllers;

use Yii;
use frontend\models\base\testIoGii;
use frontend\models\testIoGiiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TestIoGiiController implements the CRUD actions for testIoGii model.
 */
class TestIoGiiController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all testIoGii models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new testIoGiiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single testIoGii model.
     * 
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new testIoGii model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new testIoGii();

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', ]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing testIoGii model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * 
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', ]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing testIoGii model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * 
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->deleteWithRelated();

        return $this->redirect(['index']);
    }
    
    /**
     * 
     * for export pdf at actionView
     *  
     * @param type $id
     * @return type
     */
    public function actionPdf($id) {
        $model = $this->findModel($id);

        $content = $this->renderAjax('_pdf', [
            'model' => $model,
        ]);

        $pdf = new \kartik\mpdf\Pdf([
            'mode' => \kartik\mpdf\Pdf::MODE_CORE,
            'format' => \kartik\mpdf\Pdf::FORMAT_A4,
            'orientation' => \kartik\mpdf\Pdf::ORIENT_PORTRAIT,
            'destination' => \kartik\mpdf\Pdf::DEST_BROWSER,
            'content' => $content,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => '.kv-heading-1{font-size:18px}',
            'options' => ['title' => \Yii::$app->name],
            'methods' => [
                'SetHeader' => [\Yii::$app->name],
                'SetFooter' => ['{PAGENO}'],
            ]
        ]);

        return $pdf->render();
    }
    
    /**
     * Finds the testIoGii model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * 
     * @return testIoGii the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = testIoGii::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
