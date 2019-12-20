<li>
    <a href="{{URL::to('home')}}"><span class="fa fa-desktop"></span> <span class="xn-text">Dashboard</span></a>
</li>
{{-- <li>
    <a href="{{URL::to('user')}}"><span class="fa fa-user"></span> <span class="xn-text">Pengguna</span></a>
</li> --}}
<li class="xn-openable">
    <a href="#"><span class="fa fa-paper-plane-o"></span> <span class="xn-text">Berita</span></a>
    <ul>
        <li><a href="{{URL::to('posts')}}">Semua Berita</a></li>
        <li><a href="{{URL::to('posts/create')}}">Berita Baru</a></li>
        <li><a href="{{URL::to('categories')}}">Kategori</a></li>
    </ul>
</li>
<li class="xn-openable">
    <a href="#"><span class="fa fa-file"></span> <span class="xn-text">Halaman</span></a>
    <ul>
        <li><a href="{{URL::to('pages')}}">Semua Halaman</a></li>
        <li><a href="{{URL::to('pages/create')}}">Halaman Baru</a></li>
    </ul>
</li>
<li>
    <a href="{{URL::to('info')}}"><span class="fa fa-info-circle"></span><span class="xn-text">Informasi</span></a>
</li>
<li>
    <a href="{{URL::to('slider')}}"><span class="fa fa-file-image-o"></span><span class="xn-text">Slider</span></a>
</li>
<li>
  <a href="{{URL::to('usulans')}}"><span class="fa fa-tasks"></span> <span class="xn-text">Usulan</span></a>
</li>
<li>
  <a href="{{URL::to('menu')}}"><span class="fa fa-tasks"></span> <span class="xn-text">Menu</span></a>
</li>
<li>
  <a href="{{URL::to('setting')}}"><span class="fa fa-gears"></span><span class="xn-text">Pengaturan</span></a>
</li>
{{-- <li>
    <a href="{{URL::to('mgalleri')}}"><span class="fa fa-picture-o"></span> <span class="xn-text">Gallery</span></a>
</li> --}}
{{-- <li>
    <a href="{{URL::to('mfaq')}}"><span class="fa fa-question"></span> <span class="xn-text">FAQ</span></a>
</li> --}}
{{-- <li>
    <a href="{{URL::to('mqa')}}"><span class="fa fa-bullhorn"></span> <span class="xn-text">Q&A</span></a>
</li> --}}
