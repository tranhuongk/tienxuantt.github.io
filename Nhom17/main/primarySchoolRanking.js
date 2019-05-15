/**
 * Cần import primarySchoolData.js
 */
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


function primarySchoolRanking(lat, lon){
	var lat1= lat;
	var lon1= lon;
	var range=[0.2,0.5,1,2];
	var scoreInRange=[1,0.5,0.25,0.1];
	var numInRange=[0,0,0,0];
	
	for(var i=0; i< primarySchoolArray.length;i+=2 ){
		var lat2=primarySchoolArray[i];
		var lon2= primarySchoolArray[i+1];
		var distance=  getDistance(lat1,lon1, lat2,lon2);
		for(var j=0; j< range.length; j++){
			if(distance<=range[j]){
				numInRange[j]= numInRange[j]+1;
				break;
			}
		}
	}

	console.log(numInRange);
	var total=0;
	for(var i=0; i< range.length; i++){
		total= total+ numInRange[i];
	}
	var lastIndex= primarySchoolArray.length-total;
	var score= 0;
	for(var i=0; i< range.length;i++){
		score= score+ scoreInRange[i]*numInRange[i];
	}
	var firstIndex;
	if(score>=10) firstIndex = [10];	
	else firstIndex= [score];	
	return firstIndex.concat(numInRange).concat([lastIndex])
}
function nhom10Ranking(lat, lng){
    var primarySchoolRankingt = primarySchoolRanking(lng,lat);
    	console.log(primarySchoolRankingt)
		$(".primarySchoolRanking1").text(primarySchoolRankingt[0] + "/10");
		$(".primarySchoolRanking2").text(primarySchoolRankingt[1]);
		$(".primarySchoolRanking3").text(primarySchoolRankingt[2]);
		$(".primarySchoolRanking4").text(primarySchoolRankingt[3]);
		$(".primarySchoolRanking5").text(primarySchoolRankingt[4]);
		$(".primarySchoolRanking6").text(primarySchoolRankingt[5]);
}