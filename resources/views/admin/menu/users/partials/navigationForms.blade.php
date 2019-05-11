<form action="{{ route('admin.users') }}" id="navigationStudent" method="GET" class="hidden">
    <input type="text" value="student" name="search">
</form>

<form action="{{ route('admin.users') }}" id="navigationTeacher" method="GET" class="hidden">
    <input type="text" value="teacher" name="search">
</form>

<form action="{{ route('admin.users') }}" id="navigationActive" method="GET" class="hidden">
    <input type="text" value="active" name="search">
</form>

<form action="{{ route('admin.users') }}" id="navigationInactive" method="GET" class="hidden">
    <input type="text" value="inactive" name="search">
</form>