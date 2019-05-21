var x1, y1, x2, y2, xmin, ymin, lengthMin, sumDistance, nearest_i;
var numInRange = 0;
const RANGE = 10;
start = 0;
var control;

$(document).ready(function () {

	$(".card-header span").click(function () {
		$(".card").hide();
	});

	map.on('click', function (e) {
		numInRange = 0;
		
		if (start > 0) {
			control.spliceWaypoints(0, 2);
		}
	
		start++;
		lengthMin = 100000;
		x1 = e.latlng.lat;
        y1 = e.latlng.lng;
	
		for (var i = 0; i < array1.length; i += 2) {
	
			x2 = array1[i + 1];
			y2 = array1[i];
			length = Math.sqrt(Math.pow((x1 - x2), 2) + Math.pow((y1 - y2), 2));
			if (length < lengthMin) {
				lengthMin = length;
				xmin = x2;
				ymin = y2;
				nearest_i = i;
			}
			var distance = getDistance(x1, y1, x2, y2);
			
			if (distance <= RANGE) numInRange++;
		
		}
		
	
		control = L.Routing.control(L.extend(window.lrmConfig, {
			waypoints: [
				L.latLng(x1, y1),
				L.latLng(xmin, ymin)
			],
			geocoder: L.Control.Geocoder.nominatim(),
			routeWhileDragging: true,
			reverseWaypoints: true,
			showAlternatives: true,
			altLineOptions: {
				styles: [{
						color: 'black',
						opacity: 0,
						weight: 9
					},
					{
						color: 'white',
						opacity: 0,
						weight: 6
					},
					{
						color: 'blue',
						opacity: 1,
						weight: 2
					}
				]
			}
		})).addTo(map);
	
		control.on('routesfound', function (e) {
			var routes = e.routes;
			var summary = routes[0].summary;
			sumDistance = (summary.totalDistance / 1000.0).toString();
			let ss = setProperties();
			let pq= L.popup();
			pq
				.setLatLng([x1, y1])
				.setContent(ss)
				.openOn(map);

		});
	});
	

});


function setProperties() {

	let a = numInRange;
	let b = array2[nearest_i / 2];
	let b2 = array3[nearest_i / 2];
	let c = parseFloat(sumDistance).toFixed(2) + " Km";
	return `Số trường mầm non trong 10km: <b>${a}</b> <br>Trường mầm non gần nhất: <b>${b}</b><br>Địa chỉ: <b>${b2}</b><br>Khoảng cách: <b>${c}</b>`
}


function getDistance(lat1, lon1, lat2, lon2) {
	var R = 6371; // Radius of the earth in km
	var dLat = deg2rad(lat2 - lat1); // deg2rad below
	var dLon = deg2rad(lon2 - lon1);
	var a =
		Math.sin(dLat / 2) * Math.sin(dLat / 2) +
		Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
		Math.sin(dLon / 2) * Math.sin(dLon / 2);
	var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
	var d = R * c; // Distance in km
	return d;
}

function deg2rad(deg) {
	return deg * (Math.PI / 180)
}

$(document).ready(function() {
	var show = false;
	for (let i=0;i<count.length;i++){
		$('table').append('<tr>'
			+ '<td>' + (i + 1) + '</td>'
			+ '<td style="text-align:left;font-weight:500;padding-left:5px">' + dist[i] + '</td>'
			+ '<td>' + count[i] + '</td>'
			+ '</tr>');
	}

	$("#left-hide").on('click',function(){
		$(".hide-show").animate(
			{width: "toggle"},300
		);
		if(show){
			show = false;
			$("#left-hide").animate(
				{"left": "-=25%"}, 300, function(){
					$("#control-hide").animate(
						{ deg: 0 },
						{duration: 400,
							step: function(now) {
								$(this).css({ transform: 'rotate(' + now + 'deg)' });
							}
						});
				}
			)
			$("#map").animate(
				{width: "100%"},300
			);

		}
		else{
			show = true;
			$("#left-hide").animate(
				{"left": "+=25%"}, 300, function(){
					$("#control-hide").animate(
						{ deg: -180 },
						{duration: 400,
							step: function(now) {
								$(this).css({ transform: 'rotate(' + now + 'deg)' });
							}
						});
				}
			)
			$("#map").animate(
				{width: "70%"},300
			);

		}
	});
})