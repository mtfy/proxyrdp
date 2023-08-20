<template>
	<ClientLayout :user="user" :activePage="5">
		<div class="flex flex-col w-full p-0 m-0">
			<span class="flex flex-col font-medium whitespace-pre-wrap text-[20px] leading-[24px] capitalize">Invoices</span>
		</div>
		<div class="flex flex-col w-full relative bg-white border border-[#D1D9E4] rounded-xl p-[24px] m-0 mt-[20px] space-y-[20px]">
			<div class="flex flex-col w-full relative">
				<table class="table-fixed font-motify w-full text-left text-[14px] leading-[18px]">
					<thead>
						<th colspan="3">ID</th>
						<th>Subtotal</th>
						<th colspan="2">Status</th>
						<th colspan="2">Created at</th>
						<th colspan="3">Updated at</th>
					</thead>
					<tbody>
						<tr v-for="item in props.items.data" :key="item.invoice_id">
							<td colspan="3" class="py-[6px] lg:py-[4px]"><span class="tracking-wide" v-html="formatInvoiceId(item.invoice_id)"></span></td>
							<td class="py-[6px] lg:py-[4px]">{{ num.format(parseFloat(item.amount) || 0) }}</td>
							<td colspan="2" class="py-[6px] lg:py-[4px]">{{ item.status }}</td>
							<td colspan="2" class="py-[6px] lg:py-[4px]">{{ formatDate(item.created_at) }}</td>
							<td colspan="2" class="py-[6px] lg:py-[4px]">{{ formatDate(item.updated_at) }}</td>
							<td class="py-[6px] lg:py-[4px]">
								<Link :href="`/clientarea/invoices/${item.invoice_id}`" class="flex flex-col w-full lg:w-auto justify-center items-center select-none cursor-pointer no-underline transition-all duration-300">
									<Button :type="'button'" :customClass="'motify-table-btn-sm rounded-[4px] bg-theme-secondary-500 text-white w-full capitalize text-center justify-center items-center hover:bg-theme-secondary-700 hover:text-[#F5F5F5]'">
										View
									</Button>
								</Link>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="flex flex-col w-full relative">
				<pagination :links="props.items.links" />
			</div>
		</div>
	</ClientLayout>
</template>
<script setup>
	import ClientLayout from '../../Layouts/ClientLayout.vue';
	import { reactive, onMounted, computed, ref, nextTick } from 'vue';
	import { usePage, Link } from '@inertiajs/vue3';
	import Pagination from '../../Components/Pagination.vue';
	import Button from '../../Components/Button.vue';

	const props = defineProps({
		items : Object
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
		var i = id.toUpperCase().replace(/([A-F0-9]{4})([A-F0-9]{4})([A-F0-9]{4})([A-F0-9]{4})([A-F0-9]{4})/g, '$1<span class="tracking-tight text-slate-950">-</span>$2<span class="tracking-tight text-slate-950">-</span>$3<span class="tracking-tight text-slate-950">-</span>$4<span class="tracking-tight text-slate-950">-</span>$5</span>');
		console.log(i);
		return i;
	}

	onMounted(async() => {
	});
</script>