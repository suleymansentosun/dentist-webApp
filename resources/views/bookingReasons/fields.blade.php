<div class="form-group row">
        <label class="col-sm-2 col-form-label" for="bookingReason">{{__('Hasta Şikayet Başlığı')}}</label>
        <div class="col-sm-10">
            <input name="name" type="text" class="form-control" value="{{ $bookingReason->name ?? '' }}"/>
            <small class="form-text text-muted">{{__('Hastanın randevu ayarlarken seçimlik listeden seçebileceği şikayet başlığı ekleyin.')}}</small>
            <input name="nameEn" type="text" class="form-control" value="{{ $bookingReason->nameEn ?? '' }}"/>
            <small class="form-text text-muted">{{__('Eklediğiniz şikayet başlığının ingilizce çevirisini girin')}}</small>
        </div>
</div>

@csrf