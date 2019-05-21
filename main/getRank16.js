
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

function getRank16(lat, lng) {
	var range = 1;
	var distanceRange = [range/5, range/2, range, 2*range, 3*range];
	var count = [0,0,0,0,0];
	var total = array16.length;
	var point = 0;
	for (var i = 0; i < array16.length; i += 2) {
		x = array16[i + 1];
		y = array16[i];
		var distance = getDistance(lat, lng, x, y);
		if (distance <= distanceRange[0]) count[0]++;
		if (distance > distanceRange[0] && distance <= distanceRange[1]) count[1]++;
		if (distance > distanceRange[1] && distance <= distanceRange[2]) count[2]++;
		if (distance > distanceRange[2] && distance <= distanceRange[3]) count[3]++;
		if (distance > distanceRange[3] ) count[4]++;
	}

	if(count[0] > 5) {
		point = 10;
	}
	else if(count[0] > 0){
		point = 9;
	}
	else if(count[1] > 5){
		point = 8;
	}
	else if(count[1] > 0){
		point = 7;
	}
	else if(count[2] > 5){
		point = 6;
	}
	else if(count[2] > 0){
		point = 5;
	}
	else if(count[3] > 5){
		point = 4;
	}
	else if(count[3] > 0){
		point = 3;
	}
	else if(count[4] > 5){
		point = 2;
	}
	else if(count[4] > 0){
		point = 1;
	}

	return [point, count[0], count[1], count[2], count[3], count[4]];
}

function nhom16Ranking(lat, lng){
    var nhom16Rankingt = getRank16(lat,lng);
		$(".coffe1").text(nhom16Rankingt[0] + "/10");
		$(".coffe2").text(nhom16Rankingt[1]);
		$(".coffe3").text(nhom16Rankingt[2]);
		$(".coffe4").text(nhom16Rankingt[3]);
		$(".coffe5").text(nhom16Rankingt[4]);
		$(".coffe6").text(nhom16Rankingt[5]);
}