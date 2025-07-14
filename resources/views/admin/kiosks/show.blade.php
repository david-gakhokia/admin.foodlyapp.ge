<x-layouts.app>
    <div class="max-w-4xl mx-auto py-10">
      <h1 class="text-2xl font-bold mb-4">{{ $product->name }}</h1>
      <p class="mb-2"><strong>ID:</strong> {{ $product->id }}</p>
      <p class="mb-2"><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
      <p class="mb-2"><strong>Description:</strong> {{ $product->description }}</p>
      
      <div class="mt-6">
        <a href="{{ route('products.index') }}" class="bg-gray-800 text-white px-4 py-2 rounded">Back to Products</a>
        <a href="{{ route('products.edit', $product->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded">Edit Product</a>
        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline">
          @csrf
          @method('DELETE')
          <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Delete Product</button>
        </form>
      </div>
    </div>
  </x-layouts.app>