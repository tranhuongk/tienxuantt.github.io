window.lrmConfig = {
};
// Địa điểm khi mới vào
 var map = L.map('map').setView([21.028711, 105.852638], 13.5);

// Nguồn bản đồ
L.tileLayer('https://vmap.vn/tiles/{z}/{x}/{y}.png', {}).addTo(map);


var IconPage = L.Icon.extend({
    options: {
        iconSize: [25, 25]
    }
});
IconCurrent = new IconPage({ iconUrl: "../quankaraoke/images/karaoke.png"});
for(var i = 0; i < array1.length - 1; i+=2){
    notifi = array2[i/2] + "<br/> Địa chỉ: "+ array3[i/2];
    L.marker([array1[i+1], array1[i]], {icon: IconCurrent}).bindPopup(notifi).addTo(map);
}
