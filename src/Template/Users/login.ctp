<div class="users form">
<?php use App\Model\Entity\User; ?>
<?= $this->Flash->render('auth') ?>
<?= $this->element('header2', [
'header2_for_layout' => __('Kirjaudu sisään')]) ?>
    <div class='col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 text-center'>
        <?= $this->Form->create() ?>
        <?= $this->Form->input('username', ['label' => __('Käyttäjätunnus'), 'id' => 'username']) ?>
        <?= $this->Form->input('password', ['label' => __('Salasana'), 'id' => 'password']) ?>
        <?= $this->Form->button(__('Kirjaudu'), ['class' => 'btn btn-primary']); ?>
    </div>

    <?= $this->Form->end() ?>
    <script>
    $('document').ready(function () {
        $('#password').change(function() {
            if (!validatePassword($('#password').val())) {
                $('#password').addClass('inputError');
            }
            else {
                $('#password').removeClass('inputError');
            }
        });
    });
    </script>
</div>
