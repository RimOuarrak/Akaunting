@if ($enabled)
    <div>
        <button wire:click="switch" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
            Disable
        </button>
    </div>
@else
    <div>
        <button wire:click="switch" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Enable
        </button>
    </div>
@endif
