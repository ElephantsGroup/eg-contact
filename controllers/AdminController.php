<?php

namespace elephantsGroup\contact\controllers;

use Yii;
use elephantsGroup\contact\models\ContactUs;
use elephantsGroup\contact\models\ContactUsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use elephantsGroup\base\EGController;

/**
 * AdminController implements the CRUD actions for ContactUs model.
 */
class AdminController extends EGController
{
    private $message = [];
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
     * Lists all ContactUs models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContactUsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ContactUs model.
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
     * Creates a new ContactUs model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->validate($_POST);
        $module = \Yii::$app->getModule('contact');

        if(count($this->message) > 0)
            return implode("\n",$this->message);

        else
        {
            $model = new ContactUs();
            if(isset($_POST['name'])) $model->name = $_POST['name'];
            if(isset($_POST['email'])) $model->email = $_POST['email'];
            if(isset($_POST['description'])) $model->description = $_POST['description'];

            $model->user_id = (int) Yii::$app->user->id;

            if($model->save())
                return Yii::t('contact', 'Thank you, Your message was sent');
            else
                return Yii::t('contact', 'There is a problem on server, please come back later.');
        }
    }

    private function validate($data)
    {
        $module = \Yii::$app->getModule('contact');

        if(!isset($_POST['name']) || empty($data['name']))
            $this->message[]= Yii::t('contact', 'Please enter name');
        if(!isset($_POST['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL))
            $this->message[]= Yii::t('contact', 'Please enter correct email');
        if(!isset($_POST['description']) || empty($data['description']))
            $this->message[]= Yii::t('contact', 'Please enter description');
    }

    /**
     * Updates an existing ContactUs model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if($model->save())
                return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ContactUs model.
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
     * Finds the ContactUs model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ContactUs the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ContactUs::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
