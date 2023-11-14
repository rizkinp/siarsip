@extends('admin')
@section('content')
@foreach ($categories as $kategori)
    <tr class="bg-white border-b hover:bg-gray-50">
        <!-- Add other table columns as needed -->
        <td class="w-4 p-4">
            <div class="flex items-center">
                <input id="checkbox-table-search-{{ $kategori->id }}" type="checkbox"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                <label for="checkbox-table-search-{{ $kategori->id }}" class="sr-only">checkbox</label>
            </div>
        </td>
        <th scope="row"
            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
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
                class="mr-5 font-medium text-yellow-400 hover:underline">Edit</a>
            <form action="{{ route('kategori.delete', $kategori->id) }}" method="POST"
                onsubmit="confirmDelete(event)">
                @csrf
                @method('DELETE')

                <button type="submit"
                    class="mr-3 font-medium text-red-600 hover:underline">
                    Hapus
                </button>
            </form>
        </td>
    </tr>
@endforeach

@endsection