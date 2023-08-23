<template>
	<ClientLayout :activePage="7">
		<div class="flex flex-col w-full p-0 m-0">
			<span class="flex flex-col font-medium whitespace-pre-wrap text-[20px] leading-[24px] capitalize">Users</span>
		</div>
		<div class="flex flex-col w-full relative bg-white border border-[#D1D9E4] rounded-xl p-[24px] m-0 mt-[20px] space-y-[20px]">
			<div class="flex flex-col w-full p-0 m-0">
				<span class="flex flex-col font-medium whitespace-pre-wrap text-[20px] leading-[24px] capitalize">Users</span>
			</div>
			<div class="flex flex-col w-full max-w-[100%] overflow-x-auto relative">
				<DataTable :data="props.users.data" :options="proxy.dataTables.options" class="display motify-table table-auto md:table-fixed font-motify w-full text-left text-[14px] leading-[18px]">
					<thead>
						<tr>
							<th>ID</th>
							<th>Email</th>
							<th>Full name</th>
							<th>Balance</th>
							<th class="text-center">Admin</th>
							<th>Registered</th>
						</tr>
					</thead>
				</DataTable>
			</div>
			<div class="flex flex-col w-full relative">
				<pagination :links="props.users.links" />
			</div>
		</div>
	</ClientLayout>
</template>
<script setup>
	import ClientLayout from '../../../Layouts/ClientLayout.vue';
	import { reactive, onMounted, computed, nextTick } from 'vue';
	import { usePage, Link } from '@inertiajs/vue3';
	import Button from '../../../Components/Button.vue';
	import Input from '../../../Components/Input.vue';
	import Pagination from '../../../Components/Pagination.vue';
	import DataTable from 'datatables.net-vue3';
	import DataTablesCore from 'datatables.net';

	DataTable.use(DataTablesCore);

	const props = defineProps({
		users: Object
	}),

	locale = ('object' === typeof navigator && null !== navigator && 'language' in navigator && 'string' === typeof navigator.language) ? navigator.language : 'en-US',

	num = new Intl.NumberFormat(locale, {
		style: 'currency',
		currency: 'EUR',
		maximumFractionDigits: 2
	}),

	formatName = (name) => {
		var buf = name.charAt(0).toUpperCase() + name.slice(1).toLowerCase();
		console.log(buf);
		return buf;
	},

	formatDate = (date) => {
		var d = new Date(date);
		return `${d.toLocaleDateString()}&#xa0;${d.toLocaleTimeString()}`.replace(/\s/, '&#xa0;');
	},

	page = usePage(),
	user = computed(() => page.props.user),

	proxy = reactive({
		dataTables: {
			data: [],
			options: {
				autoWidth: true,
				paging: false,
				columns: [
					{
						data: 'id',
						width: '10%',
						render : (data, type, row) => {
							return `<a class="transition-colors duration-300 no-underline outline-0 text-blue-700 hover:text-blue-400" href="/admin/users/${row.id.toString()}" target="_blank">${row.id}</a>`;
						}
					},
					{
						data: 'email',
						width: '25%',
						render : (data, type, row) => {
							if ( 'display' === type ) {
								return `<a class="transition-colors duration-300 no-underline outline-0 text-blue-700 hover:text-blue-400" href="/admin/users/${row.id.toString()}" target="_blank" title="${data.toLowerCase()}">${row.email.toLowerCase()}</a>`
							}
							return row.email;
						}
					},
					{
						data: 'first_name',
						width: '20%',
						render : (data, type, row) => {
							if ( 'display' === type ) {
								return `${formatName(row.first_name)}&#xa0;${formatName(row.last_name)}`;
							}
							return `${formatName(row.first_name)} ${formatName(row.last_name)}`;
						}
					},
					{
						data: 'balance',
						width: '12.5%',
						render : (data, type, row) => {
							if ( 'display' === type ) {
								return `${num.format(row.balance)}`;
							}
							return (parseFloat(row.balance) || 0).toFixed(2);
						}
					},
					{
						data: 'roles',
						width: '10%',
						render : (data, type, row) => {
							if ( 'display' === type ) {
								if (row.roles.includes('Administrator')) {
									return `<div class="flex flex-col w-full items-center justify-center p-0 m-0 select-none pointer-events-none text-green-700"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" role="img" class="flex flex-col select-none pointer-events-none" width="14px" height="14px" fill="currentColor" zoomAndPan="magnify" viewBox="0 0 30 30.000001" preserveAspectRatio="xMidYMid meet"><defs><clipPath id="id1"><path d="M 2.328125 4.222656 L 27.734375 4.222656 L 27.734375 24.542969 L 2.328125 24.542969 Z M 2.328125 4.222656 " clip-rule="nonzero"/></clipPath></defs><g clip-path="url(#id1)"><path fill="rgb(13.729858%, 12.159729%, 12.548828%)" d="M 27.5 7.53125 L 24.464844 4.542969 C 24.15625 4.238281 23.65625 4.238281 23.347656 4.542969 L 11.035156 16.667969 L 6.824219 12.523438 C 6.527344 12.230469 6 12.230469 5.703125 12.523438 L 2.640625 15.539062 C 2.332031 15.84375 2.332031 16.335938 2.640625 16.640625 L 10.445312 24.324219 C 10.59375 24.472656 10.796875 24.554688 11.007812 24.554688 C 11.214844 24.554688 11.417969 24.472656 11.566406 24.324219 L 27.5 8.632812 C 27.648438 8.488281 27.734375 8.289062 27.734375 8.082031 C 27.734375 7.875 27.648438 7.679688 27.5 7.53125 Z M 27.5 7.53125 " fill-opacity="1" fill-rule="nonzero"/></g></svg></div>`
								} else {
									return `<div class="flex flex-col w-full items-center justify-center p-0 m-0 select-none pointer-events-none text-red-500"><svg xmlns="http://www.w3.org/2000/svg" role="img" class="flex flex-col select-none pointer-events-none" width="14px" height="14px" fill="currentColor" viewBox="0 0 30 30"><path d="M 7 4 C 6.744125 4 6.4879687 4.0974687 6.2929688 4.2929688 L 4.2929688 6.2929688 C 3.9019687 6.6839688 3.9019687 7.3170313 4.2929688 7.7070312 L 11.585938 15 L 4.2929688 22.292969 C 3.9019687 22.683969 3.9019687 23.317031 4.2929688 23.707031 L 6.2929688 25.707031 C 6.6839688 26.098031 7.3170313 26.098031 7.7070312 25.707031 L 15 18.414062 L 22.292969 25.707031 C 22.682969 26.098031 23.317031 26.098031 23.707031 25.707031 L 25.707031 23.707031 C 26.098031 23.316031 26.098031 22.682969 25.707031 22.292969 L 18.414062 15 L 25.707031 7.7070312 C 26.098031 7.3170312 26.098031 6.6829688 25.707031 6.2929688 L 23.707031 4.2929688 C 23.316031 3.9019687 22.682969 3.9019687 22.292969 4.2929688 L 15 11.585938 L 7.7070312 4.2929688 C 7.5115312 4.0974687 7.255875 4 7 4 z"/></svg></div>`;
								}
							}
							return row.roles.join(', ');
						}
					},
					{
						data: 'created_at',
						render : (data, type, row) => {
							if ( 'display' === type ) {
								return `${formatDate( row.created_at )}`;
							}
							return row.created_at;
						}
					}
				]
			}
		}
	});

	onMounted(async() => {
		await nextTick().then(async() => {
			for (let i = 0; i !== props.users.data.length; ++i) {
				var data = [];

				for (const [key, value] of Object.entries(props.users.data[i])) {
					
					if ('object' === typeof value) {
						data.push(value.join(', '));
					} else {
						data.push(value);
					}
				}

				proxy.dataTables.data.push(data);
			}
		});
	});
</script>