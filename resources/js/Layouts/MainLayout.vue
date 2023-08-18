<template>
	<div class="flex flex-col w-full max-w-[100%] p-0 m-0 relative min-h-screen h-[100%]">
		<div class="flex flex-col w-full max-w-[100%] p-0 m-0 relative">
			<Header />
			<div class="flex flex-col p-0 m-0 max-w-[100%] w-full mt-[56px] md:mt-0">
				<main class="flex flex-col max-w-[100%] w-full p-0 m-0">
					<slot />
				</main>
			</div>
			<Footer />
		</div>
	</div>
</template>

<script setup>
	import Header from '../Components/Header.vue';
	import Footer from '../Components/Footer.vue';
	import { computed } from 'vue';
	import { usePage } from '@inertiajs/vue3';

	const page = usePage(),
	user = computed(() => page.props.user);
</script>