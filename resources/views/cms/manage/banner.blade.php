@extends('layouts.cms')

@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/cms/assets') }}">Assets</a></li>
    <li class="breadcrumb-item active" aria-current="page">Manage Banner</li>
  </ol>
</nav>


<div class="row">

  <!-- pop-up menu -->
  <div class="col-2">
    <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Add New Banner</button>
  </div>
  
  <!-- existing banners in cards -->
  <div class="col">
      <div class="row">

        <!-- dynamic content -->

        <div class="card bg-dark text-white  mt-3">
          <img src="https://blog.paper.li/wp-content/uploads/2020/02/LinkedIn-banner-14-1024x256.png" class="card-img" alt="...">
          <div class="card-img-overlay">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            <p class="card-text">Last updated 3 mins ago</p>
            <p><button class="btb btn-sm btn-danger">remove</button>&nbsp;<button class="btb btn-sm btn-info">edit</button></p>
          </div>
        </div>

        <div class="card bg-dark text-white  mt-3">
          <img src="https://freelinkedinbackgrounds.com/wp-content/uploads/2015/01/Abstract_003.jpg" class="card-img" alt="...">
          <div class="card-img-overlay">
            <h5 class="card-title">Card title </h5>
            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            <p class="card-text">Last updated 3 mins ago</p>
            <p><button class="btb btn-sm btn-danger">remove</button>&nbsp;<button class="btb btn-sm btn-info">edit</button></p>
          </div>
        </div>

        <div class="card bg-dark text-black  mt-3">
          <img src="https://cultivatedculture.com/wp-content/uploads/2019/05/Chromatic-LinkedIn-Cover-Photo-Background.png" class="card-img" alt="...">
          <div class="card-img-overlay">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            <p class="card-text">Last updated 3 mins ago</p>
            <p><button class="btb btn-sm btn-danger">remove</button>&nbsp;<button class="btb btn-sm btn-info">edit</button></p>
          </div>
        </div>
      
      </div> <!-- div row -->
  </div>  <!-- div col -->

  <!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content  bg-primary">
      
        <div class="modal-header">
          <h5 class="modal-title lead text-white" id="exampleModalLongTitle">Add New Banner</h5>
          <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div> <!-- modal-header -->

        <div class="modal-body">

          <div class="form-row mt-3"> 
            <input type="text" class="form-control" placeholder="Banner Title">
          </div>
          
          <div class="form-row mt-3">
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="customFile">
              <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
          </div>

        </div> <!-- modal-body -->

        <div class="modal-footer">
          <button type="button" class="btn btn-success">Upload Banner</button>
        </div>
      </div>
    </div>
  </div>

</div>


<script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>

@stop
