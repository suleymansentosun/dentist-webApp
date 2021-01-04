google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);
let urlSegments = window.location.pathname.split("/");
let languageOfSite = urlSegments[1];

var chart;

function drawChart() {
    $.ajax({
        url: `/${languageOfSite}/getBookingReasonsCountsLastTwentyWeeks`,
        dataType: "json",
        success: function(bookingReasonsCounts) {
            switch (languageOfSite) {
                case 'tr':
                  var data = google.visualization.arrayToDataTable([
                      ['Randevu Gerekçesi', 'Sayı'],
                      ['Diş Ağrısı', bookingReasonsCounts[0]],
                      ['Diş Estetiği', bookingReasonsCounts[1]],
                      ['Diş Bakımı', bookingReasonsCounts[2]],
                      ['Eksik Diş', bookingReasonsCounts[3]],
                  ]);
                  break;
                case 'en':
                    var data = google.visualization.arrayToDataTable([
                        ['Randevu Gerekçesi', 'Sayı'],
                        ['Toothache', bookingReasonsCounts[0]],
                        ['Cosmetic Dentistry', bookingReasonsCounts[1]],
                        ['Dental Care', bookingReasonsCounts[2]],
                        ['Missing Teeth', bookingReasonsCounts[3]],
                    ]);
                    break;
                default:
                    var data = google.visualization.arrayToDataTable([
                        ['Randevu Gerekçesi', 'Sayı'],
                        ['Toothache', bookingReasonsCounts[0]],
                        ['Cosmetic Dentistry', bookingReasonsCounts[1]],
                        ['Dental Care', bookingReasonsCounts[2]],
                        ['Missing Teeth', bookingReasonsCounts[3]],
                    ]);
            }
        
            var options = {
                title: languageOfSite == 'tr' ? 
                'Randevu Alma Gerekçeleri (20 Haftalık Toplam Dağılım)'
                : languageOfSite == 'en' ? 
                'Reasons for appointment (Total distribution for 20 weeks)' : 
                'Reasons for appointment (Total distribution for 20 weeks)',
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
            url: `/${languageOfSite}/getBookingReasonsCountsLastTwentyWeeks`,
            dataType: "json",
            success: function(bookingReasonsCounts) {
                switch (languageOfSite) {
                    case 'tr':
                      var data = google.visualization.arrayToDataTable([
                          ['Randevu Gerekçesi', 'Sayı'],
                          ['Diş Ağrısı', bookingReasonsCounts[0]],
                          ['Diş Estetiği', bookingReasonsCounts[1]],
                          ['Diş Bakımı', bookingReasonsCounts[2]],
                          ['Eksik Diş', bookingReasonsCounts[3]],
                      ]);
                      break;
                    case 'en':
                        var data = google.visualization.arrayToDataTable([
                            ['Randevu Gerekçesi', 'Sayı'],
                            ['Toothache', bookingReasonsCounts[0]],
                            ['Cosmetic Dentistry', bookingReasonsCounts[1]],
                            ['Dental Care', bookingReasonsCounts[2]],
                            ['Missing Teeth', bookingReasonsCounts[3]],
                        ]);
                        break;
                    default:
                        var data = google.visualization.arrayToDataTable([
                            ['Randevu Gerekçesi', 'Sayı'],
                            ['Toothache', bookingReasonsCounts[0]],
                            ['Cosmetic Dentistry', bookingReasonsCounts[1]],
                            ['Dental Care', bookingReasonsCounts[2]],
                            ['Missing Teeth', bookingReasonsCounts[3]],
                        ]);
                }
            
                var options = {
                    title: languageOfSite == 'tr' ? 
                    'Randevu Alma Gerekçeleri (20 Haftalık Toplam Dağılım)'
                    : languageOfSite == 'en' ? 
                    'Reasons for appointment (Total distribution for 20 weeks)' : 
                    'Reasons for appointment (Total distribution for 20 weeks)',
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
            url: `/${languageOfSite}/getBookingReasonsCountsLastTenMonths`,
            dataType: "json",
            success: function(bookingReasonsCounts) {
                switch (languageOfSite) {
                    case 'tr':
                      var data = google.visualization.arrayToDataTable([
                          ['Randevu Gerekçesi', 'Sayı'],
                          ['Diş Ağrısı', bookingReasonsCounts[0]],
                          ['Diş Estetiği', bookingReasonsCounts[1]],
                          ['Diş Bakımı', bookingReasonsCounts[2]],
                          ['Eksik Diş', bookingReasonsCounts[3]],
                      ]);
                      break;
                    case 'en':
                        var data = google.visualization.arrayToDataTable([
                            ['Randevu Gerekçesi', 'Sayı'],
                            ['Toothache', bookingReasonsCounts[0]],
                            ['Cosmetic Dentistry', bookingReasonsCounts[1]],
                            ['Dental Care', bookingReasonsCounts[2]],
                            ['Missing Teeth', bookingReasonsCounts[3]],
                        ]);
                        break;
                    default:
                        var data = google.visualization.arrayToDataTable([
                            ['Randevu Gerekçesi', 'Sayı'],
                            ['Toothache', bookingReasonsCounts[0]],
                            ['Cosmetic Dentistry', bookingReasonsCounts[1]],
                            ['Dental Care', bookingReasonsCounts[2]],
                            ['Missing Teeth', bookingReasonsCounts[3]],
                        ]);
                }
            
                var options = {
                    title: languageOfSite == 'tr' ? 
                    'Randevu Alma Gerekçeleri (10 Aylık Toplam Dağılım)'
                    : languageOfSite == 'en' ? 
                    'Reasons for appointment (Total distribution for 10 months)' : 
                    'Reasons for appointment (Total distribution for 10 months)',
                    is3D: true,
                };
            
                chart = new google.visualization.PieChart(document.getElementById('bookingReasonsCounts'));
            
                chart.draw(data, options);
            },
        });
    });
});