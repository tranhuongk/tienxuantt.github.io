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

function karaokePoint(lat, lng) {
  x1 = lat;
  y1 = lng;
  let range = [0.2, 0.5, 1, 2, 9999999999];
  let numInRange = [0, 0, 0, 0, 0, 0];

  for (var i = 0; i < karaokeArray1.length; i += 2) {

    x2 = karaokeArray1[i + 1];
    y2 = karaokeArray1[i];
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

function nhom14Ranking(lat, lng){
  var karaokeRankingt = karaokePoint(lat,lng);
  console.log(karaokeRankingt);
  $(".karaokeRanking1").text(10-karaokeRankingt[0] + "/10");
  $(".karaokeRanking2").text(karaokeRankingt[1]);
  $(".karaokeRanking3").text(karaokeRankingt[2]);
  $(".karaokeRanking4").text(karaokeRankingt[3]);
  $(".karaokeRanking5").text(karaokeRankingt[4]);
  $(".karaokeRanking6").text(karaokeRankingt[5]);
}