<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Event'), ['action' => 'edit', $event->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Event'), ['action' => 'delete', $event->id], ['confirm' => __('Are you sure you want to delete # {0}?', $event->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Events'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Event'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Guilds'), ['controller' => 'Guilds', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Guild'), ['controller' => 'Guilds', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Attendances'), ['controller' => 'Attendances', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Attendance'), ['controller' => 'Attendances', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="events view large-10 medium-9 columns">
    <h2><?= h($event->title) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Title') ?></h6>
            <p><?= h($event->title) ?></p>
            <h6 class="subheader"><?= __('Guild') ?></h6>
            <p><?= $event->has('guild') ? $this->Html->link($event->guild->title, ['controller' => 'Guilds', 'action' => 'view', $event->guild->id]) : '' ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($event->id) ?></p>
            <h6 class="subheader"><?= __('Points') ?></h6>
            <p><?= $this->Number->format($event->points) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($event->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($event->modified) ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Body') ?></h6>
            <?= $this->Text->autoParagraph(h($event->body)) ?>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Attendances') ?></h4>
    <?php if (!empty($event->attendances)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Created') ?></th>
            <th><?= __('Verified') ?></th>
            <th><?= __('Event Title') ?></th>
            <th><?= __('User RealName') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($event->attendances as $attendances): ?>
        <tr>
            <td><?= h($attendances->id) ?></td>
            <td><?= h($attendances->created) ?></td>
            <td><?= h($attendances->verified) ?></td>
            <td><?= h($attendances->event_title) ?></td>
            <td><?= h($attendances->user_realName) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Attendances', 'action' => 'view', $attendances->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Attendances', 'action' => 'edit', $attendances->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Attendances', 'action' => 'delete', $attendances->id], ['confirm' => __('Are you sure you want to delete # {0}?', $attendances->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
