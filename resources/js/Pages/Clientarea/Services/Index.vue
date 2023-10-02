<template>
	<ClientLayout :activePage="3">
		<div class="flex flex-col w-full p-0 m-0">
			<span class="flex flex-col font-medium whitespace-pre-wrap text-[20px] leading-[24px] capitalize">My services</span>
		</div>
		<div class="flex flex-col w-full relative bg-white border border-[#D1D9E4] rounded-xl p-[24px] m-0 mt-[20px] space-y-[20px]">
			<div class="flex flex-col w-full relative">
				<div class="flex flex-col w-full max-w-[100%] overflow-x-auto relative pb-[20px] md:pb-0">
					<DataTable :data="props.services.data" :options="proxy.dataTables.options" class="display motify-table-md table-auto md:table-fixed font-motify w-full text-left text-[14px] leading-[18px]">
						<thead>
							<tr>
								<th>Service</th>
								<th>Pricing</th>
								<th>Due date</th>
								<th>Created</th>
								<th>Status</th>
							</tr>
						</thead>
					</DataTable>
				</div>
				<div class="flex flex-col w-full relative">
					<pagination :links="props.services.links" />
				</div>
			</div>
		</div>
	</ClientLayout>
</template>
<script setup>
	import ClientLayout from '../../../Layouts/ClientLayout.vue';
	import { reactive, onMounted, computed } from 'vue';
	import { usePage } from '@inertiajs/vue3';
	import Pagination from '../../../Components/Pagination.vue';
	import DataTable from 'datatables.net-vue3';
	import DataTablesCore from 'datatables.net';
	import moment from 'moment';

	DataTable.use(DataTablesCore);

	const props = defineProps({
		services: Object
	}),

	page = usePage(),
	user = computed(() => page.props.user),

	locale = ('object' === typeof navigator && null !== navigator && 'language' in navigator && 'string' === typeof navigator.language) ? navigator.language : 'en-US',

	num = new Intl.NumberFormat(locale, {
		style: 'currency',
		currency: 'EUR',
		maximumFractionDigits: 2
	}),

	proxy = reactive({
		dataTables: {
			data: [],
			options: {
				order: [[3, 'desc']],
				autoWidth: true,
				paging: false,
				columns: [
					{
						data: 'id',
						width: '40%',
						render : (data, type, row) => {
							if ( 'display' === type ) {
								return `<a class="transition-colors duration-300 no-underline outline-0 text-blue-700 hover:text-blue-400" href="/clientarea/services/${row.id.toString()}">${row.title}</a>`;
							}
							return row.id;
						}
					},
					{
						data: 'billing_amount',
						width: '20%',
						render : (data, type, row) => {
							if ( 'display' === type ) {
								var t = (parseInt(row.billing_type) || 0);
								return `${num.format(row.billing_amount)}${ ((t === 1) ? '&#xa0;/&#xa0;GB' : '') }`;
							}
							return (parseFloat(row.billing_amount) || 0);
						}
					},
					{
						data: 'expires_at',
						width: '20%',
						render : (data, type, row) => {
							var exp = row.expires_at, t = (parseInt(row.billing_type) || 0);
							if ( 'display' === type ) {
								if (null === exp || 1 === t)  {
									return 'N/A';
								} else {
									var d = new Date(0);
									d.setUTCSeconds(row.expires_at);
									return moment(d.toISOString()).format('YYYY-MM-DD HH:mm').replace(/\s/, '&#xa0;');
								}
							}
							return ((exp === null || t === 1) ? 0 : exp);
						}
					},
					{
						data: 'created_at',
						width: '20%',
						render : (data, type, row) => {
							var date = row.created_at;
							if ( 'display' === type ) {
								var d = new Date(0);
								d.setUTCSeconds(row.created_at);
								return moment(d.toISOString()).fromNow().replace(/\s/, '&#xa0;');
							}
							return ((date === null) ? 0 : date);
						}
					},
					{
						data: 'status',
						width: '20%',
						render : (data, type, row) => {
							var status = ( parseInt(row.status) || 0 );
							if ( 'display' === type ) {
								switch (status) {
									case 1:
										status = `<div class="motify-text-shadow-services--status inline-block align-middle w-auto relative py-[4px] px-[8px] rounded-[4px] text-white bg-green-400">Active</div>`;
										break;

									case 2:
										status = '<div class="motify-text-shadow-services--status inline-block align-middle w-auto relative py-[4px] px-[8px] rounded-[4px] text-white bg-red-600">Terminated</div>';
										break;

									default:
										status = '<div class="motify-text-shadow-services--status inline-block align-middle w-auto relative py-[4px] px-[8px] rounded-[4px] text-white bg-orange-300">Pending</div>';
								}
							}
							return status;
						}
					}
				]
			}
		}
	});

	onMounted(async() => {
		
	});
</script>