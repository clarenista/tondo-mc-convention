@extends('layouts.cms')

@section('title')
    Chat
@stop

@section('content')

    <div class="d-flex">
        <div class="flex-fill">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" >
                    <li class="breadcrumb-item active"  style="width:100%" aria-current="page">Me <span class="pull-right">{{ $guest->name }}</span></li>
                </ol>
            </nav>
        </div>
    </div>


    <div class="row">
        <div class="col-sm col-lg">
            <table id="example" class="table table-bordered">
                @foreach ($guest->chats as $chat)

                    @php
                        $sender = $guest->name;
                        $align = 'end';
                        if ($chat->sender_id == auth()->user()->booth->id) {
                            $sender = 'Me';
                            $align = 'left';
                        }
                    @endphp
                    <tr>
                        <td style="text-align: {{ $align }}">
                            {{ $chat->message }}
                        </td>
                    </tr>
                @endforeach

            </table>
            <form method="POST" action="{{ route('cms.sponsor.chat.guest.message', $guest->id) }}">
                @csrf
                <div class="d-flex">
                    <div class="flex-fill">
                        <input type="text" class="form-control" name="message" placeholder="Enter Message" aria-label="Enter Message">
                    </div>
                    <div class="d-flex">
                        <button type="submit" class="btn btn-primary">SEND</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

@section('js')

    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>

@stop
