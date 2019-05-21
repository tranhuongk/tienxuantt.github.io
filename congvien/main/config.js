window.lrmConfig = {
};
// Địa điểm khi mới vào
var map = L.map('map').setView([21.017695, 105.811214], 13.5);
L.tileLayer('https://vmap.vn/tiles/{z}/{x}/{y}.png', {}).addTo(map);

var IconPage = L.Icon.extend({
    options: {
        iconSize: [25, 25],	
    }
});
IconCurrent = new IconPage({ iconUrl: "../Nhom8park/images/tree.png"});

for(var i = 0; i < parkarray1.length; i+=2){
    notifi = parkarray2[i/2] + "<br/> Địa chỉ: "+ parkarray3[i/2];
    L.marker([parkarray1[i+1], parkarray1[i]], {icon: IconCurrent}).bindPopup(notifi).addTo(map);
}
