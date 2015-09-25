
			<div class="content container-fluid">
				<div class="header2 row">
	    		<div class="white-space col-md-3 col-xs-1">&nbsp;</div>
						<div class="col-md-6 col-xs-10">
							<h2><?php if (isset($header2_for_layout)) echo $header2_for_layout;?></h2>
						</div>
					<div class="white-space col-md-3 col-xs-1">&nbsp;</div>
				</div>
				<div class="row">				
					<!-- <div class='col-xs-10 col-md-8 col-lg-6 text-center'>
						<div class="btn-group">
							<button type="button" class="btn btn-primary btn-toggle" data-toggle="button">
								Kilta
							</button>
							<button type="button" class="btn btn-primary btn-toggle" data-toggle="button">
								Yhteiset
							</button>
							<button type="button" class="btn btn-primary btn-toggle" data-toggle="button">
								ISOt
							</button>
						</div>
						<button class="btn btn-primary">
							<img class="img-button" src="i/omaplus.svg" style="height:18px"></img> Uusi tapahtuma
						</button>
					</div> -->
                    <div class='col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 text-center'>
                        <input class="search-bar" id="search-event" type="text" name="search" placeholder="<?= __('Etsi tapahtumista') ?>">
                    </div>					
				</div>
				<br>
                <?= $this->Form->create() ?>
                    <div class='col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 text-center'>
						<table class="event-list" style="border-collapse:collapse;">
							<thead>
								<tr>
									<td>Tapahtuma</td>
									<td />
								</tr>
							</thead>
							<tbody>
								<script>
									$('.collapse').on('show.bs.collapse', function () {
										$('.collapse.in').collapse('hide');
									});
								</script>
                                <?php foreach ($events as $event) : ?>
                                <tr>
                                    <td><?= $event->title ?></td>
                                    <td><button class="add-event" name="eventId" value="<?= $event->id ?>">LISÄÄ</button>
                                </tr>
                                <?php endforeach; ?>
							</tbody>
						</table>
						<br><span>Tapahtumia yhteensä: 9001</span>
					</div>
				</form>
			</div>					

