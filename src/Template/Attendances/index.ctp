<div class="col-lg-1 col-md-2 col-sm-3 col-xs-10">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Attendance'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="form-content col-lg-10 col-md-8 col-sm-7 col-xs-12">
    <table class="event-list">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('created') ?></th>
            <th><?= $this->Paginator->sort('verified') ?></th>
            <th><?= $this->Paginator->sort('event_id') ?></th>
            <th><?= $this->Paginator->sort('user_id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($attendances as $attendance):
			foreach ($allowed_events as $allowed_event):
			if($attendance->event_id == $allowed_event->id){
    ?>
			<td><?= $this->Number->format($attendance->id) ?></td>
            <td><?= h($attendance->created) ?></td>
            <td><?= h($attendance->verified) ?></td>
            <td><?php $event_name=$events->get($attendance->event_id); 
					echo $event_name->title;
				?></td>
            <td><?php $user_name=$users->get($attendance->user_id); 
					echo $user_name->realName;
				?></td>
            <td class="actions">
                <!--<?= $this->Html->link(__('View'), ['action' => 'view', $attendance->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $attendance->id]) ?>-->
                <?php if($attendance->verified==''){
                echo $this->Form->postLink(__('Verify'), ['action' => 'verify', $attendance->id]);
                }else{
                echo $this->Form->postLink(__('Unverify'), ['action' => 'unverify', $attendance->id]);
                } ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $attendance->id], ['confirm' => __('Are you sure you want to delete # {0}?', $attendance->id)]) ?>
            </td>
        </tr>

    <?php }
			endforeach;
			endforeach; ?>
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
