<template>
    <div class="min-h-screen flex-1  z-20 px-6 mt-5 md:px-0 flex flex-col items-center">
        <div v-if="loginModal" class="z-20  flex flex-col">
            <div class="flex flex-row items-center md:w-88">
                <svg class="h-10 w-10 text-c-blue pr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" />
                </svg>
                <span class="pl-2 border-white border-l-2 font-serif text-c-blue text-md md:text-xl font-black">PicGram</span>
            </div>
            <p class="font-serif text-c-blue text-sm font-normal  mt-1">Share Memories</p>
            <a :href="`/redirect`" class="flex justify-around items-center bg-white rounded-full py-2 w-56 rounded-lg border bg-c-blue border-c-blue px-4  my-4 ">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6  text-c-white">
                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                </svg>
                <span class="text-c-white text-sm ml-3">Login with Facebook</span>
            </a>
            <form :action="`/login`" :method="`post`" class="mt-6" id="loginForm">
                <input type="hidden" name="_token" :value="csrf">
                <input type="hidden" name="login">
                <div class="w-full md:w-88 ">
                    <div class="mb-4  w-full">
                        <label class="block text-c-blue text-md mb-2 font-light   " for="email">
                            E-Mail
                        </label>
                        <input class=" text-gray-800 rounded appearance-none   w-full
                            py-3 px-4  leading-tight focus:outline-none  border border-c-blue" :class="(emailErr.length > 0) ? 'is-invalid': ''" id="email" type="email" v-model="email" name="email" value="" autocomplete="email" autofocus placeholder="*******@gmail.com">
                        <div v-if="emailErr.length > 0" class="">
                            <p v-for="e in emailErr" class="text-red-500 text-sm mt-2 px-1 py-1 rounded" role="alert">
                                {{ e }}
                            </p>
                        </div>
                    </div>
                    <div class="mb-4  w-full md:w-88">
                        <label class="block text-c-blue text-sm font-light mb-2    " for="password">
                            Password
                        </label>
                        <input class=" text-gray-800 rounded appearance-none   w-full   py-3 px-4  leading-tight focus:outline-none  border border-c-blue" :class="(passErr.length > 0) ? 'is-invalid': ''" id="password" type="password" v-model="password" name="password" autocomplete="password" autofocus placeholder="**********">
                        <div v-if="passErr.length > 0" class="">
                            <p v-for="e in passErr" class="text-red-500 text-sm mt-2 px-1 py-1 rounded" role="alert">
                                {{ e }}
                            </p>
                        </div>
                    </div>
                    <div class=" mb-4 flex flex-row items-center">
                        <input class="p-1 rounded mr-3 " type="checkbox" v-model="remember">
                        <label class="form-check-label font-normal text-c-blue" for="remember">
                            Remember Me
                        </label>
                    </div>
                    <div class="flex flex-col my-4 w-full md:w-88">
                        <button @click.prevent="validateData()" type="submit" id="logBtn" class="w-full mb-3 font-bold text-lg bg-c-blue-dark hover:opacity-75 text-c-white py-3 px-6 rounded">
                            Login
                        </button>
                        <a class="btn btn-link w-full  text-center text-c-blue text-sm" :href="`/password/reset`">
                            Forgot Your Password?
                        </a>
                        <p @click="toggle()" id="regLink" class=" mt-6  w-full text-center text-c-blue cursor-pointer text-sm">
                            Don't have an account ? <strong class="font-bold text-md ">Register Now.</strong>
                        </p>
                    </div>
                </div>
            </form>
        </div>
        <div v-else class="z-20 flex flex-col">
            <a :href="`/redirect`" class="flex justify-around items-center bg-white rounded-full py-2 w-56 rounded-lg border bg-c-blue border-c-blue px-4  mt-4 ">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6  text-c-white">
                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                </svg>
                <span class="text-c-white text-sm ml-3">Login with Facebook</span>
            </a>
            <form :method="`post`" :action="`/register`" class="mt-6" id="registerForm">
                <input type="hidden" name="_token" :value="csrf">
                <input type="hidden" name="register">
                <div class="mb-4 w-full md:w-88 ">
                    <label class="block text-c-blue text-sm mb-2 font-light   " for="name">
                        Name
                    </label>
                    <input class=" text-gray-800 rounded appearance-none   w-full  py-3 px-4  leading-tight focus:outline-none  border border-c-blue" :class="(nameErr.length > 0) ? 'is-invalid' : '' " id="name" v-model="name" name="name" autocomplete="name" autofocus placeholder="Hari ....">
                    <div v-if="nameErr.length > 0" class="">
                        <p v-for="e in nameErr" class="text-red-500 text-sm mt-2 px-1 py-1 rounded" role="alert">
                            {{ e }}
                        </p>
                    </div>
                </div>
                <div class="mb-4 w-full md:w-88 ">
                    <label class="block text-c-blue text-sm mb-2 font-light   " for="email">
                        E-Mail
                    </label>
                    <input class=" text-gray-800 rounded appearance-none   w-full py-3 px-4  leading-tight focus:outline-none  border border-c-blue" :class="(emailErr.length > 0) ? 'is-invalid': ''" id="email" type="email" v-model="email" name="email" value="" autocomplete="email" autofocus placeholder="*******@gmail.com">
                    <div v-if="emailErr.length > 0" class="">
                        <p v-for="e in emailErr" class="text-red-500 text-sm mt-2 px-1 py-1 rounded" role="alert">
                            {{ e }}
                        </p>
                    </div>
                </div>
                <div class="mb-4 w-full md:w-88  ">
                    <label class="block text-c-blue text-sm font-light mb-2    " for="password">
                        Password
                    </label>
                    <input class=" text-gray-800 rounded appearance-none   w-full py-3 px-4  leading-tight focus:outline-none  border border-c-blue" :class="(passErr.length > 0) ? 'is-invalid': ''" id="password" type="password" v-model="password" name="password" autocomplete="password" autofocus placeholder="**********">
                    <div v-if="passErr.length > 0" class="">
                        <p v-for="e in passErr" class="text-red-500 text-sm mt-2 px-1 py-1 rounded" role="alert">
                            {{ e }}
                        </p>
                    </div>
                </div>
                <div class="mb-4 w-full md:w-88 ">
                    <label class="block text-c-blue text-sm font-light mb-2    " for="password-confirm">
                        Confirm Password
                    </label>
                    <input class=" text-gray-800 rounded appearance-none   w-full py-3 px-4  leading-tight focus:outline-none  border border-c-blue" :class="(passErr.length > 0) ? 'is-invalid': ''" id="password-confirm" type="password" v-model="confirm" autocomplete="new-password" autofocus placeholder="**********">
                </div>
                <div class="flex flex-col mt-6 w-full md:w-88">
                    <button @click.prevent="validateData()" type="submit" id="regBtn" class="w-full mb-3 font-bold text-lg bg-c-blue-dark hover:opacity-75 text-white py-2 px-6 rounded">
                        Register
                    </button>
                    <p @click="toggle()" id="regLink" class=" mt-2  w-full text-center text-c-blue cursor-pointer text-sm">
                        Already Have an account ? <strong class="font-bold text-md ">Login Now.</strong>
                    </p>
                </div>
            </form>
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
            csrf: ""
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
        validateData() {
            let formData = new FormData;
            formData.append('email', this.email);
            formData.append('password', this.password);

            if (this.loginModal) {
                formData.append('remember', this.remember);
                formData.append('type', 'login');
            } else {
                formData.append('name', this.name);
                formData.append('password_confirmation', this.confirm);
                formData.append('type', 'register');
            }

            const logForm = document.getElementById('loginForm');
            const regForm = document.getElementById('registerForm');
            console.log(logForm, regForm);

            axios.post(`/validateData`, formData).then(res => {
                if (res.status == 200) {
                    if (this.loginModal) {
                        console.log(logForm);
                        logForm.submit();
                    } else {
                        console.log(regForm);
                        regForm.submit();
                    }

                }
            }).catch((err) => {
                let errors = err.response.data.errors;
                this.password = '';
                this.confirm = '';
                this.nameErr = '';
                this.emailErr = '';
                this.passErr = '';

                if (errors.name) {
                    this.nameErr = errors.name;
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
