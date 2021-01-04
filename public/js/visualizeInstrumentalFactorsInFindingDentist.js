google.charts.load("current", {packages:['bar']});
google.charts.setOnLoadCallback(drawChart);
currentUrl = window.location.href;
languageOfSite = currentUrl.slice(20, 22);

var chart;

function drawChart() {
    $.ajax({
        url: `/${languageOfSite}/getWeeklyInstrumentalFactorsInFindingDentist`,
        dataType: "json",
        success: function(instrumentalFactorCountsPerWeek) {
            var data = new google.visualization.DataTable();
            switch (languageOfSite) {
                case 'tr':
                  data.addColumn('date', 'Tarih');
                  data.addColumn('number', 'Web Araması');
                  data.addColumn('number', 'Tavsiye');
                  data.addColumn('number', 'Sosyal Medya');
                  data.addColumn('number', 'Yer Yakınlığı');
                case 'en':
                  data.addColumn('date', 'Date');
                  data.addColumn('number', 'Web Search');
                  data.addColumn('number', 'Advice');
                  data.addColumn('number', 'Social Media');
                  data.addColumn('number', 'Neighbour');
                  break;
                default:
                  data.addColumn('date', 'Date');
                  data.addColumn('number', 'Web Search');
                  data.addColumn('number', 'Advice');
                  data.addColumn('number', 'Social Media');
                  data.addColumn('number', 'Neighbour');
            }

            instrumentalFactorCountsPerWeek = instrumentalFactorCountsPerWeek.map((item) => {
                item = [new Date(item[0]), {v: item[1][1], f: `${item[1][1]} (${item[1][0]}%)`}, {v: item[2][1], f: `${item[2][1]} (${item[2][0]}%)`}, 
                {v: item[3][1], f: `${item[3][1]} (${item[3][0]}%)`}, {v: item[4][1], f: `${item[4][1]} (${item[4][0]}%)`}];
                return item;
            });

            data.addRows(instrumentalFactorCountsPerWeek);

            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1, 2, 3, 4]);

            // Set chart options
            var options = {
                title: languageOfSite == 'tr' ? 
                'Kliniğimizi Nasıl Keşfettiler (Haftalık Bazda Dağılım)' 
                : languageOfSite == 'en' ? 
                'What are the effective factors in finding our hospital? (Distribution on a weekly basis)' : 
                'What are the effective factors in finding our hospital? (Distribution on a weekly basis)',
                titleTextStyle: {
                    color: 'black',
                    fontSize: 14,
                    bold: true,
                    italic: true,
                },
                hAxis: {
                    textStyle: {
                        color: 'black',
                        fontSize: 14,
                        bold: true,
                        italic: true,
                    }
                },
                vAxis: {
                    textStyle: {
                        color: 'black',
                        fontSize: 14,
                        bold: true,
                    }
                },
                height: 300,
                isStacked: false,
                series: {
                    0:{color:'#3366CC'},
                    1:{color:'#DC3912'},
                    2:{color:'#FF9900'},
                    3:{color:'#109618'},
                },
                focusTarget: 'category',
            };
        
            // Instantiate and draw our chart, passing in some options.
            chart = new google.charts.Bar(document.getElementById('instrumentalFactorsInFinding'));
            chart.draw(view, google.charts.Bar.convertOptions(options));
        },
    });   
}

$(document).ready(function() {
    $("#weeklyData_btn").on("click", function() {
        $("#instrumentalFactorsInFinding").show();
        $.ajax({
            url: `/${languageOfSite}/getWeeklyInstrumentalFactorsInFindingDentist`,
            dataType: "json",
            success: function(instrumentalFactorCountsPerWeek) {
                var data = new google.visualization.DataTable();
                switch (languageOfSite) {
                    case 'tr':
                      data.addColumn('date', 'Tarih');
                      data.addColumn('number', 'Web Araması');
                      data.addColumn('number', 'Tavsiye');
                      data.addColumn('number', 'Sosyal Medya');
                      data.addColumn('number', 'Yer Yakınlığı');
                    case 'en':
                      data.addColumn('date', 'Date');
                      data.addColumn('number', 'Web Search');
                      data.addColumn('number', 'Advice');
                      data.addColumn('number', 'Social Media');
                      data.addColumn('number', 'Neighbour');
                      break;
                    default:
                      data.addColumn('date', 'Date');
                      data.addColumn('number', 'Web Search');
                      data.addColumn('number', 'Advice');
                      data.addColumn('number', 'Social Media');
                      data.addColumn('number', 'Neighbour');
                }
    
                instrumentalFactorCountsPerWeek = instrumentalFactorCountsPerWeek.map((item) => {
                    item = [new Date(item[0]), {v: item[1][1], f: `${item[1][1]} (${item[1][0]}%)`}, {v: item[2][1], f: `${item[2][1]} (${item[2][0]}%)`}, 
                    {v: item[3][1], f: `${item[3][1]} (${item[3][0]}%)`}, {v: item[4][1], f: `${item[4][1]} (${item[4][0]}%)`}];
                    return item;
                });
    
                data.addRows(instrumentalFactorCountsPerWeek);
    
                var view = new google.visualization.DataView(data);
                view.setColumns([0, 1, 2, 3, 4]);
    
                // Set chart options
                var options = {
                    title: languageOfSite == 'tr' ? 
                    'Kliniğimizi Nasıl Keşfettiler (Haftalık Bazda Dağılım)' 
                    : languageOfSite == 'en' ? 
                    'What are the effective factors in finding our hospital? (Distribution on a weekly basis)' : 
                    'What are the effective factors in finding our hospital? (Distribution on a weekly basis)',
                    titleTextStyle: {
                        color: 'black',
                        fontSize: 14,
                        bold: true,
                        italic: true,
                    },
                    hAxis: {
                        textStyle: {
                            color: 'black',
                            fontSize: 14,
                            bold: true,
                            italic: true,
                        }
                    },
                    vAxis: {
                        textStyle: {
                            color: 'black',
                            fontSize: 14,
                            bold: true,
                        }
                    },
                    height: 300,
                    isStacked: false,
                    series: {
                        0:{color:'#3366CC'},
                        1:{color:'#DC3912'},
                        2:{color:'#FF9900'},
                        3:{color:'#109618'},
                    },
                    focusTarget: 'category',
                };
    
    
            
                // Instantiate and draw our chart, passing in some options.
                chart = new google.charts.Bar(document.getElementById('instrumentalFactorsInFinding'));
                chart.draw(view, google.charts.Bar.convertOptions(options));
            },
        });
    });

    $("#dailyData_btn").on("click", function() {
        $("#instrumentalFactorsInFinding").html("");
    });

    $("#monthlyData_btn").on("click", function() {
        $.ajax({
            url: `/${languageOfSite}/getMonthlyInstrumentalFactorsInFindingDentist`,
            dataType: "json",
            success: function(instrumentalFactorCountsPerMonth) {
                var data = new google.visualization.DataTable();
                switch (languageOfSite) {
                    case 'tr':
                      data.addColumn('date', 'Tarih');
                      data.addColumn('number', 'Web Araması');
                      data.addColumn('number', 'Tavsiye');
                      data.addColumn('number', 'Sosyal Medya');
                      data.addColumn('number', 'Yer Yakınlığı');
                    case 'en':
                      data.addColumn('date', 'Date');
                      data.addColumn('number', 'Web Search');
                      data.addColumn('number', 'Advice');
                      data.addColumn('number', 'Social Media');
                      data.addColumn('number', 'Neighbour');
                      break;
                    default:
                      data.addColumn('date', 'Date');
                      data.addColumn('number', 'Web Search');
                      data.addColumn('number', 'Advice');
                      data.addColumn('number', 'Social Media');
                      data.addColumn('number', 'Neighbour');
                }
    
                instrumentalFactorCountsPerMonth = instrumentalFactorCountsPerMonth.map((item) => {
                    item = [new Date(item[0]), {v: item[1][1], f: `${item[1][1]} (${item[1][0]}%)`}, {v: item[2][1], f: `${item[2][1]} (${item[2][0]}%)`}, 
                    {v: item[3][1], f: `${item[3][1]} (${item[3][0]}%)`}, {v: item[4][1], f: `${item[4][1]} (${item[4][0]}%)`}];
                    return item;
                });
    
                data.addRows(instrumentalFactorCountsPerMonth);
    
                var view = new google.visualization.DataView(data);
                view.setColumns([0, 1, 2, 3, 4]);
    
                // Set chart options
                var options = {
                    title: languageOfSite == 'tr' ? 
                    'Kliniğimizi Nasıl Keşfettiler (Aylık Bazda Dağılım)' 
                    : languageOfSite == 'en' ? 
                    'What are the effective factors in finding our hospital? (Distribution on a monthly basis)' : 
                    'What are the effective factors in finding our hospital? (Distribution on a monthly basis)',
                    titleTextStyle: {
                        color: 'black',
                        fontSize: 14,
                        bold: true,
                        italic: true,
                    },
                    hAxis: {
                        textStyle: {
                            color: 'black',
                            fontSize: 14,
                            bold: true,
                            italic: true,
                        }
                    },
                    vAxis: {
                        textStyle: {
                            color: 'black',
                            fontSize: 14,
                            bold: true,
                        }
                    },
                    height: 300,
                    isStacked: false,
                    series: {
                        0:{color:'#3366CC'},
                        1:{color:'#DC3912'},
                        2:{color:'#FF9900'},
                        3:{color:'#109618'},
                    },
                    focusTarget: 'category',
                };
    
    
            
                // Instantiate and draw our chart, passing in some options.
                chart = new google.charts.Bar(document.getElementById('instrumentalFactorsInFinding'));
                chart.draw(view, google.charts.Bar.convertOptions(options));
            },
        });
    });
});