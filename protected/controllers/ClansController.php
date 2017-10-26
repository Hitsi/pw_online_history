<?php

class ClansController extends RController {

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
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionGvg($id) {
        $this->render('gvg', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionVideo($id) {
        $this->render('video', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Clans;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Clans'])) {
            $model->attributes = $_POST['Clans'];
            //Полю icon присвоить значения поля формы icon
            $model->icon = CUploadedFile::getInstance($model, 'icon');
            if ($model->icon) {
                $sourcePath = pathinfo($model->icon->getName());
                $fileName = $model->name . '.' . $sourcePath['extension'];
                $model->image = $fileName;
            }
            if ($model->save()) {
                //Если поле загрузки файла не было пустым, то            
                if ($model->icon) {
                    //сохранить файл на сервере в каталог images/2011 под именем 
                    //month-day-alias.jpg
                    $file = Yii::app()->basePath . '/../images/clans/' . $fileName;
                    $model->icon->saveAs($file);
                }
                $this->redirect(array('view', 'id' => $model->id, 'name' => $model->name));
            }
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
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Clans'])) {
            $model->attributes = $_POST['Clans'];
            $model->icon = CUploadedFile::getInstance($model, 'icon');
            if ($model->icon) {
                $sourcePath = pathinfo($model->icon->getName());

                $fileName = $model->name . '.' . $sourcePath['extension'];
                $model->image = $fileName;
            }
            if ($model->save()) {
                if ($model->del_img) {
                    if (file_exists(Yii::app()->basePath . '/../images/clans/' . $model->image)) {
                        //удаляем файл
                        unlink('./images/clans/' . $model->image);
                        $model->image = '';
                    }
                }

                //Если поле загрузки файла не было пустым, то            
                if ($model->icon) {
                    $file = './images/clans/' . $fileName;
                    //сохранить файл на сервере под именем 
                    //month-day-alias.jpg Если файл с таким именем существует, он будет заменен.
                    $model->icon->saveAs($file);
                }
                $this->redirect(array('view', 'id' => $model->id));
            }
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
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $model = new Clans('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Clans']))
            $model->attributes = $_GET['Clans'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Clans('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Clans']))
            $model->attributes = $_GET['Clans'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Clans the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Clans::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Clans $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'clans-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
