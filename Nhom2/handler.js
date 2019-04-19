function distance(lat1, lng1, lat2, lng2) {
  var R = 6371; // km (change this constant to get miles)
  var dLat = ((lat2 - lat1) * Math.PI) / 180;
  var dLon = ((lng2 - lng1) * Math.PI) / 180;
  var a =
    Math.sin(dLat / 2) * Math.sin(dLat / 2) +
    Math.cos((lat1 * Math.PI) / 180) *
      Math.cos((lat2 * Math.PI) / 180) *
      Math.sin(dLon / 2) *
      Math.sin(dLon / 2);
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
  var d = R * c;
  // if (d>1) return Math.round(d)+"km";
  // else if (d<=1) return Math.round(d*1000)+"m";
  return Math.round(d);
}
function findNearestWaterFactory(lat, lon) {
  var index;
  var closest = 9999;
  factories.forEach(({ location }, i) => {
    if (location) {
      var lat1 = location.split(",")[0];
      var lng2 = location.split(",")[1];
      if (distance(lat, lon, lat1, lng2) < closest) {
        closest = distance(lat, lon, lat1, lng2);
        index = i;
      }
    }
  });
  return factories[index];
}
