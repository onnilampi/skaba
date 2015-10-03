<div class="users form">
<?= $this->Flash->render('auth') ?>
<?= $this->element('header2', [
'header2_for_layout' => __('Vaihda salasana')]) ?>
    <div class='col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 text-center'>
        <?= $this->Form->create() ?>
        <?= $this->Form->input('username', ['type' => 'hidden', 'value' => $this->request->session()->read('Auth.User.username')]) ?>
        <?= $this->Form->input('password', ['label' => __('Vanha salasana'), 'name' => 'password', 'class' => 'pw']) ?>        
        <?= $this->Form->input('password', ['label' => __('Uusi salasana'), 'name' => 'new-password', 'class' => 'pw']) ?>
        <?= $this->Form->input('password', ['label' => __('Uusi salasana uudestaan'), 'name' => 'new-password2', 'class' => 'pw']) ?>
        <?= $this->Form->button(__('Muuta salasana'), ['class' => 'btn btn-primary']); ?>
    </div>

    <?= $this->Form->end() ?>
    <script>
    $('document').ready(function () {
        $('.pw').change(function() {
            if (!validatePassword($(this).val())) {
                $(this).addClass('inputError');
            }
            else {
                $(this).removeClass('inputError');
            }
        });
    });
    </script>
</div>
