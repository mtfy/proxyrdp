<template>
	<ClientLayout :activePage="9">
		
	</ClientLayout>
</template>
<script setup>
	import ClientLayout from '../../Layouts/ClientLayout.vue';
	import { reactive, onMounted, computed } from 'vue';
	import { usePage } from '@inertiajs/vue3';

	const props = defineProps({}),

	page = usePage(),
	user = computed(() => page.props.user),

	proxy = reactive();

	onMounted(async() => {
		
	});
</script>