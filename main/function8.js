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

function marketPoint(lat, lng) {
  x1 = lat;
  y1 = lng;
  let range = [0.2, 0.5, 1, 2, 9999999999];
  let numInRange = [0, 0, 0, 0, 0, 0];

  for (var i = 0; i < marketarray1.length; i += 2) {

    x2 = marketarray1[i + 1];
    y2 = marketarray1[i];
    var distance = getDistance(x1, y1, x2, y2);
    for (var j = 0; j < range.length; j++) {
      if (distance <= range[j]) numInRange[j + 1] += 1;
    }
  }
  var x;
  for (var i = 0; i < range.length; i++) {
    if (numInRange[i + 1] > 0) {
      x = i + 1;
      break;
    }
  }
  numInRange[0] = x;
  return numInRange;
}

function parkPoint(lat, lng) {
  //hàm này phân loại 1 tọa độ theo hạng từ 1 -> n, hạng càng thấp thì càng chất lượng
  x1 = lat;
  y1 = lng;
  let range = [0.5, 1, 2, 3, 9999999999];// mảng khoảng cách để tính điểm,đơn vị : km. => explain: dưới 0.2km -> hạng 1; dưới 0.5 km -> hạng 2, ....
  let numInRange = [0, 0, 0, 0, 0, 0];// mảng trên có bao nhiêu phần tử thì mảng này có bấy nhiêu số 0 :).

  for (var i = 0; i < parkarray1.length; i += 2) {

    x2 = parkarray1[i + 1];
    y2 = parkarray1[i];
    var distance = getDistance(x1, y1, x2, y2);
    for (var j = 0; j < range.length; j++) {
      if (distance <= range[j]) numInRange[j + 1] += 1;
    }
  }
  var x;
  for (var i = 0; i < range.length; i++) {
    if (numInRange[i + 1] > 0) {
      x = i + 1;
      break;
    }
  }
  numInRange[0] = x;
  return numInRange;
}


function supermarketPoint(lat, lng) {
  //hàm này phân loại 1 tọa độ theo hạng từ 1 -> n, hạng càng thấp thì càng chất lượng
  x1 = lat;
  y1 = lng;
  let range = [0.2, 0.5, 1, 2, 9999999999];// mảng khoảng cách để tính điểm,đơn vị : km. => explain: dưới 0.2km -> hạng 1; dưới 0.5 km -> hạng 2, ....
  let numInRange = [0, 0, 0, 0, 0, 0];// mảng trên có bao nhiêu phần tử thì mảng này có bấy nhiêu số 0 :).

  for (var i = 0; i < supermarketarray1.length; i += 2) {

    x2 = supermarketarray1[i + 1];
    y2 = supermarketarray1[i];
    var distance = getDistance(x1, y1, x2, y2);
    for (var j = 0; j < range.length; j++) {
      if (distance <= range[j]) numInRange[j + 1] += 1;
    }
  }
  var x;
  for (var i = 0; i < range.length; i++) {
    if (numInRange[i + 1] > 0) {
      x = i + 1;
      break;
    }
  }
  numInRange[0] = x;
  return numInRange;
}

function nhom8Ranking(lat, lng){
  var parkRankingt = parkPoint(lat,lng);
  console.log(parkRankingt);
  $(".parkRanking1").text(5-parkRankingt[0] + "/5");
  $(".parkRanking2").text(parkRankingt[1]);
  $(".parkRanking3").text(parkRankingt[2]);
  $(".parkRanking4").text(parkRankingt[3]);
  $(".parkRanking5").text(parkRankingt[4]);
  $(".parkRanking6").text(parkRankingt[5]);

  var marketRankingt = marketPoint(lat,lng);
  console.log(marketRankingt)
  $(".marketRanking1").text(5-marketRankingt[0] + "/5");
  $(".marketRanking2").text(marketRankingt[1]);
  $(".marketRanking3").text(marketRankingt[2]);
  $(".marketRanking4").text(marketRankingt[3]);
  $(".marketRanking5").text(marketRankingt[4]);
  $(".marketRanking6").text(marketRankingt[5]);

  var supermarketRankingt = supermarketPoint(lat,lng);
  console.log(supermarketRankingt);
  $(".supermarketRanking1").text(5-supermarketRankingt[0] + "/5");
  $(".supermarketRanking2").text(supermarketRankingt[1]);
  $(".supermarketRanking3").text(supermarketRankingt[2]);
  $(".supermarketRanking4").text(supermarketRankingt[3]);
  $(".supermarketRanking5").text(supermarketRankingt[4]);
  $(".supermarketRanking6").text(supermarketRankingt[5]);
}