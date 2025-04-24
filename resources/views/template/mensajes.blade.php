@if (count($errors) > 0)
    <div class="alert alert-danger">
    	<p>Atención con las siguientes observaciones:</p>
        <br>
        <ul>
            @foreach ($errors->all() as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
@endif