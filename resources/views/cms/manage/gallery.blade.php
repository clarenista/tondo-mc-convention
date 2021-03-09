@extends('layouts.cms')

@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/cms/assets') }}">Assets</a></li>
    <li class="breadcrumb-item active" aria-current="page">Manage Gallery</li>
  </ol>
</nav>


<div class="row">
    <!-- pop-up menu -->
    <div class="col-2">
        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Add New Image</button>
    </div>
    
    <!-- existing images in cards -->
    <div class="col">
        <div class="row">
            <div class="card-columns">
                <div class="card">
                    <img src="https://images.unsplash.com/photo-1614413203780-e851bb421c83?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" class="card-img-top" alt="...">
                    <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <p><button class="btb btn-sm bg-danger">delete</button>&nbsp;<button class="btb btn-sm bg-info">edit</button></p>
                    </div>
                    <div class="card-footer">
                    <small class="text-muted">Last updated 3 mins ago</small>
                    </div>
                </div>
                <div class="card">
                    <img src="https://images.unsplash.com/photo-1614354518913-63b8ed1d8ac3?ixlib=rb-1.2.1&ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&auto=format&fit=crop&w=701&q=80" class="card-img-top" alt="...">
                    <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                    <p><button class="btb btn-sm bg-danger">delete</button>&nbsp;<button class="btb btn-sm bg-info">edit</button></p>
                    </div>
                    <div class="card-footer">
                    <small class="text-muted">Last updated 3 mins ago</small>
                    </div>
                </div>
                <div class="card">
                    <img src="https://images.unsplash.com/photo-1614349164346-bf9ef221a64d?ixlib=rb-1.2.1&ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&auto=format&fit=crop&w=650&q=80" class="card-img-top" alt="...">
                    <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                    <p><button class="btb btn-sm bg-danger">delete</button>&nbsp;<button class="btb btn-sm bg-info">edit</button></p>
                    </div>
                    <div class="card-footer">
                    <small class="text-muted">Last updated 3 mins ago</small>
                    </div>
                </div>
                <div class="card">
                    <img src="https://images.unsplash.com/photo-1614357975885-1ac53a78d914?ixlib=rb-1.2.1&ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&auto=format&fit=crop&w=634&q=80" class="card-img-top" alt="...">
                    <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                    <p><button class="btb btn-sm bg-danger">delete</button>&nbsp;<button class="btb btn-sm bg-info">edit</button></p>
                    </div>
                    <div class="card-footer">
                    <small class="text-muted">Last updated 3 mins ago</small>
                    </div>
                </div>
                
            </div>
        </div>
    </div> <!-- div col -->


    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content  bg-primary">
        
            <div class="modal-header">
            <h5 class="modal-title lead text-white" id="exampleModalLongTitle">Add New Image</h5>
            <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div> <!-- modal-header -->

            <div class="modal-body">

            <div class="form-row mt-3"> 
                <input type="text" class="form-control" placeholder="Image Title">
            </div>
            
            <div class="form-row mt-3">
                <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFile">
                <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
            </div>

            </div> <!-- modal-body -->

            <div class="modal-footer">
            <button type="button" class="btn btn-success">Upload Image</button>
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