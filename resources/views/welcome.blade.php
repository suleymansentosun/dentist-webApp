@extends('layouts.app')

@section('bg_image')
  <div id="mainSlide" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#mainSlide" data-slide-to="0" class="active"></li>
      <li data-target="#mainSlide" data-slide-to="1"></li>
      <li data-target="#mainSlide" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active bg_image" id="bg_image">
          <span class="bg_text">Gülümsemelerinizi beyaz ve sağlıklı dişler takip etsin!</span>
      </div>
      <div class="carousel-item bg-image-1" id="bg_image1">
          <span class="bg_text" id="bg_text1">İçiniz mutluyken dışınız buna rahatlıkla eşlik edebilsin!</span>
      </div>
      <div class="carousel-item bg-image-2" id="bg_image2">
      <span class="bg_text" id="bg_text2">Bazen sağlıklı dişler yatırım gerektirir!</span>
      </div>
    </div>
    <a class="carousel-control-prev disabled" href="#mainSlide" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </a>
    <a class="carousel-control-next disabled" href="#mainSlide" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </a>
  </div>

@endsection

@section('content')

  <!-- Marketing messaging and featurettes
  ================================================== -->
  <!-- Wrap the rest of the page in another container to center all the content. -->

  <div class="container marketing">

    <!-- Three columns of text below the carousel -->
    <div class="row">
      <div class="col-lg-4">
        <img src="{{ asset('/dist/img/tootache.svg') }}" class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 140x140"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"/><text x="50%" y="50%" fill="#777" dy=".3em"></text></img>
        <h2>Diş Ağrıları</h2>
        <p>Diş ağrılarınızı geçirici tedaviyi anında uygulamanın yanı sıra dişte düzenli tedavi gerektiren bir kusur varsa bunun tespitini yapıyoruz.</p>
        <p><a class="btn btn-secondary" href="#" role="button">Detayları gör &raquo;</a></p>
      </div><!-- /.col-lg-4 -->
      <div class="col-lg-4">
        <img src="{{ asset('/dist/img/implant.svg') }}" class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 140x140"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"/><text x="50%" y="50%" fill="#777" dy=".3em"></text></img>
        <h2>İmplant</h2>
        <p>Yapay diş alanında son yılların en etkili tedavisi sayılabilecek implant tedavisi bu konuda uzmanlaşmış doktorlarımızca yapılıyor.</p>
        <p><a class="btn btn-secondary" href="#" role="button">Detayları gör &raquo;</a></p>
      </div><!-- /.col-lg-4 -->
      <div class="col-lg-4">
        <img src="{{ asset('/dist/img/cleanTeeth.svg') }}" class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 140x140"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"/><text x="50%" y="50%" fill="#777" dy=".3em"></text></img>
        <h2>Diş Bakımı</h2>
        <p>Düzenli bir diş bakımı ile yaşayabileceğiniz diş ağrısı ve kusurlarını minimuma indirmeye çalışıyoruz.</p>
        <p><a class="btn btn-secondary" href="#" role="button">Detayları gör &raquo;</a></p>
      </div><!-- /.col-lg-4 -->
    </div><!-- /.row -->


    <!-- START THE FEATURETTES -->

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading">Dent Cappadocia merkez konumuyla sizleri bekliyor.</h2>
        <p class="lead">İster özel aracınızla ister toplu taşıma araçlarıyla rahatlıkla ulaşabileceğiniz Dent Cappadocia şehrin merkezinde adeta ışıldıyor.</p>
      </div>
      <div class="col-md-5">
        <img src="{{ asset('\img\office.png') }}" class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 500x500"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"/><text x="50%" y="50%" fill="#aaa" dy=".3em"></text></img>
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7 order-md-2">
        <h2 class="featurette-heading">Son Teknoloji Tedavi</h2>
        <p class="lead">Teknoloji ve tıppın birbirinin ayrılmaz bir parçası olduğu olgusundan hareketle, tedavilerde verimliliği ve konforu son teknoloji ekipmanlarımızla sağlıyoruz.</p>
      </div>
      <div class="col-md-5 order-md-1">
        <img src="{{ asset('\img\treating.png') }}" class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 500x500"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"/><text x="50%" y="50%" fill="#aaa" dy=".3em"></text></img>
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading">Ve Sizleri Bekliyoruz!</h2>
        <p class="lead">Kararınızı bizden yana kullandıysanız tek yapmanız gereken aşağıda yer alan 'Randevu Ayarla' butonuna tıklamak. Şimdiden geçmiş olsun dileklerimizi sunarız.</p>
      </div>
      <div class="col-md-5">
        <img src="{{ asset('\img\lobby.png') }}" class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 500x500"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"/><text x="50%" y="50%" fill="#aaa" dy=".3em"></text></img>
      </div>
    </div>

    <hr class="featurette-divider">

    <!-- /END THE FEATURETTES -->

  </div><!-- /.container -->
@endsection