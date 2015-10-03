
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
				</div> -->
				<br>
                <?= $this->Form->create() ?>
                    <div class='col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 text-center'>
						<table class="event-list" style="border-collapse:collapse;">
							<thead>
								<tr>
									<td><?= __('Tapahtuma') ?></td>
									<td><?= __('Raakapisteet') ?></td>
								</tr>
							</thead>
							<tbody>
								<script>
									$('.collapse').on('show.bs.collapse', function () {
										$('.collapse.in').collapse('hide');
									});
								</script>
								<?php 
									$points = 0;
									foreach ($results as $event) : 
									$points = $points + $event->points;
									?>
								    <tr>
									<td><?= $event->title ?></td>
									<td><?= $event->points ?></td>
								    </tr>
								<?php endforeach; ?>	
								
							</tbody>
								<tfoot>
									<tr>
										<td><b><?= __('Raakapisteitä yhteensä')?></b></td>
										<td><b><?= $points?></b></td>    
									</tr>
								</tfoot>
						</table>
					</div>
				</form>
			</div>					

