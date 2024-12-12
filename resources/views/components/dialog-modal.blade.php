
<div x-data="{ open: false }" x-show="open" @click.away="open = false" class="fixed inset-0 flex items-center justify-center z-50">
    <div class="bg-gray-900 opacity-50 absolute inset-0"></div>
    
    <div class="bg-white p-6 rounded shadow-md w-1/3">
        <h2 class="text-xl font-semibold mb-4">Confirmation</h2>
        <p class="mb-4">Are you sure you want to proceed?</p>
        <div class="flex justify-end space-x-4">
            <button class="bg-gray-500 text-white px-4 py-2 rounded" @click="open = false">Cancel</button>
            <button class="bg-blue-500 text-white px-4 py-2 rounded">Confirm</button>
        </div>
    </div>
</div>
