<template>
        <GuestLayout text="Remember your password?">
          <div>
            <label for="email-address" class="sr-only">Email address</label>
            <input id="email-address" name="email" type="email" autocomplete="email" required=""
                   class="appearance-none  relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded focus:outline-none focus:ring-regal-brown focus:border-regal-brown focus:z-10 sm:text-sm"
                   placeholder="Email address"/>
          </div>
       </GuestLayout>
       
  </template>
  
<script setup>
import GuestLayout from '../components/GuestLayout.vue';
</script>