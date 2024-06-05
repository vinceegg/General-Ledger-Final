<div class="p-6 grid sm:col-span-1 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"> 
    <div class="flex gap-2 pb-3">
        <div class="">
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="#1e40af" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28"/>
            </svg>
                <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M10 6v4l3.276 3.276M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
            </svg>
        </div>
            <div class="">
              <text class="white-card-title w-6 h-6 text-blue-800 dark:text-white"> Create a Task </text> 
            </div>
    </div>
    <div class="mb-6">
        <form wire:submit.prevent="store" class="flex flex-col space-y-4">
            <input type="text" wire:model="title" placeholder="Write Outstanding Transaction/Unposted Items..." class="border border-gray-300 py-3 px-4 bg-white 100 rounded-md">
            <textarea wire:model="description" placeholder="Description of the Task" class="border border-gray-300 py-3 px-4 bg-white rounded-md"></textarea>
            <!-- date picker -->
            <div class="relative max-w-lg">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                    </svg>
                </div>
                <input datepicker type="text" wire:model="deadline"  class=" text-gray-500 py-3 px-4 bg-white rounded-md bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Deadline">
            </div>    
            <button type="submit" class="w-30 py-2 px-8 bg-blue-800 text-white rounded-md hover:bg-blue-900">Add Task</button>
        </form>
    </div>

        <div class="flex gap-2 pb-3">
            <div class="">
                <svg class="w-6 h-6 dark:text-white w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="#1e40af"  stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3m0 3h6m-6 7 2 2 4-4m-5-9v4h4V3h-4Z"/>
                </svg>  
                    <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M10 6v4l3.276 3.276M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
            </div>
            <div class="">
              <text class="white-card-title w-6 h-6 text-blue-800 dark:text-white"> List of Tasks </text> 
            </div>
        </div> 
    
    <div class="mt-2">
        @foreach ($todos as $todo)         
            <div class="{{ $todo->isDone ? '' : '' }} py-4 flex items-center border-b border-gray-300 px-3">
                <div class="flex-1 pr-8">
                    <h3 class="text-lg {{ $todo->isDone ? 'text-green-600' : 'text-gray-900' }} font-semibold">{{ $todo->title }}</h3>
                    <p class="text-gray-500">{{ $todo->description }}</p>
                    <p class="text-gray-500">{{ $todo->deadline }}</p>   
                </div>
                <div class="flex space-x-3">
                    <button wire:click="update({{ $todo->todo_id }})" class="py-2 px-2 bg-green-500 hover:bg-green-600 text-white rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                    </button>
                    <button wire:click="destroy({{ $todo->todo_id}})" class="py-2 px-2 bg-red-500 hover:bg-red-600 text-white rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                    </button>
                </div>
            </div>
        @endforeach
    </div>
</div>