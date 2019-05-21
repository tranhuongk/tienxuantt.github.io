window.lrmConfig = {
};
// Địa điểm khi mới vào
 var map = L.map('map').setView([21.028711, 105.852638], 13.5);

// Nguồn bản đồ
L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
    maxZoom: 20,
    attribution: 'Map data &copy; <a href="https://www.openstreetmymap.org/">OpenStreetMap</a> contributors, ' +
        '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
        'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    id: 'mapbox.streets'
}).addTo(map);

var IconPage = L.Icon.extend({
    options: {
        iconSize: [25, 25]
    }
});
IconCurrent = new IconPage({ iconUrl: "../Nhom14/images/karaoke.png"});
for(var i = 0; i < array1.length; i+=2){
    notifi = array2[i/2] + "<br/> Địa chỉ: "+ array3[i/2];
    L.marker([array1[i+1], array1[i]], {icon: IconCurrent}).bindPopup(notifi).addTo(map);
}
