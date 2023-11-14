<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@extends('admin')
@section('content')
    <div class="p-4 mt-12 sm:ml-64">
        <div class="mt-4 p-4 relative overflow-x-auto shadow-md sm:rounded-lg">
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
                <caption class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                     KATEGORI SURAT
                     <h3 class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400"> Berikut ini adalah kategori yang bisa
                         digunakan untuk melabeli surat.<h3>
                            <h3 class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400"> Klik "Tambah Kategori" pada kolom aksi untuk menambahkan kategori baru.<h3>
                            <p></p>
                </caption>
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="p-4">
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
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody id="kategori-table-body">
                    @foreach ($categories as $kategori)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <!-- Add other table columns as needed -->
                            <td class="w-4 p-4">
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
            function handleSearch() {
                // Dapatkan nilai pencarian
                var searchTerm = document.getElementById('table-search').value.toLowerCase();

                // Dapatkan semua baris tabel
                var rows = document.querySelectorAll('tbody tr');

                // Iterasi melalui setiap baris tabel
                rows.forEach(function (row) {
                    // Dapatkan nilai teks dari setiap kolom dalam baris
                    var columns = row.querySelectorAll('td, th');
                    var rowText = Array.from(columns).map(function (column) {
                        return column.textContent.toLowerCase();
                    }).join(' ');

                    // Tampilkan atau sembunyikan baris berdasarkan pencarian
                    if (rowText.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }
    // </script>
    <style>
        /* ... your existing styles ... */

        /* Add this style for the blur effect */
        .blur-background {
            filter: blur(5px); /* Adjust the blur amount as needed */
            transition: filter 0.3s ease-in-out; /* Add a smooth transition effect */
        }
    </style>
        <script>
            function confirmDelete(event) {
                event.preventDefault();

                var form = event.target;

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
                        form.submit();
                    }
                });
            }
        </script>
    @endsection
</script>
