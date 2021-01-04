google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawMultSeries);
currentUrl = window.location.href;
languageOfSite = currentUrl.slice(20, 22);

var chart;

function drawMultSeries() {
    $.ajax({
        url: `/${languageOfSite}/getBookingPatientCountsBelongToDoctorsLastTwentyWeeks`,
        dataType: "json",
        success: function(bookingPatientCountsBelongToDoctors) {
          switch (languageOfSite) {
            case 'tr':
              bookingPatientCountsBelongToDoctors.unshift(['Doktor', 'Randevu Sayısı', 'Hasta Sayısı']);
              break;
            case 'en':
              bookingPatientCountsBelongToDoctors.unshift(['Doctor', 'Booking Count', 'Patient Count']);
              break;
            default:
              bookingPatientCountsBelongToDoctors.unshift(['Doctor', 'Booking Count', 'Patient Count']);
        }
          
          var data = google.visualization.arrayToDataTable(bookingPatientCountsBelongToDoctors);

          var options = {
            title: languageOfSite == 'tr' ? 
            'Doktorların Baktıkları Randevu ve Hasta Sayıları (20 Haftalık)'
            : languageOfSite == 'en' ? 
            'The number of patients treated by doctors and the number of appointments they had (Based on 20 weeks)' : 
            'The number of patients treated by doctors and the number of appointments they had (Based on 20 weeks)',
            chartArea: {width: '50%'},
            hAxis: {
              title: languageOfSite == 'tr' ? 
              'Toplam Sayı'
              : languageOfSite == 'en' ? 
              'Total Count' : 
              'Total Count',
              minValue: 0,
            },
            vAxis: {
              title: languageOfSite == 'tr' ? 
              'Doktor Adı'
              : languageOfSite == 'en' ? 
              'Doctor Name' : 
              'Doctor Name',
            }
          };

          chart = new google.visualization.BarChart(document.getElementById('bookingPatientCountsBelongToDoctors'));
          chart.draw(data, options);
        },
    });
}

$(document).ready(function() {  
  $("#weeklyData_btn").on("click", function() {
      $("#bookingPatientCountsBelongToDoctors").show();
      $.ajax({
        url: `/${languageOfSite}/getBookingPatientCountsBelongToDoctorsLastTwentyWeeks`,
        dataType: "json",
        success: function(bookingPatientCountsBelongToDoctors) {
          bookingPatientCountsBelongToDoctors.unshift(['Doktor', 'Randevu Sayısı', 'Hasta Sayısı']);

          var data = google.visualization.arrayToDataTable(bookingPatientCountsBelongToDoctors);

          var options = {
            title: 'Doktorların Baktıkları Randevu ve Hasta Sayıları (İşe Başladıkları Tarihten İtibaren)',
            chartArea: {width: '50%'},
            hAxis: {
              title: languageOfSite == 'tr' ? 
              'Toplam Sayı'
              : languageOfSite == 'en' ? 
              'Total Count' : 
              'Total Count',
              minValue: 0,
            },
            vAxis: {
              title: languageOfSite == 'tr' ? 
              'Doktor Adı'
              : languageOfSite == 'en' ? 
              'Doctor Name' : 
              'Doctor Name',
            }
          };

          chart = new google.visualization.BarChart(document.getElementById('bookingPatientCountsBelongToDoctors'));
          chart.draw(data, options);
        },
      });    
  });

  $("#dailyData_btn").on("click", function() {
    $("#bookingPatientCountsBelongToDoctors").hide();
  });

  $("#monthlyData_btn").on("click", function() {
    $("#bookingPatientCountsBelongToDoctors").hide();
  });
});