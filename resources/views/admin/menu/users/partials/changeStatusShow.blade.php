@if($data->status !== 'active')
    <a href="{{ route('admin.users.update.status.active',$data->id) }}" class="btn btn-app"
       onclick="event.preventDefault();
        document.getElementById('changeStatusActive').submit();">
        <i class="fa fa-plus-circle"></i> Activate
    </a>

    <form id="changeStatusActive" action="{{ route('admin.users.update.status.active',$data->id) }}"
        method="POST" style="display: none">
        @csrf
    </form>
@else
    <a href="{{ route('admin.users.update.status.deactivate',$data->id) }}" class="btn btn-app"
        onclick="event.preventDefault();
        document.getElementById('changeStatusDeactivate').submit();">
        <i class="fa fa-times"></i> Deactivate
    </a>

    <form id="changeStatusDeactivate" action="{{ route('admin.users.update.status.deactivate',$data->id) }}"
        method="POST" style="display: none">
        @csrf
    </form>
@endif