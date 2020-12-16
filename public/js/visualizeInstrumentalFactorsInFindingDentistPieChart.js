google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

var chart;

function drawChart() {
    $.ajax({
        url: "/getInstrumentalFactorsInFindingDentistLastTwentyWeeks",
        dataType: "json",
        success: function(instrumentalFactors) {
            var data = google.visualization.arrayToDataTable([
                ['Etken Faktör', 'Sayı'],
                ['Web Araması', instrumentalFactors[0]],
                ['Tavsiye', instrumentalFactors[1]],
                ['Sosyal Medya', instrumentalFactors[2]],
                ['Yer Yakınlığı', instrumentalFactors[3]],
            ]);
        
            var options = {
                title: 'Kliniğimizi Nasıl Keşfettiler (20 Haftalık Toplam Dağılım)',
                is3D: true,
            };
        
            chart = new google.visualization.PieChart(document.getElementById('instrumentalFactorsInFindingPieChart'));
        
            chart.draw(data, options);
        },
    });
}

$(document).ready(function() {
    $("#weeklyData_btn").on("click", function() {
        $("#instrumentalFactorsInFindingPieChart").show();
        $.ajax({
            url: "/getInstrumentalFactorsInFindingDentistLastTwentyWeeks",
            dataType: "json",
            success: function(instrumentalFactors) {
                var data = google.visualization.arrayToDataTable([
                    ['Etken Faktör', 'Sayı'],
                    ['Web Araması', instrumentalFactors[0]],
                    ['Tavsiye', instrumentalFactors[1]],
                    ['Sosyal Medya', instrumentalFactors[2]],
                    ['Yer Yakınlığı', instrumentalFactors[3]],
                ]);
            
                var options = {
                    title: 'Kliniğimizi Nasıl Keşfettiler (20 Haftalık Toplam Dağılım)',
                    is3D: true,
                };
            
                chart = new google.visualization.PieChart(document.getElementById('instrumentalFactorsInFindingPieChart'));
            
                chart.draw(data, options);
            },
        });
    });

    $("#dailyData_btn").on("click", function() {
        $("#instrumentalFactorsInFindingPieChart").hide();
    });

    $("#monthlyData_btn").on("click", function() {
        $("#instrumentalFactorsInFindingPieChart").show();
        $.ajax({
            url: "/getInstrumentalFactorsInFindingDentistLastTenMonths",
            dataType: "json",
            success: function(instrumentalFactors) {
                var data = google.visualization.arrayToDataTable([
                    ['Etken Faktör', 'Sayı'],
                    ['Web Araması', instrumentalFactors[0]],
                    ['Tavsiye', instrumentalFactors[1]],
                    ['Sosyal Medya', instrumentalFactors[2]],
                    ['Yer Yakınlığı', instrumentalFactors[3]],
                ]);
            
                var options = {
                    title: 'Kliniğimizi Nasıl Keşfettiler (10 Aylık Toplam Dağılım)',
                    is3D: true,
                };
            
                chart = new google.visualization.PieChart(document.getElementById('instrumentalFactorsInFindingPieChart'));
            
                chart.draw(data, options);
            },
        });
    });
});