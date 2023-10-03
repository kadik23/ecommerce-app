<template>
        <GuestLayout text="Go back to Login ">
          <div>
            <label for="new-password" class="sr-only">New Password</label>
            <input id="new-password" name="password" type="password" required=""
                   class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-amber-700 focus:border-amber-700 focus:z-10 sm:text-sm"
                   placeholder="New Password"/>
          </div>
          <div>
            <label for="password-repeat" class="sr-only">Repeat Password</label>
            <input id="password-repeat" name="password_repeat" type="password" required=""
                   class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-amber-700 focus:border-amber-700 focus:z-10 sm:text-sm"
                   placeholder="Repeat Password"/>
          </div>
        </GuestLayout>     
</template>
<script setup>
import GuestLayout from '../components/GuestLayout.vue';
</script>