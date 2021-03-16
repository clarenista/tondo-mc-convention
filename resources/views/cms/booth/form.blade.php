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
<div id="my-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="my-modal-title">Select Sponsor</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-light table-hover" id="example">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sponsors as $key => $sponsor)
                        <tr onclick="select_sponsor({{$sponsor}})" style="cursor: pointer;">
                            <td>{{$key + 1}}</td>
                            <td>{{$sponsor->first_name." ".$sponsor->last_name}}</td>
                            <td>{{$sponsor->email}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    
                </table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-warning" type="button" id="cancelSelectSponsor">Cancel</button>
            </div>
            
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/cms/booths') }}">Booth</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Booth</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-12">
            <a href="{{ url('/cms/booths') }}" class="btn btn-info float-right">RETURN</a>
        </div>
        <div class="col-md-6">
            <form action="{{ route('cms.booths.store') . ( $booth->id ? '/' . $booth->id : '') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @isset($booth->id)
                {{ method_field('PUT') }}
                @endisset
                <?php $model = $booth; ?>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-prepend">
                        <span class="input-group-text">Sponsor</span>
                        </span>
                        <div class="form-control" id="sponsor_name">{{$booth->user ? $booth->user->first_name : 'Select Sponsor'}}</div>
                        <input type="hidden" readonly class="form-control" name="user_id" value="{{$booth->user_id ? $booth->user_id : ''}}">
                    </div>
                </div>
                <div class="form-group">
                    @error('user_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>


                @include('cms.include.input-text', ['key' => 'name', 'label' => 'Name'])
                @include('cms.include.input-text', ['key' => 'caption', 'label' => 'Caption'])
                @include('cms.include.input-text', ['key' => 'url', 'label' => 'Url'])
                @include('cms.include.input-text', ['key' => 'x', 'label' => 'X Position'])
                @include('cms.include.input-text', ['key' => 'y', 'label' => 'Y Position'])
                @include('cms.include.input-file', ['key' => 'background', 'label' => 'Background'])
                @include('cms.include.input-file', ['key' => 'booth', 'label' => 'Booth'])
                <br>
                @foreach ($booth->hotspots as $i => $hotspot)
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-prepend">
                            <span class="input-group-text">{{$hotspot->name}}</span>
                        </span>
                        <input type="text" class="form-control" name="hotspots[{{$hotspot->id}}][name]"
                            placeholder="Hotspot" aria-label="Hotspot" value="{{$hotspot->name}}">
                    </div>
                </div>
                @endforeach
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

    function select_sponsor(sponsor){
        $('[name="user_id"]').val(sponsor.id)
        $('#sponsor_name').text(sponsor.first_name+" "+sponsor.last_name)
        $('#my-modal').modal('hide')
    }
</script>
@stop
