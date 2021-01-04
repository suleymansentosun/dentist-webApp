    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="specialty_name">{{__('Doktor Uzmanlık Alanı')}}</label>
        <div class="col-sm-10">
            <input name="name" type="text" class="form-control" value="{{ $specialty->name ?? '' }}"/>
            <small class="form-text text-muted">{{__('Doktorların uzmanı olduğu alandır.')}}</small>
            <input name="nameEn" type="text" class="form-control" value="{{ $specialty->nameEn ?? '' }}"/>
            <small class="form-text text-muted">{{__('Girdiğiniz uzmanlık alanının ingilizce çevirisini girin')}}</small>
        </div>
    </div>

    @csrf