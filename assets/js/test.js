$(document).ready(function () {
//	$('div.poem-stanza').addClass('highlight');
//        $('#selected-plays > li').addClass('horizontal');
//        $('#selected-plays li:not(.horizontal)').addClass('sub-level');
//        $('tr:nth-child(odd)').addClass('alt');
//        $('td:contains(Henry)').nextAll().addClass('user-important');
//        $('input[type="text"]:disabled';
    $('#switcher-default').addClass('selected').on('click', function () {
        $("body").removeClass();


    });

    $('#switcher-narrow').on('click', function () {
        $('body').removeClass().addClass('narrow');


    });

    $('#switcher-large').on('click', function () {
        $('body').removeClass().addClass('large');


    });
    $('#switcher button').on('click', function () {
        $('#switcher button').removeClass('selected');
        $(this).addClass('selected');
    });

    $('#switcher h3').hover(function () {
        $(this).addClass('hover');
    }, function () {
        $(this).removeClass('hover');
    });

});