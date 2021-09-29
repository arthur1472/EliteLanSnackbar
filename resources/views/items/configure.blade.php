<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Configureer je item') }}
        </h2>
    </x-slot>

    <form action="{{route('carts.add_item')}}" method="post">
        @csrf
        <input type="hidden" name="itemId" value="{{$item->id}}">
        <div class="max-w-2xl mx-auto py-6 px-4 sm:py-6 sm:px-6 lg:max-w-4xl lg:px-8">
            <div class="bg-white px-4 py-5 border-b border-gray-200 sm:px-6 rounded">
                <div class="-ml-4 -mt-4 flex justify-between items-center flex-wrap sm:flex-nowrap">
                    <div class="ml-4 mt-4">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            {{$item->name}}
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">
                            {{$item->description}}
                        </p>
                    </div>
                    <div class="ml-4 mt-4 flex-shrink-0">
                        <button type="submit" class="relative inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Toevoegen
                        </button>
                    </div>
                </div>

                <fieldset>
                    <div class="mt-4 border-t border-b border-gray-200 divide-y divide-gray-200">
                        @foreach($item->toppings()->active()->get() as $topping)
                            <div class="relative flex items-start py-4">
                                <div class="min-w-0 flex-1 text-sm">
                                    <label for="topping-{{$topping->id}}" class="font-medium text-gray-700 select-none">{{$topping->name}}</label>
                                </div>
                                <div class="ml-3 flex items-center h-5">
                                    <input id="topping-{{$topping->id}}" name="toppings[{{$topping->id}}]" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </fieldset>
            </div>
        </div>
    </form>
</x-app-layout>
