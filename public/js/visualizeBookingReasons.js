google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

var chart;

function drawChart() {
    $.ajax({
        url: "/getBookingReasonsCountsLastTwentyWeeks",
        dataType: "json",
        success: function(bookingReasonsCounts) {
            var data = google.visualization.arrayToDataTable([
                ['Randevu Gerekçesi', 'Sayı'],
                ['Diş Ağrısı', bookingReasonsCounts[0]],
                ['Diş Estetiği', bookingReasonsCounts[1]],
                ['Diş Bakımı', bookingReasonsCounts[2]],
                ['Eksik Diş', bookingReasonsCounts[3]],
            ]);
        
            var options = {
                title: 'Randevu Alma Gerekçeleri (20 Haftalık Toplam Dağılım)',
                is3D: true,
            };
        
            chart = new google.visualization.PieChart(document.getElementById('bookingReasonsCounts'));
        
            chart.draw(data, options);
        },
    });
}

$(document).ready(function() {
    $("#weeklyData_btn").on("click", function() {
        $("#bookingReasonsCounts").show();
        $.ajax({
            url: "/getBookingReasonsCountsLastTwentyWeeks",
            dataType: "json",
            success: function(bookingReasonsCounts) {
                var data = google.visualization.arrayToDataTable([
                    ['Randevu Gerekçesi', 'Sayı'],
                    ['Diş Ağrısı', bookingReasonsCounts[0]],
                    ['Diş Estetiği', bookingReasonsCounts[1]],
                    ['Diş Bakımı', bookingReasonsCounts[2]],
                    ['Eksik Diş', bookingReasonsCounts[3]],
                ]);
            
                var options = {
                    title: 'Randevu Alma Gerekçeleri (20 Haftalık Toplam Dağılım)',
                    is3D: true,
                };
            
                chart = new google.visualization.PieChart(document.getElementById('bookingReasonsCounts'));
            
                chart.draw(data, options);
            },
        });
    });

    $("#dailyData_btn").on("click", function() {
        $("#bookingReasonsCounts").hide();
    });

    $("#monthlyData_btn").on("click", function() {
        $("#bookingReasonsCounts").show();
        $.ajax({
            url: "/getBookingReasonsCountsLastTenMonths",
            dataType: "json",
            success: function(bookingReasonsCounts) {
                var data = google.visualization.arrayToDataTable([
                    ['Randevu Gerekçesi', 'Sayı'],
                    ['Diş Ağrısı', bookingReasonsCounts[0]],
                    ['Diş Estetiği', bookingReasonsCounts[1]],
                    ['Diş Bakımı', bookingReasonsCounts[2]],
                    ['Eksik Diş', bookingReasonsCounts[3]],
                ]);
            
                var options = {
                    title: 'Randevu Alma Gerekçeleri (10 Aylık Toplam Dağılım)',
                    is3D: true,
                };
            
                chart = new google.visualization.PieChart(document.getElementById('bookingReasonsCounts'));
            
                chart.draw(data, options);
            },
        });
    });
});