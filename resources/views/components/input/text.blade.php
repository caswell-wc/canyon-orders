@props(['name', 'label' => null, 'errors', 'box-class' => null])
<div class="{{$attributes->get('class')}}">
    @if(!empty($label))
        <label for="{{$name}}" class="block text-sm font-medium text-gray-700">{{$label}}</label>
    @endif
    <div class="mt-1 relative rounded-md shadow-sm">
        <input
            {{$attributes->except('class')}}
            name="{{$name}}"
            id="{{$name}}"
            class="block w-full pr-10 sm:text-sm rounded-md
                @if(!empty($errors))border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @endif "
            aria-invalid="{{ empty($errors) ? 'false' : 'true' }}"
            @if(!empty($errors))
            aria-describedby="{{$name}}-error"
            @endif
        >
        @if(!empty($errors))
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                <!-- Heroicon name: solid/exclamation-circle -->
                <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
            </div>
        @endif
    </div>
    @if(!empty($errors))
        <ul class="mt-2 text-sm text-red-600" id="{{$name}}-error">
           @foreach($errors as $error)
               <li>{{$error}}</li>
           @endforeach
        </ul>
    @endif
</div>
