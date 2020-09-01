<template>
    <div class="w-full mt-4 ">
        <form @submit.prevent="savePost" :enctype="`multipart/form-data`">
            <div class="w-full">
                <div class="flex flex-row justify-between items-center mb-3">
                    <div class="flex items-center">
                        <h1 class="m-0 text-lg text-c-blue font-semibold ml-2">New Post</h1>
                    </div>
                    <div class="flex items-center">
                        <svg @click="reset" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 mr-2 cursor-pointer mr-4 text-c-blue-dark">
                            <polyline points="23 4 23 10 17 10"></polyline>
                            <path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path>
                        </svg>
                        <button type="submit" class=" hover:bg-blue-500 bg-blue-600 hover:opacity-75 text-gray-100 font-bold py-3 px-8 rounded focus:outline-none focus:shadow-outline">
                            Save
                        </button>
                    </div>
                </div>
                <div class="relative">
                    <div v-if="processing" class="absolute inset-0 bg-gray-100  z-30 flex justify-center items-center">
                        <div class="spinner">
                            <div class="rect1"></div>
                            <div class="rect2"></div>
                            <div class="rect3"></div>
                            <div class="rect4"></div>
                            <div class="rect5"></div>
                        </div>
                    </div>
                    <div class="flex flex-col w-full items-center bg-grey-lighter mb-3">
                        <label class="w-full flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue ">
                            <svg class="w-8 h-8 text-c-blue" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                            </svg>
                            <span class="mt-2 text-lg text-c-blue">Click to Upload Images</span>
                            <input type='file' id="files" ref="files" class="hidden" multiple @change="handleFileUpload" />
                        </label>
                        <div v-if="fileErr.length > 0" class="">
                            <p class="text-red-500 mt-1 px-1 py-1 rounded flex " role="alert">
                                {{ fileErr }}
                            </p>
                        </div>
                    </div>
                    <div v-if="files.length > 0" class=" w-full h-64 overflow-y-scroll grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div v-for="(file) in fileRead" class="w-full flex flex-row flex-wrap  items-center justify-between">
                            <div class="flex flex-col items-center rounded-lg">
                                <span class="rounded-lg my-2 text-white font-semibold text-lg  w-full text-center">
                                    <svg v-on:click="removeFile( file )" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mb-1 md:mb-0 h-6 w-6 md:h-8 md:h-8 text-red-600 cursor-pointer">
                                        <path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path>
                                        <line x1="18" y1="9" x2="12" y2="15"></line>
                                        <line x1="12" y1="9" x2="18" y2="15"></line>
                                    </svg>
                                </span>
                                <img :src="`${file}`" class="w-full rounded-lg">
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col  rounded-lg mb-3">
                        <label for="caption" class=" px-2 py-3 text-c-blue text-sm font-thin ">Caption</label>
                        <input type="text" id="caption" v-model="caption" class="px-3 py-3 rounded-lg  border border-c-blue text-gray-900">
                        <div v-if="captionErr.length > 0" class="">
                            <p v-for="e in captionErr" class="text-red-500 mt-1 px-1 py-1 rounded" role="alert">
                                {{ e }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
import Toast from './Alert';

export default {
    name: 'upload',
    data() {
        return {
            files: [],
            fileRead: [],
            caption: '',
            fileErr: [],
            captionErr: [],
            processing: false
        }
    },
    mounted() {},
    methods: {
        handleFileUpload() {
            // this.files = this.$refs.files.files;
            let uploadedFiles = this.$refs.files.files;
            for (var i = 0; i < uploadedFiles.length; i++) {
                this.files.push(uploadedFiles[i]);
                this.readFileUrl(uploadedFiles[i]);
            }
            // this.coverFile = this.$refs.files.files[0];
            console.log(this.files);

        },
        readFileUrl(file) {
            let name = file.name;
            let reader = new FileReader();
            reader.onload = (e) => {
                // get file content  
                let text = e.target.result;
                this.fileRead.push(e.target.result);
            }
            reader.readAsDataURL(file);
        },
        removeFile(file) {
            this.files = this.files.filter((state) => {
                return state !== file;
            });
            this.fileRead = this.fileRead.filter((state) => {
                return state !== file;
            });
        },
        savePost() {
            this.processing = true;
            this.captionErr = [];
            this.fileErr = [];
            let formData = new FormData();
            for (var i = 0; i < this.files.length; i++) {
                let file = this.files[i];

                formData.append('files[' + i + ']', file);
            }


            formData.append('caption', this.caption);
            axios.post(`/p`,
                    formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }).then((res) => {
                    if (res.status === 201) {

                        Toast.fire({
                            icon: 'success',
                            title: `Post uploaded successfully!`
                        });

                        this.reset();
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: 'There was some network error!'
                        });
                    }
                    this.processing = false;

                })
                .catch((err) => {
                    this.processing = false;
                    let errors = err.response.data.errors;
                    this.captionErr = [];

                    console.log('data', err.response.data.errors);
                    console.log('response', err.response);
                    if (errors.caption) {
                        this.captionErr = errors.caption;
                    }
                    this.fileErr = [];
                    if (err.response.status == 422) {
                        this.fileErr = 'Image must be jpg, jpeg, png, gif';
                    }
                    Toast.fire({
                        icon: 'error',
                        title: 'There was some network error!'
                    });
                });
        },
        reset() {
            this.caption = '';
            this.files = [];
            this.fileRead = [];
        }
    }
};

</script>
<style scoped>
.spinner {
    margin: 100px auto;
    width: 100px;
    height: 80px;
    text-align: center;
    font-size: 10px;
}

.spinner>div {
    background-color: #6886c5;
    height: 100%;
    width: 6px;
    /*margin: 0 4px 0 0;*/
    display: inline-block;

    -webkit-animation: sk-stretchdelay 1.2s infinite ease-in-out;
    animation: sk-stretchdelay 1.2s infinite ease-in-out;
}

.spinner .rect2 {
    -webkit-animation-delay: -1.1s;
    animation-delay: -1.1s;
}

.spinner .rect3 {
    -webkit-animation-delay: -1.0s;
    animation-delay: -1.0s;
}

.spinner .rect4 {
    -webkit-animation-delay: -0.9s;
    animation-delay: -0.9s;
}

.spinner .rect5 {
    -webkit-animation-delay: -0.8s;
    animation-delay: -0.8s;
}

@-webkit-keyframes sk-stretchdelay {

    0%,
    40%,
    100% {
        -webkit-transform: scaleY(0.4)
    }

    20% {
        -webkit-transform: scaleY(1.0)
    }
}

@keyframes sk-stretchdelay {

    0%,
    40%,
    100% {
        transform: scaleY(0.4);
        -webkit-transform: scaleY(0.4);
    }

    20% {
        transform: scaleY(1.0);
        -webkit-transform: scaleY(1.0);
    }
}

</style>
