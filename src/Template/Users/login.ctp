<div class="users form">
<?= $this->Flash->render('auth') ?>
<?= $this->element('bootstrap_left', [
'header2_for_layout' => __('Kirjaudu sisään')]) ?>
					<div class='col-xs-10 col-md-8 col-lg-6 text-center'>
					<?= $this->Form->input('username') ?>
        	<?= $this->Form->input('password') ?>
    </fieldset>
<?= $this->Form->button(__('Login')); ?>
<?= $this->Form->end() ?>
</div>
