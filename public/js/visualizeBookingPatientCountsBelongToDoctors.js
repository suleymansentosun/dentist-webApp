google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawMultSeries);

var chart;

function drawMultSeries() {
    $.ajax({
        url: "/getBookingPatientCountsBelongToDoctorsLastTwentyWeeks",
        dataType: "json",
        success: function(bookingPatientCountsBelongToDoctors) {
          bookingPatientCountsBelongToDoctors.unshift(['Doktor', 'Randevu Sayısı', 'Hasta Sayısı']);

          var data = google.visualization.arrayToDataTable(bookingPatientCountsBelongToDoctors);

          var options = {
            title: 'Doktorların Baktıkları Randevu ve Hasta Sayıları (İşe Başladıkları Tarihten İtibaren)',
            chartArea: {width: '50%'},
            hAxis: {
              title: 'Toplam Sayı',
              minValue: 0,
            },
            vAxis: {
              title: 'Doktor Adı'
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
        url: "/getBookingPatientCountsBelongToDoctorsLastTwentyWeeks",
        dataType: "json",
        success: function(bookingPatientCountsBelongToDoctors) {
          bookingPatientCountsBelongToDoctors.unshift(['Doktor', 'Randevu Sayısı', 'Hasta Sayısı']);

          var data = google.visualization.arrayToDataTable(bookingPatientCountsBelongToDoctors);

          var options = {
            title: 'Doktorların Baktıkları Randevu ve Hasta Sayıları (İşe Başladıkları Tarihten İtibaren)',
            chartArea: {width: '50%'},
            hAxis: {
              title: 'Toplam Sayı',
              minValue: 0,
            },
            vAxis: {
              title: 'Doktor Adı'
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
      $("#bookingPatientCountsBelongToDoctors").show();
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