$(document).ready(function () {
    $("#search_result_diagnosis").hide();
    $("#case_summary_view").hide();
});

function view_graph(data, data2) {
    $("#case_summaries").show();
    $("#case_view_graphical").show();
    $("#case_summary_view").hide();
    $("#frequent_searched_case").hide();
    $("#system_users").hide();
    $("#search_result_diagnosis").show();
    var lineData = {
        labels: data2,
        datasets: [
            {
                backgroundColor: [
                    'rgba(255, 255, 255, 255)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)'

                ],

                data: data
            }
        ]
    };

    var lineOptions = {
        responsive: true,
        title: {
            display: true,
            text: "Likely Disease",
        },

        scales: {
            yAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Symptom Frequency'
                    },
                    ticks: {
                        suggestedMin: 0
                    },
                    gridLines: {
                        display: false
                    }
                }]
        }
    };

    var ctx = document.getElementById("lineChart").getContext("2d");
    var myNewChart = new Chart(ctx, {
        type: 'line',
        data: lineData,
        options: lineOptions
    });

}

$(document).ready(function () {
    $('#searchReport').on('change', function () {
        var value = $(this).val();
        if (value === 'case_view') {
            case_view();
        } else if (value === 'case_summary') {
            case_summary();
        } else if (value === 'sytem_user') {
            view_all_users();
        } else if (value === 'frequently_searched') {
            frequently_searched();
        } else {
           
        }
    });
});

function case_view() {
    var srvRqst = $.ajax({
        url: 'http://localhost/cbr/index.php/welcome/case_summary',
        data: {},
        type: 'post',
        datatype: 'json'

    }
    );
    srvRqst.done(function (responses)
    {

        var responseObj = $.parseJSON(responses);
        var disease_lables = Object.keys(responseObj);
        var disease_values = Object.keys(responseObj).map(function (k) {
            return responseObj[k];
        });
        var barData = {
            labels: disease_lables,
            datasets: [
                {
                    label: "Symptom Number",
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1,

                    data: disease_values
                }
            ]
        };

        var barOption = {
            scales: {
                yAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Symptom Frequency'
                        },
                        ticks: {
                            suggestedMin: 0
                        },
                        gridLines: {
                            display: false
                        }
                    }]
            },
            title: {
                display: true,
                text: "Likely Disease",
            }
        };
        var ctx = document.getElementById("case_view_graphical").getContext("2d");


        var myBarChat = new Chart(ctx, {
            type: 'bar',
            data: barData,
            options: barOption
        });
    });

}

function view_all_users() {
    $("#case_summaries").hide();
    $("#case_view_graphical").hide();
    $("#case_summary_view").hide();
    $("#frequent_searched_case").hide();
    $("#system_users").show();
    var srvRqst = $.ajax({
        url: 'http://localhost/cbr/user/view_all_users',
        data: {},
        type: 'post'
    });

    srvRqst.done(function (response) {
        $('div.reports_areas').html(response);
    });
}

// function show_confirm(act, gotoid) {
//         var controller= "";
//     if (act === "edit_symptom") {

//         var r = confirm("Do you really want to edit the Symptom?");
//     } else if (act === "edit_disease") {
//                 controller= "disease"
//         var r = confirm("Do you really want to edit the Disease?");
//     } else if (act === "delete_symptom") {

//         var r = confirm("Do you really want to edit the Symptom?");
//     } else if (act === "delete_disease") {

//         var r = confirm("Do you really want to delete the Disease");
//     } else if (act === "edit_user") {
//         var r = confirm("Do you really want to edit the user?");
//     } else {
//         var r = confirm("Do yo really want to delete the user?");
//     }

//     if (r === true) {

//         window.location = controller +"/" + act + "/" + gotoid;
//     }
//     //            function display_name() {
//     //                console.log('Daniel Mutwiri');
//     //            }
// }
$(document).ready(function () {
    $("#new_user").click(function () {
        $("#myModal3").modal({backdrop: false});
    });
    $('form#add_new_user').on('submit', function (form) {
        form.preventDefault();
        $.post('index.php/welcome/new_user', $('form#add_new_user').serialize(), function (data) {
            $('div.user_error').html(data);
        });
    });
});

function alert_form() {

    $("#new_user").click(function () {
        $("#myModal3").modal({backdrop: false});
    });
}

function case_summary() {
    $("#case_view_graphical").hide();
    $("#frequent_searched_case").hide();
    $("#case_summary_view").show();
    $("#system_users").hide();
    var srvRqst = $.ajax({
        url: 'http://localhost/cbr/welcome/unaccount_symptom',
        data: {},
        type: 'post'
    });

    srvRqst.done(function (response) {
        $('div.symptom_unaccount').html(response);
    });
    var srvRqst = $.ajax({
        url: 'http://localhost/cbr/index.php/welcome/frequent_symptom',
        data: {},
        type: 'post',
        datatype: 'json'

    }
    );
    srvRqst.done(function (responses)
    {

        var responseObj = $.parseJSON(responses);
        var disease_lables = Object.keys(responseObj);
        var disease_values = Object.keys(responseObj).map(function (k) {
            return responseObj[k];
        });
        var barData = {
            labels: disease_lables,
            datasets: [
                {
                    label: "Number of Times",
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1,
                    data: disease_values
                }
            ]
        };

        var barOption = {
            title: {
                display: true,
                text: "Likely Disease",
            },
            scales: {
                yAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Symptom Frequency'
                        },
                        ticks: {
                            suggestedMin: 0
                        },

                        gridLines: {
                            display: false
                        }
                    }],
                xAxes: [{
                        barPercentage: 1,
                        gridLines: {
                            display: false
                        }
                    }]
            }
        };
        var ctx = document.getElementById("symptom_frequency").getContext("2d");


        var myBarChat = new Chart(ctx, {
            type: 'bar',
            data: barData,
            options: barOption
        });
    });


}

function frequently_searched() {
    $("#case_summaries").hide();
    $("#case_view_graphical").hide();
    $("#case_summary_view").hide();
    $("#frequent_searched_case").show();
    $("#system_users").hide();
    var srvRqst = $.ajax({
        url: 'http://localhost/cbr/welcome/frequent_symptom_searches',
        data: {},
        type: 'post',
        datatype: 'json'

    }
    );
    srvRqst.done(function (responses)
    {
       
        var responseObj = $.parseJSON(responses);
        var disease_lables = Object.keys(responseObj);
        var disease_values = Object.keys(responseObj).map(function (k) {
            return responseObj[k];
        });
        
        var barData = {
            labels: disease_lables,
            datasets: [
                {
                    label: "Number of Times",
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                    ],
                    borderWidth: 1,
                    data: disease_values
                }
            ]
        };

        var barOption = {
            scales: {
                yAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Symptom Frequency'
                        },
                        ticks: {
                            suggestedMin: 0
                        },

                        gridLines: {
                            display: false
                        }
                    }],
                xAxes: [{
                        barPercentage: 1,
                        gridLines: {
                            display: false
                        }
                    }]

            }
        };
        var ctx = document.getElementById("frequent_search").getContext("2d");


        var myBarChat = new Chart(ctx, {
            type: 'bar',
            data: barData,
            options: barOption
        });
    });
}
