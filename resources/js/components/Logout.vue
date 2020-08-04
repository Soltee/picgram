<template>
    <div class="relative flex flex-row items-center relative">
        <div class="flex items-center">
            <a class="mr-2" :href="`/profile/${auth.id}/${auth.name}`">
                <img class="w-8 h-8    bg-cover rounded-full" :src="`${profile.avatar }`">
            </a>
            <svg v-if="menu" @click="menu = false;" class="h-8 w-8 text-c-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="18 15 12 9 6 15"></polyline>
            </svg>
            <svg v-else @click="menu = true;" class="h-8 w-8 text-c-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="6 9 12 15 18 9"></polyline>
            </svg>
        </div>
        <ul v-if="menu" class="m-0 flex flex-col absolute right-0 top-0 mt-8 p-1 rounded bg-c-blue">
            <li>
                <svg @click.prevent="toggleLogoutModel" class=" hover:opacity-75 h-8 w-8  md:h-10 md:w-10 text-c-white" mlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                    <polyline points="16 17 21 12 16 7"></polyline>
                    <line x1="21" y1="12" x2="9" y2="12"></line>
                </svg>
            </li>
        </ul>
        <div v-if="logoutModal">
            <div class="fixed inset-0  rounded-lg flex flex-col  justify-center rounded-lg z-20">
                <div class="h-full w-full bg-transparent" @click="logoutModal = false;">
                </div>
                <div class="absolute  bg-white left-0 right-0  mx-auto  max-w-xl shadow-lg rounded-lg p-6 z-30">
                    <div class="text-right">
                        <button @click="logoutModal = false;" type="button" class=" cursor-pointer" data-dismiss="modal" aria-label="Close">
                            <svg class="fill-current text-gray-900" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                            </svg>
                        </button>
                    </div>
                    <p class="mt-4 text-lg font-semibold text-red-600 text-center">Are you sure? You want to logout ?</p>
                    <div class="mt-6 mb-3 flex justify-end">
                        <button @click="logoutModal = false;" class="cursor-pointer text-gray-900 px-4 py-3 rounded-lg mr-4">Discard</button>
                        <form :method="`POST`" :action="`/logout`">
                            <input type="hidden" name="_token" :value="`${csrf}`">
                            <button type="submit" class="cursor-pointer bg-red-600 hover:bg-red-600 text-white px-4 py-3 rounded-lg">Logout</button>
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
