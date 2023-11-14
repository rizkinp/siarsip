<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@extends('admin')
@section('content')
    <div class="p-4 mt-12 sm:ml-64">
        <div class="mt-4 p-4  relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="pb-4 bg-white dark:bg-gray-900">
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative mt-1 flex">
                    <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="text" id="table-search"
                        class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Search for items">
                    <button type="button" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-md"
                            onclick="handleSearch()">
                        Cari
                    </button>
                </div>
            </div>

            {{-- //TABLE KATEGORI --}}
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <caption
                    class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                    TAMBAH KATEGORI
                    <h1>Tambah kategori Surat Di button Tambah</h1>
                </caption>
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="p-4">
                            <div class="flex items-center">
                                <input id="checkbox-all-search" type="checkbox"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="checkbox-all-search" class="sr-only">checkbox</label>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            ID Kategori
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama Kategori
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Keterangan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody id="kategori-table-body">
                    @foreach ($categories as $kategori)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <!-- Add other table columns as needed -->
                            <td class="w-4 p-4">
                                <div class="flex items-center">
                                    <input id="checkbox-table-search-{{ $kategori->id }}" type="checkbox"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="checkbox-table-search-{{ $kategori->id }}" class="sr-only">checkbox</label>
                                </div>
                            </td>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $kategori->id }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $kategori->nama_kategori }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $kategori->deskripsi }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('kategori.edit', $kategori->id) }}"
                                    class="mr-5 font-medium text-yellow-400 dark:text-blue-500 hover:underline">Edit</a>
                                <form action="{{ route('kategori.delete', $kategori->id) }}" method="POST"
                                    onsubmit="confirmDelete(event)">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="mr-3 font-medium text-red-600 dark:text-blue-500 hover:underline">
                                        Hapus
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- //BUTTON TAMBAH SURAT --}}
            <a href="kategori/tambah"
                class="mt-10 inline-block text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Tambahkan
                Kategori</a>
        </div>
        <div id="search-results"></div>
        <script>
            // Use jQuery in noConflict mode
            function searchKategori() {
    var searchTerm = $('#table-search').val();

    fetch(`/kategori/search?search=${searchTerm}`)
        .then(response => response.text())
        .then(data => {
            console.log(data);  // Log the response to the console
            return JSON.parse(data);  // Attempt to parse the response as JSON
        })
        .then(data => {
            // Process the data and update the search results div
            updateSearchResults(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
}


    function updateSearchResults(categories) {
        var resultsDiv = $('#kategori-table-body');
        resultsDiv.empty();

        if (categories.length > 0) {
            categories.forEach(category => {
                resultsDiv.append(`
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <!-- Add other table columns as needed -->
                        <td class="w-4 p-4">
                            <div class="flex items-center">
                                <input type="checkbox"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            </div>
                        </td>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            ${category.id}
                        </th>
                        <td class="px-6 py-4">
                            ${category.nama_kategori}
                        </td>
                        <td class="px-6 py-4">
                            ${category.deskripsi}
                        </td>
                        <td class="px-6 py-4">
                            <a href="/kategori/edit/${category.id}" class="mr-5 font-medium text-yellow-400 dark:text-blue-500 hover:underline">Edit</a>
                            <form action="/kategori/delete/${category.id}" method="POST" onsubmit="confirmDelete(event)">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="mr-3 font-medium text-red-600 dark:text-blue-500 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                `);
            });
        } else {
            resultsDiv.html('<p>No results found.</p>');
        }
    }

            function confirmDelete(event) {
                event.preventDefault();

                var form = event.target;
                var arsipId = form.getAttribute('data-arsip-id');

                Swal.fire({
                    title: 'Konfirmasi Hapus',
                    text: 'Apakah Anda yakin ingin menghapus data ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit the form after confirmation
                        form.submit();
                    }
                });
            }
        </script>
    @endsection
