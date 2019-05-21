function getDistance(lat1, lon1, lat2, lon2) {
	const R = 6371; // Radius of the earth in km
	const dLat = deg2rad(lat2 - lat1); // deg2rad below
	const dLon = deg2rad(lon2 - lon1);
	const a =
		Math.sin(dLat / 2) * Math.sin(dLat / 2) +
		Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
		Math.sin(dLon / 2) * Math.sin(dLon / 2);
	const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
	const d = R * c; // Distance in km
	return d;
}

function deg2rad(deg) {
	return deg * (Math.PI / 180);
}

function cinemaScoring(latitude, longitude) {
    const cinema_ranking = [
        {
            condition: distance => 0 <= distance && distance <= 0.2,
            count: 0,
            coefficent: 4.0,
        }, {
            condition: distance => 0.2 < distance && distance <= 0.5,
            count: 0,
            coefficent: 3.0,
        }, {
            condition: distance => 0.5 < distance && distance <= 1.0,
            count: 0,
            coefficent: 2.0,
        }, {
            condition: distance => 1.0 < distance && distance <= 2.0,
            count: 0,
            coefficent: 1.0,
        }, {
            condition: distance => distance > 2.0,
            count: 0,
            coefficent: 0,
        },
    ];
    CINEMAS.forEach(cinema => {
        const {lat, long} = cinema.coords;
        const distance = getDistance(latitude, longitude, lat, long);
        const rank = cinema_ranking.findIndex(ranking => ranking.condition(distance));
        ++cinema_ranking[rank].count;
    });
    const score = cinema_ranking.reduce((current, next) => current + next.coefficent * next.count, 0); 
    return [score <= 10 ? score : 10, ...cinema_ranking.map(ranking => ranking.count)];
}

function displayCinemaScoring(latitude, longitude) {
    cinemaScoring(latitude, longitude).forEach((score, i) => {
        $(`.cinema-score-${i}`).text(`${score}${i === 0 ? '/10' : ''}`);
    });
}