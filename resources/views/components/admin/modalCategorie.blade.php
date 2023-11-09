

<!-- Main modal -->
<dialog id="my_modal_1" class="modal">
    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <form method="dialog" class="modal-backdrop">
            <button class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            </form>
            <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Create new category</h3>
                <form method="POST" class="space-y-6" action="{{route('category.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category name</label>
                        <input type="text" name="category" id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Category name" required>
                    </div>
                    @error('category')
                    {{-- print to users error when it exist  --}}
                    {{$message}}  
                    @enderror
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload icon</label>
                        <input type="file" name="icon" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-regal-brown dark:border-gray-600 dark:placeholder-gray-400" id="file_input" >                      
                    </div>
                    @error('icon')
                    {{-- print to users error when it exist  --}}
                    {{$message}}  
                    @enderror
                    <button type="submit" class="w-full text-white bg-regal-brown hover:bg-amber-700 focus:ring-4 focus:outline-none focus:ring-amber-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-regal-brown dark:hover:bg-regal-brown dark:focus:ring-amber-700">Create new category</button>    
                </form>
            </div>
        </div>
    </div>
  </dialog> 
  