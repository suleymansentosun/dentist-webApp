@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group row">
    <label class="col-sm-2 col-form-label" for="doctor_role">{{__('Kullanıcı')}}</label>
    <div class="col-sm-10">
        <select name="user_id" class="form-control custom-select" id="user_id" required>
            @foreach($users as $id => $display)
                <option value="{{ $id }}" {{ (isset($doctor->user_id) && $id === $doctor->user_id) ? 'selected' : '' }}
                {{ $id === 0 ? 'disabled' : ''}}>
                    {{ $display }}
                </option>
            @endforeach
        </select>
        <small class="form-text text-muted">{{__('Doktor Olarak Eklenecek Kullanıcı')}}</small>
        <div class="invalid-feedback">
            {{__('Lütfen bir kullanıcı adı seçiniz')}}
        </div>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label" for="start">{{__('Adı')}}</label>
    <div class="col-sm-10">
        <input name="name" type="text" class="form-control" value="{{ $doctor->name ?? ''}}" required/>
        <small class="form-text text-muted">{{__('Doktorun Adı')}}</small>
        <div class="invalid-feedback">
            {{__('Lütfen bir isim yazınız')}}
        </div>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label" for="start">{{__('Soyadı')}}</label>
    <div class="col-sm-10">
        <input name="surname" type="text" class="form-control" value="{{ $doctor->surname ?? ''}}" required/>
        <small class="form-text text-muted">{{__('Doktorun Soyadı')}}</small>
        <div class="invalid-feedback">
            {{__('Lütfen bir soyadı yazınız')}}
        </div>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label" for="start">{{__('Profil Resmi')}}</label>
    <div class="col-sm-10">
        <input name="profile_picture" type="file" class="form-control-file" required/>
        <small class="form-text text-muted">{{__('Doktorun Profil Fotoğrafı')}}</small>
        <div class="invalid-feedback">
            {{__('Lütfen geçerli bir profil resmi yükleyiniz')}}
        </div>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label" for="graduation_date">{{__('Mezuniyet Yılı')}}</label>
    <div class="col-sm-10">
        <input name="graduation_date" type="date" class="form-control" required placeholder="yyyy-mm-dd"
        value="{{ $doctor->graduation_date ?? ''}}"/>
        <small class="form-text text-muted">{{__('Doktorun üniversite mezuniyet tarihi')}}</small>
        <div class="invalid-feedback">
            {{__('Lütfen Mezuniyet Tarihini Giriniz')}}
        </div>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label" for="start">{{__('İşe Başlama Tarihi')}}</label>
    <div class="col-sm-10">
        <input name="starting_date_employement" type="date" class="form-control" required placeholder="yyyy-mm-dd"
        value="{{ $doctor->starting_date_employement ?? ''}}"/>
        <small class="form-text text-muted">{{__('Doktorun kliniğimizde işe başlama tarihi')}}</small>
        <div class="invalid-feedback">
            {{__('Lütfen kaydetmek istediğiniz doktorun işe giriş tarihini seçiniz')}}
        </div>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label"for="salary">{{__('Maaşı')}}</label>
    <div class="col-sm-10">
        <input type="number" name="salary" min="2200" max="100000" step="100" class="form-control"
        value="{{ $doctor->salary ?? '' }}" required>
        <small class="form-text text-muted">{{__('Doktorun aylık maaşı')}}</small>
        <div class="invalid-feedback">
            {{__('Lütfen geçerli bir maaş giriniz. Maaş en az 2200 TL olmalı ve 100 sayısının katları olmalıdır')}}
        </div>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label" for="doctor_specialty">{{__('Uzmanlık Alanı')}}</label>
    <div class="col-sm-10">
        <select name="specialties[]" class="form-control custom-select" id="doctor_specialty" multiple required>
            @foreach($specialties as $id => $display)
                <option value="{{ $id }}" {{ (isset($doctor_specialtyIds) && in_array($id, $doctor_specialtyIds)) ? 'selected' : ''}}
                {{ $id === 0 ? 'disabled' : '' }}>
                    {{ $display }}
                </option>
            @endforeach
        </select>
        <small class="form-text text-muted">{{__('Doktorun uzmanlık alanı')}}</small>
        <div class="invalid-feedback">
            {{__('Lütfen bir veya daha fazla uzmanlık alanı seçiniz')}}
        </div>
    </div>
</div>
@csrf