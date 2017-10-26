<?php
/* @var $this VideoController */
/* @var $model Video */

$this->breadcrumbs = array(
    'Видео' => array('index'),
    $model->title,
);

$this->menu = array(
    array('label' => 'Список видео', 'url' => array('index')),
    array('label' => 'Добавить видео', 'url' => array('create'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Video.create",Yii::app()->user->id)),
    array('label' => 'Обновить видео', 'url' => array('update', 'id' => $model->id, 'title' => $model->title), 'visible' => Yii::app()->getAuthManager()->checkAccess("Video.update",Yii::app()->user->id)),
    array('label' => 'Удалить видео', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Вы точно хотите удалить?'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Video.delete",Yii::app()->user->id)),
    array('label' => 'Управление видео', 'url' => array('admin'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Video.admin",Yii::app()->user->id)),
    array('label' => 'Добавить видеооператора', 'url' => array('frapser/create'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Frapser.create",Yii::app()->user->id)),
);
?>

<h1>Просмотр видео <?php echo $model->title; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'title',
        array(
            'type' => 'date',
            'name' => 'create_time',
            'value' => Yii::app()->dateFormatter->format("dd-MM-y ", $model->create_time),
        ),
        array(
            'type' => 'html',
            'name' => 'frapserid',
            'value' => CHtml::link($model->frapser_info->nick, Frapser::getUrl($model->frapser_info->id,$model->frapser_info->nick)),
        ),
        array(
            'type' => 'html',
            'name' => 'clan',
            'value' => Clans::getIcon($model->clan_info->id, $model->clan_info->name, $model->clan_info->image) . "&nbsp;" .CHtml::link($model->clan_info->name, Clans::getVideoUrl($model->clan_info->id, $model->clan_info->name)),
        ),
        array(
            'type' => 'raw',
            'name' => 'type',
            'value' => Lookup::item('VideoType', $model->type),
        ),
        array(
            'type' => 'raw',
            'name' => 'link',
            'value' => CHtml::link(CHtml::encode($model->link), $model->link, array('target' => '_blank')),
        ),
        array(
            'type' => 'raw',
            'name' => 'class',
            'value' => Lookup::item('PlayerClassName', $model->class),
        ),
        array(
            'type' => 'raw',
            'name' => 'battleid',
            'value' => $model->battle_info == null ? "" : CHtml::link(CHtml::encode($model->battle_info->datestart), Gvg::getUrl(Gvg::model()->findByAttributes(array('id' => $model->battle_info->gvgid))->datestart)) . " " .
                    CHtml::link(CHtml::encode(Clans::model()->findByPk($model->battle_info->defend)->name), Clans::getVideoUrl(Clans::model()->findByPk($model->battle_info->defend)->id, Clans::model()->findByPk($model->battle_info->defend)->name))
                    . " vs " .
                    CHtml::link(CHtml::encode(Clans::model()->findByPk($model->battle_info->atack)->name), Clans::getVideoUrl(Clans::model()->findByPk($model->battle_info->atack)->id, Clans::model()->findByPk($model->battle_info->atack)->name))
                    . " | Победил " .
                    Clans::model()->findByPk($model->battle_info->winner)->name,
        ),
    ),
));
?>
<center>
    <?php
    if ($model->linktype == Video::YOUTUBE_VIDEO) {
        preg_match('/[?&]v=([-_a-z0-9]{11})/i', $model->link, $link);
        if (isset($link[1])) {
            ?>

            <iframe width="560" height="315" src="//www.youtube.com/embed/<?php echo $link[1]; ?>" frameborder="0" allowfullscreen></iframe>

            <?php
        }
    }
    ?>
</center>
