<div class="form-group row">
        <label class="col-sm-2 col-form-label" for="bookingReason">Hasta Şikayet Başlığı</label>
        <div class="col-sm-10">
            <input name="name" type="text" class="form-control" value="{{ $bookingReason->name ?? '' }}"/>
            <small class="form-text text-muted">Hastanın randevu ayarlarken seçimlik listeden seçebileceği şikayet başlığı ekleyin.</small>
        </div>
</div>

@csrf