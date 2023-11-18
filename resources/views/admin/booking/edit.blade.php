<x-app-layout>
  <x-slot name="title">Admin</x-slot>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      <a href="#!" onclick="window.history.go(-1); return false;">
        ←
      </a>
      {!! __('Item &raquo; Sunting &raquo; #') . $item->id . ' &middot; ' . $item->name !!}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div>
        @if ($errors->any())
          <div class="mb-5" role="alert">
            <div class="px-4 py-2 font-bold text-white bg-red-500 rounded-t">
              Ada kesalahan!
            </div>
            <div class="px-4 py-3 text-red-700 bg-red-100 border border-t-0 border-red-400 rounded-b">
              <p>
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
              </p>
            </div>
          </div>
        @endif
    <form class="w-full" action="{{ route('admin.item.update', $item->id) }}" method="post" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
            <div class="w-full">
              <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-last-name">
                Name*
              </label>
              <input value="{{ old('name') ?? $item->name }}" name="name"
                     class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                     id="grid-last-name" type="text" placeholder="Input item name" required>
              <div class="mb-10 mt-2 text-sm text-gray-500">
                Item name is required, and maximal character is 255.
              </div>
            </div>
          </div>

          <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
            <div class="w-full">
              <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-last-name">
                Brand*
              </label>
              <select name="brand_id"
                     class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                     type="text" placeholder="Input item name" required>
                     @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}" {{ $item->brand->id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                     @endforeach
              </select>
              <div class="mb-10 mt-2 text-sm text-gray-500">
                Brand is required, please choose
              </div>
            </div>
          </div>

          <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
            <div class="w-full">
              <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-last-name">
                Type*
              </label>
              <select name="type_id"
                     class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                     type="text" placeholder="Input item name" required>
                     @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{ $item->type->id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                     @endforeach
              </select>
              <div class="mb-10 mt-2 text-sm text-gray-500">
                Type is required, please choose
              </div>
            </div>
          </div>

          <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
            <div class="w-full">
              <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-last-name">
                Features*
              </label>
              <input value="{{ old('features') ?? $item->features }}" name="features"
                     class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                     id="grid-last-name" type="text" placeholder="Input item features">
              <div class="mb-10 mt-2 text-sm text-gray-500">
                Item features is optional, fill example : Feature 1, Feature 2, Feature 3...
              </div>
            </div>
          </div>

          <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
            <div class="w-full">
              <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-last-name">
                Image*
              </label>
              <input value="{{ old('photos') }}" name="photos[]"
                     class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                     id="grid-last-name" type="file" accept="image/png, image/jpg, image/jpeg, image/webp" multiple>
              <div class="mb-10 mt-2 text-sm text-gray-500">
                Can upload more than one.
              </div>
            </div>
          </div>

          <div class="grid grid-cols-3 gap-3 px-3 mt-4 mb-6 -mx-3">
            <div class="w-full">
              <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-last-name">
                Price*
              </label>
              <input value="{{ old('price') ?? $item->price }}" name="price"
                     class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                     id="grid-last-name" type="number" placeholder="Input item price" required>
              <div class="mb-10 mt-2 text-sm text-gray-500">
                Item price is a number.
              </div>
            </div>
            <div class="w-full">
              <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-last-name">
                Review*
              </label>
              <input value="{{ old('review') ?? $item->review }}" name="review"
                     class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                     id="grid-last-name" type="number" placeholder="Input item review" required>
              <div class="mb-10 mt-2 text-sm text-gray-500">
                Item review is number.
              </div>
            </div>
            <div class="w-full">
              <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-last-name">
                Star*
              </label>
              <input value="{{ old('star') ?? $item->star }}" name="star"
                     class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                     id="grid-last-name" type="number" placeholder="Input item star" min="1" max="5" step="0.1" required>
              <div class="mb-10 mt-2 text-sm text-gray-500">
                Item star is number.
              </div>
            </div>
          </div>

          <div class="flex flex-wrap mb-6 -mx-3">
            <div class="w-full px-3 text-right">
              <button type="submit"
                      class="px-4 py-2 font-bold text-white bg-green-500 rounded shadow-lg hover:bg-green-700">
                Save Item
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>
