<div class="col-sm-8 conversation">
    <div class="row heading">
        <div class="col-sm-2 col-md-1 col-xs-3 heading-avatar">
            <div class="heading-avatar-icon">
                <img src="https://bootdey.com/img/Content/avatar/avatar6.png" />
            </div>
        </div>
        <div class="col-sm-8 col-xs-7 heading-name">
            <a class="heading-name-meta">John Doe</a>
            <span class="heading-online">Online</span>
        </div>
        <div class="col-sm-1 col-xs-1 heading-dot pull-right">
            <i class="fa fa-ellipsis-v fa-2x pull-right" aria-hidden="true"></i>
        </div>
    </div>

    <div class="d-flex flex-column message" id="conversation">
        @foreach ($messages as $message)
            @if ($message->user_id_from == auth()->user()->id)
                <div class="col-sm-12 message-main-sender">
                    <div class="sender">
                        <div class="message-text h-auto">{{ $message->text }}</div>
                        <span class="message-time pull-right">{{ $message->created_at }}</span>
                    </div>
                </div>
            @else
                <div class="col-sm-12 message-main-receiver">
                    <div class="receiver h-auto">
                        <div class="message-text">{{ $message->text }}</div>
                        <span class="message-time pull-right">{{ $message->created_at }}</span>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <div>
        <form class="row reply" wire:submit.prevent="sendMessage">
            {{-- <div class="col-sm-1 col-xs-1 reply-emojis">
                <i class="fa fa-smile-o fa-2x"></i>
            </div> --}}
            <div class="col-sm-11 col-xs-11 reply-main">
                <textarea class="form-control" rows="1" id="comment" wire:model="text"></textarea>
            </div>
            {{-- <div class="col-sm-1 col-xs-1 reply-recording">
                <i class="fa fa-microphone fa-2x" aria-hidden="true"></i>
            </div> --}}
            <button type="submit" class="col-sm-1 col-xs-1 reply-send btn">
                <i class="fa fa-send fa-2x" aria-hidden="true"></i>
            </button>
        </form>
    </div>
</div>
