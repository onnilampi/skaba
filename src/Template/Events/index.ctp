
			<div class="content container-fluid">
				<div class="header2 row">
	    		<div class="white-space col-md-3 col-xs-1">&nbsp;</div>
						<div class="col-md-6 col-xs-10">
							<h2><?php if (isset($header2_for_layout)) echo $header2_for_layout;?>ASD</h2>
						</div>
					<div class="white-space col-md-3 col-xs-1">&nbsp;</div>
				</div>
				<div class="row">
					<div class="white-space col-xs-1 col-md-2 col-lg-3"></div>					
					<div class='col-xs-10 col-md-8 col-lg-6 text-center'>
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
					</div>
					<div class="white-space col-xs-1 col-md-2 col-lg-3"></div>					
				</div>
				<br>
				<form name="add_event" action="TÄHÄN PHP FILE" method="post">
					<div class="white-space col-xs-0 col-md-2 col-lg-3"></div>
					<div class="col-xs-12 col-md-8 col-lg-6">
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
								<tr><td>asd</td><td>dfg</td></tr>
								<tr><td>456</td><td>123</td></tr>
								<tr><td>hjktl</td><td>jkrsjgklqu</td></tr>
							</tbody>
						</table>
						<br><span>Tapahtumia yhteensä: 9001</span>
					</div>
					<div class="white-space col-xs-0 col-md-2 col-lg-3"></div>
				</form>
			</div>					

