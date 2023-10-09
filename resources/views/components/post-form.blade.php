<form action="
    @if (isset($post))
        {{ route('posts.update', $post->id) }}
    @else
        {{ route('posts.store') }}
    @endif
    " 
    method="post"
    >
    @csrf

    @if(isset($post))
        @method('put')
    @endif

    <div class="space-y-12">
      <div class="border-b border-gray-900/10 pb-12">
        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
          <div class="sm:col-span-4">
            <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Title</label>
            <div class="mt-2">
              <x-text-input name="title" required value="{{ $post->title ?? old('title') }}"></x-text-input>
              @error('title')
                  <p style="color: red">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <div class="col-span-full">
            <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Body</label>
            <div class="mt-2">
              <textarea name="body" required id="about" name="about" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ $post->body ?? old('body') }}</textarea>
                @error('body')
                    <p style="color: red">{{ $message }}</p>
                @enderror
            </div>
          </div>
        </div>
        <x-primary-button class="mt-2" type="submit">Save</x-primary-button>
      </div>
    </div>
</form>