@props(['label', 'name', 'options'])
<div class="{{$attributes->get('class')}}">
    <label for="{{$name}}" class="block text-sm font-medium text-gray-700">{{$label}}</label>
    <select
        {{$attributes->except(['class', 'placeholder'])}}
        id="{{$name}}"
        name="{{$name}}"
        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
        @if($attributes->has('placeholder'))
            <option selected disabled value="">{{ $attributes->get('placeholder') }}</option>
        @endif
        @foreach($options as $value => $display)
            <option value="{{$value}}">{{$display}}</option>
        @endforeach
    </select>
</div>
