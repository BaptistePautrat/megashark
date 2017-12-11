<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $showtime
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Showtimes'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="showtimes form large-9 medium-8 columns content">

    <fieldset>
        <legend><?= __('Planning') ?></legend>
        <?php
            echo $this->Form->control('Select room', ['options' => $rooms]);
            
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
    
    
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