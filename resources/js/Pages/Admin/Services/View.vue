<template>
	<ClientLayout :activePage="9">
		<div class="flex flex-col w-full p-0 m-0" v-if="props.service === null">
			<span class="flex flex-col font-medium whitespace-pre-wrap text-[20px] leading-[24px] capitalize">Service not found</span>
		</div>
		
		<div class="flex flex-col w-full p-0 m-0" v-else>
			<div class="flex flex-col w-full p-0 m-0">
				<span class="flex flex-col font-medium whitespace-pre-wrap text-[20px] leading-[24px] capitalize">Service &#x23;{{ props.service.id }}</span>
			</div>
			<div class="flex flex-col w-full m-0 mt-[18px] xl:mt-[24px] p-0">
				<div class="flex flex-col w-full relative m-0 p-0 gap-x-0 gap-y-6">
					<div class="flex flex-col w-full relative bg-white border border-[#D1D9E4] rounded-xl p-[24px] space-y-[20px]">
						<div class="flex flex-col w-full p-0 m-0">
							<span class="flex flex-col font-medium whitespace-pre-wrap text-[18px] leading-[28px]">Edit service</span>
						</div>
						<div class="flex flex-col w-full relative max-w-full lg:max-w-[50%]">
							<div class="flex flex-col w-full m-0 mb-4 p-0 relative transition-all ease-in-out duration-300" v-if="(errors && Object.values(props.errors).length !== 0) && !proxy.hideErrors">
								<div class="flex flex-col w-full bg-red-200 px-[30px] py-[15px] border border-red-400 rounded-sm">
									<div class="flex flex-col w-full items-start justify-start">
										<span class="flex flex-col font-motify font-semibold whitespace-pre-wrap text-slate-800 text-[12px] leading-[18px] md:text-[14px] md:leading-[22px]">The following error(s) needs to be corrected:</span>
									</div>
									<div class="flex flex-col w-full items-start justify-start">
										<ul role="list" class="flex flex-col w-full list-disc text-slate-800 relative p-0 m-0 pl-5">
											<li v-for="(err) in Object.values(props.errors)">
												<span class="flex flex-col font-motify font-semibold whitespace-pre-wrap text-[12px] leading-[18px] md:text-[14px] md:leading-[22px]">{{ err }}</span>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<form class="flex flex-col w-full relative space-y-[20px]" @submit.prevent="submit">
								<div class="flex flex-col w-full relative m-0 p-0">
									<div class="flex flex-col w-full m-0 p-0">
										<label class="flex flex-col font-motify font-medium w-full capitalize text-slate-950 text-[12px] leading-[18px] md:text-[14px] md:leading-[22px]" for="service_title">Title</label>
										<Input v-model="form.title" :type="'text'" :maxlength="64" :id="'service_title'" :name="'Service Title'" :customClass="'cursor-text'" :autocomplete="'off'"  />
									</div>
								</div>

								<div class="flex flex-col w-full relative m-0 p-0">
									<div class="flex flex-col w-full m-0 p-0">
										<label class="flex flex-col font-motify font-medium w-full capitalize text-slate-950 text-[12px] leading-[18px] md:text-[14px] md:leading-[22px]" for="service_description">Descripton</label>
										<div class="group flex flex-col w-full m-0 p-0">
											<div class="flex flex-col relative z-[1] gap-[8px] items-center w-full py-0">
												<textarea id="service_description" name="Service Description" v-model="form.description" autocomplete="off" maxlength="65535" class="flex flex-col relative z-[1] px-[12px] outline-0 transition-colors duration-300 border-[1px] border-[#0C0C0C0] rounded-[12px] min-h-[180px] max-h-[480px] flex flex-col w-full text-[#0a0a0a] whitespace-nowrap text-ellipsis p-[12px] text-[12px] md:text-[14px] outline-0 transition-all duration-300 ring-0 focus:ring-2 focus:ring-theme-primary-600 focus:border-theme-primary-600" required="true" aria-required="true"></textarea>
											</div>
										</div>
									</div>
								</div>

								<div class="flex flex-col md:flex-row w-full relative space-y-[20px] md:space-x-[20px] md:space-y-0">
									<div class="flex flex-col w-full relative m-0 p-0 md:w-6/12">
										<div class="flex flex-col w-full m-0 p-0">
											<label class="flex flex-col font-motify font-medium w-full text-slate-950 text-[12px] leading-[18px] md:text-[14px] md:leading-[22px]" for="service_category">Category</label>
											<select v-model="form.category" id="service_category" name="Service Category" class="flex flex-col w-full text-[#0a0a0a] whitespace-nowrap text-ellipsis p-[12px] text-[12px] md:text-[14px] outline-0 transition-all duration-300 ring-0 border-[1px] border-[#0C0C0C0] rounded-[12px] select-none" placeholder="Select an option" required="true" aria-required="true">
												<option value="0">Proxies</option>
												<option value="2" disabled="true" aria-disabled="true">Servers</option>
											</select>
										</div>
									</div>

									<div class="flex flex-col w-full relative m-0 p-0 md:w-6/12">
										<div class="flex flex-col w-full m-0 p-0">
											<label class="flex flex-col font-motify font-medium w-full text-slate-950 text-[12px] leading-[18px] md:text-[14px] md:leading-[22px]" for="service_billing_type">Billing type</label>
											<select v-model="form.billing" id="service_billing_type" name="Service Billing Type" class="flex flex-col w-full text-[#0a0a0a] whitespace-nowrap text-ellipsis p-[12px] text-[12px] md:text-[14px] outline-0 transition-all duration-300 ring-0 border-[1px] border-[#0C0C0C0] rounded-[12px] select-none" required="true" aria-required="true">
												<option value="0" selected="">Monthly</option>
												<option value="1">Per GB (for proxies)</option>
											</select>
										</div>
									</div>
								</div>
								

								<div class="flex flex-col w-full relative m-0 p-0">
									<div class="flex flex-col w-full m-0 p-0">
										<label class="flex flex-col font-motify font-medium w-full capitalize text-slate-950 text-[12px] leading-[18px] md:text-[14px] md:leading-[22px]" for="service_pricing">Pricing</label>
										<Input v-model="form.price" :type="'number'" :step=".01" :min="0.01" :max="9999" :id="'service_pricing'" :name="'Service Pricing'" :customClass="'cursor-text'"  />
									</div>
								</div>
								
								<div class="flex flex-col w-full m-0 p-[10px]">
									<div class="flex flex-row space-x-2 items-start justify-start">
										<Checkbox v-bind:checked="(form.disabled !== 0)" v-model="form.disabled" class="mt-[5px] cursor-pointer" id="service_disabled" />
										<div class="flex flex-col select-none items-center justify-center">
											<label class="flex flex-col select-none font-motify font-semibold w-full capitalize text-slate-950 cursor-pointer text-[12px] leading-[18px] md:text-[14px] md:leading-[22px]" for="service_disabled">Disabled</label>
										</div>
									</div>
									<div class="flex flex-col w-full p-0 mt-1">
										<span class="text-[14px] leading-[22px] text-theme-primary-foreground-clientarea-alt">Checking this will hide this service from the <Link class="transition-colors duration-300 font-medium text-theme-primary-500 hover:text-theme-secondary-400" href="/clientarea/order">services catalog</Link>.</span>
									</div>
								</div>

								<div class="flex flex-col w-full m-0 p-0">
									<div>
										<Button type="'submit'" :disabled="proxy.pendingEdit" :customClass="'w-auto outline-0 text-center justify-center items-center motify-btn-sm bg-theme-secondary-500 text-white hover:bg-theme-secondary-700 hover:text-[#F5F5F5]'">
											<div class="flex flex-row w-full items-center justify-center space-x-2 leading-[16px] outline-0">
												<div class="flex flex-col"><svg xmlns="http://www.w3.org/2000/svg" role="img" class="flex flex-col select-none pointer-events-none" width="14px" height="14px" fill="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M13.0207 5.82839L15.8491 2.99996L20.7988 7.94971L17.9704 10.7781M13.0207 5.82839L3.41405 15.435C3.22652 15.6225 3.12116 15.8769 3.12116 16.1421V20.6776H7.65669C7.92191 20.6776 8.17626 20.5723 8.3638 20.3847L17.9704 10.7781M13.0207 5.82839L17.9704 10.7781" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
												<div class="flex flex-col">Save changes</div>
											</div>
										</Button>
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
	import { usePage, useForm, Link } from '@inertiajs/vue3';
	import Button from '../../../Components/Button.vue';
	import Input from '../../../Components/Input.vue';
	import Checkbox from '../../../Components/Checkbox.vue'
	import Swal from 'sweetalert2/dist/sweetalert2.js'
	import 'sweetalert2/dist/sweetalert2.min.css';

	const props = defineProps({
		errors: Object,
		service: Object
	}),

	page = usePage(),
	user = computed(() => page.props.user),

	form = useForm({
		title: props.service.title,
		description: props.service.description,
		category: props.service.category,
		billing: props.service.billing,
		price: props.service.price,
		disabled: props.service.disabled
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

	proxy = reactive({
		hideErrors: true,
		pendingEdit: false
	}),

	submit = () => {
		proxy.pendingEdit = true;
		form.post(route('admin.services.edit', [props.service.id]), {
			onFinish: () => {
				proxy.pendingEdit = false;
			},
			onSuccess: () => {
				Toast.fire({
					icon: 'success',
					title: 'Success',
					text: `Service edited successfully!`
				});
			},
			onError: (errors) => {
				proxy.pendingEdit = false;
			}
		});
	};

	onMounted(async() => {
		
	});
</script>