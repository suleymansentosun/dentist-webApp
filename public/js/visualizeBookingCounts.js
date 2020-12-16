google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

var chart;

// get kullan
// veri transferini azalt (veriyi php tarafında düzenle)
// mümkünse dataToTable kullanma

function drawChart() {
    $.ajax({
        url: "/getWeeklyBookingDatas",
        dataType: "json",
        success: function(bookingCountsPerWeek) {
            var data = new google.visualization.DataTable();
            data.addColumn('date', 'Tarih');
            data.addColumn('number', 'Randevu Sayısı');
            data.addColumn('number', 'Ortalama Randevu Sayısı');

            bookingCountsPerWeek = bookingCountsPerWeek.map((item) => {
                item = [new Date(item[0]), item[1], item[2]];
                return item;
            });

            data.addRows(bookingCountsPerWeek);

            // Set chart options
            var options = {
                'title':'Randevu Sayısı',
                'width':1000,
                'height':300,
                hAxis: {
                    title: 'Tarih',
                    format: 'd/MM/Y',
                    titleTextStyle: {
                        color: '#0000',
                        bold: true,
                    },
                    slantedText: true,
                },
            };
        
            // Instantiate and draw our chart, passing in some options.
            chart = new google.visualization.LineChart(document.getElementById('daily_booking_datas'));
            chart.draw(data, options);
        },
    });
}

$(document).ready(function() {
    $("#weeklyData_btn").on("click", function() {
        $.ajax({
            url: "/getWeeklyBookingDatas",
            dataType: "json",
            success: function(bookingCountsPerWeek) {
                var data = new google.visualization.DataTable();
                data.addColumn('date', 'Tarih');
                data.addColumn('number', 'Randevu Sayısı');
                data.addColumn('number', 'Ortalama Randevu Sayısı');
    
                bookingCountsPerWeek = bookingCountsPerWeek.map((item) => {
                    item = [new Date(item[0]), item[1], item[2]];
                    return item;
                });

                data.addRows(bookingCountsPerWeek);

                // Set chart options
                var options = {
                    'title':'Randevu Sayısı',
                    'width':1000,
                    'height':300,
                    hAxis: {
                        title: 'Tarih',
                        format: 'd/MM/Y',
                        titleTextStyle: {
                            color: '#0000',
                            bold: true,
                        },
                        slantedText: true,
                    },
                };
            
                // Instantiate and draw our chart, passing in some options.
                chart = new google.visualization.LineChart(document.getElementById('daily_booking_datas'));
                chart.draw(data, options);
            },
        });     
    });

    $("#dailyData_btn").on("click", function() {
        $.ajax({
            url: "/getDailyBookingDatas",
            dataType: "json",
            success: function(bookingCountsPerDay) {
                var data = new google.visualization.DataTable();
                data.addColumn('date', 'Tarih');
                data.addColumn('number', 'Randevu Sayısı');
                data.addColumn('number', 'Ortalama Randevu Sayısı');
                    
                bookingCountsPerDay = bookingCountsPerDay.map((item) => {
                    item = [new Date(item[0]), item[1], item[2]];
                    return item;
                });
            
                data.addRows(bookingCountsPerDay);
            
                // Set chart options
                var options = {
                    'title':'Randevu Sayısı',
                    'width':1000,
                    'height':300,
                    hAxis: {
                        title: 'Tarih',
                        format: 'd/MM/Y',
                        titleTextStyle: {
                            color: '#0000',
                            bold: true,
                        },
                        slantedText: true,
                    },
                };
            
                // Instantiate and draw our chart, passing in some options.
                chart = new google.visualization.LineChart(document.getElementById('daily_booking_datas'));
                chart.draw(data, options);
            }
        });
    });

    $("#monthlyData_btn").on("click", function() {
        $.ajax({
            url: "/getMonthlyBookingDatas",
            dataType: "json",
            success: function(bookingCountPerMonth) {
                var data = new google.visualization.DataTable();
                data.addColumn('date', 'Tarih');
                data.addColumn('number', 'Randevu Sayısı');
                data.addColumn('number', 'Ortalama Randevu Sayısı');
    
                bookingCountPerMonth = bookingCountPerMonth.map((item) => {
                    item = [new Date(item[0]), item[1], item[2]];
                    return item;
                });

                data.addRows(bookingCountPerMonth);

                // Set chart options
                var options = {
                    'title':'Randevu Sayısı',
                    'width':1000,
                    'height':300,
                    hAxis: {
                        title: 'Tarih',
                        format: 'd/MM/Y',
                        titleTextStyle: {
                            color: '#0000',
                            bold: true,
                        },
                        slantedText: true,
                    },
                };
            
                // Instantiate and draw our chart, passing in some options.
                chart = new google.visualization.LineChart(document.getElementById('daily_booking_datas'));
                chart.draw(data, options);
            },
        });        
    });
});