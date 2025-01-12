@props(['route'])

<div class="mb-4 flex flex-wrap items-center justify-between">
    <div class="flex items-center space-x-2 mb-2 sm:mb-0">
        <select id="sort-select" class="form-select rounded-md shadow-sm mt-1 block w-full" onchange="sortTable()">
            <option value="">Sort A-Z</option>
            <option value="asc">A to Z</option>
            <option value="desc">Z to A</option>
        </select>
        <input type="text" id="search-input" placeholder="Search..." class="form-input rounded-md shadow-sm mt-1 block w-full" oninput="searchTable()">
    </div>
    <div class="flex items-center space-x-2">
        <button onclick="refreshTable()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Refresh
        </button>
        <button onclick="printTable()" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Print
        </button>
    </div>
</div>

<script>
function sortTable() {
    const sortSelect = document.getElementById('sort-select');
    const sortOrder = sortSelect.value;
    if (sortOrder) {
        window.location.href = '{{ $route }}?sort=' + sortOrder;
    }
}

function searchTable() {
    const searchInput = document.getElementById('search-input');
    const searchTerm = searchInput.value;
    window.location.href = '{{ $route }}?search=' + encodeURIComponent(searchTerm);
}

function refreshTable() {
    window.location.reload();
}

function printTable() {
    window.print();
}
</script>

