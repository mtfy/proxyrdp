<template>
	<ClientLayout :activePage="4">
		<div class="flex flex-col w-full p-0 m-0">
			<span class="flex flex-col font-medium whitespace-pre-wrap text-[20px] leading-[24px] capitalize">Wallet</span>
		</div>
		<div class="flex flex-col w-full p-0 m-0 mt-[8px]">
			<span class="flex flex-col text-[14px] leading-[22px] text-theme-primary-foreground-clientarea-alt">Hello, {{ user.first_name }}! Here you can add funds to your wallet or view past top ups.</span>
		</div>
		<div class="flex flex-col w-full relative p-0 m-0 mt-[28px]">
			<div class="flex flex-col w-full relative">
				<div class="grid grid-cols-1 md:grid-cols-2 relative gap-3 md:gap-5">
					<div class="flex flex-col group select-none w-full py-[12px] px-[20px] rounded-[4px] relative transition-colors duration-300 bg-[#FFFFFF] hover:bg-[#F2F4F920] border-[1px] border-[#D1D9E4] group-hover:border-[#DDDDDD]">
						<div class="flex flex-col w-full relative">
							<div class="flex flex-col w-full relative">
								<div class="flex flex-row w-full relative">
									<div class="flex flex-col w-9/12">
										<span class="flex flex-row items-center transition-colors duration-300 font-motify leading-normal text-[24px] md:text-[36px] text-[#0A0A0A] group-hover:text-[#0A0A0A75]"><span class="flex flex-col items-center">{{ (parseFloat( user.balance ) || 0).toFixed(2) }}</span><span class="flex flex-col items-center tracking-normal text-[18px] md:text-[28px] font-inter">&#xa0;&#x20ac;</span></span>
									</div>
									<div class="flex flex-col w-3/12 justify-center items-end select-none pointer-events-none">
										<svg xmlns="http://www.w3.org/2000/svg" role="img" class="inline-flex transition-colors duration-300 text-amber-600 group-hover:text-amber-600/50 pointer-events-none select-none p-0 m-0" width="24px" height="24px" fill="currentColor" viewBox="0 0 16 16"><path d="M5.5 9.511c.076.954.83 1.697 2.182 1.785V12h.6v-.709c1.4-.098 2.218-.846 2.218-1.932 0-.987-.626-1.496-1.745-1.76l-.473-.112V5.57c.6.068.982.396 1.074.85h1.052c-.076-.919-.864-1.638-2.126-1.716V4h-.6v.719c-1.195.117-2.01.836-2.01 1.853 0 .9.606 1.472 1.613 1.707l.397.098v2.034c-.615-.093-1.022-.43-1.114-.9H5.5zm2.177-2.166c-.59-.137-.91-.416-.91-.836 0-.47.345-.822.915-.925v1.76h-.005zm.692 1.193c.717.166 1.048.435 1.048.91 0 .542-.412.914-1.135.982V8.518l.087.02z"/><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="M8 13.5a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11zm0 .5A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"/></svg>
									</div>
								</div>
							</div>
							<div class="flex flex-col w-full relative">
								<span class="inline-flex select-none transition-colors tracking-tightest duration-300 font-motify leading-normal text-[16px] md:text-[20px] text-[#5A6372] group-hover:text-[#5A637290]">Balance</span>
							</div>
						</div>
					</div>
					<div class="flex flex-col group select-none w-full py-[12px] px-[20px] rounded-[4px] relative transition-colors duration-300 bg-[#FFFFFF] hover:bg-[#F2F4F920] border-[1px] border-[#D1D9E4] group-hover:border-[#DDDDDD]">
						<div class="flex flex-col w-full relative">
							<div class="flex flex-col w-full relative">
								<div class="flex flex-row w-full relative">
									<div class="flex flex-col w-9/12">
										<span class="flex flex-col transition-colors duration-300 font-motify leading-normal text-[24px] md:text-[36px] text-[#0A0A0A] group-hover:text-[#0A0A0A75]">0.00</span>
									</div>
									<div class="flex flex-col w-3/12 justify-center items-end select-none pointer-events-none">
										<svg xmlns="http://www.w3.org/2000/svg" role="img" class="inline-flex transition-colors duration-300 text-pink-500 group-hover:text-pink-500/75 pointer-events-none select-none p-0 m-0" width="24px" height="24px" fill="currentColor" viewBox="0 0 384 512"><path d="M384 128h-128V0L384 128zM256 160H384v304c0 26.51-21.49 48-48 48h-288C21.49 512 0 490.5 0 464v-416C0 21.49 21.49 0 48 0H224l.0039 128C224 145.7 238.3 160 256 160zM64 88C64 92.38 67.63 96 72 96h80C156.4 96 160 92.38 160 88v-16C160 67.63 156.4 64 152 64h-80C67.63 64 64 67.63 64 72V88zM72 160h80C156.4 160 160 156.4 160 152v-16C160 131.6 156.4 128 152 128h-80C67.63 128 64 131.6 64 136v16C64 156.4 67.63 160 72 160zM197.5 316.8L191.1 315.2C168.3 308.2 168.8 304.1 169.6 300.5c1.375-7.812 16.59-9.719 30.27-7.625c5.594 .8438 11.73 2.812 17.59 4.844c10.39 3.594 21.83-1.938 25.45-12.34c3.625-10.44-1.891-21.84-12.33-25.47c-7.219-2.484-13.11-4.078-18.56-5.273V248c0-11.03-8.953-20-20-20s-20 8.969-20 20v5.992C149.6 258.8 133.8 272.8 130.2 293.7c-7.406 42.84 33.19 54.75 50.52 59.84l5.812 1.688c29.28 8.375 28.8 11.19 27.92 16.28c-1.375 7.812-16.59 9.75-30.31 7.625c-6.938-1.031-15.81-4.219-23.66-7.031l-4.469-1.625c-10.41-3.594-21.83 1.812-25.52 12.22c-3.672 10.41 1.781 21.84 12.2 25.53l4.266 1.5c7.758 2.789 16.38 5.59 25.06 7.512V424c0 11.03 8.953 20 20 20s20-8.969 20-20v-6.254c22.36-4.793 38.21-18.53 41.83-39.43C261.3 335 219.8 323.1 197.5 316.8z"/></svg>
									</div>
								</div>
							</div>
							<div class="flex flex-col w-full relative">
								<span class="inline-flex select-none transition-colors tracking-tightest duration-300 font-motify leading-normal text-[16px] md:text-[20px] text-[#5A6372] group-hover:text-[#5A637290]">Invoices</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="flex flex-col w-full relative bg-white border border-[#D1D9E4] rounded-xl p-[24px] m-0 mt-[20px] space-y-[20px]">
			<div class="flex flex-col w-full p-0 m-0">
				<div class="flex flex-col w-full p-0 m-0">
					<span class="flex flex-col font-medium whitespace-pre-wrap text-[18px] leading-[28px]">Add funds to your balance</span>
				</div>
				<div class="flex flex-col w-full p-0 m-0 mt-[5px]">
					<span class="flex flex-col text-[14px] leading-[22px] text-theme-primary-foreground-clientarea-alt">Top up your balance using various crypto currencies and PayPal.</span>
				</div>
			</div>
			<div class="flex flex-col w-full relative max-w-full lg:max-w-[50%]">
				<div class="flex flex-col w-full m-0 mb-4 p-0 relative transition-all ease-in-out duration-300" v-if="('addFunds' in errors && Object.values(props.errors).length !== 0) && !proxy.forms.addFunds.hideErrors">
					<div class="flex flex-col w-full bg-red-200 px-[30px] py-[15px] border border-red-400 rounded-sm">
						<div class="flex flex-col w-full items-start justify-start">
							<span class="flex flex-col font-motify font-semibold whitespace-pre-wrap text-slate-800 text-[12px] leading-[18px] md:text-[14px] md:leading-[22px]">The following error(s) needs to be corrected:</span>
						</div>
						<div class="flex flex-col w-full items-start justify-start">
							<ul role="list" class="flex flex-col w-full list-disc text-slate-800 relative p-0 m-0 pl-5">
								<li v-for="(err) in Object.values(props.errors.addFunds)">
									<span class="flex flex-col font-motify font-semibold whitespace-pre-wrap text-[12px] leading-[18px] md:text-[14px] md:leading-[22px]">{{ err }}</span>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<form class="flex flex-col w-full relative space-y-[20px]" @submit.prevent="submitAddFunds">
					<div class="flex flex-col md:flex-row w-full space-y-[20px] md:space-y-0 md:space-x-5 relative m-0 p-0">
						<div class="flex flex-col w-full md:w-6/12 relative m-0 p-0">
							<div class="flex flex-col w-full m-0 p-0">
								<label class="flex flex-col font-motify font-medium w-full text-slate-950 text-[12px] leading-[18px] md:text-[14px] md:leading-[22px]" for="payment_method">Payment method</label>
								<select v-model="form.addFunds.payment_method" id="payment_method" name="Payment Method" class="flex flex-col w-full text-[#0a0a0a] whitespace-nowrap text-ellipsis p-[12px] text-[12px] md:text-[14px] outline-0 transition-all duration-300 ring-0 border-[1px] border-[#0C0C0C0] rounded-[12px] select-none" placeholder="Select an option" required="true" aria-required="true">
									<option selected="true" value="0" disabled="true" aria-disabled="true">Select an option</option>
									<option value="1">Crypto currency</option>
									<option value="2">PayPal</option>
								</select>
							</div>
						</div>
						<div class="flex flex-col w-full md:w-6/12 relative m-0 p-0">
							<div class="flex flex-col w-full m-0 p-0">
								<label class="flex flex-col font-motify font-medium w-full capitalize text-slate-950 text-[12px] leading-[18px] md:text-[14px] md:leading-[22px]" for="payment_amount">Amount</label>
								<Input v-model="form.addFunds.payment_amount" :type="'number'" :step=".01" :min="5.00" :max="9999" :id="'payment_amount'" :name="'Payment Amount'" :customClass="'cursor-text'"  />
							</div>
						</div>
					</div>
					
					<div class="flex flex-col w-full m-0 p-0">
						<div>
							<Button type="'submit'" :disabled="proxy.forms.addFunds.checkoutPending" :customClass="'w-auto text-center justify-center items-center motify-btn-sm bg-theme-secondary-500 text-white hover:bg-theme-secondary-700 hover:text-[#F5F5F5]'">
								<div class="flex flex-row w-full items-center justify-center space-x-2 leading-[16px] outline-0">
									<div class="flex flex-col"><svg xmlns="http://www.w3.org/2000/svg" role="img" class="flex flex-col select-none pointer-events-none" width="14px" height="14px" fill="currentColor" viewBox="0 0 16 16"><path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v1H0V4zm0 3v5a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7H0zm3 2h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1a1 1 0 0 1 1-1z"/></svg></div>
									<div class="flex flex-col">Continue to payment</div>
								</div>
							</Button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="flex flex-col w-full relative bg-white border border-[#D1D9E4] rounded-xl p-[24px] m-0 mt-[20px] space-y-[20px]">
			<div class="flex flex-col w-full p-0 m-0">
				<span class="flex flex-col font-medium whitespace-pre-wrap text-[20px] leading-[24px] capitalize">History</span>
			</div>
			<div class="flex flex-col w-full max-w-[100%] overflow-x-auto relative">
				<table class="table-auto md:table-fixed font-motify w-full text-left text-[14px] leading-[18px]">
					<thead>
						<th colspan="3">ID</th>
						<th>Amount</th>
						<th colspan="2">Status</th>
						<th colspan="2">Created at</th>
						<th colspan="3">Updated at</th>
					</thead>
					<tbody>
						<tr v-for="item in props.items.data" :key="item.token" v-if="Object.entries(props.items.data).length">
							<td colspan="3" class="py-[6px] lg:py-[4px]"><span class="tracking-wide" v-html="formatInvoiceId(item.token)"></span></td>
							<td class="py-[6px] lg:py-[4px]">{{ num.format(parseFloat(item.amount) || 0) }}</td>
							<td colspan="2" class="py-[6px] lg:py-[4px]">{{ item.status }}</td>
							<td colspan="2" class="py-[6px] lg:py-[4px]">{{ formatDate(item.created_at) }}</td>
							<td colspan="2" class="py-[6px] lg:py-[4px]">{{ formatDate(item.updated_at) }}</td>
							<td class="py-[6px] lg:py-[4px]">
								<Link :href="`/clientarea/invoices/${item.token}`" class="flex flex-col w-full lg:w-auto justify-center items-center select-none cursor-pointer no-underline transition-all duration-300">
									<Button :type="'button'" :customClass="'motify-table-btn-sm rounded-[4px] bg-theme-secondary-500 text-white w-full capitalize text-center justify-center items-center hover:bg-theme-secondary-700 hover:text-[#F5F5F5]'">
										<div class="flex flex-row w-full items-center justify-center space-x-2 leading-[16px] outline-0">
											<div class="flex flex-col"><svg xmlns="http://www.w3.org/2000/svg" role="img" class="flex flex-col select-none pointer-events-none" width="12px" height="12px" fill="currentColor" viewBox="0 0 16 16"><path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/><path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/></svg></div>
											<div class="flex flex-col">View</div>
										</div>
									</Button>
								</Link>
							</td>
						</tr>
						<tr v-else>
							<td colspan="11"><span class="flex flex-col w-full text-center mt-5">No past records found</span></td>
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
	import ClientLayout from '../../../Layouts/ClientLayout.vue';
	import { reactive, onMounted , computed} from 'vue';
	import { usePage, useForm, Link } from '@inertiajs/vue3';
	import Button from '../../../Components/Button.vue';
	import Input from '../../../Components/Input.vue';
	import Pagination from '../../../Components/Pagination.vue';
	import Swal from 'sweetalert2/dist/sweetalert2.js'
	import 'sweetalert2/dist/sweetalert2.min.css';

	const props = defineProps({
		errors: Object,
		items: Object
	}),
	page = usePage(),
	user = computed(() => page.props.user),

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

	form = {
		addFunds: useForm({
			'payment_method': '0',
			'payment_amount': '5.00'
		})
	},

	proxy = reactive({
		forms: {
			addFunds: {
				hideErrors: true,
				checkoutPending: false
			}
		}
	}),

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
		return i;
	},

	submitAddFunds = () => {
		proxy.forms.addFunds.checkoutPending = true;
		form.addFunds.post(route('clientarea.wallet.topup'), {
			onFinish: () => {
				proxy.forms.addFunds.checkoutPending = false;
			},
			onSuccess: () => {
				proxy.forms.addFunds.hideErrors = true;
				form.addFunds.reset();
			},
			onError: (errors) => {
				proxy.forms.addFunds.hideErrors = false;
				form.addFunds.reset('payment_method');
			}
		});
	};

	onMounted(async() => {});
</script>