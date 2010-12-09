<div class='dash'>

	<h1 class='top'><?=$this->config->item('site_title')?></h1>

	<p>Analytics last <b>30</b> days: &nbsp;&nbsp;&nbsp; <b>Total Visits: <?=$totalVisits?></b> &nbsp;&nbsp;&nbsp; <b>Total Page Views: <?=$totalPageViews?></b> &nbsp;&nbsp;&nbsp; <a href='http://google.com/analytics/' target='new' class='speBtn'>more stats &#155;</a></p>

	<div id='analyticsVisitorsChart' style='width: 800px; height: 150px;'></div>

	<?php 
	$d1 = array();
	$d2 = array();
	$ticks = array();
	$i=0;
	foreach($visitStats as $day => $stats):
		$d1[] = '['.$i.','.$stats['pageViews'].']';
		$d2[] = '['.$i.','.$stats['visits'].']';
		$ticks[] = '['.$i.',"'.$day.'"]';
		$i++;
	endforeach;
	?>

	<script type='text/javascript'>
	Event.observe(window, 'load', function() {
		new Proto.Chart($('analyticsVisitorsChart'), 
			[
				{data: [<?=implode(',',$d1)?>], label: "Page Views"},
				{data: [<?=implode(',',$d2)?>], label: "Visitors"}
			],
			{
				colors: ['#94d0ff','#0090ff'],
				xaxis: {
					ticks: [<?=implode(',',$ticks)?>]
				},
				points: { show: true },
				lines: { show: true },
				grid: { backgroundColor: '#ffffff', borderWidth: 0 },
				legend: { show: true, position: 'nw' }
			}
		);
	});
	</script>
				
	<!-- include an api for google analytics -->
	<!-- get visits for chamber member pages -->

	<div class='twitter_dash'>

		<div>
			<form method='post' id='twitterUpdateForm' action='javascript: twitterUpdate();'>
				<p>
				Twitter: <b>What are you doing?</b> <span id='tweetUpdateStatus'></span><br />
				<textarea id='tweetUpdate' style='width: 650px;height: 40px;'></textarea> <button type='submit'>update</button>
				</p>
			</form>
		</div>

		<div class='clear'></div>

		<div class='latest_tweets' id='latestTweets'></div>

		<div class='clear'></div>

	</div>


</div>