<ul>
    <?php foreach ($this->getRecentGvg() as $gvg): ?>
        <li>
            <?php echo CHtml::link(CHtml::encode(Yii::app()->dateFormatter->format("dd-MM-y ", $gvg->datestart)), $gvg->getUrl()); ?>
        </li>
    <?php endforeach; ?>
</ul>