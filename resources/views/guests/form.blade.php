@extends('layouts.cms')

@section('title')
Add User
@stop


@section('content')
<style>
    .input-group>span {
        width: 120px;
    }

    .input-group>span>span {
        width: 120px;
    }
</style>
<div class="col-md-12">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/cms/users') }}">Users</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{isset($user->id) ? 'Edit User' : 'Add User'}}</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-12">
            <a href="{{ url('/cms/users') }}" class="btn btn-info float-right">RETURN</a>
        </div>
        <div class="col-md-6">
            <form action="{{ route('cms.users.store') . ( $user->id ? '/' . $user->id : '') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @isset($user->id)
                {{ method_field('PUT') }}
                @endisset
                <?php $model = $user; ?>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-prepend">
                            <span class="input-group-text">Role</span>
                        </span>
                        <select id="my-select" class="form-control custom-select" name="role">
                            <option>Admin</option>
                            <option>Sponsor</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    
                </div>
                @include('cms.include.input-text', ['key' => 'first_name', 'label' => 'First Name'])
                @include('cms.include.input-text', ['key' => 'last_name', 'label' => 'Last Name'])
                @include('cms.include.input-text', ['key' => 'mobile_number', 'label' => 'Mobile Number'])
                @empty($user->id)
                @include('cms.include.input-text', ['key' => 'email', 'label' => 'Username'])
                @include('cms.include.input-text', ['key' => 'password', 'label' => 'Password'])
                @endempty
                <br>
                <br>
                <div class="form-group">
                    <button class="btn btn-success btn-block">ADD NEW BOOTH</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
@section('js')
<script>
    $(document).ready(function() {
        let sponsor_name = $('#sponsor_name')
        let user_id = $('[name="user_id"]')
        let modalSelectSponsor  =  $('#my-modal')
        $('#example').DataTable();
        sponsor_name.click(function(e){
            modalSelectSponsor.modal({
                show: true,
                backdrop: 'static',
                keyboard: false
            })
        })
        $('#sponsor_details').dblclick(function(){
            let details = $(this).data("details")
            user_id.val(details.id)
            sponsor_name.text(details.first_name)
            modalSelectSponsor.modal('hide')
        })
        $('#cancelSelectSponsor').click(function(){
            if(!user_id){
                user_id.val(null)
            }
            modalSelectSponsor.modal('hide')
        });
    });
    $("input[type=file]").each(function () {
        $(this).on('change', function(){
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    });
</script>
@stop
