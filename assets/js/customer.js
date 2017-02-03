function updateClock() {
    var currentTime = new Date( );
    var currentHours = currentTime.getHours( );
    var currentMin = currentTime.getMinutes( );
    var currentSeconds = currentTime.getSeconds( );

    currentMin = (currentMin < 10 ? "0" : "") + currentMin;
    currentSeconds = (currentSeconds < 10 ? "0" : "") + currentSeconds;

    var timeOfDay = (currentHours < 12) ? " AM" : " PM";

    currentHours = (currentHours > 12) ? currentHours - 12 : currentHours;

    currentHours = (currentHours === 0) ? 12 : currentHours;

    var currentTimeString = currentHours + ":" + currentMin + ":" + currentSeconds + "" + timeOfDay;

    $('#timeClock').html(currentTimeString);

}

$(document).ready(function () {
    setInterval('updateClock()', 1000);
});
