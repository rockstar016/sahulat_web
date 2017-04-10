var MapsGoogle = function () {
    var mapMarker = function () {
        var lat = $('#google_map').attr('data-name');
        var lot = $('#google_map').attr('data-value');
        var map = new GMaps({
           el: '#google_map',
           lat: lat,
           lng: lot
        });

        map.addMarker({
            lat: lat,
            lng: lot,
            title: 'Client Position',
            infoWindow:{
                content: "<b>Client Position</b>"
            }
        });
        map.setZoom(5);
    }

    return {
        //main function to initiate map samples
        initmapmarker: function () {
            mapMarker();
        }

    };

}();