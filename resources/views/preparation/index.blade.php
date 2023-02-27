@extends('layouts.empty-app')

@section('content')
    <div class="flex">
        <div class="w-1/6">
            <div class="bg-blue-500">
                <p class="p-2 text-white text-3xl font-bold">Nieuw</p>
            </div>
            <dl class="mt-2 grid grid-cols-1 gap-5 lg:grid-cols-2">
                @foreach($newOrders as $newOrder)
                    <div class="ml-4">
                        <p class="font-bold text-blue-400 text-6xl">{{$newOrder->getKey()}}</p>
                        <p class="text-sm truncate">{{$newOrder->user->name}}</p>
                        <p class="text-xs truncate">{{$newOrder->updated_at->format('H:i')}}</p>
                    </div>
                @endforeach
            </dl>
        </div>
        <div class="w-1/6">
            <div class="bg-gray-500">
                <p class="p-2 text-white text-3xl font-bold">Wordt bereid</p>
            </div>
            <dl class="mt-2 grid grid-cols-1 gap-5 lg:grid-cols-2">
                @foreach($prepareOrders as $prepareOrder)
                    <div class="ml-4">
                        <p class="font-bold text-gray-400 text-6xl">{{$prepareOrder->getKey()}}</p>
                        <p class="text-sm truncate">{{$prepareOrder->user->name}}</p>
                        <p class="text-xs truncate">{{$prepareOrder->updated_at->format('H:i')}}</p>
                    </div>
                @endforeach
            </dl>
        </div>
        <div class="w-4/6">
            <div class="bg-green-500">
                <p class="p-2 text-white text-3xl font-bold">Gereed</p>
            </div>
            <dl class="mt-2 grid grid-cols-1 gap-3 sm:grid-cols-3 lg:grid-cols-6">
                @foreach($doneOrders as $doneOrder)
                    <div class="ml-4">
                        <p class="font-bold text-green-400 @if($loop->first) text-9xl @else text-8xl @endif">{{$doneOrder->getKey()}}</p>
                        <p class="text-sm truncate">{{$doneOrder->user->name}}</p>
                        <p class="text-sm truncate">{{$doneOrder->updated_at->format('H:i')}}</p>
                    </div>
                @endforeach
            </dl>
        </div>
    </div>
    <div class="absolute w-full bg-black bottom-0 z-10">
        <div class="flex justify-center p-2">
            <p class="text-white text-2xl font-bold">Eet smakelijk!</p>
        </div>
    </div>

    <script>
        setTimeout(function(){
            window.location.reload();
        }, 10000);
    </script>
@endsection
