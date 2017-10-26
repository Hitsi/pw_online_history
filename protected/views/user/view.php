<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
    'Пользователи' => array('index'),
    $model->username,
);

$this->menu = array(
    array('label' => 'Список пользователей', 'url' => array('index')),
    array('label' => 'Создать пользователя', 'url' => array('create')),
    array('label' => 'Обновить пользователя', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Удалить пользователя', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Управление пользователями', 'url' => array('admin')),
);
?>

<h1>Просмотр пользователя #<?php echo $model->username; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'username',
        'email',
        'profile',
    ),
));
?>
