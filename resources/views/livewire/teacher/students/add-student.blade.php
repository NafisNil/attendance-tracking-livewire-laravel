<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <!-- Comment Form -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <div class="mx-auto max-w-2xl">
      <div class="text-center">
        <h2 class="text-xl text-gray-800 font-bold sm:text-3xl dark:text-white">
          Add New Student
        </h2>
      </div>
  
      <!-- Card -->
      <div class="mt-5 p-4 relative z-10 bg-white border border-gray-200 rounded-xl sm:mt-10 md:p-10 dark:bg-neutral-900 dark:border-neutral-700">
        <form wire:submit="save">
          <div class="mb-4 sm:mb-8">
            <label for="hs-feedback-post-comment-name-1" class="block mb-2 text-sm font-medium dark:text-white">First name</label>
            <input type="text" id="hs-feedback-post-comment-name-1" class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="First name" wire:model="first_name">
            @error('first_name')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
          </div>


          <div class="mb-4 sm:mb-8">
            <label for="hs-feedback-post-comment-name-1" class="block mb-2 text-sm font-medium dark:text-white">Last name</label>
            <input type="text" id="hs-feedback-post-comment-name-1" class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="Last name" wire:model="last_name">
            @error('last_name')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
          </div>
  
          <div class="mb-4 sm:mb-8">
            <label for="hs-feedback-post-comment-email-1" class="block mb-2 text-sm font-medium dark:text-white">Age</label>
            <input type="number" id="hs-feedback-post-comment-email-1" class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="enter age" wire:model="age">
            @error('age')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
          </div>
  
          <div>
            <label for="hs-feedback-post-comment-textarea-1" class="block mb-2 text-sm font-medium dark:text-white">Grade</label>
            <div class="mt-1">
              <select class="py-3 px-4 pe-9 block w-full bg-gray-100 border-transparent rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-transparent dark:text-neutral-400 dark:focus:ring-neutral-600" wire:model="grade">
                <option selected="">Select Grade</option>
                @foreach ($grades as $item)
                <option value="{{ $item->id }}" wire:key="{{ $item->id }}">{{$item->name}}</option>
                @endforeach
              </select>
              @error('grade')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
            </div>
          </div>
  
          <div class="mt-6 grid">
            <button type="submit" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
              <div wire:loading class="animate-spin inline-block size-6 border-3 border-current border-t-transparent text-blue-600 rounded-full dark:text-blue-500" role="status" aria-label="loading">
                <span class="sr-only">Loading...</span>
              </div>
              Submit</button>
          </div>
        </form>
      </div>
      <!-- End Card -->
    </div>
  </div>
  <!-- End Comment Form -->
</div>
