
$(document).ready(function () {
	map.on('click', function (e) {
		let lat = e.latlng.lat;
		let lng = e.latlng.lng;
		L.marker([lat, lng]).addTo(map);

	
		nhom12Ranking(lat, lng);
		nhom8Ranking(lat, lng);
		nhom5Ranking(lat, lng);
		nhom6Ranking(lat, lng);
		nhom9Ranking(lat, lng); // ong nao nhom 7 nham voi nhom t
		nhom9Function(lat, lng);
		nhom10Ranking(lat, lng);
		nhom11Ranking(lat, lng);
		nhom16Ranking(lat, lng);
		displayCinemaScoring(lat, lng);
	});
});


