<template>
	<div class="bg-theme-primary-500 motify-grid-background flex flex-col justify-center relative max-w-[100%] w-full p-0 m-0 z-[-2] min-h-screen h-screen lg:min-h-[668px] lg:h-[668px]">
		<div class="motify-container relative min-h-screen h-screen lg:min-h-[668px] lg:h-[668px]">
			<div class="flex flex-row m-0 p-0 w-full flex-grow flex-wrap relative items-center">
				<div class="flex flex-col m-0 p-0 w-full relative md:w-7/12">
					<div class="flex flex-col relative m-0 p-0 w-full relative items-center md:items-start md:space-y-[14px]">
						<span class="inline-flex text-white font-motify font-bold whitespace-pre-line text-[40px] leading-[46px] md:text-[64px] md:leading-[68px]">
							Lorem ipsum dolor
						</span>
						<span class="inline-flex text-theme-highlight-400 font-motify font-bold whitespace-pre-line text-[40px] leading-[46px] md:text-[64px] md:leading-[68px]">
							Sed ut perspiciatis
						</span>
						<span class="inline-flex text-white font-motify font-bold whitespace-pre-line text-[40px] leading-[46px] md:text-[64px] md:leading-[68px]">
							Eu sale efficiendi
						</span>
					</div>
					<div class="relative m-0 p-0 relative mt-[36px]">
						<Button :type="'button'" :custom-class="' py-[17px] px-[43px] mx-auto md:m-0 bg-theme-highlight-500 text-theme-primary-500 hover:bg-theme-highlight-400 hover:text-theme-primary-600'">
							Order Now
						</Button>
					</div>
				</div>
				<div class="flex flex-col m-0 p-0 w-full flex-grow flex-wrap relative md:w-5/12">
					<figure class="flex items-end justify-end h-[100%] select-none pointer-events-none">
						<img class="select-none pointer-events-none" @mousedown="() => { return false }" width="772" height="602" src="./../../media/landing-hero-illustration.png" alt="Landing" decoding="async" loading="lazy" srcset="./../../media/landing-hero-illustration.png 772w, ./../../media/landing-hero-illustration-300x234.png 300w, ./../../media/landing-hero-illustration-768x599.png 768w, ./../../media/landing-hero-illustration-360x281.png 360w" sizes="(max-width: 772px) 100vw, 772px">
					</figure>
				</div>
			</div>
		</div>
	</div>
</template>

<script setup>
	import { Link } from '@inertiajs/vue3';
	import Button from './Button.vue';
</script>