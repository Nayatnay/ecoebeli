@if ($errors->any())
    <div {{ $attributes }}>
        <div class="font-medium text-lime-600">¡Vaya! Algo salió mal.</div>

        <ul class="mt-3 list-disc list-inside text-sm text-lime-600">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
