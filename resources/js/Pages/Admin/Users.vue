<template>
	<ClientLayout :activePage="7">
		<div class="flex flex-col w-full p-0 m-0">
			<span class="flex flex-col font-medium whitespace-pre-wrap text-[20px] leading-[24px] capitalize">Users</span>
		</div>
		<div class="flex flex-col w-full m-0 mt-[18px] xl:mt-[24px] p-0">
			
		</div>
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