<x-app-layout>

    <div class="p-6">

        <!-- 検索ワードから該当内容が見つからない場合 -->
        @if($keyword && $posts->count() === 0)
            <div class="mb-4 px-4 py-2 bg-yellow-100 text-yellow-700 rounded">
                「{{ $keyword }}」に一致する投稿は見つかりませんでした
            </div>
        @endif

        <!-- 新規投稿に失敗した場合 -->
        @if(session('save_error'))
            <div class="mb-4 px-4 py-2 bg-red-100 text-red-700 rounded">
                {{ session('save_error') }}
            </div>
        @endif

        <!-- 投稿内容の更新に失敗した場合 -->
            @if(session('update_error'))
            <div class="mb-4 px-4 py-2 bg-red-100 text-red-700 rounded">
                {{ session('update_error') }}
            </div>
        @endif

        <!-- 投稿削除に失敗した場合 -->
        @if(session('delete_error'))
            <div class="mb-4 px-4 py-2 bg-red-100 text-red-700 rounded">
                {{ session('delete_error') }}
            </div>
        @endif


        <!-- 新規投稿フォーム -->
        <h2 class="text-xl font-bold mb-2">新規投稿</h2>

        @if($errors->any())
            <div style="color: red;">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{route('posts.store')}}" class="mb-8">
            @csrf
            <textarea name="content" class="border w-full"></textarea>
            <button type="submit" class="mt-2 px-8 py-2 bg-blue-600 rounded-md text-white">投稿</button>
        </form>

        <!-- 投稿一覧 -->
        <div class="flex items-center justify-between mb-2">
            <h2 class="text-xl font-bold">投稿一覧</h2>

            <!-- 検索フォーム -->
            <form method="GET" action="{{route('posts.index')}}" class="flex items-center gap-3">
                <input type="text" name="keyword" value="{{$keyword ?? ''}}" class="border rounded px-3 py-1 text-sm w-56" placeholder="検索フォーム">
                <button type="submit" class="px-4 py-1 bg-gray-800 rounded-md text-white">検索</button>
            </form>
        </div>


        @foreach($posts as $post)

            <div class="border p-4 mb-8 rounded bg-white shadow-sm">
                <!-- 投稿者 -->
                <div class="text-gray-500 mb-2">
                    <span class="font-semibold text-gray-800">
                        {{ $post->user_name }}
                    </span>
                <!-- 投稿内容 -->
                <div class="text-gray-900 leading-relaxed mb-1">
                    {{ $post->contents }}
                </div>
                <!-- 更新日時 -->
                <span class="text-sm text-gray-400">
                    {{ $post->updated_at->format('Y/m/d H:i')}}
                </span>
                <!-- 投稿日時 -->
                <!-- <span class="text-sm text-gray-400">
                    {{ $post->created_at->format('Y/m/d H:i') }}
                </span> -->
            </div>

                <!-- 編集・削除 -->
                @if($post->user_name === auth()->user()->name)
                    <div class="flex gap-8 mt-2">
                        <a href="{{route('posts.edit',$post)}}" class="px-4 py-1 bg-blue-100 text-blue-600 rounded">編集</a>
                        <form method="POST" action="{{route('posts.destroy',$post)}}" onsubmit="return confirm('投稿内容を削除しますか？');" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-1 bg-red-100 text-red-600 rounded" >削除</button>
                        </form>
                    </div>
                @endif
            </div>
        @endforeach

    </div>
</x-app-layout>
