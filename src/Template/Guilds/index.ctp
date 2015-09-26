<div class="col-lg-2 col-md-3 col-xs-12">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Guild'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="form-content col-lg-8 col-md-8 col-xs-12">
    <table class="event-list">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('title') ?></th>
            <th><?= $this->Paginator->sort('abbr') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($guilds as $guild): ?>
        <tr>
            <td><?= $this->Number->format($guild->id) ?></td>
            <td><?= h($guild->title) ?></td>
            <td><?= h($guild->abbr) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $guild->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $guild->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $guild->id], ['confirm' => __('Are you sure you want to delete # {0}?', $guild->id)]) ?>
            </td>
        </tr>

    <?php endforeach; ?>
    </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
