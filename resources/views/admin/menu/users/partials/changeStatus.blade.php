@if($dt->status !== 'active')
    <a href="{{ route('admin.users.update.status.active',$dt->id) }}" class="btn btn-sm btn-success"
        onclick="event.preventDefault();
        document.getElementById('changeStatusActive').submit();">
        <i class="fa fa-plus-circle"></i>
    </a>

    <form id="changeStatusActive" action="{{ route('admin.users.update.status.active',$dt->id) }}" method="POST" style="display: none">
        @csrf
    </form>
@else
    <a href="{{ route('admin.users.update.status.deactivate',$dt->id) }}" class="btn btn-sm btn-danger"
        onclick="event.preventDefault();
        document.getElementById('changeStatusDeactivate').submit();">
        <i class="fa fa-times"></i>
    </a>

    <form id="changeStatusDeactivate" action="{{ route('admin.users.update.status.deactivate',$dt->id) }}" method="POST" style="display: none">
        @csrf
    </form>
@endif