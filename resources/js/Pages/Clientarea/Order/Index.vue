<template>
	<ClientLayout :activePage="1">
		<div class="flex flex-col w-full p-0 m-0">
			<span class="flex flex-col font-medium whitespace-pre-wrap text-[20px] leading-[24px] capitalize">Order</span>
		</div>
		<div class="flex flex-col w-full relative bg-white border border-[#D1D9E4] rounded-xl p-[24px] m-0 mt-10 space-y-[20px]">
			<div class="flex flex-col w-full p-0 m-0">
				<span class="flex flex-col font-medium whitespace-pre-wrap text-[18px] leading-[28px] capitalize">Proxies</span>
			</div>
			<div class="flex flex-col w-full space-y-10">
				<div class="flex flex-col w-full lg:p-2">
					<div class="grid grid-cols-1 md:grid-cols-3 w-full relative relative gap-5 md:gap-10 ">
						<div v-for="item in props.proxies.data" :key="item.id" class="flex flex-col motify-card-shadow flex-grow flex-shrink basis-0 w-full items-center min-h-[471px] bg-slate-50 border-[1px] border-[#b2b2b275] rounded-[12px] font-motify leading-snug text-[14px] md:text-[16px]">
							<div class="flex flex-col w-full p-[20px] justify-center items-center bg-theme-primary-500 rounded-t-[12px] space-y-2 min-h-[96px] max-h-[96px]">
								<div class="flex flex-col select-none pointer-events-none">
									<svg xmlns="http://www.w3.org/2000/svg" role="img" class="text-white inline-flex pointer-events-none select-none p-0 m-0" width="32px" height="32px" fill="currentColor" viewBox="0 0 24 24"><path d="M15.0127,9.3949l4.56982-4.56977L21,6.24261V2H16.75739l1.41088,1.41089L13.33405,8.24512A3.93757,3.93757,0,0,0,8.14288,10.9953H5.72009a2.00033,2.00033,0,1,0,.00507,2H8.14a3.94008,3.94008,0,0,0,5.20423,2.75647l4.83069,4.83069L16.75739,22H21V17.75732l-1.41089,1.41095-4.57043-4.57043a3.96651,3.96651,0,0,0,.84137-1.60254L18,13v2l3-3L18,9v2l-2.14288-.0047A3.96785,3.96785,0,0,0,15.0127,9.3949Z"></path></svg>
								</div>
								<div class="flex flex-col w-full justify-center items-center">
									<span class="text-white text-center text-[14px] md:text-[16px] leading-[20px] md:leading-[18px] capitalize">{{ item.title }}</span>
								</div>
							</div>
							<div class="flex flex-col w-full p-[20px] justify-center items-center">
								<div class="flex flex-col w-full justify-center items-center">
									<ul role="list" class="flex flex-col list-none space-y-2 px-[10px] font-motify leading-snug text-center p-0 m-0 text-[12px] md:text-[14px]">
										<li v-for="row in item.description" class="text-[14px] leading-[20px] md:leading-[16px]">{{ row }}</li>
									</ul>
								</div>
							</div>
							<div class="flex flex-col flex-grow w-full relative justify-end h-full items-center">
								<div class="flex flex-col w-full relative p-[20px]">
									<span class="text-center font-motify text-[14px] md:text-[16px] leading-[16px] md:leading-[18px]">
										<span class="text-black font-semibold tracking-wide">{{ num.format(item.price) }}</span> {{ (item.billing === 1) ? '/' : 'for' }} <span class="font-semibold">{{ (item.billing === 1) ? 'GB' : '30 days' }}</span>
									</span>
								</div>
							</div>
							<div class="flex flex-col flex-grow w-full relative justify-end items-center">
								<div class="flex flex-col w-full relative p-[20px] pt-0">
									<Link class="flex flex-col w-full" :href="`/clientarea/order/create/${item.id.toString()}`">
										<Button type="'button'" :customClass="'w-auto text-center justify-center items-center motify-btn-sm bg-theme-secondary-500 text-white hover:bg-theme-secondary-700 hover:text-[#F5F5F5]'">
											<div class="flex flex-row w-full items-center justify-center space-x-2 leading-[16px] outline-0">
												<div class="flex flex-col"><svg xmlns="http://www.w3.org/2000/svg" role="img" class="flex flex-col select-none pointer-events-none" width="14px" height="14px" fill="currentColor" viewBox="0 0 16 16"><path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v1H0V4zm0 3v5a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7H0zm3 2h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1a1 1 0 0 1 1-1z"/></svg></div>
												<div class="flex flex-col">Purchase</div>
											</div>
										</Button>
									</Link>
								</div>
							</div>
						</div>
					</div>
					<div class="flex flex-col w-full relative mt-8">
						<pagination :links="props.proxies.links" />
					</div>
				</div>
			</div>
		</div>
		<div class="flex flex-col w-full relative bg-white border border-[#D1D9E4] rounded-xl p-[24px] m-0 mt-[20px] space-y-[20px]">
			<div class="flex flex-col w-full p-0 m-0">
				<span class="flex flex-col font-medium whitespace-pre-wrap text-[18px] leading-[28px] capitalize">Servers</span>
			</div>
			<div class="flex flex-col flex-grow flex-shrink flex-wrap basis-0 w-full font-motify leading-snug text-[14px] md:text-[16px] lg:flex-row">
				<div class="flex flex-col w-full lg:w-6/12">
					<div class="flex flex-col w-full mb-5 mt-0 p-0 relative transition-all duration-300 lg:pr-[20px] justify-start items-start" v-if="('servers' in props.errors && Object.values(props.errors.servers).length !== 0) && !proxy.forms.servers.hideErrors">
						<div class="flex flex-col w-full bg-red-200 px-[30px] py-[15px] border border-red-400 rounded-sm">
							<div class="flex flex-col w-full items-start justify-start">
								<span class="flex flex-col font-motify font-semibold whitespace-pre-wrap text-slate-800 text-[12px] leading-[18px] md:text-[14px] md:leading-[22px]">The following error(s) needs to be corrected:</span>
							</div>
							<div class="flex flex-col w-full items-start justify-start">
								<ul role="list" class="flex flex-col w-full list-disc text-slate-800 relative p-0 m-0 pl-5">
									<li v-for="(err) in Object.values(props.errors.servers)">
										<span class="flex flex-col font-motify font-semibold whitespace-pre-wrap text-[12px] leading-[18px] md:text-[14px] md:leading-[22px]">{{ err }}</span>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="flex flex-col w-full justify-start items-start pb-[20px] lg:p-0 lg:pr-[20px]">
						<p class="whitespace-pre-wrap text-[16px] lg:text-[18px]">Customize server settings, sepcifications, and resources to align perfectly with your unique requirements. Scale up or down effortlessly as your needs evolve, ensuring seamless performance and resource allocation.</p>
					</div>
				</div>
				<div class="flex flex-col w-full lg:w-6/12">
					<form class="flex flex-col w-full p-0 m-0 space-y-[20px]"  @submit.prevent="submitServer">
						<div class="flex flex-col w-full">
							<label class="flex flex-row w-full space-x-2" for="cores">
								<div class="flex flex-col">Cores</div>
								<div class="flex flex-col font-semibold">{{ form.servers.cores }}</div>
							</label>
							<div class="flex flex-col w-full pt-[6px]">
								<div class="flex flex-col">
									<input
										type="range"
										class="ring-0 transition-all duration-300 cursor-pointer"
										min="2"
										max="12"
										aria-valuemin="2"
										aria-valuemax="12"
										step="2"
										v-model="form.servers.cores"
										id="cores"
										@input="async() => { await nextTick().then(async() => { await calcServerSubtotal() }) }"
										aria-required="true"
										required="true"
									/>
								</div>
							</div>
						</div>

						<div class="flex flex-col w-full">
							<label class="flex flex-row w-full space-x-2" for="ram">
								<div class="flex flex-col">RAM</div>
								<div class="flex flex-col font-semibold">{{ proxy.forms.servers.memory.values[form.servers.memory] }} GB</div>
							</label>
							<div class="flex flex-col w-full pt-[6px]">
								<div class="flex flex-col">
									<input
										type="range"
										class="ring-0 transition-all duration-300 cursor-pointer"
										min="1"
										max="10"
										aria-valuemin="1"
										aria-valuemax="10"
										step="1"
										v-model="form.servers.memory"
										id="ram"
										@input="async() => { await nextTick().then(async() => { await calcServerSubtotal() }) }"
										aria-required="true"
										required="true"
									/>
								</div>
							</div>
						</div>

						<div class="flex flex-col w-full">
							<label class="flex flex-row w-full space-x-2" for="storage">
								<div class="flex flex-col">SSD</div>
								<div class="flex flex-col font-semibold">{{ proxy.forms.servers.storage.values[form.servers.storage] }} GB</div>
							</label>
							<div class="flex flex-col w-full pt-[6px]">
								<div class="flex flex-col">
									<input
										type="range"
										class="ring-0 transition-all duration-300 cursor-pointer"
										min="1"
										max="6"
										aria-valuemin="1"
										aria-valuemax="6"
										step="1"
										v-model="form.servers.storage"
										id="storage"
										@input="async() => { await nextTick().then(async() => { await calcServerSubtotal() }) }"
										aria-required="true"
										required="true"
									/>
								</div>
							</div>
						</div>

						<div class="flex flex-col w-full">
							<label class="flex flex-row w-full space-x-2" for="ipv4">
								<div class="flex flex-col">Additional IP</div>
								<div class="flex flex-col font-semibold">{{ form.servers.ipv4 }}</div>
							</label>
							<div class="flex flex-col w-full pt-[6px]">
								<div class="flex flex-col">
									<input
										type="range"
										class="ring-0 transition-all duration-300 cursor-pointer"
										min="0"
										max="4"
										aria-valuemin="0"
										aria-valuemax="4"
										step="1"
										v-model="form.servers.ipv4"
										id="ipv4"
										@input="async() => { await nextTick().then(async() => { await calcServerSubtotal() }) }"
										aria-required="true"
										required="true"
									/>
								</div>
							</div>
						</div>

						<div class="flex flex-col w-full select-none pointer-events-none">
							<hr class="flex flex-col w-full border-[#D1D9E4] m-0 my-[12px]" />
						</div>
						<div class="flex flex-col space-y-3 flex-grow flex-shrink flex-wrap basis-0 m-0 p-0 w-full lg:space-y-0 lg:flex-row">
							<div class="flex flex-col w-full items-center justify-center lg:w-6/12 lg:justify-center lg:items-end">
								<div class="flex flex-row w-full space-x-2">
									<div class="flex flex-col">Total</div>
									<div class="flex flex-col font-semibold">{{ parseFloat(proxy.subtotal.servers).toFixed(2) }}&#160;&#x20ac;</div>
								</div>
							</div>
							<div class="flex flex-col w-full items-center justify-center lg:w-6/12 lg:justify-center lg:items-end">
								<div class="w-full lg:w-auto">
									<Button :type="'submit'" :disabled="proxy.forms.servers.checkoutPending" :custom-class="'override:text-[14px] override:font-medium w-full lg:w-auto capitalize text-center justify-center items-center text-[12px] md:text-[14px] bg-theme-secondary-500 text-white hover:bg-theme-secondary-700 hover:text-[#F5F5F5]'">
										<div class="flex flex-row w-full items-center justify-center space-x-2 leading-[18px]">
											<div class="flex flex-col"><svg xmlns="http://www.w3.org/2000/svg" role="img" width="20px" height="20px" fill="currentColor" class="flex flex-col select-none pointer-events-none" viewBox="0 0 24 24"><path d="M7,18c-1.1,0-1.99,0.9-1.99,2S5.9,22,7,22s2-0.9,2-2S8.1,18,7,18z M17,18c-1.1,0-1.99,0.9-1.99,2s0.89,2,1.99,2s2-0.9,2-2 S18.1,18,17,18z M8.1,13h7.45c0.75,0,1.41-0.41,1.75-1.03L21,4.96L19.25,4l-3.7,7H8.53L4.27,2H1v2h2l3.6,7.59l-1.35,2.44 C4.52,15.37,5.48,17,7,17h12v-2H7L8.1,13z M12,2l4,4l-4,4l-1.41-1.41L12.17,7L8,7l0-2l4.17,0l-1.59-1.59L12,2z"/></svg></div>
											<div class="flex flex-col">Checkout</div>
										</div>
									</Button>
								</div>
							</div>
							
						</div>

					</form>
				</div>
			</div>
		</div>
	</ClientLayout>
</template>
<script setup>
	import ClientLayout from '../../../Layouts/ClientLayout.vue';
	import { reactive, onMounted, computed, nextTick } from 'vue';
	import { useForm, usePage, Link } from '@inertiajs/vue3';
	import Button from '../../../Components/Button.vue';
	import Pagination from '../../../Components/Pagination.vue';
	import Swal from 'sweetalert2/dist/sweetalert2.js'
	import 'sweetalert2/dist/sweetalert2.min.css';

	const props = defineProps({
		errors: Object,
		proxies: Object
	}),

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
	page = usePage(),
	user = computed(() => page.props.user),

	proxy = reactive({
		subtotal		:	{
			servers		:	12.00
		},
		forms			:	{
			servers		:	{
				hideErrors : true,
				checkoutPending: false,
				memory	:	{
					values	:	{
						'1'	:	'2',
						'2'	:	'4',
						'3' :	'6',
						'4'	:	'8',
						'5'	:	'10',
						'6' :	'12',
						'7'	:	'16',
						'8'	:	'20',
						'9'	:	'24',
						'10':	'32'
					}
				},
				storage		:	{
					hideErrors : true,
					values	:	{
						'1'		:	'50',
						'2'		:	'100',
						'3'		:	'150',
						'4'		:	'200',
						'5'		:	'400',
						'6'		:	'500'
					}
				}
			}
		}
	}),

	locale = ('object' === typeof navigator && null !== navigator && 'language' in navigator && 'string' === typeof navigator.language) ? navigator.language : 'en-US',

	num = new Intl.NumberFormat(locale, {
		style: 'currency',
		currency: 'EUR',
		maximumFractionDigits: 2
	}),

	form = {
		servers : useForm({
			cores : '2',
			memory: '1',
			storage: '1',
			ipv4: '0'
		})
	},

	

	calcServerSubtotal = async() => {
		proxy.forms.servers.hideErrors = true;
		if ((parseInt(form.servers.memory) || 0) === 12) {
			proxy.forms.servers.memory.step = '4';
		} else {
			proxy.forms.servers.memory.step = '2';
		}

		let total = 0.00;
		
		const values = {
			cores: parseInt(form.servers.cores) || 0,
			memory: parseInt(proxy.forms.servers.memory.values[form.servers.memory]) || 0,
			storage: parseInt(proxy.forms.servers.storage.values[form.servers.storage]) || 0,
			ipv4: parseInt(form.servers.ipv4) || 0
		};
		
		switch (values.cores) {
			case 2:
				total += 5.5;
				break;

			case 4:
				total += 11;
				break;
			
			case 6:
				total += 17.5;
				break;

			case 8:
				total += 25;
				break;
			
			case 10:
				total += 32;
				break;
			
			case 12:
				total += 38.5;
				break;
		}

		switch (values.memory) {
			case 2:
				total += 3;
				break;

			case 4:
				total += 6;
				break;
			
			case 6:
				total += 9;
				break;

			case 8:
				total += 12;
				break;
			
			case 10:
				total += 15;
				break;
			
			case 12:
				total += 18;
				break;

			case 16:
				total += 18;
				break;

			case 20:
				total += 29.5;
				break;
			
			case 24:
				total += 35.5;
				break;

			case 32:
				total += 47.5;
				break;
		}

		switch (values.storage) {
			case 50:
				total += 3.5;
				break;
			
			case 100:
				total += 7;
				break;

			case 150:
				total += 11;
				break;

			case 200:
				total += 14.5;
				break;

			case 400:
				total += 29;
				break;

			case 500:
				total += 36;
				break;
		}

		total += (values.ipv4 * 2.00);
		
		proxy.subtotal.servers = parseFloat(total.toString());
	},

	submitServer = async() => {
		proxy.forms.servers.checkoutPending = true;
		form.servers.post(route('clientarea.order.server'), {
			onFinish: () => {
				proxy.forms.servers.checkoutPending = false;
			},
			onSuccess: () => {
				proxy.forms.servers.hideErrors = true;
				Swal.fire({
					icon: 'info',
					text: `OK`
				});
			},
			onError: (errors) => {
				proxy.forms.servers.hideErrors = false;
				Toast.fire({
					icon: 'error',
					title: 'Whoops!',
					text: `Sorry, but please check your entries and try again!`
				});
			}
		});
	};

	/*fetchCurrencies = async() => {
		return new Promise(async(resolve, reject) => {

			await fetch(`/payments/currencies`, {
				method : 'POST',
				credentials: 'same-origin',
				headers: {
					'Accept' : 'application/json', 
					'X-CSRF-TOKEN' : usePage().props.csrf_token,
				}
			}).then(async(response) => {
				return response.text();
			}).then(async(result) => {
				try {
					result = JSON.parse(result);
				} catch(err) {
					reject({
						success: false,
						message: err,
						data: {}
					});
				}

				if (!result.success) {
					reject(result);
				} else {
					resolve(result);
				}
			});

		});
	},

	selectPaymentCurrency = async() => {
		proxy.forms.servers.checkoutPending = true;

		async function prompt() {
			let currencies = {};
			for (let i = 0; i !== proxy.payment.currencies.length; ++i)
				currencies[proxy.payment.currencies[i].toLowerCase()] = proxy.payment.currencies[i].toUpperCase();
			
			const { value: currency } = await Swal.fire({
				title: 'Payment method',
				input: 'select',
				inputOptions: {
					'Crypto currencies': currencies
				},
				inputPlaceholder: 'Select a payment option',
				showCancelButton: true,
				inputValidator: (value) => {
					return new Promise((resolve) => {
						if (value.trim() === '') {
							resolve('Please select a payment method.');
						} else {
							resolve();
						}
					});
				}
			});

			if (currency) {
				form.servers.payment_method = currency;
				await nextTick().then(async() => {
					await submitServer();
				});
			}
			proxy.forms.servers.checkoutPending = false;
		};

		if (null === proxy.payment.currencies) {
			await fetchCurrencies().then(async(result) => {
				if (result.success !== false) {
					proxy.payment.currencies = result.data;
					await prompt();
				} else {
					Swal.fire({
						icon: 'error',
						title: 'Whoops!',
						text: result.message
					});
				}
			}).catch(async(result) => {
				Swal.fire({
					icon: 'error',
					title: 'Whoops!',
					text: result.message
				});
				proxy.forms.servers.checkoutPending = false;
			});
		} else {
			await prompt();
		}
		
		
	};*/

	onMounted(async() => {

	});
</script>