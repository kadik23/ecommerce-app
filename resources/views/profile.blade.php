@if(Auth::user()->hasRole('admin')) 
    @extends('layouts.dashboard')
    @section('content1')
@else
    @extends('layouts.accounts')
    @section('content')
@endif 
      <!-- Main modal -->
      <div id="imageUpload" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="imageUpload">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Profile picture</h3>
                    <form method="POST" action="{{route('dash.pictureEdit')}}" class="space-y-6" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div>
                            <input type="file" name="image" id="image" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                        </div>
                        @error('image')
                        {{$message}}  
                       @enderror
                    
                        <button type="submit" class="w-full text-white bg-regal-brown hover:bg-amber-700 focus:ring-4 focus:outline-none focus:ring-amber-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-regal-brown dark:focus:ring-blue-800">Change profile picture</button>
                    
                    </form>
                </div>
            </div>
        </div>
    </div> 
    {{-- section 1 --}}
<div class="mt-20">
    <div class="container flex flex-row justify-around ">
        <div class="flex flex-col">
            <div data-theme="light" class="max-w-sm mt-5 flex flex-col items-center   border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
              
                <div class="relative group overflow-hidden w-32 h-32 rounded-full mt-3 z-0">
                    <!-- Modal toggle -->
                    <div data-modal-target="imageUpload" data-modal-toggle="imageUpload" class="absolute inset-0 w-32 h-32 opacity-0 cursor-pointer text-white bg-transparent ">   </div>
                
                    <div class="w-32 h-32 rounded-full overflow-hidden">
                        <img
                        {{-- src="{{asset('assets/images/logo.png')}}" --}}
                            src="{{asset('assets/images/profiles/'.Auth::user()->profileImage)}}"
                            alt="Profile Picture"
                            class="w-full h-full object-cover cursor-pointer"
                        >
                    
                    </div>
                    <div class="absolute  rounded-bl-full rounded-br-full  inset-0 flex items-center justify-center w-32 h-20 bg-black bg-opacity-40 opacity-0 cursor-pointer  group-hover:opacity-100 transition-opacity" style="top:39%;">
                        <span class=" ml-2 text-white text-sm">Change Profile Picture</span>
                    </div>
                </div>
   
                
                
                <div class="p-5 flex flex-col ">
                    <h2 class="mb-1 text-lg font-bold text-gray-700 mx-auto dark:text-gray-400">{{Auth::user()->username}}</h2>
                    <h5 class="mb-5 text-md inline-block px-3 mx-auto  rounded-lg bg-red-400  tracking-tight  text-white">
                      @if(Auth::user()->hasRole('admin'))  
                        Admin
                        @else
                        user
                      @endif
                    </h5>
                    <a href="{{ route('logout') }}" class="inline-flex items-center px-16 py-2 text-sm font-medium text-center text-white bg-regal-brown rounded-lg hover:bg-amber-700 focus:ring-4 focus:outline-none focus:ring-amber-300 ">
                        {{ __('Logout') }}
                  
                    </a>
                </div>
            </div>
            
            
            <div  data-theme="light" class="max-w-sm  mt-3  border  border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
              
                <div class="py-2 px-5">
                    <div class="flex flex-row  mb-2 ">
                        <span class="material-symbols-outlined pr-1 text-regal-brown">
                            email
                        </span>
                        <span>
                            {{Auth::user()->email}}
                        </span>
                    </div>
                    <div class="flex flex-row mb-2 ">
                        <span class="material-symbols-outlined pr-1 text-regal-brown">
                            phone_iphone
                        </span>
                        <span>
                            {{Auth::user()->phone}}
                        </span>
                    </div>
                    <div class="flex flex-row mb-2 ">
                        <span class="material-symbols-outlined pr-1 text-regal-brown">
                            location_on
                        </span>
                        <span>
                            {{Auth::user()->country}} {{Auth::user()->city}}
                        </span>
                    </div>
                    <div>
                        <img 
                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAACUUlEQVR4nGNgGAWjYBSMglEwCoYDMM6U+08L/Ob9R5pghlEPZI7GwP/RJIQMRjNx5jAphaKCVf7PMND5v1fG8P9pEeP/lyVt/l+3j/5/v2Hy/5fX7w5eDzgmyv9fpKX7/5KACRyfETb+f8Mz5f+dtNr/t2NL/l83D/v/oGfu4POAU6LC/z0yhnCHnxcy+d9so/nfNlkew+Jn2w7+fzRt+eDxgGmG3P+1Kvpwx58VNv4fG6iCNw+8fvHq/8sbdweHB3I91VCSTYmrOt5M/PLq7cGVhNaqIkIflIxM0ORfv3oLt/TJ6u3/77dOHzwesEiT/39R0BjugU4rLQw191um/b8dX/7/8bw1/68oOoH5g8YDvtGKKMknz0MNQw0oBm44xMDVgNiPF2/6//rpi4H3gFe0EooHCtxR0z8sD9yr6EWoEzL7f8M54f+jqUv+v37zfmA9YJkmDy4y4UnIEjMJPdt1+P9lMUt4LNxvnDJ4kpBxptz/dUhFKKj2BRWryPJPNu75/+rOQ7CloAptUOUB40y5/1leqMVoqYsGzmL09bOX/58s3zK4PGCSIf9/tZoeSkUWR0RF9ure48HhARB2SVD8v1vOAKUp0Wat+d8OvSnx7sP/p5v3/380e9XgiQFj5MacNmpj7qyQ8f8b7sn/bydW/r8VVvD/mlHQ/0czKG8HvaFlczo6WPn/dEOd/7tlDf6fEjH+f0XB8f8Np3hwc/rVrQdUcfyb0VGJTOJjhFoh/mY0BjLJyxOjMfB+NAnJDY0kNApGwSgYBaNgFDAMQQAABL4aqvM3W6gAAAAASUVORK5CYII="
                        class="w-16 mx-auto"
                        >
                    </div>
                </div>
            </div>
          
        </div>
    
    
        <div data-theme="light" class=" mt-5  border border-gray-200  rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <h1 class="mt-3 mx-5 text-2xl font-bold">My profile details</h1>
            <form  method="POST" action="{{route('dash.profileEdit')}}" class="flex flex-col p-10">
                @csrf
                @method("PUT")
                <div class="flex flex-row">
                    <div >
                        <div class="mb-6 mr-10">
                            <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your username</label>
                            <input type="text" name="username" id="username" value="{{ Auth::user()->username  }}" class="bg-gray-50 border pr-32  border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-amber-700 focus:border-amber-700 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-amber-700 dark:focus:border-amber-700" required>
                            @error('username')
                            {{$message}}  
                            @enderror
                        </div>
                        <div class="mb-6 mr-10">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                            <input type="email" name="email" id="email" value="{{ Auth::user()->email  }}" class="bg-gray-50 border pr-32 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-amber-700 focus:border-amber-700 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-amber-700 dark:focus:border-amber-700" placeholder="name@flowbite.com" required>
                            @error('email')
                            {{$message}}  
                            @enderror        
                        </div>
                        <div class="mb-6 mr-10">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                        <input type="password" name="password" id="password" value="adminOruserPass" class="bg-gray-50 border pr-32 mb-2  border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-amber-700 focus:border-amber-700 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-amber-700 dark:focus:border-amber-700" required>
                        @if (Route::has('password.request'))
                        <a class="font-semibold text-regal-brown hover:text-amber-700" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                        </div>
                    </div>
                    <div>
                        <div class="mb-6">
                            <label for="tel" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your phone number</label>
                            <input type="text" name="tel" value="{{Auth::user()->phone}}" id="tel" class="bg-gray-50 border pr-32 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-amber-700 focus:border-amber-700 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-amber-700 dark:focus:border-amber-700" placeholder="Phone number" >
                            @error('tel')
                            {{$message}}  
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="country" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your country</label>
                            <input type="text" name="country" id="country" value="{{Auth::user()->country}}" class="bg-gray-50 border pr-20 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-amber-700 focus:border-amber-700 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-amber-700 dark:focus:border-amber-700" placeholder="Country" >
                            @error('country')
                            {{$message}}  
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your city</label>
                            <input type="text" name="city" value="{{Auth::user()->city}}" id="City" class="bg-gray-50 border pr-20  border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-amber-700 focus:border-amber-700 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-amber-700 dark:focus:border-amber-700" placeholder="City"  >
                            @error('city')
                            {{$message}}  
                            @enderror
                        </div>
                        
                    </div>        
                </div>
        
                <div>
                    <button type="submit" class="text-white bg-regal-brown hover:bg-amber-700 focus:ring-4 focus:outline-none focus:ring-regal-brown font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-amber-brown dark:hover:bg-amber-700 dark:focus:ring-regal-brown">Update information</button>
                </div>
            </form>
            
        </div>
    
        
    
</div>

@endsection