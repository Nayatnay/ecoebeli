@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        
            <div class="mt-3 text-center sm:mt-0 sm:ms-4">
                <h3 class="text-lg font-medium text-gray-900 pb-3 border-b">
                    {{ $title }}
                </h3>

                <div class="my-4 text-sm text-gray-600">
                    {{ $content }}
                </div>
            </div>
        
    </div>

    <div class="flex flex-row justify-center px-6 py-4 bg-gray-100 text-end">
        {{ $footer }}
    </div>
</x-modal>
