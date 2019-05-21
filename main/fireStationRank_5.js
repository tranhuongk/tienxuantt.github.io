
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

function fireStationPoint(lat,lng){
	//Hàm này sẽ chấm điểm thang điểm 10, chia ra làm 2 phần: phần 1 chấm độ gần (7 điểm), phần 2 chấm độ sẵn sàng, số lượng trạm cứu hỏa (3 điểm)
	x1 = lat;
	y1 = lng;
	let range=[0.5,1,2,3];// 4 phần tử, mảng khoảng cách theo yêu cầu của thầy  
	let numInRange=[0,0,0,0];// 4 phần tử, mảng để tính số trạm cứu hỏa trong range tương ứng. 

	for (var i = 0; i < fsarray1.length; i += 2) {

		x2 = fsarray1[i + 1];
		y2 = fsarray1[i];
		var distance = getDistance(x1, y1, x2, y2);
		for(var j=0; j<range.length;j++){
			if (distance <= range[j]) numInRange[j]+=1;
		}// distance = 1.5 km thi numInRange=[0,0,1,1]
	}// khi do numInRange=[a0, a1, a2, a3]
	// ai là số fire station có khoảng cách nhỏ hơn bằng range[i] km so với điểm (lat,lng)  

	let result=[0,0,0,0,0,0] // Mảng kết quả trả về theo yêu cầu của thầy
	
	let point = 0

	// Chấm điểm tính sẵn sàng :) 
	// Tổng cộng 3 điểm 
	if(numInRange[1]>1) point += 1;// nếu trong khoảng cách 1 km mà có ít nhất 2 trạm cứu hỏa thì cộng 1 điểm
	if(numInRange[2]>1) point += 1;// nếu trong khoảng cách 2 km mà có ít nhất 2 trạm cứu hỏa thì cộng 1 điểm
	if(numInRange[3]>2) point += 1;// nếu trong khoảng cách 3 km mà có ít nhất 3 trạm cứu hỏa thì cộng 1 điểm

	// Chấm điểm khoảng cách
	// Tổng 7 điểm
	
	
	for(var i=0 ; i< range.length; i++){
		if(numInRange[i]>0) {	
			point += 7 - i;
			break;
		} // 0 điểm hoặc từ 4 đến 7 điểm
	}
	result[0] = point; // Điểm
	result[1] = numInRange[0];// 0->0.5
	result[2] = numInRange[1] - numInRange[0];// 0.5->1
	result[3] = numInRange[2] - numInRange[1];// 1->2
	result[4] = numInRange[3] - numInRange[2];// 2->3
	result[5] = fsarray1.length / 2 - numInRange[3];// >=3 
	return result;
}

function nhom5Ranking(lat, lng){
        var fsRanking = fireStationPoint(lat, lng);

        $(".fireStationRanking1").text(fsRanking[0] + "/10");
        $(".fireStationRanking2").text(fsRanking[1]);
        $(".fireStationRanking3").text(fsRanking[2]);
        $(".fireStationRanking4").text(fsRanking[3]);
        $(".fireStationRanking5").text(fsRanking[4]);
        $(".fireStationRanking6").text(fsRanking[5]);
}

