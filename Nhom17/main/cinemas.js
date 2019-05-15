const CINEMAS = [
    {
        "id": "1",
        "name": "Beta Cineplex Đan Phượng",
        "address": "Tòa nhà HHA-khu đô thị-Tân Tây Đô-Đan Phượng-Hà Nội",
        "coords": {
            "long": 105.7017894,
            "lat": 21.0750687
        }
    },
    {
        "id": "2",
        "name": "Beta Cineplex Mỹ Đình",
        "address": "Tầng hầm B1-tòa nhà Golden Palace -Nam Từ Liêm-Hà Nội",
        "coords": {
            "long": 105.7752579,
            "lat": 21.0119067
        }
    },
    {
        "id": "3",
        "name": "Beta Cineplex Thanh Xuân",
        "address": "Tầng hầm B1 tòa nhà Golden West",
        "coords": {
            "long": 105.802127,
            "lat": 21.0026327
        }
    },
    {
        "id": "4",
        "name": "BHD Star Cầu Giấy",
        "address": "302 Đường Cầu Giấy-Dịch Vọng-Cầu Giấy-Hà Nội",
        "coords": {
            "long": 105.7944174,
            "lat": 21.0354272
        }
    },
    {
        "id": "5",
        "name": "BHD Star Phạm Ngọc Thạch",
        "address": "Vincom Center-2 Phạm Ngọc Thạch-Kim Liên Đống Đa-Hà Nội",
        "coords": {
            "long": 105.8319952,
            "lat": 21.0064286
        }
    },
    {
        "id": "6",
        "name": "CGV Aeon Long Biên",
        "address": "Tầng 4-TTTM AEON Mega Maill-Số 27 Cổ Linh Long Biên-Hà Nội",
        "coords": {
            "long": 105.9006806,
            "lat": 21.0265591
        }
    },
    {
        "id": "7",
        "name": "CGV Artemis Hanoi",
        "address": "Tầng 6-Tòa nhà Artemis-số 3-Lê Trọng Tấn Khương Mai-Thanh Xuân-Hà Nội",
        "coords": {
            "long": 105.8283506,
            "lat": 20.9996882
        }
    },
    {
        "id": "8",
        "name": "CGV D'Le Roi Soleil",
        "address": "59 Xuân Diệu-Quảng An-Tây Hồ-Hà Nội",
        "coords": {
            "long": 105.827352,
            "lat": 21.0650657
        }
    },
    {
        "id": "9",
        "name": "CGV Hà Nội Centerpoint",
        "address": "Tầng 5 TTTM Hà Nội Centerpoint-27 Đường Lê Văn Lương Nhân Chính-Thanh Xuân-Hà Nội",
        "coords": {
            "long": 105.8044482,
            "lat": 21.004719
        }
    },
    {
        "id": "10",
        "name": "CGV Ho Guom Plaza",
        "address": "Tầng 3-TTTM Hồ Gươm Plaza-110 Trần Phú-P. Mộ Lao Hà Đông-Hà Nội",
        "coords": {
            "long": 105.7856378,
            "lat": 20.9790077
        }
    },
    {
        "id": "11",
        "name": "CGV IPH",
        "address": "Tầng 4-Indochina Plaza-241 Xuân Thủy Dịch Vọng Hậu-Cầu Giấy-Hà Nội",
        "coords": {
            "long": 105.782275,
            "lat": 21.036056
        }
    },
    {
        "id": "12",
        "name": "CGV Machinco Hà Đông",
        "address": "Tầng 7-TTTM Machinco-10 Trần Phú-P. Mộ Lao Hà Đông-Hà Nội",
        "coords": {
            "long": 105.791516,
            "lat": 20.983379
        }
    },
    {
        "id": "13",
        "name": "CGV Mipec Tower",
        "address": "Tầng 5-MIPEC Tower-229 Tây Sơn-Ngã Tư Sở Đống Đa-Hà Nội",
        "coords": {
            "long": 105.823733,
            "lat": 21.0055654
        }
    },
    {
        "id": "14",
        "name": "CGV Rice City",
        "address": "Rice City Linh Đàm -Tòa nhà Trung-Hoàng Liệt Hoàng Mai-Hà Nội",
        "coords": {
            "long": 105.8229783,
            "lat": 20.9633682
        }
    },
    {
        "id": "15",
        "name": "CGV Sun Grand Luong Yen",
        "address": "03 Lương Yên-Bạch Đằng-Hai Bà Trưng-Hà Nội",
        "coords": {
            "long": 105.8640449,
            "lat": 21.0107525
        }
    },
    {
        "id": "16",
        "name": "CGV Sun Grand Thuy Khue",
        "address": "Thuỵ Khuê-Tây Hồ-Hà Nội",
        "coords": {
            "long": 105.8262098,
            "lat": 21.0414017
        }
    },
    {
        "id": "17",
        "name": "CGV Sungrand Ancora Lương Yên",
        "address": "Số 3 Đường Bạch Đằng-Bạch Đằng-Hai Bà Trưng-Hà Nội",
        "coords": {
            "long": 105.8632526,
            "lat": 21.0121694
        }
    },
    {
        "id": "18",
        "name": "CGV Trang Tien Plaza",
        "address": "Tầng 5-TTTM Tràng Tiền Plaza-24 Hai Bà Trưng-Tràng Tiền Hoàn Kiếm-Hà Nội",
        "coords": {
            "long": 105.8533411,
            "lat": 21.0248411
        }
    },
    {
        "id": "19",
        "name": "CGV Trương Định Plaza",
        "address": "Tầng 5-TTTM Trương Định Plaza-461 Trương Định-Tân Mai Hoàng Mai-Hà Nội",
        "coords": {
            "long": 105.846261,
            "lat": 20.984297
        }
    },
    {
        "id": "20",
        "name": "CGV Vincom Bac Tu Liem",
        "address": "Tòa nhà 21B5-234 Phạm Văn Đồng-Bắc Từ Liêm-Cổ Nhuế Từ Liêm-Hà Nội",
        "coords": {
            "long": 105.7800956,
            "lat": 21.0530292
        }
    },
    {
        "id": "21",
        "name": "CGV Vincom Center Ba Trieu",
        "address": "Vincom Center Hà Nội-Tầng 6-Toà-191 Đường Bà Triệu Lê Đại Hành Hai Bà Trưng-Hà Nội",
        "coords": {
            "long": 105.8495107,
            "lat": 21.0110831
        }
    },
    {
        "id": "22",
        "name": "CGV Vincom Mega Mall Royal City",
        "address": "TTTM Vincom Mega Mall Royal City Thanh Xuân-Hà Nội",
        "coords": {
            "long": 105.8154839,
            "lat": 21.0030263
        }
    },
    {
        "id": "23",
        "name": "CGV Vincom Metropolis Lieu Giai",
        "address": "29 Liễu Giai-Ngọc Khánh-Ba Đình-Hà Nội",
        "coords": {
            "long": 105.8146896,
            "lat": 21.0320675
        }
    },
    {
        "id": "24",
        "name": "CGV Vincom Nguyễn Chí Thanh",
        "address": "số 54A Nguyễn Chí Thanh-Láng Thượng Đống Đa-Hà Nội",
        "coords": {
            "long": 105.8092125,
            "lat": 21.0232842
        }
    },
    {
        "id": "25",
        "name": "CGV Vincom Plaza Long Biên",
        "address": "Vincom Plaza-Tầng 5-TTTM-Vinhomes Riverside Long Biên-Hà Nội",
        "coords": {
            "long": 105.9163423,
            "lat": 21.0509866
        }
    },
    {
        "id": "26",
        "name": "CGV Vincom Times City",
        "address": "Tầng B1-TTTM Vincom Mega Mall Times City Hai Bà Trưng-Hà Nội",
        "coords": {
            "long": 105.8684911,
            "lat": 20.9942669
        }
    },
    {
        "id": "27",
        "name": "Cinema Gummy",
        "address": "12-Giải Phóng-Thịnh Liệt-Hoàng Mai-Hà Nội",
        "coords": {
            "long": 105.8470204,
            "lat": 20.9722574
        }
    },
    {
        "id": "28",
        "name": "Cinema Mê Linh",
        "address": "88 Lò Đúc-Phạm Đình Hổ-Hai Bà Trưng-Hà Nội",
        "coords": {
            "long": 105.856885,
            "lat": 21.0149997
        }
    },
    {
        "id": "29",
        "name": "Cinema People's Army",
        "address": "SO 17-Ly Nam De-Quán Thánh-Hoàn Kiếm-Hà Nội",
        "coords": {
            "long": 105.8456326,
            "lat": 21.0378837
        }
    },
    {
        "id": "30",
        "name": "Fafim Cinema",
        "address": "19 Nguyễn Trãi-Ngã Tư Sở-Thanh Xuân-Hà Nội",
        "coords": {
            "long": 105.8203706,
            "lat": 21.0019643
        }
    },
    {
        "id": "31",
        "name": "Fanslands",
        "address": "7 Nam Ngư-Cửa Nam-Hoàn Kiếm-Hà Nội",
        "coords": {
            "long": 105.8427979,
            "lat": 21.0260623
        }
    },
    {
        "id": "32",
        "name": "Fimnet",
        "address": "No. 1-Trung Yen 3 Street-Trung Hoà-Cầu Giấy-Hà Nội",
        "coords": {
            "long": 105.8001241,
            "lat": 21.0152567
        }
    },
    {
        "id": "33",
        "name": "Galaxy Mipec Long Biên",
        "address": "Chung Cư Mipec Riverside-Tầng 6-Toà-Phố Long Biên 2 Ngọc Lâm-Long Biên-Hà Nội",
        "coords": {
            "long": 105.8663177,
            "lat": 21.0454366
        }
    },
    {
        "id": "34",
        "name": "Hanoi Doclab",
        "address": "56 Phố Nguyễn Thái Học-Điện Bàn-Ba Đình-Hà Nội",
        "coords": {
            "long": 105.8374196,
            "lat": 21.0300628
        }
    },
    {
        "id": "35",
        "name": "Lotte Cinema Hà Đông",
        "address": "Tầng 4-Toà nhà Mê Linh-Đường-P. Tô Hiệu-Hà Cầu Hà Đông-Hà Nội",
        "coords": {
            "long": 105.7718115,
            "lat": 20.9636625
        }
    },
    {
        "id": "36",
        "name": "Lotte Cinema Keangnam",
        "address": "Keangnam Hanoi Landmark Tower-Phạm Hùng Mễ Trì -Cầu Giấy-Hà Nội",
        "coords": {
            "long": 105.7835932,
            "lat": 21.0170462
        }
    },
    {
        "id": "37",
        "name": "Lotte Cinema Long Bien",
        "address": "7 Nguyễn Văn Linh-Gia Thụy-Long Biên-Hà Nội",
        "coords": {
            "long": 105.8918255,
            "lat": 21.0506906
        }
    },
    {
        "id": "38",
        "name": "Lotte Cinema Thăng Long",
        "address": "Tầng 3 Big C Thăng Long-222 Trần Duy Hưng Trung Hoà-Cầu Giấy-Hà Nội",
        "coords": {
            "long": 105.7929637,
            "lat": 21.0068227
        }
    },
    {
        "id": "39",
        "name": "National Cinema Center",
        "address": "87 Láng Hạ-Chợ Dừa-Ba Đình-Hà Nội",
        "coords": {
            "long": 105.8156256,
            "lat": 21.0168438
        }
    },
    {
        "id": "40",
        "name": "Platinum Cinema Garden",
        "address": "TTTM Garden-Mễ Trì-Mỹ Đình Nam Từ Liêm-Hà Nội",
        "coords": {
            "long": 105.777933,
            "lat": 21.01535
        }
    },
    {
        "id": "41",
        "name": "Platinum The Gadern",
        "address": "Đường Mễ Trì-Điện Bàn-Ba Đình-Hà Nội",
        "coords": {
            "long": 105.83739,
            "lat": 21.030518
        }
    },
    {
        "id": "42",
        "name": "Rạp chiếu phim Cổ Loa",
        "address": "Cổ Loa-Đông Anh-Hanoi",
        "coords": {
            "long": 105.8551148,
            "lat": 21.1246898
        }
    },
    {
        "id": "43",
        "name": "Rạp Đại Đồng",
        "address": "Hoàng Hoa Thám-P. Nguyễn Trãi-Hà Đông-Hà Nội",
        "coords": {
            "long": 105.7775829,
            "lat": 20.9716416
        }
    },
    {
        "id": "44",
        "name": "Rạp Đại Nam",
        "address": "89 Huế-Ngô Thì Nhậm-Hai Bà Trưng-Hà Nội",
        "coords": {
            "long": 105.8517957,
            "lat": 21.016357
        }
    },
    {
        "id": "45",
        "name": "Rạp Khăn Quàng Đỏ",
        "address": "36 Lý Thái Tổ-Lý Thái Tổ-Hoàn Kiếm-Hà Nội",
        "coords": {
            "long": 105.8551024,
            "lat": 21.028315
        }
    },
    {
        "id": "46",
        "name": "Rạp Kim Đồng.",
        "address": "19 Phố Hàng Bài-Hàng Bài-Hoàn Kiếm-Hà Nội",
        "coords": {
            "long": 105.8530185,
            "lat": 21.0238018
        }
    },
    {
        "id": "47",
        "name": "Rạp Tháng 8",
        "address": "45 Phố Hàng Bài-Hàng Bài-Hoàn Kiếm-Hà Nội",
        "coords": {
            "long": 105.8524925,
            "lat": 21.0215038
        }
    },
    {
        "id": "48",
        "name": "Thanh Giong Cinema",
        "address": "7 Trần Phú-Điện Bàn-Ba Đình-Hà Nội",
        "coords": {
            "long": 105.8434881,
            "lat": 21.0301413
        }
    },
    {
        "id": "49",
        "name": "Théâtre de la Jeunesse",
        "address": "11 Ngô Thì Nhậm-Hai Bà Trưng-Hà Nội",
        "coords": {
            "long": 105.853014,
            "lat": 21.017828
        }
    },
    {
        "id": "50",
        "name": "Viet Theatre",
        "address": "Tầng 9-Tòa nhà Royal-180 Triệu Việt Vương Bùi Thị Xuân-Hai Bà Trưng-Hà Nội",
        "coords": {
            "long": 105.8503213,
            "lat": 21.0122102
        }
    },
    {
        "id": "51",
        "name": "Vozwarez",
        "address": "36B/ A2 Phạm Ngọc Thạch-Trung Tự Đống Đa-Hà Nội",
        "coords": {
            "long": 105.835311,
            "lat": 21.010228
        }
    }
];