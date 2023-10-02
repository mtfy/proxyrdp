<template>
	<ClientLayout :activePage="3">
		<div class="flex flex-col w-full p-0 m-0" v-if="props.service === null">
			<span class="flex flex-col font-medium whitespace-pre-wrap text-[20px] leading-[24px] capitalize">Service not found</span>
		</div>
		<div class="flex flex-col w-full p-0 m-0" v-else>
			<div class="flex flex-col w-full p-0 m-0">
				<span class="flex flex-col font-medium whitespace-pre-wrap text-[20px] leading-[24px] capitalize">Order &#x23;{{ props.service.id }}</span>
			</div>
			<div class="flex flex-col w-full m-0 mt-[18px] xl:mt-[24px] p-0">
				<div class="flex flex-col w-full relative bg-white border border-[#D1D9E4] rounded-xl p-[24px] space-y-[20px]">
					<div class="flex flex-col w-full p-0 m-0">
						<span class="flex flex-col font-medium whitespace-pre-wrap text-[18px] leading-[28px] capitalize">Service details</span>
					</div>
					<div class="flex flex-col w-full relative">
						<table class="motify-order-table table-fixed text-left font-motify text-[14px] md:text-[16px] leading-[16px] md:leading-[20px]">
							<tbody>
								<tr>
									<th scope="col" class="max-w-[33.33%] min-w-[33.33%] md:max-w-[25%] md:min-w-[25%] w-full">ID</th>
									<td class="whitespace-no-wrap">{{ props.service.id }}</td>
								</tr>
								<tr>
									<th scope="col" class="max-w-[33.33%] min-w-[33.33%] md:max-w-[25%] md:min-w-[25%] w-full">Status</th>
									<td class="whitespace-no-wrap" v-html="serviceStatus(props.service.status)"></td>
								</tr>
								<tr>
									<th scope="col" class="max-w-[33.33%] min-w-[33.33%] md:max-w-[25%] md:min-w-[25%] w-full">Category</th>
									<td class="whitespace-no-wrap">{{ (props.service.is_server) ? 'RDP' : 'Proxies' }}</td>
								</tr>
								<tr>
									<th scope="col" class="max-w-[33.33%] min-w-[33.33%] md:max-w-[25%] md:min-w-[25%] w-full">Service</th>
									<td class="whitespace-no-wrap">{{ props.service.title }}</td>
								</tr>
								<tr v-if="!props.service.is_server">
									<th scope="col" class="flex flex-col justify-start max-w-[33.33%] min-w-[33.33%] md:max-w-[25%] md:min-w-[25%] w-full">Description</th>
									<td class="whitespace-no-wrap">{{ props.service.description }}</td>
								</tr>
								<tr v-if="props.service.is_server">
									<th scope="col" class="flex flex-col justify-start max-w-[33.33%] min-w-[33.33%] md:max-w-[25%] md:min-w-[25%] w-full">Cores</th>
									<td class="whitespace-no-wrap">{{ props.service.server.hardware.cores }}</td>
								</tr>
								<tr v-if="props.service.is_server">
									<th scope="col" class="flex flex-col justify-start max-w-[33.33%] min-w-[33.33%] md:max-w-[25%] md:min-w-[25%] w-full">RAM</th>
									<td class="whitespace-no-wrap">{{ props.service.server.hardware.memory }} GB</td>
								</tr>
								<tr v-if="props.service.is_server">
									<th scope="col" class="flex flex-col justify-start max-w-[33.33%] min-w-[33.33%] md:max-w-[25%] md:min-w-[25%] w-full">Storage</th>
									<td class="whitespace-no-wrap">{{ props.service.server.hardware.storage }} GB</td>
								</tr>
								<tr v-if="props.service.is_server && props.service.server.hardware.ipv4 > 0">
									<th scope="col" class="flex flex-col justify-start max-w-[33.33%] min-w-[33.33%] md:max-w-[25%] md:min-w-[25%] w-full">IP(s)</th>
									<td class="whitespace-no-wrap">{{ props.service.server.hardware.ipv4 }}</td>
								</tr>
								<tr>
									<th scope="col" class="max-w-[33.33%] min-w-[33.33%] md:max-w-[25%] md:min-w-[25%] w-full">Pricing</th>
									<td class="whitespace-no-wrap" v-if="!props.service.is_server"><span class="font-semibold">{{ num.format(props.service.billing_amount) }}</span> {{ (props.service.billing === 1) ? '/' : 'for' }} <span class="font-semibold">{{ (props.service.billing === 1) ? 'GB' : '30 days' }}</span></td>
									<td class="whitespace-no-wrap" v-else><span class="font-semibold">{{ num.format(props.service.billing_amount) }}</span> monthly</td>
								</tr>
								<tr v-if="(props.service.is_server || props.service.billng_type !== 1) && null !== props.service.expires_at">
									<th scope="col" class="max-w-[33.33%] min-w-[33.33%] md:max-w-[25%] md:min-w-[25%] w-full">Next due date</th>
									<td class="whitespace-no-wrap" v-html="formatDate(props.service.expires_at)"></td>
								</tr>
								<tr>
									<th scope="col" class="flex flex-col justify-start max-w-[33.33%] min-w-[33.33%] md:max-w-[25%] md:min-w-[25%] w-full">Created</th>
									<td class="whitespace-no-wrap" v-html="formatDate(props.service.created_at)"></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="flex flex-col w-full m-0 mt-[18px] xl:mt-[24px] p-0">
				<div class="flex flex-col w-full relative bg-white border border-[#D1D9E4] rounded-xl p-[24px] space-y-[20px]">
					<div class="flex flex-col w-full p-0 m-0">
						<span class="flex flex-col font-medium whitespace-pre-wrap text-[20px] leading-[24px] capitalize">Management</span>
					</div>
					<div class="flex flex-col w-full relative m-0 p-0 gap-x-0 gap-y-6">
						<div class="flex flex-col w-full relative">

						</div>
					</div>
				</div>
			</div>
		</div>
	</ClientLayout>
</template>
<script setup>
	import ClientLayout from '../../../Layouts/ClientLayout.vue';
	import { reactive, onMounted, computed } from 'vue';
	import { usePage, Link } from '@inertiajs/vue3';
	import Swal from 'sweetalert2/dist/sweetalert2.js'
	import 'sweetalert2/dist/sweetalert2.min.css';
	import moment from 'moment';

	const props = defineProps({
		service: Object
	}),

	page = usePage(),
	user = computed(() => page.props.user),

	formatDate = (date) => {
		var d = new Date(0);
		d.setUTCSeconds(date);
		return moment(d.toISOString()).format('YYYY-MM-DD HH:mm').replace(/\s/, '&#xa0;');
	},

	Toast = Swal.mixin({
		toast: true,
		position: 'top-right',
		iconColor: '#FFFFFF',
		customClass: {
			popup: 'motify-toast'
		},
		showConfirmButton: false,
		timer: 4000,
		timerProgressBar: true
	}),

	locale = ('object' === typeof navigator && null !== navigator && 'language' in navigator && 'string' === typeof navigator.language) ? navigator.language : 'en-US',

	num = new Intl.NumberFormat(locale, {
		style: 'currency',
		currency: 'EUR',
		maximumFractionDigits: 2
	}),

	serviceStatus = (status) => {

		status = (parseInt(status) || 0);

		switch (status) {
			case 1:
				status = `<div class="motify-text-shadow-services--status inline-block align-middle w-auto relative py-[3px] px-[8px] rounded-[4px] text-[14px] text-white bg-green-400">Active</div>`;
				break;

			case 2:
				status = '<div class="motify-text-shadow-services--status inline-block align-middle w-auto relative py-[3px] px-[8px] rounded-[4px] text-[14px] text-white bg-red-600">Terminated</div>';
				break;

			default:
				status = '<div class="motify-text-shadow-services--status inline-block align-middle w-auto relative py-[3px] px-[8px] rounded-[4px] text-[14px] text-white bg-orange-300">Pending</div>';
		}

		return status;
	},

	proxy = reactive({});

	onMounted(async() => {
		
	});
</script>