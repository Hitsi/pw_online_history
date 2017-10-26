<?php
/* @var $this ResponceController */
/* @var $model Responce */

$this->breadcrumbs = array(
    'Обратная связь' => array('index'),
    $model->title,
);

$this->menu = array(
    array('label' => 'Написать сообщение', 'url' => array('index')),
    array('label' => 'Обновить сообщение', 'url' => array('update', 'id' => $model->id), 'visible' => Yii::app()->getAuthManager()->checkAccess("Responce.update",Yii::app()->user->id)),
    array('label' => 'Удалить сообщение', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Вы точно хотите удалить?'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Responce.delete",Yii::app()->user->id)),
    array('label' => 'Управление сообщениями', 'url' => array('admin'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Responce.admin",Yii::app()->user->id)),
);
?>

<h1>Сообщение <?php echo $model->title; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'title',
        'nick',
        'email',
        array(
            'type' => 'html',
            'name' => 'info',
            'value' => $model->info,
        ),
    ),
));
?>
