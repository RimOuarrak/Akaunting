<x-layouts.admin>
    <x-slot name="title">
        {{ $module->alias }}
    </x-slot>
    <x-slot name="content">
        <div class="mt-10">
            <div id="item-start-detail" class="relative max-w-7xl mx-auto py-8 px-4 lg:py-24 sm:px-6 lg:px-8 lg:flex items-start lg:justify-between">
                <div class="w-full lg:w-1/4 max-w-x z-10">
                    <img src="{{ $module->icon }}" class="w-2/6 lg:w-full rounded-3xl shadow-xl" alt="Calendar">
                </div>
                <div class="max-w-xl text-right lg:ltr:text-right lg:rtl:text-left z-10 mt-5 lg:mt-0 absolute right-0 ">
                    <p class="my-5 text-6xl text-gray-500 font ">
                        {{ $module->alias }}
                    </p>
                    <div class="flex flex-col md:flex-row items-start lg:items-right justify-start lg:justify-end space-x-2" >
                        <livewire:module.setting :id="$module->id" />
                    </div>
                    <p class="mt-9 text-xl text-gray-500">
                        {{ $module->description }}
                    </p>
                </div>
                <img src="https://assets.akaunting.com/site/img/apps/path.png" class="absolute left-10 top-25 hidden lg:block" alt="">
            </div>
        </div>
    </x-slot>
</x-layouts.admin>
