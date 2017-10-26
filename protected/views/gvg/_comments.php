<?php 
$i=0;
foreach ($comments as $comment): $i++?>

    <div class="comment" id="c<?php echo $comment->id; ?>">



        <div class="author">
            <?php
            $edit="";
            if (($comment->authorId==Yii::app()->user->id and $comment->authorId>0) or
                Yii::app()->authManager->isAssigned('admin',Yii::app()->user->id) or
                Yii::app()->authManager->isAssigned('moderator',Yii::app()->user->id))
                $edit=CHtml::link("edit", Yii::app()->createUrl("comment/update",array("id"=>$comment->id)), array(
                    'class' => 'cid',
                    'title' => 'edit',
                ));
                echo $comment->user_info->username . " " .
                    CHtml::link("#{$i}", $comment->getUrl($gvg), array(
                'class' => 'cid',
                'title' => 'Ссылка на этот комментарий',
            )).$edit;
            ?>
        </div>

        <div class="content">
            <?php echo $comment->content; ?>
        </div>
        <div class="time">
            <?php echo Yii::app()->dateFormatter->format("EEEE d MMMM yyyy HH:mm", $comment->create_time); ?>
        </div>

    </div><!-- comment -->
<?php endforeach; ?>