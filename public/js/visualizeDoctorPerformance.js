google.charts.load("current", {packages:['bar']});
google.charts.setOnLoadCallback(drawChart);

var chart;

function drawChart() {
    $.ajax({
        url: "/getWeeklyDoctorsBookingCounts",
        dataType: "json",
        success: function(doctorsBookingCounts) {
            var data = new google.visualization.DataTable();
            data.addColumn('date', 'Tarih');
            data.addColumn('number', 'Reggie Zboncak');
            data.addColumn('number', 'Benton Marks');
            data.addColumn('number', 'Devin Terry');
            data.addColumn('number', 'Jackson Glover');
            data.addColumn('number', 'Ena Jacobs');
            data.addColumn('number', 'Ilene Haag');
            data.addColumn('number', 'Vince Beahan');

            doctorsBookingCounts = doctorsBookingCounts.map((item) => {
                item = [new Date(item[0]), {v: item[1][0], f: `${item[1][1]} (${item[1][0]}%)`}, 
                {v: item[2][0], f: `${item[2][1]} (${item[2][0]}%)`}, 
                {v: item[3][0], f: `${item[3][1]} (${item[3][0]}%)`}, {v: item[4][0], f: `${item[4][1]} (${item[4][0]}%)`}, 
                {v: item[5][0], f: `${item[5][1]} (${item[5][0]}%)`}, {v: item[6][0], f: `${item[6][1]} (${item[6][0]}%)`}, 
                {v: item[7][0], f: `${item[7][1]} (${item[7][0]}%)`},];
                return item;
            });

            data.addRows(doctorsBookingCounts);

            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1, 2, 3, 4, 5, 6, 7]);

            // Set chart options
            var options = {
                title: 'Gerçekleşen Randevuların Doktorlar Arasındaki Dağılımı (Haftalık Seyir)',
                titleTextStyle: {
                    color: 'black',
                    fontSize: 14,
                    bold: true,
                    italic: true,
                },
                hAxis: {
                    textStyle: {
                        color: 'black',
                        fontSize: 14,
                        bold: true,
                        italic: true,
                    }
                },
                vAxis: {
                    textStyle: {
                        color: 'black',
                        fontSize: 14,
                        bold: true,
                    }
                },
                height: 300,
                isStacked: true,
                series: {
                    0:{color:'#3366CC'},
                    1:{color:'#DC3912'},
                    2:{color:'#FF9900'},
                    3:{color:'#109618'},
                    4:{color:'#ff3399'},
                    5:{color:'#66ccff'},
                    6:{color:'#a0fa23'},
                },
                focusTarget: 'category',
            };
        
            // Instantiate and draw our chart, passing in some options.
            chart = new google.charts.Bar(document.getElementById('doctorsBookingCounts'));
            chart.draw(view, google.charts.Bar.convertOptions(options));
        },
    });   
}

$(document).ready(function() {
    $("#weeklyData_btn").on("click", function() {
        $("#doctorsBookingCounts").show();
        $.ajax({
            url: "/getWeeklyDoctorsBookingCounts",
            dataType: "json",
            success: function(doctorsBookingCounts) {
                var data = new google.visualization.DataTable();
                data.addColumn('date', 'Tarih');
                data.addColumn('number', 'Reggie Zboncak');
                data.addColumn('number', 'Benton Marks');
                data.addColumn('number', 'Devin Terry');
                data.addColumn('number', 'Jackson Glover');
                data.addColumn('number', 'Ena Jacobs');
                data.addColumn('number', 'Ilene Haag');
                data.addColumn('number', 'Vince Beahan');
    
                doctorsBookingCounts = doctorsBookingCounts.map((item) => {
                    item = [new Date(item[0]), {v: item[1][0], f: `${item[1][1]} (${item[1][0]}%)`}, 
                    {v: item[2][0], f: `${item[2][1]} (${item[2][0]}%)`}, 
                    {v: item[3][0], f: `${item[3][1]} (${item[3][0]}%)`}, {v: item[4][0], f: `${item[4][1]} (${item[4][0]}%)`}, 
                    {v: item[5][0], f: `${item[5][1]} (${item[5][0]}%)`}, {v: item[6][0], f: `${item[6][1]} (${item[6][0]}%)`}, 
                    {v: item[7][0], f: `${item[7][1]} (${item[7][0]}%)`},];
                    return item;
                });
    
                data.addRows(doctorsBookingCounts);
    
                var view = new google.visualization.DataView(data);
                view.setColumns([0, 1, 2, 3, 4, 5, 6, 7]);
    
                // Set chart options
                var options = {
                    title: 'Gerçekleşen Randevuların Doktorlar Arasındaki Dağılımı (Haftalık Seyir)',
                    titleTextStyle: {
                        color: 'black',
                        fontSize: 14,
                        bold: true,
                        italic: true,
                    },
                    hAxis: {
                        textStyle: {
                            color: 'black',
                            fontSize: 14,
                            bold: true,
                            italic: true,
                        }
                    },
                    vAxis: {
                        textStyle: {
                            color: 'black',
                            fontSize: 14,
                            bold: true,
                        }
                    },
                    height: 300,
                    isStacked: true,
                    series: {
                        0:{color:'#3366CC'},
                        1:{color:'#DC3912'},
                        2:{color:'#FF9900'},
                        3:{color:'#109618'},
                        4:{color:'#ff3399'},
                        5:{color:'#66ccff'},
                        6:{color:'#a0fa23'},
                    },
                    focusTarget: 'category',
                };
            
                // Instantiate and draw our chart, passing in some options.
                chart = new google.charts.Bar(document.getElementById('doctorsBookingCounts'));
                chart.draw(view, google.charts.Bar.convertOptions(options));
            },
        });
    });

    $("#dailyData_btn").on("click", function() {
        $("#doctorsBookingCounts").hide();
    });

    $("#monthlyData_btn").on("click", function() {
        $.ajax({
            url: "/getMonthlyDoctorsBookingCounts",
            dataType: "json",
            success: function(doctorsBookingCounts) {
                var data = new google.visualization.DataTable();
                data.addColumn('date', 'Tarih');
                data.addColumn('number', 'Reggie Zboncak');
                data.addColumn('number', 'Benton Marks');
                data.addColumn('number', 'Devin Terry');
                data.addColumn('number', 'Jackson Glover');
                data.addColumn('number', 'Ena Jacobs');
                data.addColumn('number', 'Ilene Haag');
                data.addColumn('number', 'Vince Beahan');
    
                doctorsBookingCounts = doctorsBookingCounts.map((item) => {
                    item = [new Date(item[0]), {v: item[1][0], f: `${item[1][1]} (${item[1][0]}%)`}, 
                    {v: item[2][0], f: `${item[2][1]} (${item[2][0]}%)`}, 
                    {v: item[3][0], f: `${item[3][1]} (${item[3][0]}%)`}, {v: item[4][0], f: `${item[4][1]} (${item[4][0]}%)`}, 
                    {v: item[5][0], f: `${item[5][1]} (${item[5][0]}%)`}, {v: item[6][0], f: `${item[6][1]} (${item[6][0]}%)`}, 
                    {v: item[7][0], f: `${item[7][1]} (${item[7][0]}%)`},];
                    return item;
                });
    
                data.addRows(doctorsBookingCounts);
    
                var view = new google.visualization.DataView(data);
                view.setColumns([0, 1, 2, 3, 4, 5, 6, 7]);
    
                // Set chart options
                var options = {
                    title: 'Gerçekleşen Randevuların Doktorlar Arasındaki Dağılımı (Aylık Seyir)',
                    titleTextStyle: {
                        color: 'black',
                        fontSize: 14,
                        bold: true,
                        italic: true,
                    },
                    hAxis: {
                        textStyle: {
                            color: 'black',
                            fontSize: 14,
                            bold: true,
                            italic: true,
                        }
                    },
                    vAxis: {
                        textStyle: {
                            color: 'black',
                            fontSize: 14,
                            bold: true,
                        }
                    },
                    height: 300,
                    isStacked: true,
                    series: {
                        0:{color:'#3366CC'},
                        1:{color:'#DC3912'},
                        2:{color:'#FF9900'},
                        3:{color:'#109618'},
                        4:{color:'#ff3399'},
                        5:{color:'#66ccff'},
                        6:{color:'#a0fa23'},
                    },
                    focusTarget: 'category',
                };
            
                // Instantiate and draw our chart, passing in some options.
                chart = new google.charts.Bar(document.getElementById('doctorsBookingCounts'));
                chart.draw(view, google.charts.Bar.convertOptions(options));
            },
        });
    });
});