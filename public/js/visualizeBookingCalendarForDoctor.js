google.charts.load('current', {packages:['calendar']});
google.charts.setOnLoadCallback(drawChart);
let currentUrl = window.location.href;
let languageOfSite = currentUrl.slice(20, 22);

function drawChart() {
    $.ajax({
        url: `/${languageOfSite}/getBookingCalendarForDoctor`,
        dataType: "json",
        success: function(bookingCalendarDatasForDoctor) {
            var dataTable = new google.visualization.DataTable();
            dataTable.addColumn({ type: 'date', id: 'Date' });
            dataTable.addColumn({ type: 'number', id: 'bookingCounts' });
            dataTable.addColumn({'type': 'string', 'role': 'tooltip', 'p': {'html': true}});

            bookingCalendarDatasForDoctor = bookingCalendarDatasForDoctor.map((item) => {
                item = [new Date(item[0]), item[1], item[2]];
                return item;
            });

            dataTable.addRows(bookingCalendarDatasForDoctor);
        
            var chart = new google.visualization.Calendar(document.getElementById('booking_calendar_doctor'));
        
            var options = {
              focusTarget: 'category',
              tooltip: { isHtml: true },
            };
        
            chart.draw(dataTable, options);
        },
    });
}