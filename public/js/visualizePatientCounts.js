google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

var chart;

function drawChart() {
    $.ajax({
        url: "/getWeeklyPatientDatas",
        dataType: "json",
        success: function(patientCountPerWeek) {
            var data = new google.visualization.DataTable();
            data.addColumn('date', 'Tarih');
            data.addColumn('number', 'Hasta Sayısı');
            data.addColumn('number', 'Ortalama Hasta Sayısı');

            patientCountPerWeek = patientCountPerWeek.map((item) => {
                item = [new Date(item[0]), item[1], item[2]];
                return item;
            });

            data.addRows(patientCountPerWeek);

            // Set chart options
            var options = {
                'title':'Kazanılan Hasta Sayısı',
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
            chart = new google.visualization.LineChart(document.getElementById('daily_patient_datas'));
            chart.draw(data, options);
        },
    });    
}

$(document).ready(function() {
    $("#weeklyData_btn").on("click", function() {
        $.ajax({
            url: "/getWeeklyPatientDatas",
            dataType: "json",
            success: function(patientCountPerWeek) {
                var data = new google.visualization.DataTable();
                data.addColumn('date', 'Tarih');
                data.addColumn('number', 'Hasta Sayısı');
                data.addColumn('number', 'Ortalama Hasta Sayısı');
    
                patientCountPerWeek = patientCountPerWeek.map((item) => {
                    item = [new Date(item[0]), item[1], item[2]];
                    return item;
                });

                data.addRows(patientCountPerWeek);

                // Set chart options
                var options = {
                    'title':'Kazanılan Hasta Sayısı',
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
                chart = new google.visualization.LineChart(document.getElementById('daily_patient_datas'));
                chart.draw(data, options);
            },
        });        
    });

    $("#dailyData_btn").on("click", function() {
        $.ajax({
            url: "/getDailyPatientDatas",
            dataType: "json",
            success: function(patientCountsPerDate) {
                // Create our data table out of JSON data loaded from server.
                var data = new google.visualization.DataTable();
                data.addColumn('date', 'Tarih');
                data.addColumn('number', 'Hasta Sayısı');
                data.addColumn('number', 'Ortalama Hasta Sayısı');
    
                patientCountsPerDate = patientCountsPerDate.map((item) => {
                    item = [new Date(item[0]), item[1], item[2]];
                    return item;
                });
    
                data.addRows(patientCountsPerDate);
    
                // Set chart options
                var options = {
                    'title':'Kazanılan Hasta Sayısı',
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
                chart = new google.visualization.LineChart(document.getElementById('daily_patient_datas'));
                chart.draw(data, options);
            }
        });
    });

    $("#monthlyData_btn").on("click", function() {
        $.ajax({
            url: "/getMonthlyPatientDatas",
            dataType: "json",
            success: function(patientCountPerMonth) {
                var data = new google.visualization.DataTable();
                data.addColumn('date', 'Tarih');
                data.addColumn('number', 'Hasta Sayısı');
                data.addColumn('number', 'Ortalama Hasta Sayısı');
    
                patientCountPerMonth = patientCountPerMonth.map((item) => {
                    item = [new Date(item[0]), item[1], item[2]];
                    return item;
                });

                data.addRows(patientCountPerMonth);

                // Set chart options
                var options = {
                    'title':'Kazanılan Hasta Sayısı',
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
                chart = new google.visualization.LineChart(document.getElementById('daily_patient_datas'));
                chart.draw(data, options);
            },
        });        
    });
});