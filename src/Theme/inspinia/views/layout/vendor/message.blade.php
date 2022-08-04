@if (session()->has('successMessage'))
    <div class="alert alert-success">
        {{ session()->get('successMessage') }}
    </div>
@endif
@if (session()->has('errorMessage'))
    <div class="alert alert-danger">
        {{ session()->get('errorMessage') }}
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <h3>There is an error</h3>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif