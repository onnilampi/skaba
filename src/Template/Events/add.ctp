<div class="col-lg-2 col-md-3 col-xs-12">
    <h3><?= __('Actions') ?></h3>
    <ul>
        <li><?= $this->Html->link(__('List Events'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Guilds'), ['controller' => 'Guilds', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Guild'), ['controller' => 'Guilds', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Attendances'), ['controller' => 'Attendances', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Attendance'), ['controller' => 'Attendances', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="col-lg-8 col-md-8 col-xs-12">
    <?= $this->Form->create($event) ?>
    <fieldset class="form-content">
        <legend><?= __('Add Event') ?></legend>
        <?php
            echo $this->Form->input('title');
            echo $this->Form->input('body');
            echo $this->Form->input('points');
            echo $this->Form->input('guild_id', ['options' => $guilds, 'default' => 0]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
