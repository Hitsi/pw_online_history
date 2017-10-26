<ul>
    <?php foreach ($this->getRecentComments() as $comment): ?>
        <li><?php echo $comment->user_info->username; ?> на гвг
            <?php echo CHtml::link(CHtml::encode(Yii::app()->dateFormatter->format("dd-MM-y ", $comment->gvg->datestart)), $comment->getUrl()); ?>
        </li>
    <?php endforeach; ?>
</ul>