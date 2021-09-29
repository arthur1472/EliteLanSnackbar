<x-app-layout>
    <div class="max-w-2xl mx-auto pt-8 pb-16 px-4 sm:px-6 lg:px-0">
        <h1 class="text-3xl font-extrabold text-center tracking-tight text-gray-900 sm:text-4xl">Bestelling bekijken</h1>

        <div class="mt-6">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form action="{{route('admin.orders.update', ['order' => $order])}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6">
                                    <label for="system_note" class="block text-sm font-medium text-gray-700">Opmerking</label>
                                    <textarea id="system_note" name="system_note" rows="3" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md">{{$order->system_note}}</textarea>
                                </div>
                                <div class="col-span-6">
                                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                    <select id="status" name="status">
                                        @foreach($statuses as $status)
                                            <option @if($status->id === $order->status->id) selected @endif value="{{$status->id}}">{{$status->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Opslaan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="bg-white shadow overflow-hidden mt-5 sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Bestelling gegevens
                </h3>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                <dl class="sm:divide-y sm:divide-gray-200">
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Naam
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{$order->user->name}}
                        </dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Prijs
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            €{{number_format($order->price,2)}}
                        </dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Status
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{$order->status->name}}
                        </dd>
                    </div>
                    @if($order->user_note)
                        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Opmerking
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{$order->user_note}}
                            </dd>
                        </div>
                    @endif
                </dl>
            </div>
        </div>

        <div class="bg-white shadow overflow-hidden mt-5 sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Producten
                </h3>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                <ul role="list" class="divide-y divide-gray-200">
                    @foreach($order->orderLines as $orderLine)
                        <li class="p-4 sm:p-6">
                            <div class="flex items-center sm:items-start">
                                <div class="flex-1 text-sm">
                                    <div class="font-medium text-gray-900 sm:flex sm:justify-between">
                                        <h5>
                                            {{$orderLine->item->name}}
                                        </h5>
                                        <p class="mt-2 text-md font-bold text-gray-900 sm:mt-0">
                                            {{$orderLine->quantity}}x
                                        </p>
                                    </div>
                                    @if($orderLine->toppingModels)
                                        <p class="block mt-2">
                                            <div class="mt-2">
                                                @foreach($orderLine->toppingModels as $topping)
                                                    <p class="mt-1 text-md text-gray-700">
                                                        - {{$topping->name}}
                                                    </p>
                                                @endforeach
                                            </div>
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
