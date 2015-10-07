
<div class="content container-fluid">
    <div class="header2 row">
        <div class="white-space col-md-3 col-xs-1">&nbsp;</div>
        <div class="col-md-6 col-xs-10">
            <h2><?php if (isset($header2_for_layout)) echo $header2_for_layout;?></h2>
        </div>
        <div class="white-space col-md-3 col-xs-1">&nbsp;</div>
    </div>
    <!--<div class="row">				
        <div class='col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 text-center'>
            <input class="search-bar" id="search-event" type="text" name="search" placeholder="<?= __('Etsi tapahtumista') ?>">
        </div>					
    </div>
    <br>-->
    <?= $this->Form->create(null, [
        'url' => ['controller' => 'Attendances', 'action' => 'Add']
    ]); ?>
        <div class='col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 text-center'>
            <table class="event-list event-attend" style="border-collapse:collapse;">
                <thead>
                    <tr>
                        <td><?= __('Tapahtuma') ?></td>
                        <td />
                    </tr>
                </thead>
                <tbody>
                <script>
                    $('.collapse').on('show.bs.collapse', function () {
                        $('.collapse.in').collapse('hide');
                    });
                </script>
                <?php 
                    $event_count=0;
                    foreach ($results as $event) : 
                    $event_count=$event_count+1;
                ?>
                    <tr data-toggle="collapse" data-target="#event<?= $event->id ?>" class="accordion-toggle event-name">
                        <td><?= $event->title ?></td>
                        <td class="button-cell"><button type="submit" class="btn btn-success" name="event-id" value="<?= $event->id ?>"><?= __('Lisää tapahtumiini') ?></button>
                    </tr>
                    <tr class="accordion-body collapse" id="event<?= $event->id ?>">
                        <td colspan="2" class="hiddenRow"><?= $event->body ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <br><span><?= __('Tapahtumia yhteensä') ?>: <?= $event_count ?> </span>
        </div>
    <?= $this->Form->end(); ?>
</div>					


