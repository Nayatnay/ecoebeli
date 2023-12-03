@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'text-gray-800 border-gray-200 focus:border-gray-300 focus:ring-0 rounded-md shadow-sm']) !!}>
