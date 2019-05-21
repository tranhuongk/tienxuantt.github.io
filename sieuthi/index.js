var x1, y1, x2, y2, xmin, ymin, lengthMin, sumDistance, nearest_i;
var numInRange = 0;
const RANGE = 10;
start = 0;
var control;

$(document).ready(function () {

	$(".card-header span").click(function () {
		$(".card").hide();
	});
	for (i = 0; i < statistical.length; i++) {
        $('table').append('<tr>'
            + '<td>' + (i + 1) + '</td>'
            + '<td style="text-align:left;font-weight:500;padding-left:5px;">' + statistical[i].District + '</td>'
            + '<td>' + statistical[i].Supermarket + '</td>'
            + '</tr>');
    }
	var show = false;  
    $("#left-hide").on('click',function(){
        $(".hide-show").animate(
            {width: "toggle"},300
        );
        if(show){
            show = false;
            $("#left-hide").animate(
                {"left": "-=20%"}, 300, function(){
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
                {left:'0px',right:'146px'},300
            );
            
        }
        else{
            show = true;
            $("#left-hide").animate(
                {"left": "+=20%"}, 300, function(){
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
                {left:'20%', right:'146px'},300
            );
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
	
		for (var i = 0; i < supermarketarray1.length; i += 2) {
	
			x2 = supermarketarray1[i + 1];
			y2 = supermarketarray1[i];
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
	

});


function setProperties() {
	var a = document.getElementById("InRange");
	a.innerText = numInRange;

	var b = document.getElementById("Nearest");
	b.innerText = supermarketarray2[nearest_i / 2];

	var b2 = document.getElementById("Address");
	b2.innerText = supermarketarray3[nearest_i / 2];

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

function calculatePoint(lat,lng){
	//hàm này phân loại 1 tọa độ theo hạng từ 1 -> n, hạng càng thấp thì càng chất lượng
	x1 = lat;
	y1 = lng;
	let range=[0.1,0.2,0.5,1];// mảng khoảng cách để tính điểm,đơn vị : km. => explain: dưới 0.2km -> hạng 1; dưới 0.5 km -> hạng 2, ....
	let numInRange=[0,0,0,0];// mảng trên có bao nhiêu phần tử thì mảng này có bấy nhiêu số 0 :).

	for (var i = 0; i < supermarketarray1.length; i += 2) {

		x2 = supermarketarray1[i + 1];
		y2 = supermarketarray1[i];
		length = Math.sqrt(Math.pow((x1 - x2), 2) + Math.pow((y1 - y2), 2));
		if (length < lengthMin) {
			lengthMin = length;
			xmin = x2;
			ymin = y2;
			nearest_i = i;
		}
		var distance = getDistance(x1, y1, x2, y2);
		for(var j=0; j<range.length;j++){
			if (distance <= range[j]) numInRange[j]+=1;
		}
	}
	for(var i=0 ; i< range.length; i++){
		if(numInRange[i]>0) return i+1;
	}
	return range.length;
}