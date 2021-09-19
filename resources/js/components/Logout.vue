<template>
    <div class="relative flex flex-row items-center relative">
        <div class="flex items-center border rounded-lg p-1">
            <a class="mr-2" :href="`/profile/${auth.id}/${auth.name}`">
                <img v-if="profile.avatar" class="w-6 h-6    bg-cover rounded-full" :src="`/storage/${profile.avatar }`">
                <svg v-else xmlns="http://www.w3.org/2000/svg" class="w-6 h-6    bg-cover rounded-full text-blue-light" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </a>
            <svg v-if="menu" @click="menu = false;" class="h-6 w-6 text-blue-light" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="18 15 12 9 6 15"></polyline>
            </svg>
            <svg v-else @click="menu = true;" class="h-6 w-6 text-blue-light" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="6 9 12 15 18 9"></polyline>
            </svg>
        </div>
        <ul v-if="menu" class="m-0 flex flex-col absolute right-0 top-0 mt-10 p-1 rounded border-blue-light">
            <li 
                @click.prevent="toggleLogoutModel" 
                class="flex py-1 px-2 cursor-pointer items-center group hover:bg-blue-light rounded-lg">

                <svg 
                    class=" hover:opacity-75 h-6 w-6 text-blue-light group-hover:text-c-white"
                    xmlns="http://www.w3.org/2000/svg" 
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span 
                    class="ml-2 text-sm text-blue-light group-hover:text-c-white">Logout
                </span>
            </li>
        </ul>
        <div v-if="logoutModal">
            <div class="fixed inset-0  rounded-lg flex flex-col  justify-center rounded-lg z-30">
                <div class="h-full w-full bg-gray-100" 
                    @click="logoutModal = false;">
                </div>
                <div class="absolute  bg-white left-0 right-0  mx-auto  max-w-xl shadow-lg rounded-lg p-6 z-30">
                    <div class="text-right">
                        <button @click="logoutModal = false;" type="button" class=" cursor-pointer" data-dismiss="modal" aria-label="Close">
                            <svg class="fill-current text-gray-900" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                            </svg>
                        </button>
                    </div>
                    <p class="mt-4 text-lg font-semibold text-red-400 text-center">Are you sure, you want to logout ?</p>
                    <div class="mt-6 mb-3 flex justify-end">
                        <button 
                            @click="logoutModal = false; menu = false;" 
                            class="cursor-pointer text-blue-light hover:bg-blue-light hover:text-c-white px-4 py-3 rounded-lg mr-4">Discard</button>
                        <form :method="`POST`" :action="`/logout`">
                            <input type="hidden" name="_token" :value="`${csrf}`">
                            <button type="submit" class="cursor-pointer bg-red-400 hover:bg-red-500 text-white px-4 py-3 rounded-lg">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'logout-modal',
    props: {
        auth: {
            type: Object,
            required: true
        },
        profile: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            menu: false,
            logoutModal: false,
            csrf: document.head.querySelector('meta[name="csrf-token"]').content
        }
    },
    methods: {
        toggleLogoutModel() {
            this.logoutModal = !this.logoutModal;
        }
    },

};

</script>
