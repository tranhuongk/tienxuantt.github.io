/**
 * Cần import healthData.js
 */

function getDistance(origin, destination) {
    // return distance in kilometers
    var lon1 = toRadian(origin[1]),
        lat1 = toRadian(origin[0]),
        lon2 = toRadian(destination[1]),
        lat2 = toRadian(destination[0]);

    var deltaLat = lat2 - lat1;
    var deltaLon = lon2 - lon1;

    var a = Math.pow(Math.sin(deltaLat / 2), 2) + Math.cos(lat1) * Math.cos(lat2) * Math.pow(Math.sin(deltaLon / 2), 2);
    var c = 2 * Math.asin(Math.sqrt(a));
    var EARTH_RADIUS = 6371;
    return c * EARTH_RADIUS;
}
function toRadian(degree) {
    return degree * Math.PI / 180;
}

function healthRanking(lat_o,lng_o){
    //hàm chấm điểm khi ấn vào 1 điểm bất kỳ trên bản đồ thang điểm 10, Ví dụ được 7/10 trả về: 7
    //và trả về số cơ sở y tế trong các khoảng của range[]
    let lat_d, lng_d; //Vị trí điểm đến
	let range=[0.5,1,2,3];  //mảng khoảng cách để tính điểm, đơn vị : km.
    let hospitalInRange=[0,0,0,0];   //Số lượng bệnh viện trong range[0]->range[3]
    let clinicInRange=[0,0,0,0];   //Số lượng bệnh viện trong range[0]->range[3]
    let medicalInRange=[0,0,0,0];   //Số lượng bệnh viện trong range[0]->range[3]
    let drugstoreInRange=[0,0,0,0];   //Số lượng bệnh viện trong range[0]->range[3]
    max = 0;
    let data = [0,0,0,0,0,1567];
    let hx, gx;

    for (var i = 0; i < hospitals.length; i++) {
		    lat_d = Number(hospitals[i].Lat);
		    lng_d = Number(hospitals[i].Lng);
		    var distance = getDistance([lat_o,lng_o], [lat_d,lng_d]);
		    for(var j=0; j<range.length;j++){
            if (distance <= range[j])
                hospitalInRange[j]+=1;
		    }
    }
    for (var i = 0; i < clinics.length; i++) {
		    lat_d = Number(clinics[i].Lat);
		    lng_d = Number(clinics[i].Lng);
		    var distance = getDistance([lat_o,lng_o], [lat_d,lng_d]);
		    for(var j=0; j<range.length;j++){
            if (distance <= range[j])
                clinicInRange[j]+=1;
		    }
    }
    for (var i = 0; i < medicalCenters.length; i++) {
		    lat_d = Number(medicalCenters[i].Lat);
		    lng_d = Number(medicalCenters[i].Lng);
		    var distance = getDistance([lat_o,lng_o], [lat_d,lng_d]);
		    for(var j=0; j<range.length;j++){
            if (distance <= range[j])
                medicalInRange[j]+=1;
		    }
    }
    for (var i = 0; i < drugstores.length; i++) {
		    lat_d = Number(drugstores[i].Lat);
		    lng_d = Number(drugstores[i].Lng);
		    var distance = getDistance([lat_o,lng_o], [lat_d,lng_d]);
		    for(var j=0; j<range.length;j++){
            if (distance <= range[j])
                drugstoreInRange[j]+=1;
		    }
    }

    for(var i = 0; i < range.length; i++){
        if(i==0){
            hx = Math.min(hospitalInRange[i] * 10,10);
            gx =  Math.max(Math.min(clinicInRange[i] * 4, 4),Math.min(medicalInRange[i]* 4, 4))
                    +Math.min(drugstoreInRange[i]* 5, 5);
            
            max = Math.max(max, Math.max(hx,gx));  
        }
        if(i==1){
            hx = Math.min(hospitalInRange[i] * 8,8);
            gx =  Math.max(Math.min(clinicInRange[i] * 3/2, 3),Math.min(medicalInRange[i]* 3, 3))
                    +Math.min(drugstoreInRange[i]* 4 / 3, 4);
            max = Math.max(max, Math.max(hx,gx));
        }  
        if(i==2){
            hx = Math.min(hospitalInRange[i] * 5,5);
            gx =  Math.max(Math.min(clinicInRange[i] * 2 / 3, 2),Math.min(medicalInRange[i] *2/ 2, 2))
                    +Math.min(drugstoreInRange[i] *2 / 4, 2);            
            max = Math.max(max, Math.max(hx,gx));
        }
        if(i==3){
          hx = Math.min(hospitalInRange[i] * 3/2,3);
          gx =  Math.max(Math.min(clinicInRange[i]/ 5, 1),Math.min(medicalInRange[i]/ 3, 1))
                +Math.min(drugstoreInRange[i]/ 8, 1);          
          max = Math.max(max, Math.max(hx,gx));
        }  
    }
    data[0] = max;
    for(var i = 0; i<4; i++){
        data[i+1] = hospitalInRange[i] + clinicInRange[i]
                    + medicalInRange[i] + drugstoreInRange[i];
        data[5] -= data[i+1];
    }
    return data;    
}

function nhom9Ranking(lat, lng){
    var healthRankingt = healthRanking(lat,lng);
		$(".healthRanking1").text(healthRankingt[0] + "/10");
		$(".healthRanking2").text(healthRankingt[1]);
		$(".healthRanking3").text(healthRankingt[2]);
		$(".healthRanking4").text(healthRankingt[3]);
		$(".healthRanking5").text(healthRankingt[4]);
		$(".healthRanking6").text(healthRankingt[5]);
}