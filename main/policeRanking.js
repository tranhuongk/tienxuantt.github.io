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
	//Hàm này sẽ chấm điểm thang điểm 10, chia ra làm 2 phần: phần 1 chấm độ gần (7 điểm), phần 2 chấm độ sẵn sàng, số lượng đồn cảnh sát (3 điểm)
	x1 = lat;
	y1 = lng;
	let range=[0.5,1,2,3];// 4 phần tử, mảng khoảng cách theo yêu cầu của thầy  
	let numInRange=[0,0,0,0];// 4 phần tử, mảng để tính số đồn cảnh sát trong range tương ứng. 

	for (var i = 0; i < policearray1.length; i += 2) {

		x2 = policearray1[i + 1];
		y2 = policearray1[i];
		var distance = getDistance(x1, y1, x2, y2);
		for(var j=0; j<range.length;j++){
			if (distance <= range[j]) numInRange[j]+=1;
		}// distance = 1.5 km thi numInRange=[0,0,1,1]
	}// khi do numInRange=[a0, a1, a2, a3]
	// ai là số police có khoảng cách nhỏ hơn bằng range[i] km so với điểm (lat,lng)  

	let result=[0,0,0,0,0,0] // Mảng kết quả trả về theo yêu cầu của thầy
	
	let point = 0

	// Chấm điểm tính sẵn sàng 
	// Tổng cộng 3 điểm 
	if(numInRange[1]>1) point += 1;// nếu trong khoảng cách 1 km mà có ít nhất 2 đồn cảnh sát thì cộng 1 điểm
	if(numInRange[2]>2) point += 1;// nếu trong khoảng cách 2 km mà có ít nhất 3 đồn cảnh sát thì cộng 1 điểm
	if(numInRange[3]>3) point += 1;// nếu trong khoảng cách 3 km mà có ít nhất 4 đồn cảnh sát thì cộng 1 điểm

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
	result[5] = policearray1.length / 2 - numInRange[3];// >=3 
	return result;
}

function nhom6Ranking(lat, lng){
        var policeRanking = policePoint(lat, lng);

        $(".policeRanking1").text(policeRanking[0] + "/10");
        $(".policeRanking2").text(policeRanking[1]);
        $(".policeRanking3").text(policeRanking[2]);
        $(".policeRanking4").text(policeRanking[3]);
        $(".policeRanking5").text(policeRanking[4]);
        $(".policeRanking6").text(policeRanking[5]);
}
