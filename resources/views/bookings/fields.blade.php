    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="user_id">{{__('Kullanıcı Adı')}}</label>
        <div class="col-sm-10">
            <select name="user_id" class="form-control custom-select" id="user_id" required>
                    <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
            </select>
            <small class="form-text text-muted">{{__('Randevu ayarlayan kullanıcı')}}</small>
            <div class="invalid-feedback">
                {{__('Lütfen bir kullanıcı adı seçiniz')}}
            </div>
        </div>
    </div>
    
    <div class="form-group row">
        <label class="col-sm-2 col-form-label"for="patient_name">{{__('İsim')}}</label>
        <div class="col-sm-10">
            <input name="name" type="text" class="form-control" value="{{ $booking->patient->name ?? '' }}" required/>
            <small class="form-text text-muted">{{__('Randevu Verilen Hastanın Adı')}}</small>
            <div class="invalid-feedback">
                {{__('Lütfen bir isim giriniz')}}
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"for="patient_surname">{{__('Soyisim')}}</label>
        <div class="col-sm-10">
            <input name="surname" type="text" class="form-control" value="{{ $booking->patient->surname ?? '' }}" required/>
            <small class="form-text text-muted">{{__('Randevu Verilen Hastanın Soyadı')}}</small>
            <div class="invalid-feedback">
                {{__('Lütfen bir soyadı giriniz')}}
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"for="patient_phoneNumber">{{__('Telefon Numarası')}}</label>
        <div class="col-sm-10">
            <input name="phone_number" type="tel" class="form-control" value="{{ $booking->patient->phone_number ?? '' }}" 
            pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="xxx-xxx-xxxx" required/>
            <small class="form-text text-muted">{{__('Randevu Verilen Hastanın Telefon Numarası')}}</small>
            <div class="invalid-feedback">
                {{__('Lütfen geçerli bir telefon numarası giriniz. xxx-xxx-xx-xx kalıbını takip ettiğinizden emin olun.')}}
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"for="patient_phoneNumber">{{__('T.C Kimlik Numarası')}}</label>
        <div class="col-sm-10">
            <input name="citizenship_number" type="tel" class="form-control" value="{{ $booking->patient->citizenship_number ?? '' }}" 
            pattern="[0-9]{11}" required/>
            <small class="form-text text-muted">{{__('Randevu Verilen Hastanın TC Numarası')}}</small>
            <div class="invalid-feedback">
                {{__('Lütfen geçerli bir vatandaşlık numarası giriniz')}}
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"for="user_id">{{__('Randevu Gerekçesi')}}</label>
        <div class="col-sm-10">
            <select name="bookingReason_id" class="form-control custom-select" id="bookingReason_id" required>
                @foreach($bookingReasons as $reason)
                    <option value="{{ $reason->id }}" {{ ($reason->id == $bookingReason->id) ? 'selected' : '' }}>
                        {{ app()->getLocale() == 'tr' ? $reason->name : $reason->nameEn }}
                    </option>
                @endforeach
            </select>
            <small class="form-text text-muted">{{__('Randevu Verilen Kullanıcının Şikayeti')}}</small>
            <div class="invalid-feedback">
                {{__('Lütfen bir randevu gerekçesi belirtiniz.')}}
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"for="user_id">{{__('Doktor')}}</label>
        <div class="col-sm-10">
            <select name="doctor_id" class="form-control custom-select" id="doctor_id" required>
                @foreach($doctors as $dctr)
                    <option value="{{ $dctr->id }}" {{ ($dctr->id == $doctor->id) ? 'selected' : '' }}>
                        {{ $dctr->name . ' ' . $dctr->surname }}
                    </option>
                @endforeach
            </select>
            <small class="form-text text-muted">{{__('Randevu alınan doktor.')}}</small>
            <div class="invalid-feedback">
                {{__('Lütfen bir doktor seçiniz')}}
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="booking_date">{{__('Randevu tarihi ve saati')}}</label>
        <div class="col-sm-10">
            <div class="input-group">
                <div class="input-group-prepend">
                </div>
                <input id="booking_date_field" name="booking_date" type="text" placeholder="" 
                value="{{ $booking_date }}" class="form-control" required/>
            </div>
            <small class="form-text text-muted">{{__('Randevu talep edilen tarih ve saat')}}</small>
            <div class="invalid-feedback">
                {{__('Lütfen randevu tarih ve saatini belirtiniz')}}
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="notes">{{__('Notlar')}}</label>
        <div class="col-sm-10">
            <input name="notes" type="text" class="form-control" placeholder="Notlar"
            value="{{ $booking->notes ?? '' }}"/>
            <small class="form-text text-muted">{{__('Randevu için ekstra notlar')}}</small>
        </div>
    </div>