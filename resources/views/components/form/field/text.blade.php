@props([
    'name',
    'label',
    'id',
    'for',
    'type',

])

@php
    //classes
    $main_container = "sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5";
    $label = "block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2";
    $input_container = "mt-1 sm:col-span-2 sm:mt-0";
    $input = "block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:max-w-xs sm:text-sm";
@endphp

<div class="{{ $main_container }}">
    <label for={{ $for }} class="{{ $label }}">{{ $slot }}</label>
    <div class="{{ $input_container }}">
      <input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}" class="{{ $input }}">
    </div>
</div>
