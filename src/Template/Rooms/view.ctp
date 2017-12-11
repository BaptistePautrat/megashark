<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Room $room
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Room'), ['action' => 'edit', $room->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Room'), ['action' => 'delete', $room->id], ['confirm' => __('Are you sure you want to delete # {0}?', $room->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Rooms'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Room'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Showtimes'), ['controller' => 'Showtimes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Showtime'), ['controller' => 'Showtimes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="rooms view large-9 medium-8 columns content">
    <h3><?= h($room->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($room->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($room->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Capacity') ?></th>
            <td><?= $this->Number->format($room->capacity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($room->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($room->modified) ?></td>
        </tr>
    </table>
   
        
   
    
    
    
    <table>
        <thead>
        <tr>
            <th scope="col">L</th>
            <th scope="col">M</th>
            <th scope="col">M</th>
            <th scope="col">J</th>
            <th scope="col">V</th>
            <th scope="col">S</th>
            <th scope="col">D</th>
        </tr>
        </thead>
    <table>
    <div id="contentBox" style="margin:0px auto; width:70%">
        <?php for($i=0;$i<7;$i++): ?>
            <table style="float:left; margin:0; width:14%;">
                <?php 
                    if(isset($showtimes[$i])):
                        foreach($showtimes[$i] as $showtime): ?>
                        <tr>
                            <td>
                                <?= h($showtime->movie->name); ?>
                                <?= h($showtime->start); ?>
                                <?= h($showtime->end); ?>
                            </td>
                        </tr>        
                      <?php endforeach;
                    else:
                        echo "<tr><td> Aucune seance ce jour</td></tr>";
                endif;?>
            </table>
        <?php endfor;  ?>      
    </div>
</div>
  
           
</div>
