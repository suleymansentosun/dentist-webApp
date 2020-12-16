    <div class="form-group row">
        <label class="col-sm-2 col-form-label"for="patient_user_id">Kullanıcı Adı</label>
        <div class="col-sm-10">
            <select name="user_id" class="form-control" id="user_id" required>
                    <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
            </select>
            <small class="form-text text-muted">Randevu ayarlayan kullanıcı</small>
        </div>
    </div>
    
    <div class="form-group row">
        <label class="col-sm-2 col-form-label"for="patient_name">İsim</label>
        <div class="col-sm-10">
            <input name="name" type="text" class="form-control" value="{{ $booking->patient->name ?? '' }}"/>
            <small class="form-text text-muted">Randevu Verilen Hastanın Adı</small>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"for="patient_surname">Soyisim</label>
        <div class="col-sm-10">
            <input name="surname" type="text" class="form-control" value="{{ $booking->patient->surname ?? '' }}"/>
            <small class="form-text text-muted">Randevu Verilen Hastanın Soyadı</small>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"for="patient_phoneNumber">Telefon Numarası</label>
        <div class="col-sm-10">
            <input name="phone_number" type="tel" class="form-control" value="{{ $booking->patient->phone_number ?? '' }}" 
            pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="xxx-xxx-xxxx" required/>
            <small class="form-text text-muted">Randevu Verilen Hastanın Telefon Numarası</small>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"for="patient_phoneNumber">T.C Kimlik Numarası</label>
        <div class="col-sm-10">
            <input name="citizenship_number" type="tel" class="form-control" value="{{ $booking->patient->citizenship_number ?? '' }}" 
            pattern="[0-9]{11}" required/>
            <small class="form-text text-muted">Randevu Verilen Hastanın TC Numarası</small>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"for="user_id">Randevu Gerekçesi</label>
        <div class="col-sm-10">
            <select name="bookingReason_id" class="form-control" id="bookingReason_id" required>
                @foreach($bookingReasons as $reason)
                    <option value="{{ $reason->id }}" {{ ($reason->id == $bookingReason->id) ? 'selected' : '' }}>
                        {{ $reason->name }}
                    </option>
                @endforeach
            </select>
            <small class="form-text text-muted">Randevu Verilen Kullanıcının Şikayeti</small>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"for="user_id">Doktor</label>
        <div class="col-sm-10">
            <select name="doctor_id" class="form-control" id="doctor_id" required>
                @foreach($doctors as $dctr)
                    <option value="{{ $dctr->id }}" {{ ($dctr->id == $doctor->id) ? 'selected' : '' }}>
                        {{ $dctr->name . ' ' . $dctr->surname }}
                    </option>
                @endforeach
            </select>
            <small class="form-text text-muted">Randevu alınan doktor.</small>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="booking_date">Randevu tarihi ve saati</label>
        <div class="col-sm-10">
            <div class="input-group">
                <div class="input-group-prepend">
                </div>
                <input id="booking_date_field" name="booking_date" type="text" placeholder="" 
                value="{{ $booking_date }}" class="form-control" required/>
            </div>
            <small class="form-text text-muted">Randevu talep edilen tarih ve saat.</small>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="notes">Notlar</label>
        <div class="col-sm-10">
            <input name="notes" type="text" class="form-control" placeholder="Notlar"
            value="{{ $booking->notes ?? '' }}"/>
            <small class="form-text text-muted">Randevu için ekstra notlar.</small>
        </div>
    </div>

    @csrf