let counter = document.getElementById('notification_bell');
let notification_header = document.getElementById('notification_header');
let spesific_notification = document.getElementById('spesific_notification');

let patientsOfNotifiedAppointments;

function addPatientToDatabase() {
    let xhr = new XMLHttpRequest();

    xhr.open("GET", '/getBookings');

    xhr.responseType = 'json';

    xhr.send();

    xhr.onload = function() {
        patientsOfNotifiedAppointments = xhr.response;
        counter.innerHTML += patientsOfNotifiedAppointments.length;
        notification_header.innerHTML = 'Toplam ' + counter.innerHTML + ' bildiri';
        spesific_notification.innerHTML = counter.innerHTML + ' randevu takip';

    }
}

// let timerId = setInterval(addPatientToDatabase, 1000*60*30);
addPatientToDatabase();

$(function(){
    $('.custom-modal').click(function(e){
      e.preventDefault();
      let modalBody = $('#check_booking_materialized');
      patientsOfNotifiedAppointments.forEach(function(item, index, array) {
        modalBody.append(`
           <fieldset class="form-group" id="${item[0].citizenship_number}">
               <div class="row">
                   <legend class="col-form-label col-sm-8">Hasta numarası ${item[0].id + ' olan ' + item[0].name + ' ' + item[0].surname + ' '}randevuya geldi mi?</legend>
                   <div class="col modelIfBookingMaterialized">
                       <div class="form-check-inline">
                           <input type="radio" id="customRadioInline1" name="${item[1].id}" class="form-check-input yes" value="yes">
                           <label class="form-check-label" for="customRadioInline1">Evet</label>
                       </div>
                       <div class="form-check-inline">
                           <input type="radio" id="customRadioInline1" name="${item[1].id}" class="form-check-input" value="no">
                           <label class="form-check-label" for="customRadioInline1">Hayır</label>
                       </div>
                   </div>
               </div>
           </fieldset>
        `);
      });
      
    $('#exampleModal').modal('show');

    let selectAllButton = $('#selectAll');
    let radioElementYesAnswers = $(".modelIfBookingMaterialized .yes");

    selectAllButton.on("change", function() {
        // radioElementYesAnswers.forEach( function(radioElementYesAnswer) {
        // radioElementYesAnswer.checked = true;
        // });
        $.each(radioElementYesAnswers, function(index, value) {
            $(this).prop("checked", true);
        });
    });
    
    });

    $('#exampleModal').on('hidden.bs.modal', function (e) {
        $('#check_booking_materialized').html("");
    });
});

