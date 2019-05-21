
$(document).ready(function () {
	$(".icon-show").click(function(){
		$(".show-ranking").toggle();
	});

	map.on('click', function (e) {
		let lat = e.latlng.lat;
		let lng = e.latlng.lng;
		L.marker([lat, lng]).addTo(map);

		ShowQuantityMap17(lng,lat);
		


		nhom12Ranking(lat, lng);
		nhom8Ranking(lat, lng);
		nhom5Ranking(lat, lng);
		nhom6Ranking(lat, lng);
		nhom9Ranking(lat, lng); // ong nao nhom 7 nham voi nhom t
		nhom9Function(lat, lng);
		nhom10Ranking(lat, lng);
		nhom11Ranking(lat, lng);
		nhom14Ranking(lat, lng);
		nhom16Ranking(lat, lng);
		displayCinemaScoring(lat, lng);
	});
});


function Nhom1234(x,y){
	diem1 = getResultMarker(y1, x1).toFixed(0);
	diem2 = getResultMarker_Nhom_2(x, y);
	diem3 = getResultMarker_Nhom_3(x, y);
	diem4 = getResultMarker_Nhom_4(x, y);
}

