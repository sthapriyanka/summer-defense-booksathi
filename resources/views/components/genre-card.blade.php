@props(['genre'])
<a href="/books?genre={{ urlencode($genre->name) }}"
    class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 group">
    <div class="flex items-center justify-between mb-4">
        <div class="bg-blue-100 group-hover:bg-blue-200 p-3 rounded-lg transition-colors">
            <x-icon icon="{{ $genre->icon }}" class="w-8 h-8 text-{{ $genre->color }}" />
        </div>
        <div class="text-right">
            <div class="text-2xl font-bold text-gray-900">{{ $genre->count }}</div>
            <div class="text-sm text-gray-500">Books</div>
        </div>
    </div>
    <h3 class="text-xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors">
        {{ $genre->name }}
    </h3>
</a>
