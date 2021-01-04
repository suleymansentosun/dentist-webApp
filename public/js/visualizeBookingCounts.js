google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);
currentUrl = window.location.href;
languageOfSite = currentUrl.slice(20, 22);

var chart;

function drawChart() {
    $.ajax({
        url: `/${languageOfSite}/getWeeklyBookingDatas`,
        dataType: "json",
        success: function(bookingCountsPerWeek) {
            var data = new google.visualization.DataTable();
            switch (languageOfSite) {
                case 'tr':
                  data.addColumn('date', 'Tarih');
                  data.addColumn('number', 'Randevu Sayısı');
                  data.addColumn('number', 'Ortalama Randevu Sayısı');
                  break;
                case 'en':
                  data.addColumn('date', 'Date');
                  data.addColumn('number', 'Booking Count');
                  data.addColumn('number', 'Average number of appointments');
                  break;
                default:
                  data.addColumn('date', 'Date');
                  data.addColumn('number', 'Booking Count');
                  data.addColumn('number', 'Average number of appointments');
            }

            bookingCountsPerWeek = bookingCountsPerWeek.map((item) => {
                item = [new Date(item[0]), item[1], item[2]];
                return item;
            });

            data.addRows(bookingCountsPerWeek);

            // Set chart options
            var options = {
                'title': languageOfSite == 'tr' ? 'Randevu Sayısı' : languageOfSite == 'en' ? 'Booking Count' : 'Booking Count',
                'width':1000,
                'height':300,
                hAxis: {
                    title: languageOfSite == 'tr' ? 'Tarih' : languageOfSite == 'en' ? 'Date' : 'Date',
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
            url: `/${languageOfSite}/getWeeklyBookingDatas`,
            dataType: "json",
            success: function(bookingCountsPerWeek) {
                var data = new google.visualization.DataTable();
                switch (languageOfSite) {
                    case 'tr':
                      data.addColumn('date', 'Tarih');
                      data.addColumn('number', 'Randevu Sayısı');
                      data.addColumn('number', 'Ortalama Randevu Sayısı');
                      break;
                    case 'en':
                      data.addColumn('date', 'Date');
                      data.addColumn('number', 'Booking Count');
                      data.addColumn('number', 'Average number of appointments');
                      break;
                    default:
                      data.addColumn('date', 'Date');
                      data.addColumn('number', 'Booking Count');
                      data.addColumn('number', 'Average number of appointments');
                }
    
                bookingCountsPerWeek = bookingCountsPerWeek.map((item) => {
                    item = [new Date(item[0]), item[1], item[2]];
                    return item;
                });

                data.addRows(bookingCountsPerWeek);

                // Set chart options
                var options = {
                    'title': languageOfSite == 'tr' ? 'Randevu Sayısı' : languageOfSite == 'en' ? 'Booking Count' : 'Booking Count',
                    'width':1000,
                    'height':300,
                    hAxis: {
                        title: languageOfSite == 'tr' ? 'Tarih' : languageOfSite == 'en' ? 'Date' : 'Date',
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
            url: `/${languageOfSite}/getDailyBookingDatas`,
            dataType: "json",
            success: function(bookingCountsPerDay) {
                var data = new google.visualization.DataTable();
                switch (languageOfSite) {
                    case 'tr':
                      data.addColumn('date', 'Tarih');
                      data.addColumn('number', 'Randevu Sayısı');
                      data.addColumn('number', 'Ortalama Randevu Sayısı');
                      break;
                    case 'en':
                      data.addColumn('date', 'Date');
                      data.addColumn('number', 'Booking Count');
                      data.addColumn('number', 'Average number of appointments');
                      break;
                    default:
                      data.addColumn('date', 'Date');
                      data.addColumn('number', 'Booking Count');
                      data.addColumn('number', 'Average number of appointments');
                }
                    
                bookingCountsPerDay = bookingCountsPerDay.map((item) => {
                    item = [new Date(item[0]), item[1], item[2]];
                    return item;
                });
            
                data.addRows(bookingCountsPerDay);
            
                // Set chart options
                var options = {
                    'title': languageOfSite == 'tr' ? 'Randevu Sayısı' : languageOfSite == 'en' ? 'Booking Count' : 'Booking Count',
                    'width':1000,
                    'height':300,
                    hAxis: {
                        title: languageOfSite == 'tr' ? 'Tarih' : languageOfSite == 'en' ? 'Date' : 'Date',
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
            url: `/${languageOfSite}/getMonthlyBookingDatas`,
            dataType: "json",
            success: function(bookingCountPerMonth) {
                var data = new google.visualization.DataTable();
                switch (languageOfSite) {
                    case 'tr':
                      data.addColumn('date', 'Tarih');
                      data.addColumn('number', 'Randevu Sayısı');
                      data.addColumn('number', 'Ortalama Randevu Sayısı');
                      break;
                    case 'en':
                      data.addColumn('date', 'Date');
                      data.addColumn('number', 'Booking Count');
                      data.addColumn('number', 'Average number of appointments');
                      break;
                    default:
                      data.addColumn('date', 'Date');
                      data.addColumn('number', 'Booking Count');
                      data.addColumn('number', 'Average number of appointments');
                }
    
                bookingCountPerMonth = bookingCountPerMonth.map((item) => {
                    item = [new Date(item[0]), item[1], item[2]];
                    return item;
                });

                data.addRows(bookingCountPerMonth);

                // Set chart options
                var options = {
                    'title': languageOfSite == 'tr' ? 'Randevu Sayısı' : languageOfSite == 'en' ? 'Booking Count' : 'Booking Count',
                    'width':1000,
                    'height':300,
                    hAxis: {
                        title: languageOfSite == 'tr' ? 'Tarih' : languageOfSite == 'en' ? 'Date' : 'Date',
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