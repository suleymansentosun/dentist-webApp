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
    <label class="col-sm-2 col-form-label" for="doctor_role">Kullanıcı</label>
    <div class="col-sm-10">
        <select name="user_id" class="form-control" id="user_id" required>
            @foreach($users as $id => $display)
                <option value="{{ $id }}" {{ (isset($doctor->user_id) && $id === $doctor->user_id) ? 'selected' : '' }}>
                    {{ $display }}
                </option>
            @endforeach
        </select>
        <small class="form-text text-muted">Doktor olarak eklenecek olan kullanıcı</small>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label" for="start">Adı</label>
    <div class="col-sm-10">
        <input name="name" type="text" class="form-control" value="{{ $doctor->name ?? ''}}"/>
        <small class="form-text text-muted">Doktorun adı</small>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label" for="start">Soyadı</label>
    <div class="col-sm-10">
        <input name="surname" type="text" class="form-control" value="{{ $doctor->surname ?? ''}}"/>
        <small class="form-text text-muted">Doktorun soyadı</small>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label" for="start">Profil Resmi</label>
    <div class="col-sm-10">
        <input name="profile_picture" type="file" class="form-control-file"/>
        <small class="form-text text-muted">Doktorun profil fotoğrafı</small>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label" for="graduation_date">Mezuniyet Yılı</label>
    <div class="col-sm-10">
        <input name="graduation_date" type="date" class="form-control" required placeholder="yyyy-mm-dd"
        value="{{ $doctor->graduation_date ?? ''}}"/>
        <small class="form-text text-muted">Doktorun üniversite mezuniyet tarihi</small>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label" for="start">İşe Başlama Tarihi</label>
    <div class="col-sm-10">
        <input name="starting_date_employement" type="date" class="form-control" required placeholder="yyyy-mm-dd"
        value="{{ $doctor->starting_date_employement ?? ''}}"/>
        <small class="form-text text-muted">Doktorun kliniğimizde işe başlama tarihi</small>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label"for="salary">Maaşı</label>
    <div class="col-sm-10">
        <input type="number" name="salary" min="2200" max="100000" step="100" class="form-control"
        value="{{ $doctor->salary ?? '' }}">
        <small class="form-text text-muted">Doktorun aylık maaşı</small>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label" for="doctor_specialty">Uzmanlık Alanı</label>
    <div class="col-sm-10">
        <select name="specialties[]" class="form-control" id="doctor_specialty" multiple required>
            @foreach($specialties as $id => $display)
                <option value="{{ $id }}" {{ (isset($doctor_specialtyIds) && in_array($id, $doctor_specialtyIds)) ? 'selected' : ''}}>
                    {{ $display }}
                </option>
            @endforeach
        </select>
        <small class="form-text text-muted">Doktorun uzmanlık alanı</small>
    </div>
</div>
@csrf