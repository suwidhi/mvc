<ul <?php $this->print('list-name');?>> 
    <?php
    foreach($this->get('list-items') as $item) {
        echo "<li>$item</li>";
    }
    ?>
</ul>