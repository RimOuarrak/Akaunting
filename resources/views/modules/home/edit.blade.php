<div class="mt-10">
    <h2>Edit Module</h2>
    <form action="{{ route(''apps.home.update', $module->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="enabled" value="1">
        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Enable
        </button>
        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
            Disable
        </button>
    </form>
    <form action="{{ route('apps.home.update', $module->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="enabled" value="0">
        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
            Disable
        </button>
    </form>
</div>
