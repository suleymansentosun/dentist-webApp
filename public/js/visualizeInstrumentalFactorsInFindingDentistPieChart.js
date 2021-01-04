google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);
currentUrl = window.location.href;
languageOfSite = currentUrl.slice(20, 22);

var chart;

function drawChart() {
    $.ajax({
        url: `/${languageOfSite}/getInstrumentalFactorsInFindingDentistLastTwentyWeeks`,
        dataType: "json",
        success: function(instrumentalFactors) {
            switch (languageOfSite) {
                case 'tr':
                  var data = google.visualization.arrayToDataTable([
                      ['Etken Faktör', 'Sayı'],
                      ['Web Araması', instrumentalFactors[0]],
                      ['Tavsiye', instrumentalFactors[1]],
                      ['Sosyal Medya', instrumentalFactors[2]],
                      ['Yer Yakınlığı', instrumentalFactors[3]],
                  ]);
                  break;
                case 'en':
                    var data = google.visualization.arrayToDataTable([
                        ['Etken Faktör', 'Sayı'],
                        ['Web Search', instrumentalFactors[0]],
                        ['Advice', instrumentalFactors[1]],
                        ['Social Media', instrumentalFactors[2]],
                        ['Neighbour', instrumentalFactors[3]],
                    ]);
                    break;
                default:
                    var data = google.visualization.arrayToDataTable([
                        ['Etken Faktör', 'Sayı'],
                        ['Web Search', instrumentalFactors[0]],
                        ['Advice', instrumentalFactors[1]],
                        ['Social Media', instrumentalFactors[2]],
                        ['Neighbour', instrumentalFactors[3]],
                    ]);
            }
                    
            var options = {
                title: languageOfSite == 'tr' ? 
                'Kliniğimizi Nasıl Keşfettiler (Haftalık Bazda Dağılım)' 
                : languageOfSite == 'en' ? 
                'What are the effective factors in finding our hospital? (Distribution on a weekly basis)' : 
                'What are the effective factors in finding our hospital? (Distribution on a weekly basis)',
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
            url: `/${languageOfSite}/getInstrumentalFactorsInFindingDentistLastTwentyWeeks`,
            dataType: "json",
            success: function(instrumentalFactors) {
                switch (languageOfSite) {
                    case 'tr':
                      var data = google.visualization.arrayToDataTable([
                          ['Etken Faktör', 'Sayı'],
                          ['Web Araması', instrumentalFactors[0]],
                          ['Tavsiye', instrumentalFactors[1]],
                          ['Sosyal Medya', instrumentalFactors[2]],
                          ['Yer Yakınlığı', instrumentalFactors[3]],
                      ]);
                      break;
                    case 'en':
                        var data = google.visualization.arrayToDataTable([
                            ['Etken Faktör', 'Sayı'],
                            ['Web Search', instrumentalFactors[0]],
                            ['Advice', instrumentalFactors[1]],
                            ['Social Media', instrumentalFactors[2]],
                            ['Neighbour', instrumentalFactors[3]],
                        ]);
                        break;
                    default:
                        var data = google.visualization.arrayToDataTable([
                            ['Etken Faktör', 'Sayı'],
                            ['Web Search', instrumentalFactors[0]],
                            ['Advice', instrumentalFactors[1]],
                            ['Social Media', instrumentalFactors[2]],
                            ['Neighbour', instrumentalFactors[3]],
                        ]);
                }
            
                var options = {
                    title: languageOfSite == 'tr' ? 
                    'Kliniğimizi Nasıl Keşfettiler (Haftalık Bazda Dağılım)' 
                    : languageOfSite == 'en' ? 
                    'What are the effective factors in finding our hospital? (Distribution on a weekly basis)' : 
                    'What are the effective factors in finding our hospital? (Distribution on a weekly basis)',
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
            url: `/${languageOfSite}/getInstrumentalFactorsInFindingDentistLastTenMonths`,
            dataType: "json",
            success: function(instrumentalFactors) {
                switch (languageOfSite) {
                    case 'tr':
                      var data = google.visualization.arrayToDataTable([
                          ['Etken Faktör', 'Sayı'],
                          ['Web Araması', instrumentalFactors[0]],
                          ['Tavsiye', instrumentalFactors[1]],
                          ['Sosyal Medya', instrumentalFactors[2]],
                          ['Yer Yakınlığı', instrumentalFactors[3]],
                      ]);
                      break;
                    case 'en':
                        var data = google.visualization.arrayToDataTable([
                            ['Etken Faktör', 'Sayı'],
                            ['Web Search', instrumentalFactors[0]],
                            ['Advice', instrumentalFactors[1]],
                            ['Social Media', instrumentalFactors[2]],
                            ['Neighbour', instrumentalFactors[3]],
                        ]);
                        break;
                    default:
                        var data = google.visualization.arrayToDataTable([
                            ['Etken Faktör', 'Sayı'],
                            ['Web Search', instrumentalFactors[0]],
                            ['Advice', instrumentalFactors[1]],
                            ['Social Media', instrumentalFactors[2]],
                            ['Neighbour', instrumentalFactors[3]],
                        ]);
                }
            
                var options = {
                    title: languageOfSite == 'tr' ? 
                    'Kliniğimizi Nasıl Keşfettiler (Aylık Bazda Dağılım)' 
                    : languageOfSite == 'en' ? 
                    'What are the effective factors in finding our hospital? (Distribution on a monthly basis)' : 
                    'What are the effective factors in finding our hospital? (Distribution on a monthly basis)',
                    is3D: true,
                };
            
                chart = new google.visualization.PieChart(document.getElementById('instrumentalFactorsInFindingPieChart'));
            
                chart.draw(data, options);
            },
        });
    });
});