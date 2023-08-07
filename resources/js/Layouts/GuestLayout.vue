<template>
	<div class="flex flex-col w-full max-w-[100%] p-0 m-0 relative min-h-screen h-[100%]">
		<div class="flex flex-col w-full max-w-[100%] p-0 m-0 relative">
			<Header />
			<div class="flex flex-col p-0 m-0 max-w-[100%] w-full mt-[56px] md:mt-0">
				<main class="flex flex-col max-w-[100%] w-full p-0 m-0">
					<slot />
				</main>
			</div>
		</div>
	</div>
</template>

<script setup>
	import { Head } from '@inertiajs/vue3';
	import Header from '../Components/Header.vue';
</script>