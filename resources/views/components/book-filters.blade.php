<!-- resources/views/components/book-filters.blade.php -->
<div class="p-4 bg-gray-100 rounded shadow mb-6">
    <form method="GET" action="{{ url()->current() }}" class="flex flex-col md:flex-row gap-4 items-start md:items-end">
        
        <!-- Publication Date Block -->
        <div>
            <label for="year_block" class="block text-sm font-medium text-gray-700">Publication Date</label>
            <select name="year_block" id="year_block" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <option value="">All Years</option>
                <option value="before_2000" {{ request('year_block') == 'before_2000' ? 'selected' : '' }}>Before 2000</option>
                <option value="2000_2010" {{ request('year_block') == '2000_2010' ? 'selected' : '' }}>2000 – 2010</option>
                <option value="2011_2020" {{ request('year_block') == '2011_2020' ? 'selected' : '' }}>2011 – 2020</option>
                <option value="2021_present" {{ request('year_block') == '2021_present' ? 'selected' : '' }}>2021 – Present</option>
            </select>
        </div>

        <!-- Language -->
        <div>
            <label for="language" class="block text-sm font-medium text-gray-700">Language</label>
            <select name="language" id="language" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <option value="">All Languages</option>
                <option value="English" {{ request('language') == 'English' ? 'selected' : '' }}>English</option>
                <option value="Nepali" {{ request('language') == 'Nepali' ? 'selected' : '' }}>Nepali</option>
                <!-- Add more languages if needed -->
            </select>
        </div>

        <!-- Availability -->
        <div>
            <label for="availability" class="block text-sm font-medium text-gray-700">Availability</label>
            <select name="availability" id="availability" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <option value="">All</option>
                <option value="available" {{ request('availability') == 'available' ? 'selected' : '' }}>Available Only</option>
            </select>
        </div>

        <div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded shadow hover:bg-blue-700">
                Filter
            </button>
        </div>
    </form>
</div>
