<p>
    Your message has been successfully added
</p>

@if($messages)
    Messages by last hour:
    <br>
    @foreach ($messages as $message)
        <div class="col-md-4 col-sm-6 item-message">
            <div class="message">{{ $message->message }}</div>
            <div class="user">{{ $message->user->name }}</div>
            <div class="time">{{ $message->created_at-> }}</div>
        </div>
    @endforeach
@endif