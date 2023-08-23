<template>
	<ClientLayout :activePage="9">
		<div class="flex flex-col w-full p-0 m-0">
			<span class="flex flex-col font-medium whitespace-pre-wrap text-[20px] leading-[24px] capitalize">Manage services</span>
		</div>
		<div class="flex flex-col w-full m-0 mt-[18px] xl:mt-[24px] p-0">
			<div class="flex flex-col w-full relative m-0 p-0 gap-x-0 gap-y-6">
				<div class="flex flex-col w-full relative bg-white border border-[#D1D9E4] rounded-xl p-[24px] space-y-[20px]">
					<div class="flex flex-col w-full p-0 m-0">
						<div class="flex flex-col w-full p-0 m-0">
							<span class="flex flex-col font-medium whitespace-pre-wrap text-[18px] leading-[28px]">Add new service</span>
						</div>
						<div class="flex flex-col w-full p-0 m-0 mt-[5px]">
							<span class="text-[14px] leading-[22px] text-theme-primary-foreground-clientarea-alt">Create a new service to be listed in the <Link class="transition-colors duration-300 font-medium text-theme-primary-500 hover:text-theme-secondary-400" href="/clientarea/order">services catalog</Link>.</span>
						</div>
					</div>
					<div class="flex flex-col w-full relative max-w-full lg:max-w-[50%]">
						<div class="flex flex-col w-full m-0 mb-4 p-0 relative transition-all ease-in-out duration-300" v-if="('addService' in errors && Object.values(props.errors).length !== 0) && !proxy.forms.addService.hideErrors">
							<div class="flex flex-col w-full bg-red-200 px-[30px] py-[15px] border border-red-400 rounded-sm">
								<div class="flex flex-col w-full items-start justify-start">
									<span class="flex flex-col font-motify font-semibold whitespace-pre-wrap text-slate-800 text-[12px] leading-[18px] md:text-[14px] md:leading-[22px]">The following error(s) needs to be corrected:</span>
								</div>
								<div class="flex flex-col w-full items-start justify-start">
									<ul role="list" class="flex flex-col w-full list-disc text-slate-800 relative p-0 m-0 pl-5">
										<li v-for="(err) in Object.values(props.errors.addService)">
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
									<Input v-model="form.addService.title" :type="'text'" :maxlength="64" :id="'service_title'" :name="'Service Title'" :customClass="'cursor-text'" :autocomplete="'off'"  />
								</div>
							</div>

							<div class="flex flex-col w-full relative m-0 p-0">
								<div class="flex flex-col w-full m-0 p-0">
									<label class="flex flex-col font-motify font-medium w-full capitalize text-slate-950 text-[12px] leading-[18px] md:text-[14px] md:leading-[22px]" for="service_description">Descripton</label>
									<div class="group flex flex-col w-full m-0 p-0">
										<div class="flex flex-col relative z-[1] gap-[8px] items-center w-full py-0">
											<textarea id="service_description" name="Service Description" v-model="form.addService.description" autocomplete="off" maxlength="65535" class="flex flex-col relative z-[1] px-[12px] outline-0 transition-colors duration-300 border-[1px] border-[#0C0C0C0] rounded-[12px] min-h-[180px] max-h-[480px] flex flex-col w-full text-[#0a0a0a] whitespace-nowrap text-ellipsis p-[12px] text-[12px] md:text-[14px] outline-0 transition-all duration-300 ring-0 focus:ring-2 focus:ring-theme-primary-600 focus:border-theme-primary-600" required="true" aria-required="true"></textarea>
										</div>
									</div>
								</div>
							</div>

							<div class="flex flex-col md:flex-row w-full relative space-y-[20px] md:space-x-[20px] md:space-y-0">
								<div class="flex flex-col w-full relative m-0 p-0 md:w-6/12">
									<div class="flex flex-col w-full m-0 p-0">
										<label class="flex flex-col font-motify font-medium w-full text-slate-950 text-[12px] leading-[18px] md:text-[14px] md:leading-[22px]" for="service_category">Category</label>
										<select v-model="form.addService.category" id="service_category" name="Service Category" class="flex flex-col w-full text-[#0a0a0a] whitespace-nowrap text-ellipsis p-[12px] text-[12px] md:text-[14px] outline-0 transition-all duration-300 ring-0 border-[1px] border-[#0C0C0C0] rounded-[12px] select-none" placeholder="Select an option" required="true" aria-required="true">
											<option value="0">Proxies</option>
											<option value="2" disabled="true" aria-disabled="true">Servers</option>
										</select>
									</div>
								</div>

								<div class="flex flex-col w-full relative m-0 p-0 md:w-6/12">
									<div class="flex flex-col w-full m-0 p-0">
										<label class="flex flex-col font-motify font-medium w-full text-slate-950 text-[12px] leading-[18px] md:text-[14px] md:leading-[22px]" for="service_billing_type">Billing type</label>
										<select v-model="form.addService.billing" id="service_billing_type" name="Service Billing Type" class="flex flex-col w-full text-[#0a0a0a] whitespace-nowrap text-ellipsis p-[12px] text-[12px] md:text-[14px] outline-0 transition-all duration-300 ring-0 border-[1px] border-[#0C0C0C0] rounded-[12px] select-none" required="true" aria-required="true">
											<option value="0" selected="">Monthly</option>
											<option value="1">Per GB (for proxies)</option>
										</select>
									</div>
								</div>
							</div>
							

							<div class="flex flex-col w-full relative m-0 p-0">
								<div class="flex flex-col w-full m-0 p-0">
									<label class="flex flex-col font-motify font-medium w-full capitalize text-slate-950 text-[12px] leading-[18px] md:text-[14px] md:leading-[22px]" for="service_pricing">Pricing</label>
									<Input v-model="form.addService.price" :type="'number'" :step=".01" :min="0.01" :max="9999" :id="'service_pricing'" :name="'Service Pricing'" :customClass="'cursor-text'"  />
								</div>
							</div>
							
							<div class="flex flex-col w-full m-0 p-0">
								<div>
									<Button type="'submit'" :disabled="proxy.forms.addService.pendingCreation" :customClass="'w-auto text-center justify-center items-center motify-btn-sm bg-theme-secondary-500 text-white hover:bg-theme-secondary-700 hover:text-[#F5F5F5]'">
										<div class="flex flex-row w-full items-center justify-center space-x-2 leading-[16px] outline-0">
											<div class="flex flex-col"><svg xmlns="http://www.w3.org/2000/svg" role="img" class="flex flex-col select-none pointer-events-none" width="14px" height="14px" fill="currentColor" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/></svg></div>
											<div class="flex flex-col">Create</div>
										</div>
									</Button>
								</div>
							</div>
						</form>
					</div>
				</div>

				<div class="flex flex-col w-full relative bg-white border border-[#D1D9E4] rounded-xl p-[24px] space-y-[20px]">
					<div class="flex flex-col w-full p-0 m-0">
						<span class="flex flex-col font-medium whitespace-pre-wrap text-[18px] leading-[28px] capitalize">Proxies</span>
					</div>
					<div class="grid grid-cols-1 w-full relative md:grid-cols-2 relative gap-5" v-if="Object.entries(props.services.data).length">
						<div v-for="service in props.services.data" :key="service.id" class="group flex flex-col w-full relative bg-white transition-all duration-300 py-[12px] px-[18px] md:py-[20px] md:px-[25px] rounded-[4px] border-[1px] border-[#0c0c0c40] hover:border-[#0c0c0c20] space-x-4">
							<div class="flex flex-row w-full relative p-0 m-0 flex-wrap flex-shrink flex-grow basis-0 text-[14px] md:text-[16px] font-motify leading-snug whitespace-pre-wrap text-slate-800">
								<div class="flex flex-col w-2/12 p-0 m-0s">
									<div class="flex flex-col w-full select-none pointer-events-none justify-center items-center transition-colors duration-300 text-theme-secondary-500 group-hover:text-theme-secondary-700/75 min-h-[36px] max-h-[36px] h-[36px] md:min-h-[40px] md:max-h-[40px] md:h-[40px]">
										<svg xmlns="http://www.w3.org/2000/svg" role="img" class="inline-flex pointer-events-none select-none p-0 m-0" width="28px" height="28px" fill="currentColor" viewBox="0 0 24 24"><path d="M15.0127,9.3949l4.56982-4.56977L21,6.24261V2H16.75739l1.41088,1.41089L13.33405,8.24512A3.93757,3.93757,0,0,0,8.14288,10.9953H5.72009a2.00033,2.00033,0,1,0,.00507,2H8.14a3.94008,3.94008,0,0,0,5.20423,2.75647l4.83069,4.83069L16.75739,22H21V17.75732l-1.41089,1.41095-4.57043-4.57043a3.96651,3.96651,0,0,0,.84137-1.60254L18,13v2l3-3L18,9v2l-2.14288-.0047A3.96785,3.96785,0,0,0,15.0127,9.3949Z"></path></svg>
									</div>
								</div>
								<div class="flex flex-col w-8/12 p-0 m-0 justify-center min-h-[36px] max-h-[36px] h-[36px] md:min-h-[40px] md:max-h-[40px] md:h-[40px]">
									<span class="font-motify font-regular leading-[18px] md:leading-[20px]">{{ service.title }}</span>
								</div>
								<div class="flex flex-col w-2/12 p-0 m-0 justify-center items-end min-h-[36px] max-h-[36px] h-[36px] md:min-h-[40px] md:max-h-[40px] md:h-[40px]">
									<Link :href="`/admin/services/${service.id.toString()}`" class="flex flex-col">
										<Button type="'button'" :customClass="'w-auto motify-edit-tooltip bg-theme-secondary-500 text-center justify-center items-center motify-btn-xs motify-btn-icon text-white hover:bg-theme-secondary-700 hover:text-white/75'">
											<div class="flex flex-row w-full items-center justify-center space-x-2 leading-[16px] outline-0">
												<div class="flex flex-col"><svg xmlns="http://www.w3.org/2000/svg" role="img" class="flex flex-col select-none pointer-events-none" width="16px" height="16px" fill="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M13.0207 5.82839L15.8491 2.99996L20.7988 7.94971L17.9704 10.7781M13.0207 5.82839L3.41405 15.435C3.22652 15.6225 3.12116 15.8769 3.12116 16.1421V20.6776H7.65669C7.92191 20.6776 8.17626 20.5723 8.3638 20.3847L17.9704 10.7781M13.0207 5.82839L17.9704 10.7781" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
											</div>
										</Button>
									</Link>
								</div>
							</div>
						</div>
					</div>
					<div class="flex flex-col w-full relative">
						<pagination :links="props.services.links" />
					</div>
				</div>
			</div>
		</div>
	</ClientLayout>
</template>
<script setup>
	import ClientLayout from '../../../Layouts/ClientLayout.vue';
	import { reactive, onMounted, computed, nextTick } from 'vue';
	import { usePage, useForm, Link } from '@inertiajs/vue3';
	import Button from '../../../Components/Button.vue';
	import Input from '../../../Components/Input.vue';
	import Pagination from '../../../Components/Pagination.vue';
	import Swal from 'sweetalert2/dist/sweetalert2.js'
	import 'sweetalert2/dist/sweetalert2.min.css';
	import tippy from 'tippy.js';
	import 'tippy.js/dist/tippy.css';

	const props = defineProps({
		errors: Object,
		services: Object
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

	proxy = reactive({
		forms: {
			addService: {
				pendingCreation: false,
				hideErrors: true
			}
		}
	}),

	form = {
		addService: useForm({
			title: '',
			description: '',
			category: '0',
			billing: '0',
			price: '0.01'
		})
	},

	submit = () => {
		proxy.forms.addService.pendingCreation = true;
		form.addService.post(route('admin.services.create'), {
			onFinish: () => {
				proxy.forms.addService.pendingCreation = false;
			},
			onSuccess: () => {
				proxy.forms.addService.hideErrors = true;
				form.addService.reset();
				Toast.fire({
					icon: 'success',
					title: 'Success',
					text: `Service created successfully!`
				});
			},
			onError: (errors) => {
				proxy.forms.addService.hideErrors = false;
			}
		});
	},

	initializeTooltip = async() => {
		tippy('.motify-edit-tooltip', {
			'content'	:	'Edit'
		});
	};

	onMounted(async() => {
		await nextTick().then(async() => {
			await initializeTooltip();
		});
	});
</script>