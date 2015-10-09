
			<div class="content container-fluid">
				<div class="header2 row">
	    		<div class="white-space col-md-3 col-xs-1">&nbsp;</div>
						<div class="col-md-6 col-xs-10">
							<h2><?php if (isset($header2_for_layout)) echo $header2_for_layout;?></h2>
						</div>
					<div class="white-space col-md-3 col-xs-1">&nbsp;</div>
				</div>
				<div class="row">				
				
                    					
				</div>
				<br>
                <?= $this->Form->create() ?>
					<?= $this->element('header2', ['header2_for_layout' => __('Yhteiset pisteet')]) ?>
                    <div class='col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 text-center'>
						<table class="event-list" style="border-collapse:collapse;">
							<thead>
								<tr>
									<td><?= __('ISO') ?></td>
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
									$i=0; 
									$users_array=array();
									$points_array=array();
									foreach ($results as $user) :
									array_push($users_array, $user->realName);
									array_push($points_array, $points[$i]);
									//array_push($sortable_array, $user_array);
									$i=$i+1;?>
								<?php endforeach;
								array_multisort($points_array, SORT_DESC, SORT_NUMERIC,
												$users_array, SORT_DESC, SORT_STRING);
								$amount=count($users_array);
								for ($cives=0; $cives < $amount; $cives++){ ?>
									<tr>
									<td><?= $users_array[$cives] ?></td>
									<td><?= $points_array[$cives] ?></td>
								    </tr>
								<?php } ?>
								
								
							</tbody>
						</table>
					</div>
					<?= $this->element('header2', ['header2_for_layout' => __('Kiltapisteet')]) ?>
					<div class='col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 text-center'>
						<table class="event-list" style="border-collapse:collapse;">
							<thead>
								<tr>
									<td><?= __('ISO') ?></td>
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
									$i=0; 
									$users_array=array();
									$points_array=array();
									foreach ($results_g as $user) :
									array_push($users_array, $user->realName);
									array_push($points_array, $points_g[$i]);
									//array_push($sortable_array, $user_array);
									$i=$i+1;?>
								<?php endforeach;
								array_multisort($points_array, SORT_DESC, SORT_NUMERIC,
												$users_array, SORT_DESC, SORT_STRING);
								$amount=count($users_array);
								for ($cives=0; $cives < $amount; $cives++){ ?>
									<tr>
									<td><?= $users_array[$cives] ?></td>
									<td><?= $points_array[$cives] ?></td>
								    </tr>
								<?php } ?>
								
								
							</tbody>
						</table>
					</div>
					
					<!--<?php if($taffa){ ?>
					</div>
					<?= $this->element('header2', ['header2_for_layout' => __('TF')]) ?>
					<div class='col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 text-center'>
						<table class="event-list" style="border-collapse:collapse;">
							<thead>
								<tr>
									<td><?= __('ISO') ?></td>
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
									$i=0; 
									$users_array=array();
									$points_array=array();
									foreach ($results_tf as $user) :
									array_push($users_array, $user->realName);
									array_push($points_array, $points_tf[$i]);
									//array_push($sortable_array, $user_array);
									$i=$i+1;?>
								<?php endforeach;
								array_multisort($points_array, SORT_DESC, SORT_NUMERIC,
												$users_array, SORT_DESC, SORT_STRING);
								$amount=count($users_array);
								for ($cives=0; $cives < $amount; $cives++){ ?>
									<tr>
									<td><?= $users_array[$cives] ?></td>
									<td><?= $points_array[$cives] ?></td>
								    </tr>
								<?php } ?>
								
								
							</tbody>
						</table>
					</div>
					<?php } ?>-->
					
				</form>
			</div>					
	
