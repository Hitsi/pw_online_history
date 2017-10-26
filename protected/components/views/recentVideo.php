<ul>
    <?php foreach ($this->getRecentVideo() as $video): ?>
        <li>
            <?php echo CHtml::link(CHtml::encode($video->title), $video->getUrl()); ?>
        </li>
    <?php endforeach; ?>
</ul>