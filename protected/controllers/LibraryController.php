<?php

class LibraryController extends RController {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'rights',
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function actions() {
        return array(
            'imgUpload' => array(
                'class' => 'ext.redactor-upload-action.RedactorUploadAction',
                'directory' => 'images/upload',
                'validator' => array(
                    'mimeTypes' => array('image/png', 'image/jpg', 'image/gif', 'image/jpeg', 'image/pjpeg'),
                ),
            ),
            'fileUpload' => array(
                'class' => 'ext.redactor-upload-action.RedactorUploadAction',
                'directory' => 'files/upload',
                'validator' => array(
                    'types' => 'txt, pdf, doc, docx',
                ),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($name) {
        #$name=explode("\/", $name);
        $this->render('view', array(
            'model' => $this->loadModel($name),
        ));
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionTypeview($type) {
        $dataProvider = new CActiveDataProvider('Library', array('criteria' => array(
                        'condition' => 'type=' . Lookup::model()->findByAttributes(array('name' => $type))->code)));
        $this->render('typeview', array(
            'dataProvider' => $dataProvider,
            'type' => $type,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Library;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Library'])) {
            $model->attributes = $_POST['Library'];
            if ($model->save())
                $this->redirect(array('view', 'type' => Lookup::item('LibraryType', $model->type), 'name' => $model->name));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($name) {
        $model = $this->loadModel($name);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Library'])) {
            $model->attributes = $_POST['Library'];
            if ($model->save())
                $this->redirect(array('view', 'type' => Lookup::item('LibraryType', $model->type), 'name' => $model->name));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($name) {
        $this->loadModel($name)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {


        $dataProvider = new CActiveDataProvider('Library');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'models' => Library::model()->findAll(array('order' => 'type')),
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Library('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Library']))
            $model->attributes = $_GET['Library'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Library the loaded model
     * @throws CHttpException
     */
    public function loadModel($name) {
        $model = Library::model()->findByAttributes(array('name' => $name));
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.' . $name);
        return $model;
    }

    public function loadModelType($type) {
        $model = Library::model()->findByAttributes(array('type' => Lookup::model()->findByAttributes(array('name' => $type))->code));
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Library $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'library-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
