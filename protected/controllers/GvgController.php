<?php

class GvgController extends RController {
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array ( 
            'rights',
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }
    
    public function actions(){
        return array(
            'captcha'=>array(
                'class'=>'CCaptchaAction',
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($datestart) {
        $gvg = $this->loadModel($datestart);
        $comment = $this->newComment($gvg);
        
        $this->render('view', array (
            'model' => $gvg,
            'comment' => $comment,
            'next_gvg' => $gvg->getNextGvg($datestart),
            'prev_gvg' => $gvg->getPrevGvg($datestart),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Gvg;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Gvg'])) {
            $model->attributes = $_POST['Gvg'];
            $model->icon_before = CUploadedFile::getInstance($model, 'icon_before');
            $model->icon_after = CUploadedFile::getInstance($model, 'icon_after');
            if ($model->icon_before) {
                $sourcePath = pathinfo($model->icon_before->getName());
                $fileName_before = $model->datestart.'_before.'.$sourcePath['extension'];
                $model->image_before = $fileName_before;
            }
            if ($model->icon_after) {
                $sourcePath = pathinfo($model->icon_after->getName());
                $fileName_after = $model->datestart.'_after.'.$sourcePath['extension'];
                $model->image_after = $fileName_after;
            }
            if ($model->icon_before) {
                    //сохранить файл на сервере в каталог images/2011 под именем 
                    //month-day-alias.jpg
                    $file = Yii::app()->basePath.'/../images/gvg/'.$fileName_before;
                    $model->icon_before->saveAs($file);
                }
                if ($model->icon_after) {
                    //сохранить файл на сервере в каталог images/2011 под именем 
                    //month-day-alias.jpg
                    $file = Yii::app()->basePath.'/../images/gvg/'.$fileName_after;
                    $model->icon_after->saveAs($file);
                }
            if ($model->save()) {
                
                $this->redirect(array ('view', 'id' => $model->datestart));
            }
        }

        $this->render('create', array (
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($datestart) {
        $model = $this->loadModel($datestart);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Gvg'])) {
            $model->attributes = $_POST['Gvg'];
            $model->icon_before = CUploadedFile::getInstance($model, 'icon_before');
            $model->icon_after = CUploadedFile::getInstance($model, 'icon_after');
            if ($model->icon_before) {
                $sourcePath = pathinfo($model->icon_before->getName());

                $fileName_before = $model->datestart.'_before.'.$sourcePath['extension'];
                $model->image_before = $fileName_before;
            }
            if ($model->icon_after) {
                $sourcePath = pathinfo($model->icon_after->getName());

                $fileName_after = $model->datestart.'_after.'.$sourcePath['extension'];
                $model->image_after = $fileName_after;
            }

            if ($model->del_img_before) {
                if (file_exists(Yii::app()->basePath.'/../images/gvg/'.$model->image_before)) {
                    //удаляем файл
                    unlink(Yii::app()->basePath.'/../images/gvg/'.$model->image_before);
                    unlink(Yii::app()->basePath.'/../images/gvg/thumbs/'.$model->image_before);
                    $model->image_before = '';
                }
            }
            if ($model->del_img_after) {
                if (file_exists(Yii::app()->basePath.'/../images/gvg/'.$model->image_after)) {
                    //удаляем файл
                    unlink('./images/gvg/'.$model->image_after);
                    unlink('./images/gvg/thumbs/'.$model->image_after);
                    $model->image_after = '';
                }
            }

            //Если поле загрузки файла не было пустым, то            
            if ($model->icon_before) {

                $file = Yii::app()->basePath.'/../images/gvg/'.$fileName_before;
                //сохранить файл на сервере под именем 
                $model->icon_before->saveAs($file);
            }
            if ($model->icon_after) {
                $file = Yii::app()->basePath.'/../images/gvg/'.$fileName_after;
                //сохранить файл на сервере под именем 
                $model->icon_after->saveAs($file);
            }
            if ($model->save()) {
                $this->redirect(array ('view', 'datestart' => $model->datestart));
            }
        }

        $this->render('update', array (
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($datestart) {
        $this->loadModel($datestart)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array ('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {

        $model = new Gvg('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Gvg']))
            $model->attributes = $_GET['Gvg'];

        $this->render('index', array (
            'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Gvg('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Gvg']))
            $model->attributes = $_GET['Gvg'];

        $this->render('admin', array (
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Gvg the loaded model
     * @throws CHttpException
     */
    public function loadModel($datestart) {
        $model = Gvg::model()->findByAttributes(array ('datestart' => $datestart));
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Gvg $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'gvg-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    protected function newComment($gvg) {
        $comment = new Comment;
        if (isset($_POST['Comment'])) {
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'comment-form') {
                echo CActiveForm::validate($comment);
                Yii::app()->end();
            }

            $comment->attributes = $_POST['Comment'];
            if ($gvg->addComment($comment)) {
                Yii::app()->user->setFlash('commentSubmitted', 'спасибо за ваш комментарий.');
                $this->refresh();
            }
        }
        return $comment;
    }

   

}
