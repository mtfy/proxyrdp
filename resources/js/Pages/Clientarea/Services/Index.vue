<template>
	<ClientLayout :activePage="3">
		<div class="flex flex-col w-full p-0 m-0">
			<span class="flex flex-col font-medium whitespace-pre-wrap text-[20px] leading-[24px] capitalize">My services</span>
		</div>
		<div class="flex flex-col w-full relative bg-white border border-[#D1D9E4] rounded-xl p-[24px] m-0 mt-[20px] space-y-[20px]">
			<div class="flex flex-col w-full relative">
				<table class="table-fixed font-motify w-full text-left text-[14px] leading-[18px]">
					
				</table>
			</div>
		</div>
	</ClientLayout>
</template>
<script setup>
	import ClientLayout from '../../../Layouts/ClientLayout.vue';
	import { reactive, onMounted, computed } from 'vue';
	import { usePage } from '@inertiajs/vue3';

	const props = defineProps({
		items: Object
	}),

	page = usePage(),
	user = computed(() => page.props.user),

	locale = ('object' === typeof navigator && null !== navigator && 'language' in navigator && 'string' === typeof navigator.language) ? navigator.language : 'en-US',

	num = new Intl.NumberFormat(locale, {
		style: 'currency',
		currency: 'EUR',
		maximumFractionDigits: 2
	}),

	formatDate = (date) => {
		var d = new Date(date);
		return (`${d.toLocaleDateString()} ${d.toLocaleTimeString()}`);
	},

	proxy = reactive();

	onMounted(async() => {
		
	});
</script>