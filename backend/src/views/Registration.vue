<template>
    <div class=" w-full h-full flex flex-row">
        <div class="flex h-full w-1/2 flex-1 flex-col justify-center px-6 py-12 lg:px-8">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <!-- <img class="mx-auto h-24 rounded-full  w-24" src="../assets/logo.png" alt="Your Company" /> -->
                <h2 class="mt-5 text-center text-2xl font-bold leading-9 tracking-tight ">Register a New Account</h2>
            </div>

            <div class="mt-5 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="{{ route('register') }}" method="POST">
                @csrf
                <div>
                    <label for="username" class="block text-sm font-medium leading-6 float-left" >{{ __('Username') }}</label>
                    <div class="mt-2">
                        <input id="username" name="username" type="username" autocomplete="username" required=""  class="form-control @error('username') is-invalid @enderror block w-full pl-2 rounded-md border-0 py-1.5  shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 outline-regal-brown sm:text-sm sm:leading-6" value="{{ old('username') }}" />
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium leading-6 float-left" >{{ __('Email Address') }}</label>
                    <div class="mt-2">
                        <input id="email" name="email" type="email" autocomplete="email" required=""  class=" form-control @error('email') is-invalid @enderror block w-full pl-2 rounded-md border-0 py-1.5  shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 outline-regal-brown sm:text-sm sm:leading-6" value="{{ old('email') }}"/>
                        
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium leading-6 ">{{ __('Password') }}</label>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" autocomplete="new-password" required="" class="form-control @error('password') is-invalid @enderror block pl-2  w-full rounded-md border-0 py-1.5  shadow-sm ring-1 ring-inset ring-gray-300  outline-regal-brown sm:text-sm sm:leading-6" />
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>      
                </div>

                <div>
                    <label for="password-confirm" class="block text-sm font-medium leading-6 ">{{ __('Confirm Password') }}</label>
                    <div class="mt-2">
                        <input id="password-confirm" name="password-confirmation" type="password" autocomplete="new-password" required="" class="form-control @error('password') is-invalid @enderror block pl-2  w-full rounded-md border-0 py-1.5  shadow-sm ring-1 ring-inset ring-gray-300  outline-regal-brown sm:text-sm sm:leading-6" />  
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                    </div>      
                </div>
                <div>
                    <p>Or</p>
                <img src="../assets/icons8-google-48.png" class="h-8 mx-auto mb-4 cursor-pointer" alt="">
                <button type="submit" class="flex w-full justify-center rounded-md bg-regal-brown  px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-amber-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2  " >Sign in</button>
                </div>
                
            </form>
            </div>
        </div>
        <div class="w-1/2 h-full flex flex-col ">
            <img src="../assets/background2.svg" alt="" >
            <div class="px-8 py-8 h-1/2"  style="background-color: #f5ecd9;"> 
                <h1 class=" text-2xl font-bold" style="margin: 0.4rem;"> Already have an account ?</h1>
                <h3 class="m-1 "> Sign in and discover a great amount of new opportunities!</h3>
                <br>
                <button type="submit" class="flex w-1/6 mx-auto justify-center rounded-md bg-regal-brown  px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-amber-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2  " >Sign in</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
}
</script>

<style>     
    
</style>