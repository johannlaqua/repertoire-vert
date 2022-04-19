function calculateDistance(userLat, userLng, companyLat, companyLng) {
    var p = 0.017453292519943295;    // Math.PI / 180
    var c = Math.cos;
    var a = 0.5 - c((companyLat - userLat) * p)/2 +
        c(userLat * p) * c(companyLat * p) *
        (1 - c((companyLng - userLng) * p))/2;

    var d = Math.round( 12742 * Math.asin(Math.sqrt(a) ) * 10) / 10; // 2 * R; R = 6371 km
    //console.log(12742 * Math.asin(Math.sqrt(a)))
    return d
}