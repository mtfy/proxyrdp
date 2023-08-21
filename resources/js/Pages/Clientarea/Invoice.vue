<template>
	<ClientLayout :user="user">
		<div class="flex flex-col w-full p-0 m-0">
			<span class="flex flex-col font-medium whitespace-pre-wrap text-[20px] leading-[24px] capitalize" v-text="(props.invoice.ok) ? 'Invoice' : 'Not found'"></span>
		</div>
		<div class="flex flex-col w-full relative bg-white border border-[#D1D9E4] rounded-xl p-[24px] m-0 mt-[20px] space-y-[20px]" v-if="props.invoice.ok">
			<div class="flex flex-col w-full relative">
				<table class="table-fixed text-left font-motify leading-loose text-[14px] md:text-[16px] lg:max-w-[50%]">
					<tbody>
						<tr>
							<th scope="col" class="max-w-[33.33%] min-w-[33.33%] md:max-w-[25%] md:min-w-[25%] w-full">ID</th>
							<td class="whitespace-no-wrap" v-html="formatInvoiceId( props.invoice.data.token )"></td>
						</tr>
						<tr>
							<th scope="col" class="max-w-[33.33%] min-w-[33.33%] md:max-w-[25%] md:min-w-[25%] w-full">Created at</th>
							<td class="whitespace-no-wrap">{{ formatDate(props.invoice.data.created_at) }}</td>
						</tr>
						<tr>
							<th scope="col" class="max-w-[33.33%] min-w-[33.33%] md:max-w-[25%] md:min-w-[25%] w-full">Updated at</th>
							<td class="whitespace-no-wrap">{{ formatDate(props.invoice.data.created_at) }}</td>
						</tr>
						<tr>
							<th scope="col" class="max-w-[33.33%] min-w-[33.33%] md:max-w-[25%] md:min-w-[25%] w-full">Total</th>
							<td class="whitespace-no-wrap">{{ num.format( parseFloat(props.invoice.data.amount.fiat) || 0 ) }}</td>
						</tr>
						<tr>
							<th scope="col" class="max-w-[33.33%] min-w-[33.33%] md:max-w-[25%] md:min-w-[25%] w-full">Status</th>
							<td class="whitespace-no-wrap">{{ props.invoice.data.status.text }}</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="flex flex-col relative" v-if="props.invoice.data.status.id === 0">
				<table class="table-fixed text-left font-motify leading-loose text-[14px] md:text-[16px] lg:max-w-[50%]">
					<tbody>
						<tr v-if="props.invoice.data.status.id === 0 && null !== invoice.data.currency">
							<th scope="col" class="max-w-[33.33%] min-w-[33.33%] md:max-w-[25%] md:min-w-[25%] w-full">Currency</th>
							<td class="whitespace-no-wrap">{{ props.invoice.data.currency.toUpperCase() }}</td>
						</tr>
						<tr v-if="props.invoice.data.status.id === 0 && (0 !== (parseFloat(invoice.data.amount.crypto) || 0))">
							<th scope="col" class="max-w-[33.33%] min-w-[33.33%] md:max-w-[25%] md:min-w-[25%] w-full">Amount</th>
							<td class="whitespace-pre-wrap tracking-wide">{{ props.invoice.data.amount.crypto }}</td>
						</tr>
						<tr v-if="props.invoice.data.status.id === 0 && null !== invoice.data.address">
							<th scope="col" class="max-w-[33.33%] min-w-[33.33%] md:max-w-[25%] md:min-w-[25%] w-full">Address</th>
							<td class="whitespace-pre-wrap break-all tracking-wide">{{ props.invoice.data.address }}</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="flex flex-col w-full relative w-full">
				<div class="flex flex-col w-full relative justify-center items-center lg:justify-start lg:items-start w-full lg:max-w-[50%] pt-[20px]">
					<a :href="`https://href.li/?https://nowpayments.io/payment/?iid=${props.invoice.data.invoice_id.toString()}`" class="flex flex-col w-full lg:w-auto justify-center items-center select-none cursor-pointer no-underline transition-all duration-300" target="_blank">
						<Button :type="'button'" :custom-class="'override:text-[14px] rounded-[4px] bg-theme-secondary-500 text-white w-full text-center font-medium justify-center items-center hover:bg-theme-secondary-700 hover:text-[#F5F5F5]'">
							<div class="flex flex-row w-full items-center justify-center space-x-2 leading-[20px]">
								<div class="flex flex-col"><svg xmlns="http://www.w3.org/2000/svg" role="img" width="20px" height="20px" fill="currentColor" class="flex flex-col select-none pointer-events-none" viewBox="0 0 24 24"><path d="M7,18c-1.1,0-1.99,0.9-1.99,2S5.9,22,7,22s2-0.9,2-2S8.1,18,7,18z M17,18c-1.1,0-1.99,0.9-1.99,2s0.89,2,1.99,2s2-0.9,2-2 S18.1,18,17,18z M8.1,13h7.45c0.75,0,1.41-0.41,1.75-1.03L21,4.96L19.25,4l-3.7,7H8.53L4.27,2H1v2h2l3.6,7.59l-1.35,2.44 C4.52,15.37,5.48,17,7,17h12v-2H7L8.1,13z M12,2l4,4l-4,4l-1.41-1.41L12.17,7L8,7l0-2l4.17,0l-1.59-1.59L12,2z"></path></svg></div>
								<div class="flex flex-col text-[12px] md:text-[14px]">Continue to Payment</div>
							</div>
						</Button>
					</a>
				</div>
			</div>
		</div>
	</ClientLayout>
</template>
<script setup>
	import ClientLayout from '../../Layouts/ClientLayout.vue';
	import { reactive, onMounted , computed} from 'vue';
	import { usePage, Link } from '@inertiajs/vue3';
	import Button from '../../Components/Button.vue';

	const props = defineProps({
		invoice: Object
	}),
	page = usePage(),
	user = computed(() => page.props.user),

	proxy = reactive({}),

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

	formatInvoiceId = (id) => {
		var i = id.toUpperCase().replace(/([A-F0-9]{4})([A-F0-9]{4})([A-F0-9]{4})([A-F0-9]{4})([A-F0-9]{4})/g, '$1-$2-$3-$4-$5');
		console.log(i);
		return i;
	};

	onMounted(async() => {
		window.console.log(props.invoice);
	});
</script>