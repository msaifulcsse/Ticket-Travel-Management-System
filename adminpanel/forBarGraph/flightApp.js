$(document).ready(function(){
	$.ajax({
		url: "http://localhost/softwareProjectOne/adminpanel/forBarGraph/flightData.php",
		method: "GET",
		success: function(data) {
			console.log(data);
			var route = [];
			var jNumber = [];

			for(var i in data) {
				route.push("Route: " + data[i].Route);
				jNumber.push(data[i].JourneyNum);
			}
 
			var chartdata = { 
				labels: route,
				datasets : [
					{
						label: 'Times',
						backgroundColor: 'rgba(0,255,0,1)',
						borderColor: 'rgba(255,0,0,1)',
						hoverBackgroundColor: 'rgba(255, 0, 0, 1)',
						hoverBorderColor: 'rgba(255,0,0,1)',
						data: jNumber
					}
				]
			};

			var ctx = $("#mycanvas");

			var barGraph = new Chart(ctx, {
				type: "pie",
				data: chartdata
			});
		},
		error: function(data) {
			console.log(data);
		}
	});
});
