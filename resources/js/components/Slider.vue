<template>
    <div class="relative">
        
        <!-- Vue Agile -->
        <!-- <agile
            :options="options"
            >
            <div class="slide" 
                v-for="(i, index) in images"
                :key="index"
                >
                    <a :href="`/posts/${post.id}/${post.caption}`">

                        <img 
                            :src="`${i.url}`" 
                            class="h-full rounded-lg cursor-move">
                    </a>
            
            </div>
        </agile>
        -->

        <!-- Custom -->
        <transition-group name="fade" tag="div">
            <div v-for="i in [currentIndex]" :key="i">
                <a :href="`/posts/${post.id}/${post.caption}`">
                    <img :src="currentImg" />
                </a>
            </div>
            
        </transition-group>
        <span class="prev" @click="prev">&#10094; </span>
        <span class="next" @click="next">&#10095; </span>
    

    </div>
</template>
<script>
import { VueAgile } from 'vue-agile'

export default {
    name: 'imageSlider',
    props: {
        post: {
            type: Object,
            required: true,
        },
        images: {
            type: Array,
            required: true
        }
    },
    data() {
        return {
            slides : this.images,
            options: {
                autoplay: false,
                // navButtons:true,
                // centerMode: true,
                // dots: true,
                touch:true,
            },
            currentIndex: 0
        }
    },
    components: {
        agile: VueAgile,
        
    },
    mounted(){
        this.startSlide();
    },
    methods: {
        startSlide: function() {
        },

        next: function() {
          this.currentIndex += 1;
        },
        prev: function() {
          this.currentIndex -= 1;
        }

    },
    computed: {
        currentImg() {
          return this.slides[Math.abs(this.currentIndex) % this.slides.length].url;
        }
    }
};

</script>
<style type="text/css">
    .agile__actions{
            z-index: -1;
            display: none;
    }
    .agile__nav-button{
        height: 48px;
        width: 48px;
        color: #2E8BC0;
        font-size: 32px;
        z-index: 20;
    }
    

    .agile__nav-button--prev{
        display: flex;
        align-items: center;
        justify-content: space-between;
        
    }
    .agile__nav-button--next{
        display: flex;
        align-items: center;
        justify-content: space-between;
        
    }


    /* Slideshow container */

    .fade-enter-active,
.fade-leave-active {
  transition: all 0.9s ease;
  overflow: hidden;
  visibility: visible;
  position: absolute;
  width:100%;
  opacity: 1;
}

.fade-enter,
.fade-leave-to {
  visibility: hidden;
  width:100%;
  opacity: 0;
}

/*img {
  height:600px;
  width:100%
}*/

.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 40%;
  width: auto;
  padding: 16px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.7s ease;
  border-radius: 0 4px 4px 0;
  text-decoration: none;
  user-select: none;
}

.next {
  right: 0;
}

.prev {
  left: 0;
}

.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.9);
}
</style>

