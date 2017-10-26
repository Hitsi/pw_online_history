<?php
/* @var $this ClansController */
/* @var $model Clans */

$this->breadcrumbs = array(
    'Кланы' => array('index'),
    $model->name,
);

$this->menu = array(
    array('label' => 'Список кланов', 'url' => array('index')),
    array('label' => 'Видео клана', 'url' => array('video', 'id' => $model->id, 'name' => $model->name)),
    array('label' => 'Гвг клана', 'url' => array('gvg', 'id' => $model->id, 'name' => $model->name)),
    array('label' => 'Создать клан', 'url' => array('create'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Clans.create",Yii::app()->user->id)),
    array('label' => 'Обновить клан', 'url' => array('update', 'id' => $model->id, 'name' => $model->name), 'visible' => Yii::app()->getAuthManager()->checkAccess("Clans.update",Yii::app()->user->id)),
    array('label' => 'Удалить клан', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id, 'name' => $model->name), 'confirm' => 'Вы уверены что хотите удалить?'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Clans.delete",Yii::app()->user->id)),
    array('label' => 'Управление кланами', 'url' => array('admin'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Clans.admin",Yii::app()->user->id)),
);
?>

<h1>Клан <?php echo $model->name; ?></h1>

<?php
echo $this->renderPartial('_info', array('model' => $model));
?>
<center>
<?php
    if ($model->videotype == Video::YOUTUBE_VIDEO) {
        preg_match('/[?&]v=([-_a-z0-9]{11})/i', $model->video, $link);
        if (isset($link[1])) {
            ?>

            <iframe width="560" height="315" src="//www.youtube.com/embed/<?php echo $link[1]; ?>" frameborder="0" allowfullscreen></iframe>

            <?php
        }
    }
    ?>
</center>
<?php
echo $model->info;
?>
