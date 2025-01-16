// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily =
    '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#292b2c";

$(window).on("load", function () {
    $.ajax({
        url: "/chart/best_seller_chart",
        method: "get",
        dataType: "json",
        success: function (response) {
            // buat data
            var response_length = response["data"].length;

            label_kopi = [];
            qty_data = []; 

            for(i = 0;i < response_length;i++){
                is_get = false;
                label_kopi.push(response['data'][i].product_name);
                qty_data.push(response['data'][i].qty);
            }

            var ctx = document.getElementById("bestseller_chart");
            new Chart(ctx, {
                type: "bar",
                data: {
                    labels: label_kopi,
                    datasets: [
                        {
                            label: "kuantitas",
                            lineTension: 0.3,
                            backgroundColor: "rgba(2,117,216,0.2)",
                            borderColor: "rgba(2,117,216,1)",
                            pointRadius: 5,
                            pointBackgroundColor: "rgba(2,117,216,1)",
                            pointBorderColor: "rgba(255,255,255,0.8)",
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: "rgba(2,117,216,1)",
                            pointHitRadius: 50,
                            pointBorderWidth: 2,
                            data: qty_data,
                        },
                    ],
                },
                options: {
                    scales: {
                        xAxes: [
                            {
                                time: {
                                    unit: "date",
                                },
                                gridLines: {
                                    display: false,
                                },
                                ticks: {
                                    maxTicksLimit: 7,
                                },
                            },
                        ],
                        yAxes: [
                            {
                                ticks: {
                                    min: 0,
                                    max:
                                        Math.max.apply(Math, qty_data) *
                                        1.2,
                                    maxTicksLimit: 8,
                                },
                                gridLines: {
                                    color: "rgba(0, 0, 0, .125)",
                                },
                            },
                        ],
                    },
                    legend: {
                        display: false,
                    },
                },
            });
        },
    });
});
