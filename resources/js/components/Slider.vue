<template>
	<div>
		<carousel :perPage="1" :paginationEnabled="false" :navigationEnabled="true" >
            <slide v-for="(image, index) in images" :key="index">
                <img :src="`/storage/${image.url}`" class="w-full bg-gray-400 rounded-lg shadow-lg" alt="...">
            </slide>
        </carousel>
	</div>
</template>

<script>
import { Carousel, Slide } from 'vue-carousel';
export default {
	name: 'imageSlider',
	props:{
		images : {
			type : Array,
			required : true
		}
	},
	components: {
      Carousel, Slide
   	}
}
</script>

