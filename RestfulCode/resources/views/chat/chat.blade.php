@extends('layouts.app')

@section('content')
<style type="text/css">
    .container-fluid {
        /*background-color: red;*/
  /*width: 100%;*/
  /*padding-top: 100%;*/ /* 1:1 Aspect Ratio */
  /*position: relative; *//* If you want text inside of it */
    }
    .content {
        background-color: #383842;
        /*border: 1px solid red;*/
        min-height: 400px;
        overflow-y: hidden;
        padding: 0 1em;
    }
    .item-message {
        padding: 1em;
    }
    .aside {
        padding: 0 2em 0 1em;
        margin-bottom: 1em;
    }
    .group-box {
        margin-bottom: 1em;
    }
    .wrapper {
      display: flex;
      flex-wrap: wrap;
      margin: 0 -1em;
    }
    .container {
      width: 100%;
      max-width: 70em;
      margin: 0 auto; /* Center alignment */
      padding: 0 1em;
    }
</style>
<div class="container-fluid">
    <div class="corver">
        <div class="col-md-4 col-sm-4 aside">
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
        <div class="col-md-8 col-sm-8 content">
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
