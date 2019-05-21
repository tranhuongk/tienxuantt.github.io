$(document).ready(function() {
    var hospital_route = L.Routing.control({
        waypoints: []
    });
    var clinic_route = L.Routing.control({
        waypoints: []
    });
    var drugstore_route = L.Routing.control({
        waypoints: []
    });
    var medical_route = L.Routing.control({
        waypoints: []
    });

    var i;

    var popup = L.popup();

    function getDistance(origin, destination) {
        // return distance in meters
        var lon1 = toRadian(origin[1]),
            lat1 = toRadian(origin[0]),
            lon2 = toRadian(destination[1]),
            lat2 = toRadian(destination[0]);

        var deltaLat = lat2 - lat1;
        var deltaLon = lon2 - lon1;

        var a = Math.pow(Math.sin(deltaLat / 2), 2) + Math.cos(lat1) * Math.cos(lat2) * Math.pow(Math.sin(deltaLon / 2), 2);
        var c = 2 * Math.asin(Math.sqrt(a));
        var EARTH_RADIUS = 6371;
        return c * EARTH_RADIUS * 1000;
    }
    function toRadian(degree) {
        return degree * Math.PI / 180;
    }

    function onMapClick(e) {
        hospital_route.setWaypoints([null]);
        clinic_route.setWaypoints([null]);
        drugstore_route.setWaypoints([null]);
        medical_route.setWaypoints([null]);
        $(".leaflet-routing-container").css("display", "none");
        var hos_count = 0;
        var cli_count = 0;
        var drg_count = 0;
        var mec_count = 0;

        var hos_min = getDistance([Number(hospitals[0].Lat), Number(hospitals[0].Lng)], [e.latlng.lat, e.latlng.lng]);
        var cli_min = getDistance([Number(clinics[0].Lat), Number(clinics[0].Lng)], [e.latlng.lat, e.latlng.lng]);
        var drg_min = getDistance([Number(drugstores[0].Lat), Number(drugstores[0].Lng)], [e.latlng.lat, e.latlng.lng]);
        var mec_min = getDistance([Number(medicalCenters[0].Lat), Number(medicalCenters[0].Lng)], [e.latlng.lat, e.latlng.lng]);

        
        for (i = 0; i < hospitals.length; i++) {
            result = getDistance([Number(hospitals[i].Lat), Number(hospitals[i].Lng)], [e.latlng.lat, e.latlng.lng]);
            if (hos_min >= result) {
                hos_min = result;
                hos_count = i;
            }
        }
        for (i = 0; i < clinics.length; i++) {
            result = getDistance([Number(clinics[i].Lat), Number(clinics[i].Lng)], [e.latlng.lat, e.latlng.lng]);
            if (cli_min >= result) {
                cli_min = result;
                cli_count = i;
            }
        }
        for (i = 0; i < drugstores.length; i++) {
            result = getDistance([Number(drugstores[i].Lat), Number(drugstores[i].Lng)], [e.latlng.lat, e.latlng.lng]);
            if (drg_min >= result) {
                drg_min = result;
                drg_count = i;
            }
        }
        for (i = 0; i < medicalCenters.length; i++) {
            result = getDistance([Number(medicalCenters[i].Lat), Number(medicalCenters[i].Lng)], [e.latlng.lat, e.latlng.lng]);
            if (mec_min >= result) {
                mec_min = result;
                mec_count = i;
            }
        }

        popup
            .setLatLng(e.latlng)
            .setContent("Bạn đang ở tọa độ: " + e.latlng.toString().substring(6) + '<br>'
                + '<div id="hospital-nearest" class="nearest">Bệnh viện gần nhất: ' + hospitals[hos_count].Name + '</div>'
                + '<div id="clinic-nearest" class="nearest">Phòng khám gần nhất: ' + clinics[cli_count].Name + '</div>'
                + '<div id="drugstore-nearest" class="nearest">Nhà thuốc gần nhất: ' + drugstores[drg_count].Name + '</div>'
                + '<div id="medical-nearest" class="nearest">Trạm y tế gần nhất: ' + medicalCenters[mec_count].Name + '</div>'
            ).openOn(mymap);

        $("#hospital-nearest").click(function () {
            clinic_route.setWaypoints([null]);
            drugstore_route.setWaypoints([null]);
            medical_route.setWaypoints([null]);
            $(".leaflet-routing-container").css("display", "none");
            hospital_route.setWaypoints([
                L.latLng(e.latlng),
                L.latLng(hospitals[hos_count].Lat, hospitals[hos_count].Lng)
            ]).addTo(mymap);
        });
        $("#clinic-nearest").click(function () {
            hospital_route.setWaypoints([null]);
            drugstore_route.setWaypoints([null]);
            medical_route.setWaypoints([null]);
            $(".leaflet-routing-container").css("display", "none");
            clinic_route.setWaypoints([
                L.latLng(e.latlng),
                L.latLng(clinics[cli_count].Lat, clinics[cli_count].Lng)
            ]).addTo(mymap);
        });
        $("#drugstore-nearest").click(function () {
            hospital_route.setWaypoints([null]);
            clinic_route.setWaypoints([null]);
            medical_route.setWaypoints([null]);
            $(".leaflet-routing-container").css("display", "none");
            drugstore_route.setWaypoints([
                L.latLng(e.latlng),
                L.latLng(drugstores[drg_count].Lat, drugstores[drg_count].Lng)
            ]).addTo(mymap);
        });
        $("#medical-nearest").click(function () {
            hospital_route.setWaypoints([null]);
            clinic_route.setWaypoints([null]);
            drugstore_route.setWaypoints([null]);
            $(".leaflet-routing-container").css("display", "none");
            medical_route.setWaypoints([
                L.latLng(e.latlng),
                L.latLng(medicalCenters[mec_count].Lat, medicalCenters[mec_count].Lng)
            ]).addTo(mymap);
        });

    }
    mymap.on('click', onMapClick);

    var popup = L.popup()
        .setLatLng([21.0248769, 105.8074996])
        .setContent("National Children's Hospital<br>18/879 Đường La Thành, Láng Thượng, Đống Đa, Hà Nội, Vietnam<br> 21.0248769 , 105.8074996")
        .openOn(mymap);

    var customIcon = L.Icon.extend({
        options: {
            iconSize: [38, 38],
        }
    });

    hospital = new customIcon({ iconUrl: 'hospital.png' });
    clinic = new customIcon({ iconUrl: 'clinic.png' });
    drugstore = new customIcon({ iconUrl: 'drugstore.png' });
    medical = new customIcon({ iconUrl: 'medical.png' });

    for (i = 0; i < hospitals.length; i++) {
        var sth = hospitals[i].Name + "<br>" + hospitals[i].Address + "<br>" + hospitals[i].Lat + ',' + hospitals[i].Lng;
        var marker = L.marker([hospitals[i].Lat, hospitals[i].Lng], { icon: hospital }).bindPopup(sth).addTo(mymap);
    }
    for (i = 0; i < clinics.length; i++) {
        if (clinics[i].Category == 2) {
            var sth = clinics[i].Name + "<br>" + clinics[i].Address + "<br>" + clinics[i].Lat + ',' + clinics[i].Lng;
            var marker = L.marker([clinics[i].Lat, clinics[i].Lng], { icon: clinic }).bindPopup(sth).addTo(mymap);
        }
    }
    for (i = 0; i < drugstores.length; i++) {
        if (drugstores[i].Category == 3) {
            var sth = drugstores[i].Name + "<br>" + drugstores[i].Address + "<br>" + drugstores[i].Lat + ',' + drugstores[i].Lng;
            var marker = L.marker([drugstores[i].Lat, drugstores[i].Lng], { icon: drugstore }).bindPopup(sth).addTo(mymap);
        }
    }
    for (i = 0; i < medicalCenters.length; i++) {
        if (medicalCenters[i].Category == 4) {
            var sth = medicalCenters[i].Name + "<br>" + medicalCenters[i].Address + "<br>" + medicalCenters[i].Lat + ',' + medicalCenters[i].Lng;
            var marker = L.marker([medicalCenters[i].Lat, medicalCenters[i].Lng], { icon: medical }).bindPopup(sth).addTo(mymap);
        }
    }

    var x = false;
    $("#hospital-show").click(function () {
        if (x) {
            console.log(x);
            x = false;
            console.log(x);
            $('img[src="hospital.png"]').show(100);
            $("#hospital-show").html("Ẩn bệnh viện");
        } else {
            console.log(x);
            x = true;
            console.log(x);
            $('img[src="hospital.png"]').hide(100);
            $("#hospital-show").html("Bệnh viện");
        }
    });
    var y = true;
    $("#clinic-show").click(function () {
        if (y) {
            console.log(y);
            y = false;
            console.log(y);
            $('img[src="clinic.png"]').show(100);
            $("#clinic-show").html("Ẩn phòng khám");
        } else {
            console.log(y);
            y = true;
            console.log(y);
            $('img[src="clinic.png"]').hide(100);
            $("#clinic-show").html("Phòng khám");
        }
    });
    var z = true;
    $("#drugstore-show").click(function () {
        if (z) {
            console.log(z);
            z = false;
            console.log(z);
            $('img[src="drugstore.png"]').show(100);
            $("#drugstore-show").html("Ẩn hiệu thuốc");
        } else {
            console.log(z);
            z = true;
            console.log(z);
            $('img[src="drugstore.png"]').hide(100);
            $("#drugstore-show").html("Hiệu thuốc");
        }
    });
    var t = true;
    $("#medical-show").click(function () {
        if (t) {
            t = false;
            $('img[src="medical.png"]').show(100);
            $("#medical-show").html("Ẩn trạm y tế");
        } else {
            t = true;
            $('img[src="medical.png"]').hide(100);
            $("#medical-show").html("Trạm y tế");
        }
    });

    for (i = 0; i < statistical.length; i++) {
        $('table').append('<tr>'
            + '<td>' + (i + 1) + '</td>'
            + '<td style="text-align:left;font-weight:500;padding-left:5px">' + statistical[i].District + '</td>'
            + '<td>' + statistical[i].Hospital + '</td>'
            + '<td>' + statistical[i].Clinic + '</td>'
            + '<td>' + statistical[i].Drugstore + '</td>'
            + '<td>' + statistical[i].medicalCenter + '</td>'
            + '</tr>');
    }

    var show = false;  
    $("#left-hide").on('click',function(){
        $(".hide-show").animate(
            {width: "toggle"},300
        );
        if(show){
            show = false;
            $("#left-hide").animate(
                {"left": "-=25%"}, 300, function(){
                    $("#control-hide").animate(
                        { deg: 0 },
                        {duration: 400,
                        step: function(now) {
                            $(this).css({ transform: 'rotate(' + now + 'deg)' });
                        }
                    });
                }
            )
            $("#mapid").animate(
                {width: "100%"},300
            );
            
        }
        else{
            show = true;
            $("#left-hide").animate(
                {"left": "+=25%"}, 300, function(){
                    $("#control-hide").animate(
                        { deg: -180 },
                        {duration: 400,
                        step: function(now) {
                            $(this).css({ transform: 'rotate(' + now + 'deg)' });
                        }
                    });
                }
            )
            $("#mapid").animate(
                {width: "60%"},300
            );
        }
    });
})