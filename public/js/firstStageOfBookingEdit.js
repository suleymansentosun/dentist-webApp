let bookingReasons;
let selectedBookingReasonId;
let currentDatesOnBookingCalendar = [];
let doctorInfos;
let relatedDoctorsListElement = document.getElementById('relatedDoctorInfos');
let availableBookingsForRelatedDoctors = [];
let doctorIds = [];
let currentUrl = window.location.href;
let languageOfSite = currentUrl.slice(20, 22);

function getAllBookingReasons() {
    let xhr = new XMLHttpRequest();

    xhr.open("GET", `/${languageOfSite}` + '/getAllBookingReasonsForFirstStageOfBooking');

    xhr.responseType = 'json';

    xhr.send();

    xhr.onload = function() {
        bookingReasons = xhr.response;
    }
}

function getCurrentDatesOnCalendar() {
    currentDatesOnBookingCalendar = [];
    let elementsGiveDateInfo = document.getElementsByClassName('dateInfo');

    for (let element of elementsGiveDateInfo) {
        let date = new Date(Date.parse(element.innerHTML));
        let formattedDate = date.getFullYear() + '-' + (date.getMonth()+1) + '-' + date.getDate();

        currentDatesOnBookingCalendar.push(formattedDate);        
    }
    
    return currentDatesOnBookingCalendar;
}

function getRelatedDoctorInfos(selectedBookingReasonId, doctorIdToBeViewedAtTheTop = 0) {
    if (selectedBookingReasonId == "0") {
        return;
    }
    let xhr = new XMLHttpRequest();

    xhr.open("GET", `/${languageOfSite}/getRelatedDoctorInfos/${selectedBookingReasonId}/${doctorIdToBeViewedAtTheTop}`);

    xhr.responseType = 'json';

    xhr.send();

    //c6c2c2

    xhr.onload = function() {
        relatedDoctorsListElement.innerHTML = '';
        doctorInfos = xhr.response;
        if (currentDatesOnBookingCalendar.length != 0 && languageOfSite == 'tr') {
            doctorInfos.forEach(item => {            
                relatedDoctorsListElement.insertAdjacentHTML("beforeend",`
                    <li class="list-group-item">
                        <div class="card" id="doctor_card" style="max-width: 540px;">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="${urlStorageFile}${item.profile_picture}" class="card-img" alt="Dr. ${item.name} ${item.surname}">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                    <h5 class="card-title" style="color:#375272; font-weight:600;"><strength>Dr. ${item.name} ${item.surname}</strength></h5>
                                    <p class="card-text"><span style="color:#375272; font-weight:600;">Uzmanlık Alanları: </span>${item.specialties}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                `);
            });
        } else {
            doctorInfos.forEach(item => {            
                relatedDoctorsListElement.insertAdjacentHTML("beforeend",`
                    <li class="list-group-item">
                        <div class="card" id="doctor_card" style="max-width: 540px;">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="${urlStorageFile}${item.profile_picture}" class="card-img" alt="Dr. ${item.name} ${item.surname}">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                    <h5 class="card-title" style="color:#375272; font-weight:600;"><strength>Dr. ${item.name} ${item.surname}</strength></h5>
                                    <p class="card-text"><span style="color:#375272; font-weight:600;">Specialties: </span>${item.specialties}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                `);
            });
        }
        getAvailableBookingsForRelatedDoctors(doctorInfos, currentDatesOnBookingCalendar);
    }    
}

function getAvailableBookingsForRelatedDoctors(doctorInfos, currentDatesOnBookingCalendar) {
    if (currentDatesOnBookingCalendar.length == 0) {
        return;
    }

    doctorIds = [];

    doctorInfos.forEach(item => {
        doctorIds.push(item.id);
    });

    // set availableBookingsForRelatedDoctors with ajax request

    let xhr = new XMLHttpRequest();

    let jsonDoctorIds = JSON.stringify(doctorIds);
    let jsonCurrentDatesOnBookingCalendar = JSON.stringify(currentDatesOnBookingCalendar);


    xhr.open("GET", `/${languageOfSite}/getAvailableBookingsForRelatedDoctors/${jsonDoctorIds}/${jsonCurrentDatesOnBookingCalendar}`);

    xhr.responseType = 'json';

    xhr.send();

    xhr.onload = function() {
        availableBookingsForRelatedDoctors = xhr.response;
        $('#datePicker').markyourcalendar({
            availability: availableBookingsForRelatedDoctors,
            startDate: new Date(currentDatesOnBookingCalendar[0]),
            months: ['ocak','şubat','mart','nisan','mayıs','haziran','temmuz','ağustos','eylül','ekim','kasım','aralık'],
            weekdays: ['paz','pzt','salı','çarş','perş','cuma','cts'],
        });
        makeNotAvailableTimesInactive();
        setUrlToCreateBookingPageForTimeButtons(doctorIds);

        if (document.getElementById('booking_date_field')) {
            let filteredButtons = document.querySelectorAll('#myc-day-time-container-0 #myc-available-time-for-doctor-00 a');
            for (anchorElement of filteredButtons) {
                let date1 = new Date(Date.parse(document.getElementById('booking_date_field').value));
                let date2 = new Date(Date.parse(document.querySelector('.dateInfo').innerHTML));

                if (anchorElement.getAttribute('data-time').slice(-5) == 
                document.getElementById('booking_date_field').value.slice(-8, -3) && 
                date1.getDate() + '.' + date1.getMonth() + '.' + date1.getFullYear() == 
                date2.getDate() + '.' + date2.getMonth() + '.' + date2.getFullYear()) {
                    anchorElement.className = 'currentBookingTime';
                    anchorElement.setAttribute('src', '');
                    anchorElement.innerHTML = anchorElement.getAttribute('data-time').slice(-5);
                }
            }

            let availableTimeButtons = document.getElementsByClassName('myc-available-time');
            for (let availableTimeButton of availableTimeButtons) {
                availableTimeButton.setAttribute('href', '');
                availableTimeButton.setAttribute('onclick', 'return false');
            }

            let availableTimeContainer = document.getElementById('myc-available-time-container');
            availableTimeContainer.onclick = function(event) {
                let target = event.target;

                if (target.getAttribute('class') != 'myc-available-time') {
                    return;
                } else {
                    $("#firstStageBooking").modal('hide');
                    document.getElementById('bookingReason_id').value = document.getElementById('select_bookingReasons_form').value;
                    document.getElementById('booking_date_field').value = target.getAttribute('data-date')
                    + ' ' + target.getAttribute('data-time').slice(-5) + ':00';
                    document.getElementById('doctor_id').value = doctorInfos[Number(target.parentElement.getAttribute('id').slice(-1))].id;
                }
            }
        }    
    }
}

function makeNotAvailableTimesInactive() {
    let times = document.querySelectorAll('#myc-available-time-container a');
    let currentDateAndMonth = new Date();

    for (let time of times) {
        if (time.innerHTML.trim().slice(0, 4) == 'Dolu') {
            time.className = 'inActiveTimeButton';
            time.innerHTML = `<img style="width:55px;" src="${urlSvg}"></img>`;
        } else if (+new Date(time.getAttribute('data-date') + ' ' + time.getAttribute('data-time')) < +currentDateAndMonth) {
            time.className = 'expiredTime';
            time.innerHTML = languageOfSite == 'tr' ? 'Geçti' : 'Past';
            let previousTime = time.previousElementSibling;
            while(previousTime) {
                previousTime.className = 'expiredTime';
                previousTime.innerHTML = languageOfSite == 'tr' ? 'Geçti' : 'Past';
                previousTime = previousTime.previousElementSibling;
            }
        }
    }
}

function setUrlToCreateBookingPageForTimeButtons(doctorIds) {
    let timeButtons = document.querySelectorAll('#myc-available-time-container a.myc-available-time');
    let doctor_id;
    let booking_date;
    let bookingReason_id = document.getElementById('select_bookingReasons_form').value;

    for (let timeButton of timeButtons) {
        doctor_id = doctorIds[timeButton.parentElement.id.charAt(timeButton.parentElement.id.length - 1)];
        booking_date = timeButton.getAttribute('data-date') + ' ' + timeButton.getAttribute('data-time')+':00';
        timeButton.setAttribute('href', `bookingCreatePageWithPassedData/${booking_date}/${doctor_id}/${bookingReason_id}`);
    }
}

getAllBookingReasons();

let form = document.getElementById('createBooking');
form.onclick = function(event) {
    let formControl = event.target.closest('.form-control');

    if (formControl.getAttribute('id') == 'bookingReason_id' || formControl.getAttribute('id') == 'doctor_id'
    || formControl.getAttribute('id') == 'booking_date_field') {
        let event = new MouseEvent("click", {
            view: window,
            bubbles: true,
            cancelable: true
        });
        let button = document.getElementById('create_booking_btn');
        button.dispatchEvent(event);
        document.getElementById('select_bookingReasons_form').value = 
        document.getElementById('bookingReason_id').value;
        document.getElementById('bookingReason_id').setAttribute('selected', true);
        
        $('#datePicker').markyourcalendar({
            availability: availableBookingsForRelatedDoctors,
            startDate: new Date(document.getElementById('booking_date_field').value),
            months: ['ocak','şubat','mart','nisan','mayıs','haziran','temmuz','ağustos','eylül','ekim','kasım','aralık'],
            weekdays: ['paz','pzt','salı','çarş','perş','cuma','cts'],
            onClickNavigator: function(ev, instance) {
                if ($("#select_bookingReasons_form option:selected").val() == '0') {
                    return;
                }
                currentDatesOnBookingCalendar = [];
                currentDatesOnBookingCalendar = getCurrentDatesOnCalendar();
                getAvailableBookingsForRelatedDoctors(doctorInfos, currentDatesOnBookingCalendar);
            },
        });
        getCurrentDatesOnCalendar();
        getRelatedDoctorInfos(document.getElementById('bookingReason_id').value, document.getElementById('doctor_id').value);
    }
}

$(function(){
    $('#bookingReason_id').on('mousedown', function(e) {
        e.preventDefault();
        this.blur();
        window.focus();
     });
    $('#doctor_id').on('mousedown', function(e) {
        e.preventDefault();
        this.blur();
        window.focus();
     });
    $('#booking_date_field').on('mousedown', function(e) {
        e.preventDefault();
        this.blur();
        window.focus();
     });

    $('#create_booking_btn').click(function(e){
        e.preventDefault();
        
        $('#modal_instructor div strong').html('');

        let selectBookingReasonsFormDynamicOptions = $('#firstStageBookingBody #select_bookingReasons_form');
        bookingReasons.forEach(function(item, index, array) {
            selectBookingReasonsFormDynamicOptions.append(`
                <option value="${item[0]}">${item[1]}</option>
            `);
        });

        $('#select_bookingReasons_form')
        .change(function() {
            selectedBookingReasonId = $("#select_bookingReasons_form option:selected").val();
            getCurrentDatesOnCalendar();
            getRelatedDoctorInfos(selectedBookingReasonId);
        })
        .trigger("change");

          // The modal is shown
        $('#firstStageBooking').on('shown.bs.modal', function() {
            var coords = $('#myc-available-time-container').offset();
            $('#relatedDoctorInfos').offset({top: Number(coords.top.toFixed(0))});

            $('#select_bookingReasons_form').first().css("color", "#00234B");

            $('#modal_instructor div strong').
            html('Randevu saati, randevu gerekçesi veya doktor seçiminizi buradan güncelleyebilirsiniz. En son yaptığınız seçimler aşağıda yer almaktadır.');
        });

    });

    $('#firstStageBooking').on('hidden.bs.modal', function (e) {
        $('#select_bookingReasons_form').html("");
        currentDatesOnBookingCalendar = [];
        doctorInfos = [];
        availableBookingsForRelatedDoctors = [];
        $('#relatedDoctorInfos').html("");
        $('#datePicker').html("");
    });
});