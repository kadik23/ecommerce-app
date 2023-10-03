<template>
    <div class="w-1/2 mx-auto ">
      <form class="mt-8 space-y-6" action="#" method="POST">
        <input type="hidden" name="remember" value="true"/>
        <div class="rounded-md shadow-sm -space-y-px">
        
          <slot></slot>
          </div>
             <div class="flex items-center justify-between">
          <div class="text-sm">
            <router-link :to="{name: 'login'}" class="font-medium text-reg
            al-brown hover:text-amber-700">
              {{ text }}
            </router-link>
          </div>
        </div>

        <div>
          <button type="submit"
                  class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-regal-brown hover:bg-regal-brown focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-regal-brown">

            Submit
          </button>
        </div>
      </form>
    </div>
</template>

<script >
export default {
name:"GuestLayout",
props: {
    text: String,
  },
}
</script>

<style>

</style>