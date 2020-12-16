    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="role_name">Rol Adı</label>
        <div class="col-sm-10">
            <input name="name" type="text" class="form-control" value="{{ $role->name ?? '' }}"/>
            <small class="form-text text-muted">Kullanıcıları ilintilendirmek istediğiniz yeni bir rol adı yazınız.</small>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="role_description">Rol Açıklaması</label>
        <div class="col-sm-10">
            <input name="description" type="text" class="form-control" value="{{ $role->description ?? '' }}"/>
            <small class="form-text text-muted">Kullanıcı rolünün detaylarını açıklayınız.</small>
        </div>
    </div>

    @csrf