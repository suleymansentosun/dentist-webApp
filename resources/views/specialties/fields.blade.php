    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="specialty_name">Doktor Uzmanlık Alanı</label>
        <div class="col-sm-10">
            <input name="name" type="text" class="form-control" value="{{ $specialty->name ?? '' }}"/>
            <small class="form-text text-muted">Doktorların uzmanı olduğu alandır.</small>
        </div>
    </div>

    @csrf