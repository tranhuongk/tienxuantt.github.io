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

function getPoint(lat1,lon1){
    // can import file data
    let xMin,yMin,xCurrent,yCurrent,l;
    let lMin=10000;
    let distance;
    let count02 = 0,count1 = 0,count2 = 0,c02=0,c05=0,c1=0,c2=0,c23=0;;

    for ( i = 0; i < mn9_array1.length; i += 2) {

        xCurrent = mn9_array1[i + 1];
        yCurrent = mn9_array1[i];
        l = Math.sqrt(Math.pow((x1 - xCurrent), 2) + Math.pow((y1 - yCurrent), 2));
        if (l < lMin) {
            lMin = l;
            xMin = xCurrent;
            yMin = yCurrent;
        }
        distance = getDistance(x1, y1, xCurrent, yCurrent);
        if (distance <= 0.2)
            count02++;
        else if (distance<=1)
            count1++;
        else if (distance<=2)
            count2++;
        if ( distance<= 0.2)
            c02++;
        else if (distance <= 0.5)
            c05 ++;
        else if (distance <=1 )
            c1 ++;
        else if ( distance <=2)
            c2++;
        else c23++;

    }

    let point1 = Math.min(count02*1,10)+Math.min(count1*0.5,5)+Math.min(count2*0.25,3);
    point1 = Math.min(point1,10);
    let dist = getDistance(lat1,lon1, xMin, yMin);
    if (dist <= 0.2)
        return [(10+point1)/2,c02,c05,c1,c2,c23];
    if (dist > 3)
        return [point1/2,c02,c05,c1,c2,c23];
    if (dist<1)
        return [(Math.round((10 - (dist-0.2)*2)*100)/100+point1)/2,c02,c05,c1,c2,c23];
    if (dist<2)
        return [(Math.round((8.4 - (dist-1)*3)*100)/100+point1)/2,c02,c05,c1,c2,c23];
    return [(Math.round((5.4 - (dist-2)*5)*100)/100+point1)/2,,c02,c05,c1,c2,c23];
}
function nhom9Function(lat, lng){
    var mn = getPoint(lat,lng);
    $(".mn1").text(mn[0] + "/10");
    $(".mn2").text(mn[1]);
    $(".mn3").text(mn[2]);
    $(".mn4").text(mn[3]);
    $(".mn5").text(mn[4]);
    $(".mn6").text(mn[5]);
}