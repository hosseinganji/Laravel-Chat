<div class="sideBar">
    @foreach ($users as $user)
        <div class="d-flex flex-row sideBar-body" wire:key="{{ $user->id }}" wire:click="selectUser({{ $user->id }})">
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
                    <div class="col-sm-4 col-xs-4 pull-right sideBar-time">
                        <span class="time-meta pull-right">18:18 </span>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
