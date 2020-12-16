@extends('layouts.app')

@section('content')
<div class="col">
<form action="{{ route('doctorReviews.store') }}" method="POST">
    <div class="form-group row">
        <label class="col-sm-2 col-form-label"for="patient_id">Hasta</label>
        <div class="col-sm-10">
            <select name="patient_id" class="form-control" required>
                @foreach($patient as $id => $display)
                    <option value="{{ $id }}">{{ $display }}</option>
                @endforeach
            </select>
            <small class="form-text text-muted">Yorumu yapan kullanıcı</small>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"for="doctor_id">Doktor</label>
        <div class="col-sm-10">
            <select name="doctor_id" class="form-control" required>
                @foreach($doctors as $id => $display)
                    <option value="{{ $id }}">{{ $display }}</option>
                @endforeach
            </select>
            <small class="form-text text-muted">En son randevunuzun olduğu doktor</small>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="review_headline">Başlık</label>
        <div class="col-sm-10">
            <input name="review_headline" type="text" class="form-control"/>
            <small class="form-text text-muted">Yorum Başlığı</small>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="review_body">Yorum İçeriği</label>
        <div class="col-sm-10">
            <input name="review_body" type="text" class="form-control"/>
            <small class="form-text text-muted">Yorum metnini yazın.</small>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="doctor_rating">Doktor Puanı</label>
        <div class="col-sm-10">
            <input name="doctor_rating" type="number" class="form-control" min="1" max="5"/>
            <small class="form-text text-muted">Son randevunuzu değerlendirdiğinizde doktorunuzdan ne ölçüde memnun kaldınız?</small>
        </div>
    </div>

    @csrf

    <div class="form-group row">
        <div class="col-sm-3">
            <button type="submit" class="btn btn-primary">Yorum Ekle</button>
        </div>
        <div class="col-sm-9">
            <a href="{{ route('bookings.index') }}" class="btn btn-secondary">İptal</a>
        </div>
    </div>
</form>
</div>
@endsection