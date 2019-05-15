function getDistance1(lat1, lon1, lat2, lon2) {
	var R = 6371; // Radius of the earth in km
	var dLat = deg2rad1(lat2 - lat1); // deg2rad1 below
	var dLon = deg2rad1(lon2 - lon1);
	var a =
		Math.sin(dLat / 2) * Math.sin(dLat / 2) +
		Math.cos(deg2rad1(lat1)) * Math.cos(deg2rad1(lat2)) *
		Math.sin(dLon / 2) * Math.sin(dLon / 2);
	var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
	var d = R * c; // Distance in km
	return d;
}

function deg2rad1(deg) {
	return deg * (Math.PI / 180)
}

function hsPoint(lat,lng){
	x1 = lat;
	y1 = lng;
	var range=[0.5,1,2,3,1000];
	var numInRange=[0,0,0,0,0];

	for (var i = 0; i < hsarray1.length; i += 2) {
		x2 = hsarray1[i+1];
		y2 = hsarray1[i];
		var distance = getDistance1(x1, y1, x2, y2);
		for(var j=0; j<range.length;j++){
			if (distance <= range[j]) numInRange[j]+=1;
		}
	}
	numInRange[4] = numInRange[4] - numInRange[3];
	numInRange[3] = numInRange[3] - numInRange[2];
	numInRange[2] = numInRange[2] - numInRange[1];
	numInRange[1] = numInRange[1] - numInRange[0];
	return numInRange;
}

function uniPoint(lat,lng){
	x1 = lat;
	y1 = lng;
	var range=[0.5,1,2,3,1000];
	var numInRange=[0,0,0,0,0];

	for (var i = 0; i < uniarray1.length; i += 2) {
		x2 = uniarray1[i+1];
		y2 = uniarray1[i];
		var distance = getDistance1(x1, y1, x2, y2);
		for(var j=0; j<range.length;j++){
			if (distance <= range[j]) numInRange[j]+=1;
		}
	}
	numInRange[4] = numInRange[4] - numInRange[3];
	numInRange[3] = numInRange[3] - numInRange[2];
	numInRange[2] = numInRange[2] - numInRange[1];
	numInRange[1] = numInRange[1] - numInRange[0];
	return numInRange;
}

function nhom12Ranking(lat, lng){
    var hsRanking = hsPoint(lat,lng);
	var uniRanking = uniPoint(lat,lng);
	var score = 0;
	if (hsRanking[0]>1 && uniRanking[0]>1) score = 10;
	else if (hsRanking[0]>1 || uniRanking[0]>1) score = 9;
	else if (hsRanking[1]>1 && uniRanking[1]>1) score = 8;
	else if (hsRanking[1]>1 || uniRanking[1]>1) score = 7;
	else if (hsRanking[2]>1 && uniRanking[2]>1) score = 6;
	else if (hsRanking[2]>1 || uniRanking[2]>1) score = 5;
	else if (hsRanking[3]>1 && uniRanking[3]>1) score = 4;
	else if (hsRanking[3]>1 || uniRanking[3]>1) score = 3;
	else if (hsRanking[4]>1 && uniRanking[4]>1) score = 2;
	else if (hsRanking[4]>1 || uniRanking[4]>1) score = 1;
		$(".HsUniRanking1").text(score + "/10");
		$(".HsUniRanking2").text(hsRanking[0]+uniRanking[0]);
		$(".HsUniRanking3").text(hsRanking[1]+uniRanking[1]);
		$(".HsUniRanking4").text(hsRanking[2]+uniRanking[2]);
		$(".HsUniRanking5").text(hsRanking[3]+uniRanking[3]);
		$(".HsUniRanking6").text(hsRanking[4]+uniRanking[4]);
}