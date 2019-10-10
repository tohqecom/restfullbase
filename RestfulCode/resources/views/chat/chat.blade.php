@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 aside">
            <div class="row text-center">
                <div class="logo"><img src="/logo.png" alt="logo"/></div>
                <h4 class="title"><b>Guestbook</b></h4>
            </div>
            <div class="row text-center group-box">
                <div class="decription"></div>
                <div class="send-message">
                    <button id="submitSend" data-toggle="collapse" data-target="#form-message" class="btn btn-primary text-center">Post a message</button>
                </div>
            </div>
            <div class=" row body collapse" id="form-message">
                <div class="form-group">

                    <textarea class="form-control send-message" rows="5" placeholder="Write a message..." id="message"></textarea>

                </div>
                <div class="form-group">
                    <a href="#" class=" col-lg-4 text-right btn btn-primary pull-right" id="submitSend" role="button">
                        <i class="fa fa-plus"></i> Send Message
                    </a>
                </div>
                
            </div>
        </div>
        <div class="col-md-8 content">
            <div class="" id="messageContainer"></div>
            <!-- <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Chat</div>

                    <div class="panel-body">

                        <div class="msg-wrap" id="messageContainer"></div>

                        <div class="form-group">

                            <textarea class="form-control send-message" rows="3" placeholder="Write a message..." id="message"></textarea>

                        </div>

                        <div class="form-group">
                            <a href="#" class=" col-lg-4 text-right btn btn-primary pull-right" id="submitSend" role="button">
                                <i class="fa fa-plus"></i> Send Message
                            </a>
                        </div>
                </div>
            </div> -->
        </div>
    </div>

</div>
@endsection

@push('scripts')
    <script>
        window.modules.chatController = {};
    </script>
@endpush
