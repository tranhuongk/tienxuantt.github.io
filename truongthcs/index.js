var x1, y1, x2, y2, xmin, ymin, lengthMin, sumDistance, nearest_i;
var numInRange = 0;
const RANGE = 10;
start = 0;
var control;

$(document).ready(function () {

	$(".card-header span").click(function () {
		$(".card").hide();
	});

	$('.main-content').removeClass('show-map-only');

	$('.show-map-control').on('click', () => {
		if ($('.main-content').hasClass('show-map-only')) {
			$('.main-content').removeClass('show-map-only');
			$('.show-map-control i').removeClass('fa-arrow-right').addClass('fa-arrow-left');
		} else {
			$('.main-content').addClass('show-map-only');
			$('.show-map-control i').removeClass('fa-arrow-left').addClass('fa-arrow-right');
		}
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
	
			ShowQuantity(y1, x1);
		
			for (var i = 0; i < hsarray1.length; i += 2) {
		
				x2 = hsarray1[i + 1];
				y2 = hsarray1[i];
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
				setProperties();
				$(".card").show();
			});

		});
		
		renderSecondarySchoolStatistic(secondarySchool);
	
	});
	
function setProperties() {
	var a = document.getElementById("InRange");
	a.innerText = numInRange;

	var b = document.getElementById("Nearest");
	b.innerText = array2[nearest_i / 2];

	var b2 = document.getElementById("Address");
	b2.innerText = array3[nearest_i / 2];

	var c = document.getElementById("DistanceToNearest");
	c.innerText = parseFloat(sumDistance).toFixed(2) + " Km";

	
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
function renderSecondarySchoolStatistic(secondarySchool) {
	const secondarySchool_by_district = secondarySchool.reduce((current, next) => (
		current[next.district] 
			? {...current, [next.district]: current[next.district] + 1}
			: {...current, [next.district]: 1}
	), {});
	DISTRICTS.forEach((district, i) => {
		$('.statistic-table-body').append(`
			<tr>
				<td>${i + 1}</td>
				<td>${district}</td>
				<td>${secondarySchool_by_district[district] || 0}</td>
			</tr>
		`)
	});
	$('.statistic-table-body').append(`
		<tr>
			<td colspan="2">Tổng cộng:</td>
			<td>${secondarySchool.length}</td>
		</tr>
	`);
}