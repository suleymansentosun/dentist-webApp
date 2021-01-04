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

    xhr.open("GET", `/${languageOfSite}` + `/getRelatedDoctorInfos/${selectedBookingReasonId}/${doctorIdToBeViewedAtTheTop}`);

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
        // getCurrentDatesOnCalendar();
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


    xhr.open("GET", `/${languageOfSite}` + `/getAvailableBookingsForRelatedDoctors/${jsonDoctorIds}/${jsonCurrentDatesOnBookingCalendar}`);

    xhr.responseType = 'json';

    xhr.send();

    xhr.onload = function() {
        availableBookingsForRelatedDoctors = xhr.response;
        if (languageOfSite == 'tr') {
            $('#datePicker').markyourcalendar({
                availability: availableBookingsForRelatedDoctors,
                startDate: new Date(currentDatesOnBookingCalendar[0]),
                months: ['ocak','şubat','mart','nisan','mayıs','haziran','temmuz','ağustos','eylül','ekim','kasım','aralık'],
                weekdays: ['paz','pzt','salı','çarş','perş','cuma','cts'],
            });
        } else {
            $('#datePicker').markyourcalendar({
                availability: availableBookingsForRelatedDoctors,
                startDate: new Date(currentDatesOnBookingCalendar[0]),
                months: ['january','february','march','april','may','june','july','august','september','october','november','december'],
                weekdays: ['sun','mon','tue','wed','thu','fri','sat'],
            });
        }

        makeNotAvailableTimesInactive();
        setUrlToCreateBookingPageForTimeButtons(doctorIds);
        prepareForSmartPhones(doctorInfos);
    }
}

function makeNotAvailableTimesInactive() {
    let times = document.querySelectorAll('#myc-available-time-container a');
    let currentHour = new Date().getHours();
    let currentDate = new Date().getDate();

    for (let time of times) {
        if (time.innerHTML.trim().slice(0, 4) == 'Dolu') {
            time.className = 'inActiveTimeButton';
            time.innerHTML = `<img style="width:55px;" src="${urlSvg}"></img>`;
        } else if (Number(time.innerHTML.trim().slice(0, 2)) <= currentHour && 
        new Date(time.getAttribute('data-date')).getDate() == currentDate) {
            time.className = 'expiredTime';
            time.innerHTML = languageOfSite == 'tr' ? 'Geçti' : 'Past';
            let previousTime = time.previousElementSibling;
            while(previousTime && previousTime.tagName == 'A') {
                previousTime.className = 'expiredTime';
                previousTime.innerHTML = languageOfSite == 'tr' ? 'Geçti' : 'Past';
                previousTime = previousTime.previousElementSibling;
            }
        }
    }
}

function prepareForSmartPhones(doctorInfos) {
    for (let i = 0; i < doctorInfos.length; i++) {
        let doctorInfoForSmallScreen = document.getElementsByClassName(`doctorInfoForSmallScreen${i}`);

        for (let element of doctorInfoForSmallScreen) {
            element.innerHTML = `
            <li class="list-group-item" id="doctorInfoForSmallScreen" style="width:400px;">
            <div class="card" id="doctor_card" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="${urlStorageFile}${doctorInfos[i].profile_picture}" class="card-img" alt="Doktor ${doctorInfos[i].name} ${doctorInfos[i].surname}">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                        <h5 class="card-title" style="color:#375272; font-weight:600;"><strength>Doktor ${doctorInfos[i].name} ${doctorInfos[i].surname}</strength></h5>
                        <p class="card-text"><span style="color:#375272; font-weight:600;">Uzmanlık Alanları: </span><div style="font-size:13px;">${doctorInfos[i].specialties}</div></p>
                        </div>
                    </div>
                </div>
            </div>
        </li>
            `;
            element.style.visibility = 'hidden';
        }

        let arr = [...doctorInfoForSmallScreen];

        arr[0].style.visibility = 'visible';

        /*
            `
        <li class="list-group-item" id="doctorInfoForSmallScreen">
            <div class="card" id="doctor_card" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="${urlStorageFile}${doctorInfos[i].profile_picture}" class="card-img" alt="Doktor ${doctorInfos[i].name} ${doctorInfos[i].surname}">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                        <h5 class="card-title" style="color:#375272; font-weight:600;"><strength>Doktor ${doctorInfos[i].name} ${doctorInfos[i].surname}</strength></h5>
                        <p class="card-text"><span style="color:#375272; font-weight:600;">Uzmanlık Alanları: </span>${doctorInfos[i].specialties}</p>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        `
        */

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
        timeButton.setAttribute('href', `/${languageOfSite}/bookingCreatePageWithPassedData/${booking_date}/${doctor_id}/${bookingReason_id}`);
    }
}

// function setDoctorInfoElementHeight() {
//     let doctorInfoListItems = document.querySelectorAll('#relatedDoctorInfos li');
//     let bookingTimesContainerHeightPerDoctor = document.querySelector('.myc-available-time-for-one-doctor');

//     for (doctorInfoListItem of doctorInfoListItems) {
//         doctorInfoListItem.style.height = bookingTimesContainerHeightPerDoctor.offsetHeight + 'px';
//     }
// }

getAllBookingReasons();

$(function(){
    $('#create_booking_btn').click(function(e){
        e.preventDefault();
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

        if (languageOfSite == 'tr') {
            $('#datePicker').markyourcalendar({
                availability: availableBookingsForRelatedDoctors,
                startDate: new Date(),
                months: ['ocak','şubat','mart','nisan','mayıs','haziran','temmuz','ağustos','eylül','ekim','kasım','aralık'],
                weekdays: ['paz','pzt','salı','çarş','perş','cuma','cts'],
                onClickNavigator: function(ev, instance) {
                    if (selectedBookingReasonId == '0') {
                        return;
                    }
                    currentDatesOnBookingCalendar = [];
                    currentDatesOnBookingCalendar = getCurrentDatesOnCalendar();
                    getAvailableBookingsForRelatedDoctors(doctorInfos, currentDatesOnBookingCalendar);
                    // Bu alttaki ikisi gereksiz gibi
                    // instance.setAvailability(availableBookingsForRelatedDoctors);
                    // makeNotAvailableTimesInactive();
                    // setDoctorInfoElementHeight();
                },
            });
        } else {
            $('#datePicker').markyourcalendar({
                availability: availableBookingsForRelatedDoctors,
                startDate: new Date(),
                months: ['january','february','march','april','may','june','july','august','september','october','november','december'],
                weekdays: ['sun','mon','tue','wed','thu','fri','sat'],
                onClickNavigator: function(ev, instance) {
                    if (selectedBookingReasonId == '0') {
                        return;
                    }
                    currentDatesOnBookingCalendar = [];
                    currentDatesOnBookingCalendar = getCurrentDatesOnCalendar();
                    getAvailableBookingsForRelatedDoctors(doctorInfos, currentDatesOnBookingCalendar);
                    // Bu alttaki ikisi gereksiz gibi
                    // instance.setAvailability(availableBookingsForRelatedDoctors);
                    // makeNotAvailableTimesInactive();
                    // setDoctorInfoElementHeight();
                },
            });
        }
        
          // The modal is shown
        $('#firstStageBooking').on('shown.bs.modal', function() {
            $('.carousel').carousel('pause');
            var coords = $('#myc-available-time-container').offset();
            $('#relatedDoctorInfos').offset({top: Number(coords.top.toFixed(0))});

            $('#select_bookingReasons_form').first().css("color", "#00234B");
        });

    });

    $('#firstStageBooking').on('hidden.bs.modal', function (e) {
        $('.carousel').carousel('cycle');
        $('#select_bookingReasons_form').html("");
        currentDatesOnBookingCalendar = [];
        doctorInfos = [];
        availableBookingsForRelatedDoctors = [];
        $('#relatedDoctorInfos').html("");
        $('#datePicker').html("");
    });
});