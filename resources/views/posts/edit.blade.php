<x-app-layout>
  <div class="p-6">

    <h2 class="text-xl font-bold mb-4">投稿編集</h2>

    <div class="border p-4 rounded bg-white shadow-sm max-w-4xl mx-auto">
      <form method="POST" action="{{ route('posts.update',$post) }}">
        @csrf
        @method('PUT')

        <textarea name="content" class="border w-full rounded mb-4 text-left" rows="6">{{ old('content',$post->contents) }}</textarea>

        <div class="flex gap-4">
          <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md">更新</button>

          <a href="{{ route('posts.index') }}" class="px-6 py-2 bg-gray-200 rounded-md">戻る</a>
        </div>
      </form>
    </div>
  </div>
</x-app-layout>
