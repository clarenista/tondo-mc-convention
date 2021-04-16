@extends('layouts.cms')

@section('title')
Add Booth
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
                    <li class="breadcrumb-item"><a href="{{ url('/cms/standees') }}">Standees</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{isset($standee->id) ? 'Edit Booth' : 'Add Standee'}}</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <a href="{{ url('/cms/standees') }}" class="btn btn-info float-right">RETURN</a>
        </div>
    </div>
    <br>
    <div class="row">

        <div class="col-md-6">
            <h3>Standee Details</h3>
            <form action="{{ route('cms.standees.store') . ( $standee->id ? '/' . $standee->id : '') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @isset($standee->id)
                {{ method_field('PUT') }}
                @endisset
                <?php $model = $standee; ?>
                <div class="form-group">
                    @error('user_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                @include('cms.include.input-select', ['key' => 'panorama_location', 'label' => 'Location'])
                @include('cms.include.input-text', ['key' => 'name', 'label' => 'Name'])
                @include('cms.include.input-text', ['key' => 'caption', 'label' => 'Caption'])
                @include('cms.include.input-file', ['key' => 'file', 'label' => 'File'])
                @include('cms.include.input-text', ['key' => 'pitch', 'label' => 'X Position'])
                @include('cms.include.input-text', ['key' => 'yaw', 'label' => 'Y Position'])
                <div class="form-group">
                    <button class="btn btn-success btn-block">&#10004; {{isset($standee->id) ? 'EDIT NEW BOOTH' : 'ADD NEW BOOTH'}}</button>
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

        $('#cancelSelectSponsor').click(function(){
            if(!user_id){
                user_id.val(null)
            }
            modalSelectSponsor.modal('hide')
        });

        $('#newHotspot').click(function(){
            $('#hotspot_form').show()
            $('#emptyHotspot').hide()
        })

        $(".btn-delete").click(function() {

            if (confirm('Are you sure you want to delete?')) {
                $.ajax({
                    url: $(this).data('href'),
                    type: 'POST',
                    success: function(response) {
                        console.log(response);
                        location.reload();
                    }
                });
            }

        });
    });

    $("input[type=file]").each(function () {
        $(this).on('change', function(){
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    });

    function select_sponsor(sponsor){
        $('[name="user_id"]').val(sponsor.id)
        $('#sponsor_name').text(sponsor.first_name+" "+sponsor.last_name)
        $('#my-modal').modal('hide')
    }
</script>
@stop
