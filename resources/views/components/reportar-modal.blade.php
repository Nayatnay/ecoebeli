@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="bg-white">

        <div class="flex items-center justify-between p-4 bg-gray-100 font-bold">
            {{ $title }}
        </div>

        <div class="p-4 ">
            {{ $content }}
        </div>

        <div class="p-4 text-sm text-end">
            {{ $footer }}
        </div>

    </div>
</x-modal>
