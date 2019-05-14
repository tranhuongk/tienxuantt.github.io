
$(document).ready(function () {
	map.on('click', function (e) {
		let lat = e.latlng.lat;
		let lng = e.latlng.lng;
		L.marker([lat, lng]).addTo(map);



		nhom9Ranking(lat, lng);
	});
});


