<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8">
                <dl class="mt-5 grid grid-cols-1 gap-5 mx-2 sm:grid-cols-3">
                    <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                        <dt class="text-sm font-medium text-gray-500 truncate">
                            Huidig saldo
                        </dt>
                        <dd class="mt-1 text-3xl font-semibold text-gray-900">
                            {{ $wallet }}
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>


    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-8">
            <dl class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                <div>
                    <p class="md:text-3xl ml-2 text-xl mb-2">Laatste 10 saldo wijzigingen</p>
                    <div class="flow-root bg-white rounded-lg p-5">
                        <ul role="list" class="-mb-8">
                        @foreach($lastFiveActivities as $activity)
                            <li>
                                <div class="relative pb-8">
                                    @if(! $loop->last)
                                        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                    @endif
                                    <div class="relative flex space-x-3">
                                        @if($activity['difference']->isNegative())
                                            <div>
                                                <span class="h-8 w-8 rounded-full bg-red-400 flex items-center justify-center ring-8 ring-white">
                                                  <!-- Receipt -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-white">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5L12 21m0 0l-7.5-7.5M12 21V3" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                                <div>
                                                    @if($activity['self'])
                                                        <p class="text-sm text-gray-800">Bestelling geplaatst</p>
                                                    @else
                                                        <p class="text-sm text-gray-800">Geld afgeschreven  @if($activity['activityUser'])door {{$activity['activityUser']->name}}@endif</p>
                                                    @endif
                                                    <p class="text-xs text-gray-600">{{$activity['date']}}</p>
                                                </div>
                                                <div class="whitespace-nowrap text-right text-sm text-gray-500">
                                                    <p>{{$activity['difference']->formatByIntl()}}</p>
                                                </div>
                                            </div>
                                        @else
                                            <div>
                                                <span class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white">
                                                  <!-- Smiley face money -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-white">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                                <div>
                                                    <p class="text-sm text-gray-800">Saldo opgewaardeerd @if($activity['activityUser'])door {{$activity['activityUser']->name}}@endif</p>
                                                    <p class="text-xs text-gray-600">{{$activity['date']}}</p>
                                                </div>
                                                <div class="whitespace-nowrap text-right text-sm text-gray-500">
                                                    <p>+{{$activity['difference']->formatByIntl()}}</p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endforeach


{{--                        <li>--}}
{{--                            <div class="relative pb-8">--}}
{{--                                <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>--}}
{{--                                <div class="relative flex space-x-3">--}}
{{--                                    <div>--}}
{{--                                        <span class="h-8 w-8 rounded-full bg-red-400 flex items-center justify-center ring-8 ring-white">--}}
{{--                                          <!-- Receipt -->--}}
{{--                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-white">--}}
{{--                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5L12 21m0 0l-7.5-7.5M12 21V3" />--}}
{{--                                            </svg>--}}
{{--                                        </span>--}}
{{--                                    </div>--}}
{{--                                    <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">--}}
{{--                                        <div>--}}
{{--                                            <p class="text-sm text-gray-500">Applied to <a href="#" class="font-medium text-gray-900">Front End Developer</a></p>--}}
{{--                                        </div>--}}
{{--                                        <div class="whitespace-nowrap text-right text-sm text-gray-500">--}}
{{--                                            <time datetime="2020-09-20">Sep 20</time>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </li>--}}

{{--                        <li>--}}
{{--                            <div class="relative pb-8">--}}
{{--                                <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>--}}
{{--                                <div class="relative flex space-x-3">--}}
{{--                                    <div>--}}
{{--                                        <span class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white">--}}
{{--                                          <!-- Smiley face money -->--}}
{{--                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-white">--}}
{{--                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />--}}
{{--                                            </svg>--}}
{{--                                        </span>--}}
{{--                                    </div>--}}
{{--                                    <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">--}}
{{--                                        <div>--}}
{{--                                            <p class="text-sm text-gray-500">Advanced to phone screening by <a href="#" class="font-medium text-gray-900">Bethany Blake</a></p>--}}
{{--                                        </div>--}}
{{--                                        <div class="whitespace-nowrap text-right text-sm text-gray-500">--}}
{{--                                            <time datetime="2020-09-22">Sep 22</time>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </li>--}}

{{--                        <li>--}}
{{--                            <div class="relative pb-8">--}}
{{--                                <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>--}}
{{--                                <div class="relative flex space-x-3">--}}
{{--                                    <div>--}}
{{--                                        <span class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white">--}}
{{--                                          <!-- Heroicon name: mini/check -->--}}
{{--                                          <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">--}}
{{--                                            <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />--}}
{{--                                          </svg>--}}
{{--                                        </span>--}}
{{--                                    </div>--}}
{{--                                    <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">--}}
{{--                                        <div>--}}
{{--                                            <p class="text-sm text-gray-500">Completed phone screening with <a href="#" class="font-medium text-gray-900">Martha Gardner</a></p>--}}
{{--                                        </div>--}}
{{--                                        <div class="whitespace-nowrap text-right text-sm text-gray-500">--}}
{{--                                            <time datetime="2020-09-28">Sep 28</time>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </li>--}}

{{--                        <li>--}}
{{--                            <div class="relative pb-8">--}}
{{--                                <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>--}}
{{--                                <div class="relative flex space-x-3">--}}
{{--                                    <div>--}}
{{--                                        <span class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center ring-8 ring-white">--}}
{{--                                          <!-- Heroicon name: mini/hand-thumb-up -->--}}
{{--                                          <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">--}}
{{--                                            <path d="M1 8.25a1.25 1.25 0 112.5 0v7.5a1.25 1.25 0 11-2.5 0v-7.5zM11 3V1.7c0-.268.14-.526.395-.607A2 2 0 0114 3c0 .995-.182 1.948-.514 2.826-.204.54.166 1.174.744 1.174h2.52c1.243 0 2.261 1.01 2.146 2.247a23.864 23.864 0 01-1.341 5.974C17.153 16.323 16.072 17 14.9 17h-3.192a3 3 0 01-1.341-.317l-2.734-1.366A3 3 0 006.292 15H5V8h.963c.685 0 1.258-.483 1.612-1.068a4.011 4.011 0 012.166-1.73c.432-.143.853-.386 1.011-.814.16-.432.248-.9.248-1.388z" />--}}
{{--                                          </svg>--}}
{{--                                        </span>--}}
{{--                                    </div>--}}
{{--                                    <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">--}}
{{--                                        <div>--}}
{{--                                            <p class="text-sm text-gray-500">Advanced to interview by <a href="#" class="font-medium text-gray-900">Bethany Blake</a></p>--}}
{{--                                        </div>--}}
{{--                                        <div class="whitespace-nowrap text-right text-sm text-gray-500">--}}
{{--                                            <time datetime="2020-09-30">Sep 30</time>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </li>--}}

{{--                        <li>--}}
{{--                            <div class="relative pb-8">--}}
{{--                                <div class="relative flex space-x-3">--}}
{{--                                    <div>--}}
{{--                                        <span class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white">--}}
{{--                                          <!-- Heroicon name: mini/check -->--}}
{{--                                          <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">--}}
{{--                                            <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />--}}
{{--                                          </svg>--}}
{{--                                        </span>--}}
{{--                                    </div>--}}
{{--                                    <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">--}}
{{--                                        <div>--}}
{{--                                            <p class="text-sm text-gray-500">Completed interview with <a href="#" class="font-medium text-gray-900">Katherine Snyder</a></p>--}}
{{--                                        </div>--}}
{{--                                        <div class="whitespace-nowrap text-right text-sm text-gray-500">--}}
{{--                                            <time datetime="2020-10-04">Oct 4</time>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </li>--}}
                    </ul>
                    </div>
                </div>
            </dl>
        </div>
    </div>

</x-app-layout>
