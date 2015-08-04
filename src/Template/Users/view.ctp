<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Guilds'), ['controller' => 'Guilds', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Guild'), ['controller' => 'Guilds', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Attendances'), ['controller' => 'Attendances', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Attendance'), ['controller' => 'Attendances', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="users view large-10 medium-9 columns">
    <h2><?= h($user->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('RealName') ?></h6>
            <p><?= h($user->realName) ?></p>
            <h6 class="subheader"><?= __('Username') ?></h6>
            <p><?= h($user->username) ?></p>
            <h6 class="subheader"><?= __('Password') ?></h6>
            <p><?= h($user->password) ?></p>
            <h6 class="subheader"><?= __('Role') ?></h6>
            <p><?= h($user->role) ?></p>
            <h6 class="subheader"><?= __('Guild') ?></h6>
            <p><?= $user->has('guild') ? $this->Html->link($user->guild->title, ['controller' => 'Guilds', 'action' => 'view', $user->guild->id]) : '' ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($user->id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($user->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($user->modified) ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Attendances') ?></h4>
    <?php if (!empty($user->attendances)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Created') ?></th>
            <th><?= __('Verified') ?></th>
            <th><?= __('Event Title') ?></th>
            <th><?= __('User RealName') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($user->attendances as $attendances): ?>
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
