<template>
	<ClientLayout :activePage="1">
		<div class="flex flex-col w-full p-0 m-0" v-if="props.service === null">
			<span class="flex flex-col font-medium whitespace-pre-wrap text-[20px] leading-[24px] capitalize">Service not found</span>
		</div>
		<div class="flex flex-col w-full p-0 m-0" v-else>
			<div class="flex flex-col w-full p-0 m-0">
				<span class="flex flex-col font-medium whitespace-pre-wrap text-[20px] leading-[24px]">Place an order</span>
			</div>
			<div class="flex flex-col w-full m-0 mt-[18px] xl:mt-[24px] p-0">
				<div class="flex flex-col w-full relative m-0 p-0 gap-x-0 gap-y-6">
					<div class="flex flex-col w-full relative bg-white border border-[#D1D9E4] rounded-xl p-[24px] space-y-[20px]">
						<div class="flex flex-col w-full relative">
							<table class="motify-order-table table-fixed text-left font-motify text-[14px] md:text-[16px] leading-[16px] md:leading-[20px] lg:max-w-[50%]">
								<tbody>
									<tr>
										<th scope="col" class="max-w-[33.33%] min-w-[33.33%] md:max-w-[25%] md:min-w-[25%] w-full">ID</th>
										<td class="whitespace-no-wrap">{{ props.service.id }}</td>
									</tr>
									<tr>
										<th scope="col" class="max-w-[33.33%] min-w-[33.33%] md:max-w-[25%] md:min-w-[25%] w-full">Title</th>
										<td class="whitespace-no-wrap">{{ props.service.title }}</td>
									</tr>
									<tr>
										<th scope="col" class="flex flex-col justify-start max-w-[33.33%] min-w-[33.33%] md:max-w-[25%] md:min-w-[25%] w-full">Description</th>
										<td class="whitespace-no-wrap">{{ props.service.description }}</td>
									</tr>
									<tr>
										<th scope="col" class="max-w-[33.33%] min-w-[33.33%] md:max-w-[25%] md:min-w-[25%] w-full">Amount</th>
										<td class="whitespace-no-wrap">{{ num.format(props.service.price) }} {{ (props.service.billing === 1) ? '/' : 'for' }} {{ (props.service.billing === 1) ? 'GB' : '30 days' }}</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="flex flex-col w-full lg:max-w-[50%]">
							<form class="flex flex-col w-full relative space-y-[20px]" @submit.prevent="submit">
								<div class="flex flex-col flex-grow w-full relative justify-end items-center">
									<div class="flex flex-col w-full relative p-0">
										<div>
											<Button type="'submit'" :disabled="proxy.pendingPurchase" :customClass="'w-full md:w-auto text-center justify-center items-center motify-btn-sm bg-theme-secondary-500 text-white hover:bg-theme-secondary-700 hover:text-[#F5F5F5]'">
												<div class="flex flex-row w-full items-center justify-center space-x-2 leading-[16px] outline-0">
													<div class="flex flex-col"><svg xmlns="http://www.w3.org/2000/svg" role="img" class="flex flex-col select-none pointer-events-none" width="14px" height="14px" fill="currentColor" viewBox="0 0 16 16"><path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v1H0V4zm0 3v5a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7H0zm3 2h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1a1 1 0 0 1 1-1z"/></svg></div>
													<div class="flex flex-col">Purchase</div>
												</div>
											</Button>
										</div>
									</div>
								</div>
							</form>
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
	import { usePage, useForm } from '@inertiajs/vue3';
	import Button from '../../../Components/Button.vue';
	import Swal from 'sweetalert2/dist/sweetalert2.js'
	import 'sweetalert2/dist/sweetalert2.min.css';

	const props = defineProps({
		service: Object
	}),

	locale = ('object' === typeof navigator && null !== navigator && 'language' in navigator && 'string' === typeof navigator.language) ? navigator.language : 'en-US',

	num = new Intl.NumberFormat(locale, {
		style: 'currency',
		currency: 'EUR',
		maximumFractionDigits: 2
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

	form = useForm({
		id: props.service.id
	}),

	proxy = reactive({
		pendingPurchase: false
	}),

	submit = () => {
		proxy.pendingEdit = true;
		form.post(route('clientarea.order.create', [props.service.id]), {
			onFinish: () => {
				proxy.pendingPurchase = false;
			},
			onSuccess: () => {
				Toast.fire({
					icon: 'success',
					title: 'Success',
					text: `Purchase completed!`
				});
			},
			onError: (errors) => {
				proxy.pendingPurchase = false;
				Swal.fire({
					icon: 'error',
					title: 'Whoops!',
					text: errors.order
				});
			}
		});
	};

	onMounted(async() => {
		
	});
</script>