<?php
/* @var $this GuestbookController */
/* @var $data Guestbook */
?>

<div class="comment">

    <div class="author">
        <?php
        $edit="";
        if (($data->authorid==Yii::app()->user->id and $data->authorid>0) or
            Yii::app()->authManager->isAssigned('admin',Yii::app()->user->id) or
            Yii::app()->authManager->isAssigned('moderator',Yii::app()->user->id))
            $edit=CHtml::link("edit", Yii::app()->createUrl("guestbook/update",array("id"=>$data->id)), array(
                'class' => 'cid',
                'title' => 'edit',
            ));
        echo $data->author . " " .$edit;
        ?>
    </div>

    <div class="content">
        <?php echo $data->content; ?>
    </div>
    <div class="time">
        <?php echo Yii::app()->dateFormatter->format("EEEE d MMMM yyyy HH:mm", $data->create_time); ?>
    </div>

</div>