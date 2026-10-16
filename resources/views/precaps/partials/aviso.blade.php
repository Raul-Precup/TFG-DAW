@if (session()->has('message'))
  <div class="aviso aviso--ok" role="status">{{ __(session('message')) }}</div>
@endif
@if ($errors->any())
  <div class="aviso aviso--error" role="alert">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
