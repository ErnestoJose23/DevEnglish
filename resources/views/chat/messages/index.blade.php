<div class="message-wrapper">
    <ul class="messages">
        <li class="message clearfix">
            @if($chat->user_id == Auth::id())
            <div class="sent">
                <p>{{$chat->content}}</p>
                <p class="date">{{date('d M y, h:i a', strtotime($chat->created_at))}}</p>
            </div>
            @else
            <div class="received">
                <p>{{$chat->content}}</p>
                <p class="date">{{date('d M y, h:i a', strtotime($chat->created_at))}}</p>
            </div>
            @endif
        </li>
        @foreach($chat->messages as $message)
        <li class="message clearfix" >
            <div class="{{($message->user_id == Auth::id()) ? 'sent' : 'received'}}">
                <p>{{$message->content}}</p>
                <p class="date">{{date('d M y, h:i a', strtotime($message->created_at))}}</p>
            </div>
        </li>
        @endforeach
    </ul>
</div>
<div class="input-text">
    <input type="text" name="message" class="submit consultainput">
</div>