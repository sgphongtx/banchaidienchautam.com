<script>
(function(w,d,s,g,js,fs){
  g=w.gapi||(w.gapi={});g.analytics={q:[],ready:function(f){this.q.push(f);}};
  js=d.createElement(s);fs=d.getElementsByTagName(s)[0];
  js.src='https://apis.google.com/js/platform.js';
  fs.parentNode.insertBefore(js,fs);js.onload=function(){g.load('analytics');};
}(window,document,'script'));
</script>
<?php $seo=getRecord("tbl_seo", "idshop=".$idshop); ?>
<header class="col-lg-12 clearfix">
	<div class="Dashboard-header">
		<ul class="FlexGrid">
			<li class="FlexGrid-item">
				<h1 class="Titles-main" id="view-name">Select a View</h1>
				<div class="Titles-sub" id="embed-api-auth-container"></div>
			</li>
			<li class="FlexGrid-item FlexGrid-item--fixed">
				<div id="active-users-container"></div>
			</li>
		</ul>

		<div id="view-selector-container"></div>
	</div>
</header>
<div class="col-lg-6">
	<div class="Chartjs">
		<div class="block">
			<div class="block-header">
				<h3 class="block-title"><i class="fa fa-bar-chart"></i> Thống kê truy cập tuần này &amp; tuần trước</h3>
			</div>
			<div class="block-content block-content-full bg-gray-lighter text-center">
				<div style="min-height: 1px;">
					<figure class="Chartjs-figure" id="chart-1-container"></figure>
					<ol class="Chartjs-legend" id="legend-1-container"></ol>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="col-lg-6">
	<div class="Chartjs">
		<div class="block">
			<div class="block-header">
				<h3 class="block-title"><i class="fa fa-bar-chart"></i> Thống kê truy cập năm nay &amp; năm ngoái</h3>
			</div>
			<div class="block-content block-content-full bg-gray-lighter text-center">
				<div style="min-height: 1px;">
					<figure class="Chartjs-figure" id="chart-2-container"></figure>
					<ol class="Chartjs-legend" id="legend-2-container"></ol>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="/public/templates/quantri/plugins/ggchart/js/Chart.min.js"></script>

<script type="text/javascript" src="/public/templates/quantri/plugins/ggchart/js/moment.min.js"></script>

<!-- Include the ViewSelector2 component script. -->
<script type="text/javascript" src="/public/templates/quantri/plugins/ggchart/js/view-selector2.js"></script>

<!-- Include the DateRangeSelector component script. -->
<script type="text/javascript" src="/public/templates/quantri/plugins/ggchart/js/date-range-selector.js"></script>

<!-- Include the ActiveUsers component script. -->
<script type="text/javascript" src="/public/templates/quantri/plugins/ggchart/js/active-users.js"></script>

<!-- Include the CSS that styles the charts. -->
<link rel="stylesheet" type="text/css" href="/public/templates/quantri/plugins/ggchart/css/chartjs-visualizations.css">

<script>
	// == NOTE ==
	// This code uses ES6 promises. If you want to use this code in a browser
	// that doesn't supporting promises natively, you'll have to include a polyfill.

	gapi.analytics.ready(function() {

		/**
		 * Authorize the user immediately if the user has already granted access.
		 * If no access has been created, render an authorize button inside the
		 * element with the ID "embed-api-auth-container".
		 */
		gapi.analytics.auth.authorize({
			container: 'embed-api-auth-container',
			clientid: '<?php echo $seo['client_id'] ?>'
		});


		/**
		 * Create a new ActiveUsers instance to be rendered inside of an
		 * element with the id "active-users-container" and poll for changes every
		 * five seconds.
		 */
		var activeUsers = new gapi.analytics.ext.ActiveUsers({
			container: 'active-users-container',
			pollingInterval: 5
		});


		/**
		 * Add CSS animation to visually show the when users come and go.
		 */
		activeUsers.once('success', function() {
			var element = this.container.firstChild;
			var timeout;

			this.on('change', function(data) {
				var element = this.container.firstChild;
				var animationClass = data.delta > 0 ? 'is-increasing' : 'is-decreasing';
				element.className += (' ' + animationClass);

				clearTimeout(timeout);
				timeout = setTimeout(function() {
					element.className =
						element.className.replace(/ is-(increasing|decreasing)/g, '');
				}, 3000);
			});
		});


		/**
		 * Create a new ViewSelector2 instance to be rendered inside of an
		 * element with the id "view-selector-container".
		 */
		var viewSelector = new gapi.analytics.ext.ViewSelector2({
				container: 'view-selector-container',
			})
			.execute();


		/**
		 * Update the activeUsers component, the Chartjs charts, and the dashboard
		 * title whenever the user changes the view.
		 */
		viewSelector.on('viewChange', function(data) {
			var title = document.getElementById('view-name');
			title.innerHTML = data.property.name + ' (' + data.view.name + ')';

			// Start tracking active users for this view.
			activeUsers.set(data).execute();

			// Render all the of charts for this view.
			renderWeekOverWeekChart(data.ids);
			renderYearOverYearChart(data.ids);
		});


		/**
		 * Draw the a chart.js line chart with data from the specified view that
		 * overlays session data for the current week over session data for the
		 * previous week.
		 */
		function renderWeekOverWeekChart(ids) {

			// Adjust `now` to experiment with different days, for testing only...
			var now = moment(); // .subtract(3, 'day');

			var thisWeek = query({
				'ids': ids,
				'dimensions': 'ga:date,ga:nthDay',
				'metrics': 'ga:sessions',
				'start-date': moment(now).subtract(1, 'day').day(0).format('YYYY-MM-DD'),
				'end-date': moment(now).format('YYYY-MM-DD')
			});

			var lastWeek = query({
				'ids': ids,
				'dimensions': 'ga:date,ga:nthDay',
				'metrics': 'ga:sessions',
				'start-date': moment(now).subtract(1, 'day').day(0).subtract(1, 'week')
					.format('YYYY-MM-DD'),
				'end-date': moment(now).subtract(1, 'day').day(6).subtract(1, 'week')
					.format('YYYY-MM-DD')
			});

			Promise.all([thisWeek, lastWeek]).then(function(results) {

				var data1 = results[0].rows.map(function(row) {
					return +row[2];
				});
				var data2 = results[1].rows.map(function(row) {
					return +row[2];
				});
				var labels = results[1].rows.map(function(row) {
					return +row[0];
				});

				labels = labels.map(function(label) {
					return moment(label, 'YYYYMMDD').format('ddd');
				});

				var data = {
					labels: labels,
					datasets: [{
						label: 'Tuần trước',
						fillColor: 'rgba(220,220,220,0.5)',
						strokeColor: 'rgba(220,220,220,1)',
						pointColor: 'rgba(220,220,220,1)',
						pointStrokeColor: '#fff',
						data: data2
					}, {
						label: 'Tuần này',
						fillColor: 'rgba(151,187,205,0.5)',
						strokeColor: 'rgba(151,187,205,1)',
						pointColor: 'rgba(151,187,205,1)',
						pointStrokeColor: '#fff',
						data: data1
					}]
				};

				new Chart(makeCanvas('chart-1-container')).Line(data);
				generateLegend('legend-1-container', data.datasets);
			});
		}


		/**
		 * Draw the a chart.js bar chart with data from the specified view that
		 * overlays session data for the current year over session data for the
		 * previous year, grouped by month.
		 */
		function renderYearOverYearChart(ids) {

			// Adjust `now` to experiment with different days, for testing only...
			var now = moment(); // .subtract(3, 'day');

			var thisYear = query({
				'ids': ids,
				'dimensions': 'ga:month,ga:nthMonth',
				'metrics': 'ga:users',
				'start-date': moment(now).date(1).month(0).format('YYYY-MM-DD'),
				'end-date': moment(now).format('YYYY-MM-DD')
			});

			var lastYear = query({
				'ids': ids,
				'dimensions': 'ga:month,ga:nthMonth',
				'metrics': 'ga:users',
				'start-date': moment(now).subtract(1, 'year').date(1).month(0)
					.format('YYYY-MM-DD'),
				'end-date': moment(now).date(1).month(0).subtract(1, 'day')
					.format('YYYY-MM-DD')
			});

			Promise.all([thisYear, lastYear]).then(function(results) {
					var data1 = results[0].rows.map(function(row) {
						return +row[2];
					});
					var data2 = results[1].rows.map(function(row) {
						return +row[2];
					});
					var labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
						'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
					];

					// Ensure the data arrays are at least as long as the labels array.
					// Chart.js bar charts don't (yet) accept sparse datasets.
					for (var i = 0, len = labels.length; i < len; i++) {
						if (data1[i] === undefined) data1[i] = null;
						if (data2[i] === undefined) data2[i] = null;
					}

					var data = {
						labels: labels,
						datasets: [{
							label: 'Năm ngoái',
							fillColor: 'rgba(220,220,220,0.5)',
							strokeColor: 'rgba(220,220,220,1)',
							data: data2
						}, {
							label: 'Năm nay',
							fillColor: 'rgba(151,187,205,0.5)',
							strokeColor: 'rgba(151,187,205,1)',
							data: data1
						}]
					};

					new Chart(makeCanvas('chart-2-container')).Bar(data);
					generateLegend('legend-2-container', data.datasets);
				})
				.catch(function(err) {
					console.error(err.stack);
				});
		}

		/**
		 * Extend the Embed APIs `gapi.analytics.report.Data` component to
		 * return a promise the is fulfilled with the value returned by the API.
		 * @param {Object} params The request parameters.
		 * @return {Promise} A promise.
		 */
		function query(params) {
			return new Promise(function(resolve, reject) {
				var data = new gapi.analytics.report.Data({
					query: params
				});
				data.once('success', function(response) {
						resolve(response);
					})
					.once('error', function(response) {
						reject(response);
					})
					.execute();
			});
		}


		/**
		 * Create a new canvas inside the specified element. Set it to be the width
		 * and height of its container.
		 * @param {string} id The id attribute of the element to host the canvas.
		 * @return {RenderingContext} The 2D canvas context.
		 */
		function makeCanvas(id) {
			var container = document.getElementById(id);
			var canvas = document.createElement('canvas');
			var ctx = canvas.getContext('2d');

			container.innerHTML = '';
			canvas.width = container.offsetWidth;
			canvas.height = container.offsetHeight;
			container.appendChild(canvas);

			return ctx;
		}


		/**
		 * Create a visual legend inside the specified element based off of a
		 * Chart.js dataset.
		 * @param {string} id The id attribute of the element to host the legend.
		 * @param {Array.<Object>} items A list of labels and colors for the legend.
		 */
		function generateLegend(id, items) {
			var legend = document.getElementById(id);
			legend.innerHTML = items.map(function(item) {
				var color = item.color || item.fillColor;
				var label = item.label;
				return '<li><i style="background:' + color + '"></i>' + label + '</li>';
			}).join('');
		}


		// Set some global Chart.js defaults.
		Chart.defaults.global.animationSteps = 60;
		Chart.defaults.global.animationEasing = 'easeInOutQuart';
		Chart.defaults.global.responsive = true;
		Chart.defaults.global.maintainAspectRatio = false;

	});
</script>

<style type="text/css">
.FlexGrid {
	display: -webkit-box;
	display: -webkit-flex;
	display: -ms-flexbox;
	display: flex;
	-webkit-flex-wrap: wrap;
	-ms-flex-wrap: wrap;
	flex-wrap: wrap;
	list-style: none;
	margin: 0 0 -1.5em -2em;
	padding: 0;
}
.FlexGrid-item {
	-webkit-box-flex: 1;
	-webkit-flex: 1 0 -webkit-calc(100% - 1.5em);
	-ms-flex: 1 0 calc(100% - 1.5em);
	flex: 1 0 calc(100% - 1.5em);
	margin: 0 0 1.5em 1.5em;
}
.FlexGrid-item--fixed {
	-webkit-box-flex: 0!important;
	-webkit-flex: 0 0 auto!important;
	-ms-flex: 0 0 auto!important;
	flex: 0 0 auto!important;
}
.Titles {
	font-weight: 300;
	line-height: 1.2;
	margin: 0 0 1.5em;
}
.Titles-main, .Titles-sub {
	color: inherit;
	font: inherit;
	margin: 0;
}
.Titles-main {
	font-size: 1.4em;
}
.Titles-sub {
	opacity: .6;
	margin-top: .2em;
}
.ViewSelector2 {
	display: block;
}
.ViewSelector2-item {
	display: block;
	margin-bottom: 1em;
	width: 100%;
}
.ViewSelector2-item > label {
	font-weight: 700;
	margin: 0 .25em .25em 0;
	display: block;
}
select.FormField {
	background: #fff;
	border: 1px solid #d4d2d0;
	border-radius: 4px;
	box-sizing: border-box;
	font: inherit;
	font-weight: 400;
	height: 2.42857em;
	line-height: 1.42857em;
	padding: 0.42857em;
	-webkit-transition: border-color .2s cubic-bezier(.4,0,.2,1);
	transition: border-color .2s cubic-bezier(.4,0,.2,1);
}
.ViewSelector2-item > select {
	width: 100%;
}

@media (min-width: 570px) {
	.FlexGrid-item {
		-webkit-flex-basis: 200px;
		-ms-flex-preferred-size: 200px;
		flex-basis: 200px;
	}
	.ViewSelector2 {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		margin: 0 0 -1em -1em;
		width: -webkit-calc(100% + 1em);
		width: calc(100% + 1em);
	}
	.ViewSelector2-item {
		-webkit-box-flex: 1;
		-webkit-flex: 1 1 -webkit-calc(100%/3 - 1em);
		-ms-flex: 1 1 calc(100%/3 - 1em);
		flex: 1 1 calc(100%/3 - 1em);
		margin-left: 1em;
	}
}
@media (min-width: 1024px) {
	.FlexGrid-item {
		margin: 0 0 2em 2em;
	}
}
header .Dashboard-header {
	box-shadow: 0 0 .5em rgba(0,0,0,.1);
	background: #fff;
	display: -webkit-flex;
	display: -ms-flexbox;
	display: flex;
	-webkit-flex-direction: column;
	-ms-flex-direction: column;
	flex-direction: column;
	margin: 0 0 2em 0;
	max-width: 750px;
	padding: 2em;
}
</style>
