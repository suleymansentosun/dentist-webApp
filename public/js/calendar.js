/*!
 * Author:  Mark Allan B. Meriales
 * Name:    Mark Your Calendar v0.0.1
 * License: MIT License
 */

(function($) {
    // https://stackoverflow.com/questions/563406/add-days-to-javascript-date
    Date.prototype.addDays = function(days) {
        var date = new Date(this.valueOf());
        date.setDate(date.getDate() + days);
        return date;
    }

    $.fn.markyourcalendar = function(opts) {
        var prevHtml = `
            <div id="myc-prev-week">
                <
            </div>
        `;
        var nextHtml = `<div id="myc-next-week">></div>`;
        var defaults = {
            availability: [[], [], [], [], [], [], []], // listahan ng mga oras na pwedeng piliin
            isMultiple: false,
            months: ['jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'dec'],
            prevHtml: prevHtml,
            nextHtml: nextHtml,
            selectedDates: [],
            startDate: new Date(),
            weekdays: ['sun', 'mon', 'tue', 'wed', 'thurs', 'fri', 'sat'],
        };
        var settings = $.extend({}, defaults, opts);
        var html = ``;

        var onClick = settings.onClick;
        var onClickNavigator = settings.onClickNavigator;
        var instance = this;

        // kuhanin ang buwan
        this.getMonthName = function(idx) {
            return settings.months[idx];
        };

        var formatDate = function(d) {
            var date = '' + d.getDate();
            var month = '' + (d.getMonth() + 1);
            var year = d.getFullYear();
            if (date.length < 2) {
                date = '0' + date;
            }
            if (month.length < 2) {
                month = '0' + month;
            }
            return year + '-' + month + '-' + date;
        };

        // Eto ang controller para lumipat ng linggo
        // Controller to change 
        this.getNavControl = function() {
            var previousWeekHtml = `<div id="myc-prev-week-container">` + settings.prevHtml + `</div>`;
            var nextWeekHtml = `<div id="myc-prev-week-container">` + settings.nextHtml + `</div>`;
            var monthYearHtml = `
                <div id="myc-current-month-year-container">
                    ` + this.getMonthName(settings.startDate.getMonth()) + ' ' + settings.startDate.getFullYear() + `
                </div>
            `;

            var navHtml = `
                <div id="myc-nav-container">                    
                    ` + monthYearHtml + `
                    ` + previousWeekHtml + `
                    ` + nextWeekHtml + `
                    <div style="clear:both;"></div>
                </div>
            `;
            return navHtml;
        };

        // kuhanin at ipakita ang mga araw
        this.getDatesHeader = function() {
            var tmp = ``;
            for (i = 0; i < 7; i++) {
                var d = settings.startDate.addDays(i);
                var monthNames = ["Ock", "Şbt", "Mrt", "Nis", "May", "Haz",
                "Tem", "Ağst", "Eyl", "Ekm", "Kas", "Arlk"
                ];
                tmp += `
                    <div class="myc-date-header" id="myc-date-header-` + i + `">
                        <div class="myc-date-number">` + settings.weekdays[d.getDay()] + `</div>
                        <div class="myc-date-display">` + d.getDate() + ' ' + monthNames[d.getMonth()] + `</div>
                        <div class="dateInfo" style="display:none;">` + d + `</div>
                    </div>
                `;
            }
            var ret = `<div id="myc-dates-container">` + tmp + `</div>`;
            return ret;
        }

        // kuhanin ang mga pwedeng oras sa bawat araw ng kasalukuyang linggo
        this.getAvailableTimes = function() {
            var tmp = ``;
            for (i = 0; i < 7; i++) {
                var tmpAvailTimes = ``;
                $.each(settings.availability[i], function(index) {
                        var tmpAvailTimesForOneDoctor = ``;
                        var doctorInfoForSmallScreen = `<div class="doctorInfoForSmallScreen${index}"></div>`;

                        $.each(settings.availability[i][index], function() {
                            tmpAvailTimesForOneDoctor += `                                
                                    <a href="javascript:;" class="myc-available-time" data-time="` + this + `" data-date="` + formatDate(settings.startDate.addDays(i)) + `">
                                    ` + this + `
                                    </a>    
                            `;
                        });
                        tmpAvailTimes += `
                            <div class="myc-available-time-for-one-doctor" id="myc-available-time-for-doctor-` + i + index + `">
                                ` + doctorInfoForSmallScreen + tmpAvailTimesForOneDoctor + `
                            </div>
                        `;                   
                });
                tmp += `
                    <div class="myc-day-time-container" id="myc-day-time-container-` + i + `">
                        ` + tmpAvailTimes + `
                        <div style="clear:both;"></div>
                    </div>
                `;
            }
            return tmp;
        }

        // i-set ang mga oras na pwedeng ilaan
        this.setAvailability = function(arr) {
            settings.availability = arr;
            render();
        }

        // clear
        this.clearAvailability = function() {
            settings.availability = [[], [], [], [], [], [], []];
        }

        // pag napindot ang nakaraang linggo
        this.on('click', '#myc-prev-week', function() {
            var startDate = new Date(settings.startDate);
            var today = new Date(Date.now());
            if (startDate.getDate() + '.' + startDate.getMonth() + '.' + startDate.getFullYear() ===
            today.getDate() + '.' + today.getMonth() + '.' + today.getFullYear()) {
                return;
            }

            settings.startDate = settings.startDate.addDays(-7);
            instance.clearAvailability();
            render(instance);

            if ($.isFunction(onClickNavigator)) {
                onClickNavigator.call(this, ...arguments, instance);
            }
        });

        // pag napindot ang susunod na linggo
        this.on('click', '#myc-next-week', function() {
            settings.startDate = settings.startDate.addDays(7);
            instance.clearAvailability();
            render(instance);

            if ($.isFunction(onClickNavigator)) {
                onClickNavigator.call(this, ...arguments, instance);
            }
        });

        $('#firstStageBooking').on('hidden.bs.modal', function (e) {
            if (document.getElementById('booking_date_field')) {
                settings.startDate = new Date(document.getElementById('booking_date_field').value);
            } else {
                settings.startDate = new Date();
            }            
        });

        // pag namili ng oras
        this.on('click', '.myc-available-time', function() {
            var date = $(this).data('date');
            var time = $(this).data('time');
            var tmp = date + ' ' + time;
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
                var idx = settings.selectedDates.indexOf(tmp);
                if (idx !== -1) {
                    settings.selectedDates.splice(idx, 1);
                }
            } else {
                if (settings.isMultiple) {
                    $(this).addClass('selected');
                    settings.selectedDates.push(tmp);
                } else {
                    settings.selectedDates.pop();
                    if (!settings.selectedDates.length) {
                        $('.myc-available-time').removeClass('selected');
                        $(this).addClass('selected');
                        settings.selectedDates.push(tmp);
                    }
                }
            }
            if ($.isFunction(onClick)) {
                onClick.call(this, ...arguments, settings.selectedDates);
            }
        });

        var render = function() {
            ret = `
                <div id="myc-container">
                    <div id="myc-nav-container">` + instance.getNavControl() + `</div>
                    <div id="myc-week-container">
                        <div id="myc-dates-container">` + instance.getDatesHeader() + `</div>
                        <hr id="separating_from_date_line">
                        <div id="myc-available-time-container">` + instance.getAvailableTimes() + `</div>
                    </div>
                </div>
            `;
            instance.html(ret);
        };

        render();
    };
})(jQuery);