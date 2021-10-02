<x-app-layout>
    <div class="bg-white">
        <div class="max-w-4xl mx-auto pt-8 pb-16 px-4 sm:px-6 lg:px-0">
            <h1 class="text-3xl font-extrabold text-center tracking-tight text-gray-900 sm:text-4xl">Bestellingen</h1>

            <div class="flex flex-col mt-8">
                <div class="overflow-x-auto mt-2">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nummer
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Persoon
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Datum
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                    </th>
                                </tr>
                                </thead>
                                @foreach($orders as $order)
                                    <tbody x-data="{ open: false }" class="bg-white divide-y divide-gray-200">
                                        <tr @click="open = !open">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{$order->id}}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{$order->user->name}}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <div class="inline-flex items-center font-bold px-3 py-2 border border-transparent text-sm text-white leading-4 font-medium rounded-md {{$order->status->color_class}}">
                                                    {{$order->status->name}}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{$order->created_at->toDateTimeString()}}
                                            </td>
                                            <td @click="open = !open" class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex justify-end">
                                                <a href="{{route('admin.orders.show', ['order' => $order])}}" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Bekijk</a>
                                            </td>
                                        </tr>
                                        <tr x-show="open">
                                            <td>
                                                <ul>
                                                    @foreach($order->orderLines as $orderLine)
                                                        <li class="p-2 sm:p-2">
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
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="hidden">
    <p class="bg-black">a</p>
    <p class="bg-blue-500">b</p>
    <p class="bg-green-500">c</p>
    <p class="bg-red-500">d</p>
</div>
</x-app-layout>
