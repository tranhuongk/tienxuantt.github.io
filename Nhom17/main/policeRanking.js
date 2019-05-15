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

function policePoint(lat,lng){
	x1 = lat;
	y1 = lng;
	var range=[0.5,1,2,3,1000];
	var numInRange=[0,0,0,0,0];

	for (var i = 0; i < policearray1.length; i += 2) {
		x2 = policearray1[i+1];
		y2 = policearray1[i];
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

function nhom6Ranking(lat, lng){
    var policeRanking = policePoint(lat,lng);
	var score = 0;
	if (policeRanking[0]>1) score = 10;
	else if (policeRanking[1]>1) score = 9;
	else if (policeRanking[2]>1) score = 8;
	else if (policeRanking[3]>1) score = 7;
	else if (policeRanking[4]>1) score = 6;
		$(".PoliceRanking1").text(score + "/5");
		$(".PoliceRanking2").text(policeRanking[0]);
		$(".PoliceRanking3").text(policeRanking[1]);
		$(".PoliceRanking4").text(policeRanking[2]);
		$(".PoliceRanking5").text(policeRanking[3]);
		$(".PoliceRanking6").text(policeRanking[4]);
}
