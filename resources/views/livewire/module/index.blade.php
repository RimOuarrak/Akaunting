<div class="mt-10">

    <div class="max-w-7xl mx-auto pt-8 mb-24 px-4 sm:px-6 lg:px-8 flex items-start flex-col md:flex-row">


        <div
            class="mt-10 lg:mt-16 grid grid-cols-1 gap-y-20 lg:grid-cols-3 lg:gap-y-0 lg:gap-x-8 js-apps-content gap-4">
            @foreach ($items as $item)
            @if (!$item->made)
            <div class="flex flex-col bg-white rounded-2xl shadow-xl mb-5 lg:mb-24 hover:shadow-2xl js-apps">
                <a href="{{ route('apps.module.details', ['id' => $item->id]) }}">
                    <div class="flex-1 relative pt-16 px-6 pb-8 md:px-8">
                        <div class="absolute -top-5 ltr:left-0 rtl:right-0 p-5 inline-block">
                            <img src="{{$item->icon}}"
                                class="rounded-xl shadow-lg transform -translate-y-1/2 object-cover w-auto lg:w-24 h-16">
                        </div>

                        <h3 class="text-xl font-medium text-gray-900">
                            {{$item->alias}}
                        </h3>

                        <p class="mt-4 text-base text-gray-500">
                            {{$item->description}}
                        </p>

                    </div>
                </a>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</div>
</div>

