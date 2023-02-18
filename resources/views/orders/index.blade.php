<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bestellingen') }}
        </h2>
    </x-slot>

    <div class="bg-white">
        <div class="max-w-7xl mx-auto pb-16 pt-8 px-4 sm:px-6 lg:pb-24 lg:px-8">
            <div class="w-full relative">
                <h1 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">Bestelling historie</h1>
                <p class="mt-2 text-sm text-gray-500">Bekijk de status van recente bestellingen, herbestel een bestelling of plaats een nieuwe bestelling</p>
                <a href="{{route('items.index')}}" class="md:absolute md:top-0 md:right-0 flex items-center justify-center bg-white mt-6 py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:w-auto sm:mt-0">
                    Nieuwe bestelling
                </a>
            </div>

            <div class="mt-16">
                <div class="max-w-7xl mx-auto sm:px-2 lg:px-8">
                    @if(session('success'))
                        <div class="mb-8 max-w-2xl mx-auto lg:max-w-4xl rounded-md bg-green-50 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <!-- Heroicon name: solid/check-circle -->
                                    <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-green-800">
                                        Bestelling geplaatst
                                    </h3>
                                    <div class="mt-2 text-sm text-green-700">
                                        <p>
                                            Je bestelling zal zo snel mogelijk in behandeling genomen worden.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="max-w-2xl mx-auto sm:px-4 lg:max-w-4xl lg:px-0">
                        @foreach($ordersStatuses as $orderStatus)
                            <div class="flex justify-between">
                                <p class="text-3xl">
                                    {{$orderStatus->first()->status->name}}
                                </p>
                                <div class="rounded-full p-5 {{$orderStatus->first()->status->color_class}}"></div>
                            </div>

                            @foreach($orderStatus as $order)
                                <div class="bg-white border-t border-b border-gray-200 shadow-sm sm:rounded-lg sm:border mb-10 mt-5">
                                    <div class="flex items-center p-4 border-b border-gray-200 sm:p-6 sm:grid sm:grid-cols-4 sm:gap-x-6">
                                        <dl class="flex-1 grid grid-cols-2 gap-x-4 text-sm md:col-span-3 md:grid-cols-3 lg:col-span-2">
                                            <div>
                                                <dt class="font-medium text-gray-900">Bestelling nummer</dt>
                                                <dd class="mt-1 text-gray-500">
                                                    {{$order->id}}
                                                </dd>
                                            </div>
                                            <div class="hidden sm:block">
                                                <dt class="font-medium text-gray-900">Datum geplaatst</dt>
                                                <dd class="mt-1 text-gray-500">
                                                    <time datetime="{{$order->created_at->toDateTimeString()}}">{{$order->created_at->toDateTimeString()}}</time>
                                                </dd>
                                            </div>
                                            <div>
                                                <dt class="font-medium text-gray-900">Totaal bedrag</dt>
                                                <dd class="mt-1 font-medium text-gray-900">
                                                    {{$order->total_price}}
                                                </dd>
                                            </div>
                                        </dl>

                                        <div class="lg:col-span-2 lg:flex lg:items-center lg:justify-end lg:space-x-4">
                                            <a href="{{route('orders.reorder', ['order' => $order->id])}}" class="flex items-center justify-center bg-white py-2 px-2.5 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                <span>Opnieuw bestellen</span>
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Products -->
                                    <ul role="list" class="divide-y divide-gray-200">
                                        @if($order->system_note)
                                            <li class="p-4 sm:p-6 bg-red-100">
                                                <div class="flex items-center sm:items-start">
                                                    <div class="flex-1 text-sm">
                                                        <div class="font-medium text-gray-900 sm:flex sm:justify-between">
                                                            <h5>
                                                                Opmerking systeem: {{$order->system_note}}
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endif
                                        @foreach($order->orderLines as $orderLine)
                                            <li class="p-4 sm:p-6">
                                                <div class="flex items-center sm:items-start">
                                                    <div class="flex-1 text-sm">
                                                        <div class="font-medium text-gray-900 sm:flex sm:justify-between">
                                                            <h5>
                                                                {{$orderLine->item->name}} ({{$orderLine->quantity}}x)
                                                            </h5>
                                                            <p class="mt-2 sm:mt-0">
                                                                {{$orderLine->total_price}}
                                                            </p>
                                                        </div>
                                                        <p class="text-gray-500 block mt-2">
                                                            {{$orderLine->line_price}} p.st.
                                                        </p>
                                                        <p class="text-gray-500 block mt-2">
                                                            @if($orderLine->toppingModels)
                                                                <div class="mt-2">
                                                                    @foreach($orderLine->toppingModels as $topping)
                                                                        <p class="mt-1 text-sm text-gray-500">
                                                                            - {{$topping->name}}
                                                                        </p>
                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                        @if($order->user_note)
                                                <li class="p-4 sm:p-6 bg-green-100">
                                                    <div class="flex items-center sm:items-start">
                                                        <div class="flex-1 text-sm">
                                                            <div class="font-medium text-gray-900 sm:flex sm:justify-between">
                                                                <h5>
                                                                    Opmerking: {{$order->user_note}}
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                        @endif
                                    </ul>
                                </div>
                            @endforeach
                        @endforeach
                        <!-- More orders... -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
