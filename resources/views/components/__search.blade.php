<form action="{{ $route }}" method="get" class="ml-3 py-4">
    <div class="input-group input-group-sm">
        {{ Form::text('search', Request::get('search'), [
                    'class' => 'form-control',
                    'autocomplete' => 'off',
                    ]) }}
        <div class="input-group-append">
            {{ Form::submit('Search', ['class' => 'btn btn-primary']) }}
        </div>
    </div>
</form>
