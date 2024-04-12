<div class="sideBar">
    @foreach ($users as $user)
        <div class="d-flex flex-row sideBar-body" wire:key="{{ $user->id }}"
            wire:click="selectUser({{ $user->id }})"
            style="{{ $selected_user ? ($user->id == $selected_user['id'] ? 'background: #d1d1d1;' : '') : '' }}">
            <div class="col-2 sideBar-avatar">
                <div class="avatar-icon">
                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" />
                </div>
            </div>
            <div class="col-10 sideBar-main">
                <div class="d-flex flex-row justify-content-between">
                    <div class="col-sm-8 col-xs-8 sideBar-name">
                        <span class="name-meta fw-bold">{{ $user->name }}</span>
                        <span class="row small text-secondry">{{ $user->email }}</span>
                    </div>
                    <div class="col-sm-4 col-xs-4 pull-right sideBar-time d-flex flex-column align-items-end">
                        <span class="time-meta pull-right">18:18</span>
                        @if (count(auth()->user()->recive_messages()->where("is_read", 0)->where("user_id_from", $user->id)->get()))
                            <span class="badge bg-success text-end" style="border-radius: 50%; padding-top: 5px;">
                                {{ count(auth()->user()->recive_messages()->where("is_read", 0)->where("user_id_from", $user->id)->get()) }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
