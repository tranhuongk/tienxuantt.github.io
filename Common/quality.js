// JavaScript source code
var base = 78374.13333;

function isInsidePolygon(x, y, poly) {
    var polyPoints = poly.coordinates[0];
    //console.log(polyPoints);

    var inside = false;
    for (var i = 0, j = polyPoints.length - 1; i < polyPoints.length; j = i++) {
        var xi = polyPoints[i][0], yi = polyPoints[i][1];
        var xj = polyPoints[j][0], yj = polyPoints[j][1];
        //console.log(xi);
        var intersect = ((yi > y) != (yj > y))
            && (x < (xj - xi) * (y - yi) / (yj - yi) + xi);
        if (intersect) inside = !inside;
    }

    return inside;
};

function getResultMarker(x, y) {
    for (var i = 0; i < geodata.features.length; i++) {
        feature = geodata.features[i];
        var poly = feature.geometry;
        //console.log(poly.coordinates);
        if (isInsidePolygon(x, y, poly)) {
            return quality(feature) * 10;
        }
    }
}

function getResultMarker_Nhom_3(x, y) {
    var point = {
        "Ứng Hòa": "6",
        "Bắc Từ Liêm": "8",
        "Ba Đình": "10",
        "Ba Vì": "6",
        "Cầu Giấy": "9",
        "Chương Mỹ": "6",
        "Đống Đa": "10",
        "Đan Phượng": "7",
        "Đông Anh": "8",
        "Gia Lâm": "8",
        "Hà Đông": "9",
        "Hai Bà Trưng": "10",
        "Hoài Đức": "8",
        "Hoàn Kiếm": "10",
        "Hoàng Mai": "8",
        "Long Biên": "7",
        "Mỹ Đức": "6",
        "Mê Linh": "7",
        "Nam Từ Liêm": "9",
        "Phú Xuyên": "6",
        "Phúc Thọ": "6",
        "Quốc Oai": "6",
        "Sóc Sơn": "7",
        "Sơn Tây": "5",
        "Tây Hồ": "8",
        "Thạch Thất": "6",
        "Thanh Oai": "6",
        "Thanh Trì": "7",
        "Thanh Xuân": "9",
        "Thường Tín": "7"
    }
    for (var i = 0; i < geodata.features.length; i++) {
        feature = geodata.features[i];
        var poly = feature.geometry;
        if (isInsidePolygon(x, y, poly)) {
            return point[feature.properties.NAME_2];
        }
    }
}

function getResultMarker_Nhom_2(x, y) {
    var point = {
        "Ứng Hòa": "6",
        "Bắc Từ Liêm": "7",
        "Ba Đình": "3",
        "Ba Vì": "6",
        "Cầu Giấy": "4",
        "Chương Mỹ": "3",
        "Đống Đa": "5",
        "Đan Phượng": "5",
        "Đông Anh": "3",
        "Gia Lâm": "7",
        "Hà Đông": "6",
        "Hai Bà Trưng": "7",
        "Hoài Đức": "7",
        "Hoàn Kiếm": "3",
        "Hoàng Mai": "7",
        "Long Biên": "7",
        "Mỹ Đức": "2",
        "Mê Linh": "4",
        "Nam Từ Liêm": "7",
        "Phú Xuyên": "6",
        "Phúc Thọ": "6",
        "Quốc Oai": "8",
        "Sóc Sơn": "7",
        "Sơn Tây": "3",
        "Tây Hồ": "3",
        "Thạch Thất": "3",
        "Thanh Oai": "6",
        "Thanh Trì": "7",
        "Thanh Xuân": "6",
        "Thường Tín": "7"
    }

    for (var i = 0; i < geodata.features.length; i++) {
        feature = geodata.features[i];
        var poly = feature.geometry;
        if (isInsidePolygon(x, y, poly)) {
            return point[feature.properties.NAME_2];
        }
    }
}

function getResultMarker_Nhom_4(x, y) {
    var point = {
        "Ba Vì": "2",
        "Sơn Tây": "4",
        "Phúc Thọ": "3",
        "Thạch Thất": "3",
        "Quốc Oai": "3",
        "Chương Mỹ": "2",
        "Sóc Sơn": "3",
        "Mê Linh": "3",
        "Đông Anh": "3",
        "Long Biên": "4",
        "Gia Lâm": "4",
        "Đan Phượng": "7",
        "Mỹ Đức": "3",
        "Ứng Hòa": "3",
        "Phú Xuyên": "4",
        "Thường Tín": "2",
        "Thanh Oai": "3",
        "Bắc Từ Liêm": "2",
        "Hai Bà Trưng": "5",
        "Hoài Đức": "6",
        "Hà Đông": "6",
        "Nam Từ Liêm": "3",
        "Thanh Trì": "3",
        "Hoàng Mai": "4",
        "Tây Hồ": "6",
        "Cầu Giấy": "6",
        "Ba Đình": "6",
        "Đống Đa": "4",
        "Thanh Xuân": "6",
        "Hoàn Kiếm": "10"
    }

    for (var i = 0; i < geodata.features.length; i++) {
        feature = geodata.features[i];
        var poly = feature.geometry;
        if (isInsidePolygon(x, y, poly)) {
            return point[feature.properties.NAME_2];
        }
    }
}

function quality(feature) {
    //return ((10000 - feature.properties.hours) / 10000 * 0.3 + feature.properties.density / 10 * 0.1 + feature.properties.load * 0.2 + feature.properties.gov * 0.4)
    let num = ((1 - feature.properties.hours / base * 10) * 0.3 + feature.properties.density / 10 * 0.1 + feature.properties.load * 0.2 + feature.properties.gov * 0.4);
    return num.toFixed(3);
}

function ShowQuantity(x, y) {
    diem1 = getResultMarker(y1, x1).toFixed(0);
    diem2 = getResultMarker_Nhom_2(x, y);
    diem3 = getResultMarker_Nhom_3(x, y);
    diem4 = getResultMarker_Nhom_4(x, y);

    var popup2 = L.popup();
    infor = "Chất lượng điện đạt: " + diem1 + "/10 điểm </br>";
    infor2 = "Chất lượng nước đạt: " + diem2 + "/10 điểm </br>";
    infor3 = "Hệ thống xử lý nước thải đạt: " + diem3 + "/10 điểm </br>";
    infor4 = "Hệ thống xử lý rác thải đạt: " + diem4 + "/10 điểm </br>";
    sum = infor + infor2 + infor3 + infor4;
    popup2
        .setLatLng([y, x])
        .setContent(sum)
        .openOn(map);
}

function ShowQuantityMap17(x,y){
    diem1 = getResultMarker(x, y).toFixed(0);
    diem2 = getResultMarker_Nhom_2(x, y);
    diem3 = getResultMarker_Nhom_3(x, y);
    diem4 = getResultMarker_Nhom_4(x, y);

    $(".racthai").text(diem4 + "/10");
    $(".nuoc").text(diem2 + "/10");
    $(".nuocthai").text(diem3 + "/10");
    $(".dien").text(diem1 + "/10");
}