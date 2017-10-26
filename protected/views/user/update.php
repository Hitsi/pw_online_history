<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
    'Users' => array('index'),
    $model->username => array('view', 'id' => $model->id),
    'Update',
);

$this->menu = array(
    array('label' => 'Список пользователей', 'url' => array('index')),
    array('label' => 'Создать пользователя', 'url' => array('create')),
    array('label' => 'Посмотреть пользователя', 'url' => array('view', 'id' => $model->id)),
    array('label' => 'Управление пользователями', 'url' => array('admin')),
);
?>

<h1>Обновление пользователя <?php echo $model->username; ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>