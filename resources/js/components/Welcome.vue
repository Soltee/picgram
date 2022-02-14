<template>
    
    <div class="w-full md:w-1/2 relative flex flex-col justify-center px-2 md:px-0 ">

        <div class="shadow-2xl md:shadow-none rounded-lg px-4 py-4  flex flex-col justify-center md:border-transparent  ">
            <div class="">
                <div class="flex flex-row items-center ">
                    <svg class="h-10 w-10 text-blue-light pr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" />
                    </svg>
                    <span class="border-white border-l-2 font-serif text-blue-light text-md md:text-xl font-black">PicGram</span>
                </div>
                <p class="font-serif text-blue-light text-xs font-normal ">Share Memories</p>
            </div>
                

            <div class="md:w-88">
                <div v-if="loginModal" class="z-20 w-full  flex flex-col">

                    <form 
                        @submit.prevent="loginRequest()"
                        class="mt-6" id="loginForm">
                        <input type="hidden" name="login">
                        <div class="w-full  ">
                            <div class="mb-4  w-full">
                                <label class="block text-blue-light text-xs font-light   " for="email">
                                    Email
                                </label>
                                <input 
                                    class="text-blue-light rounded appearance-none   w-full
                                    py-2 px-4  leading-tight border shadow focus:outline-none  " 
                                    :class="(emailErr.length > 0) ? 'is-invalid': ''"
                                    id="email" 
                                    type="email" 
                                    v-model="email"
                                    name="email" 
                                    autocomplete="email" autofocus placeholder="*******@gmail.com">
                                <div v-if="emailErr.length > 0" class="">
                                    <p v-for="e in emailErr" class="text-red-500 text-sm mt-2 px-1 py-1 rounded" role="alert">
                                        {{ e }}
                                    </p>
                                </div>
                            </div>
                            <div class="mb-4  w-full ">
                                <label class="block text-blue-light text-xs font-light " for="password">
                                    Password
                                </label>
                                <input class=" text-blue-light rounded appearance-none   w-full   py-2 px-4  leading-tight border shadow focus:outline-none  " :class="(passErr.length > 0) ? 'is-invalid': ''" id="password" type="password" v-model="password" name="password" autocomplete="password" autofocus placeholder="**********">
                                <div v-if="passErr.length > 0" class="">
                                    <p v-for="e in passErr" class="text-red-500 text-sm mt-2 px-1 py-1 rounded" role="alert">
                                        {{ e }}
                                    </p>
                                </div>
                            </div>
                            <div class=" mb-4 flex flex-row items-center">
                                <input class="p-1 rounded mr-3 " type="checkbox" v-model="remember">
                                <label class="form-check-label font-normal text-blue-light" for="remember">
                                    Remember Me
                                </label>
                            </div>
                            <div class="flex flex-col my-4 w-full ">
                                <button type="submit" id="logBtn" class="w-full mb-1 font-bold text-lg bg-blue-dark hover:opacity-75 text-white py-2 px-6 rounded"
                                    v-text="(loading) ? 'Loading...' : 'Login'">
        
                                    
                                </button>
                                <a class="btn btn-link w-full  text-center text-blue-light text-xs" :href="`/password/reset`">
                                    Forgot Your Password?
                                </a>
                                
                            </div>
                            <div class="flex justify-center">
                                <p @click="toggle()" id="regLink" class=" mt-4  text-center text-blue-light cursor-pointer text-xs border-b border-transparent hover:border-blue-light w-auto">
                                    Don't have an account ? <strong class="font-bold text-md ">Register Now.</strong>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
                <div v-else class="z-20 w-full  flex flex-col">

                    <form 
                        @submit.prevent="registerRequest()"
                        class="mt-4" id="registerForm">
                        <input type="hidden" name="register">

                        <div class="w-full  ">

                            <div class="mb-4 w-full ">
                                <label class="block text-blue-light text-xs  font-light   " for="name">
                                    Name
                                </label>
                                <input class=" text-blue-light rounded appearance-none   w-full  py-2 px-4  leading-tight border shadow focus:outline-none  " :class="(nameErr.length > 0) ? 'is-invalid' : '' " id="name" v-model="name" name="name" autocomplete="name" autofocus placeholder="Hari ....">
                                <div v-if="nameErr.length > 0" class="">
                                    <p v-for="e in nameErr" class="text-red-500 text-sm mt-2 px-1 py-1 rounded" role="alert">
                                        {{ e }}
                                    </p>
                                </div>
                            </div>
                            <div class="mb-4 w-full ">
                                <label class="block text-blue-light text-xs font-light   " for="email">
                                    Email
                                </label>
                                <input 
                                    class="text-blue-light rounded appearance-none   w-full py-2 px-4  leading-tight border shadow focus:outline-none  " 
                                    :class="(emailErr.length > 0) ? 'is-invalid': ''"
                                    id="email" 
                                    type="email" 
                                    v-model="email" 
                                    name="email" 
                                    autocomplete="email" autofocus placeholder="*******@gmail.com">
                                <div v-if="emailErr.length > 0" class="">
                                    <p v-for="e in emailErr" class="text-red-500 text-sm mt-2 px-1 py-1 rounded" role="alert">
                                        {{ e }}
                                    </p>
                                </div>
                            </div>
                            <div class="mb-4 w-full   ">
                                <label class="block text-blue-light text-xs font-light  " for="password">
                                    Password
                                </label>
                                <input class=" text-blue-light rounded appearance-none   w-full py-2 px-4  leading-tight border shadow focus:outline-none  " :class="(passErr.length > 0) ? 'is-invalid': ''" id="password" type="password" v-model="password" name="password" autocomplete="password" autofocus placeholder="**********">
                                <div v-if="passErr.length > 0" class="">
                                    <p v-for="e in passErr" class="text-red-500 text-sm mt-2 px-1 py-1 rounded" role="alert">
                                        {{ e }}
                                    </p>
                                </div>
                            </div>
                            <div class="mb-4 w-full  ">
                                <label class="block text-blue-light text-xs font-light " for="password-confirm">
                                    Confirm Password
                                </label>
                                <input class=" text-blue-light rounded appearance-none   w-full py-2 px-4  leading-tight border shadow focus:outline-none  " :class="(passErr.length > 0) ? 'is-invalid': ''" id="password-confirm" type="password" v-model="confirm" autocomplete="new-password" autofocus placeholder="**********">
                            </div>
                            <div class="flex flex-col mt-6 w-full ">
                                <button type="submit" id="regBtn" class="w-full mb-3 font-bold text-lg bg-blue-dark hover:opacity-75 text-white py-2 px-6 rounded" 
                                v-text="(loading) ? 'Loading...' : 'Register'">
                                    
                                </button>
                            </div>

                            <div class="flex justify-center">
                                <p @click="toggle()" id="regLink" class=" mt-4  text-center text-blue-light cursor-pointer text-xs border-b border-transparent hover:border-blue-light w-auto">
                                    Already have an account ? <strong class="font-bold text-md ">Login Now.</strong>
                                </p>
                            </div>
                        </div>

                    
                    </form>
                </div>
            </div>

        </div>
    </div>

</template>
<script>
export default {
    name: 'welcome-view',
    props: {
        errors: {
            type: Array,
            required: false
        }
    },
    data() {
        return {
            loginModal: true,
            name: '',
            email: 'test@example.com',
            remember: false,
            password: 'password',
            confirm: '',
            nameErr: [],
            passErr: [],
            emailErr: [],
            csrf: "",
            loading : false,
        }
    },
    mounted() {
        this.refreshCsrf();

        if (this.errors.email) {
            this.emailErr = [];
            this.emailErr = this.errors.email;
        }
    },
    methods: {
        toggle() {
            this.refreshCsrf();
            this.name = '';
            this.email = '';
            this.password = '';
            this.remember = false;
            this.confirm = '';
            this.nameErr = '';
            this.emailErr = '';
            this.passErr = '';
            this.loginModal = !this.loginModal;
        },
        loginRequest(){
            this.loading = true;
            let formData = new FormData;
            formData.append('email', this.email);
            formData.append('password', this.password);
            formData.append('remember', this.remember);

            axios.post(`/login`, formData).then(res => {
                this.loading = false;
                if (res.status == 200) {
                    window.location.href = "/home";
                    // window.location.href = "/login?url=login";
                }

            }).catch((err) => {
                this.loading = false;
                let errors = err.response.data.errors;
                this.password = '';
                this.confirm = '';
                this.nameErr = '';
                this.emailErr = '';
                this.passErr = '';

                if (errors.email) {
                    this.emailErr = errors.email;
                }
                if (errors.password) {
                    this.passErr = errors.password;
                }

            });
        
        },
        registerRequest(){
            this.loading = true;

            let formData = new FormData;
            formData.append('email', this.email);
            formData.append('password', this.password);
            formData.append('name', this.name);
            formData.append('password_confirmation', this.confirm);
        
            axios.post(`/register`, formData).then(res => {
                this.loading = false;

                if (res.status == 200) {
                    window.location.href = "/home";
                    // window.location.href = "/login?url=verify";
                }

            }).catch((err) => {
                this.loading = false;

                let errors = err.response.data.errors;
                this.password = '';
                this.confirm = '';
                this.nameErr = '';
                this.emailErr = '';
                this.passErr = '';

                if(errors.name){
                    this.nameErr  = errors.name;
                }
                if (errors.email) {
                    this.emailErr = errors.email;
                }
                if (errors.password) {
                    this.passErr = errors.password;
                }

            });
        },
    

        refreshCsrf() {
            this.csrf = document.head.querySelector('meta[name="csrf-token"]').content;
        }

    }
}

</script>
