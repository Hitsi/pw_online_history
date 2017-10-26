<?php
/* @var $this FrapserController */
/* @var $model Frapser */

$this->breadcrumbs = array(
    'Видеооператоры' => array('index'),
    $model->nick => array('view', 'id' => $model->id, 'nick' => $model->nick),
    'Обновление',
);

$this->menu = array(
    array('label' => 'Список видеооператоров', 'url' => array('index')),
    array('label' => 'Добавить видеооператора', 'url' => array('create'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Frapser.create",Yii::app()->user->id)),
    array('label' => 'Просмотр', 'url' => array('view', 'id' => $model->id, 'name' => $model->nick)),
    array('label' => 'Управление видеооператорами', 'url' => array('admin'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Frapser.admin",Yii::app()->user->id)),
);
?>

<h1>Обновление видеооператора <?php echo $model->nick; ?></h1>
<?php echo Frapser::model()->findByPk($_GET['id'])->owner;?>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>