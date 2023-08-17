<template>
	<div v-if="links.length > 3">
		<div class="flex flex-wrap -mb-1">
			<template v-for="(link, key) in links" :key="key">
				<div v-if="link.url === null" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded" v-html="link.label" />
				<Link v-else class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500" :class="{ 'bg-white': link.active }" :href="link.url" v-html="link.label"></Link>
			</template>
		</div>
	</div>
</template>

<script setup>
	import { Link } from '@inertiajs/vue3';
	import { defineProps } from 'vue';

	defineProps({
		links: Array
	});

</script>