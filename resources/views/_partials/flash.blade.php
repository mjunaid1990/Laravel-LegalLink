@if(Session::has('message'))
<div id="app-alert-msg" class="alert alert-success alert-dismissible fade show m-0" role="alert">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  {!! Session::get('message') !!}
</div>
@endif
