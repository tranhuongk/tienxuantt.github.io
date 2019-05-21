window.lrmConfig = {
};
// Địa điểm khi mới vào
var map = L.map('map').setView([21.017695, 105.811214], 13.5);
L.tileLayer('https://vmap.vn/tiles/{z}/{x}/{y}.png', {}).addTo(map);

var IconPage = L.Icon.extend({
    options: {
        iconSize: [25, 25]
    }
});
IconCurrent = new IconPage({ iconUrl: "../Nhom5/images/fire.png"});
for(var i = 0; i < fsarray1.length; i+=2){
    notifi = fsarray2[i/2] + "<br/> Địa chỉ: "+ fsarray3[i/2];
    L.marker([fsarray1[i+1], fsarray1[i]], {icon: IconCurrent}).bindPopup(notifi).addTo(map);
}
