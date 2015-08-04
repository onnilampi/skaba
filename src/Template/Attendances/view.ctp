<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Attendance'), ['action' => 'edit', $attendance->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Attendance'), ['action' => 'delete', $attendance->id], ['confirm' => __('Are you sure you want to delete # {0}?', $attendance->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Attendances'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Attendance'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="attendances view large-10 medium-9 columns">
    <h2><?= h($attendance->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Event Title') ?></h6>
            <p><?= h($attendance->event_title) ?></p>
            <h6 class="subheader"><?= __('User RealName') ?></h6>
            <p><?= h($attendance->user_realName) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($attendance->id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($attendance->created) ?></p>
            <h6 class="subheader"><?= __('Verified') ?></h6>
            <p><?= h($attendance->verified) ?></p>
        </div>
    </div>
</div>
