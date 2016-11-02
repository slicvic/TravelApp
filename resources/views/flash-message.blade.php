@if (count($errors) > 0)
<div class="alert alert-danger">
    <strong><i class="fa fa-times"></i> Whoops</strong>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
