@extends('layouts.cms')

@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Assets</li>
  </ol>
</nav>

<div class="card bg-primary text-white lead">
  <h5 class="card-header display-4">Banner</h5>
  <div class="card-body">
    <h5 class="card-title lead text-white">Contains all your banner</h5>
    <p class="card-text lead text-white">You can manage items under banner, just click the 'Manage' button</p>
    <a href="{{ url('/cms/assets/banner') }}" class="btn btn-danger">Manage</a>
  </div>
</div>


<div class="card bg-dark text-white lead mt-5">
  <h5 class="card-header display-4">Gallery</h5>
  <div class="card-body">
    <h5 class="card-title lead text-white">Contains all images from your gallery</h5>
    <p class="card-text lead text-white">You can manage items under gallery, just click the 'Manage' button</p>
    <a href="{{ url('/cms/assets/gallery') }}" class="btn btn-danger">Manage</a>
  </div>
</div>


<div class="card bg-success text-white lead mt-5">
  <h5 class="card-header display-4">Brochures</h5>
  <div class="card-body">
    <h5 class="card-title lead text-white">Contains all your brochures</h5>
    <p class="card-text lead text-white">You can manage items under brochures, just click the 'Manage' button</p>
    <a href="#" class="btn btn-danger">Manage</a>
  </div>
</div>


<div class="card bg-warning text-white lead mt-5 mb-5">
  <h5 class="card-header display-4">External links</h5>
  <div class="card-body">
    <h5 class="card-title lead text-white">Contains all your external links</h5>
    <p class="card-text lead text-white">You can manage items under external links, just click the 'Manage' button</p>
    <a href="#" class="btn btn-danger">Manage</a>
  </div>
</div>



@stop