<template>
	<ClientLayout :activePage="7">
		<div class="flex flex-col w-full p-0 m-0" v-if="props.data === null">
			<span class="flex flex-col font-medium whitespace-pre-wrap text-[20px] leading-[24px] capitalize">User not found</span>
		</div>
		<div class="flex flex-col w-full p-0 m-0" v-else>
			<div class="flex flex-col w-full p-0 m-0">
				<span class="flex flex-col font-medium whitespace-pre-wrap text-[20px] leading-[24px]">Profile of {{ formatName(props.data.first_name) }}</span>
			</div>
			<div class="flex flex-col w-full m-0 mt-[18px] xl:mt-[24px] p-0">
				<div class="flex flex-col lg:flex-row flex-shrink flex-grow basis-0 w-full relative m-0 p-0 gap-x-0 gap-y-6 lg:gap-x-6">
					<div class="flex flex-col flex-shrink flex-wrap flex-grow basis-0 w-full relative bg-white border border-[#D1D9E4] rounded-xl p-[24px] space-y-[20px] lg:w-6/12">
						<div class="flex flex-col w-full p-0 m-0">
							<div class="flex flex-col w-full p-0 m-0">
								<span class="flex flex-col font-medium whitespace-pre-wrap text-[18px] leading-[28px]">Edit profile</span>
							</div>
							<div class="flex flex-col w-full p-0 m-0 mt-[5px]">
								<span class="text-[14px] leading-[22px] text-theme-primary-foreground-clientarea-alt">Create a new service to be listed in the <Link class="transition-colors duration-300 font-medium text-theme-primary-500 hover:text-theme-secondary-400" href="/clientarea/order">services catalog</Link>.</span>
							</div>
						</div>
						<div class="flex flex-col w-full relative flex-grow">
							<div class="flex flex-col w-full mb-4 mt-2 p-0 relative transition-all ease-in-out duration-300" v-if="('editProfile' in props.errors && Object.values(props.errors.editProfile).length !== 0) && !proxy.forms.editProfile.hideErrors">
								<div class="flex flex-col w-full bg-red-200 px-[30px] py-[15px] border border-red-400 rounded-sm">
									<div class="flex flex-col w-full items-start justify-start">
										<span class="flex flex-col font-motify font-semibold whitespace-pre-wrap text-slate-800 text-[12px] leading-[18px] md:text-[14px] md:leading-[22px]">The following error(s) needs to be corrected:</span>
									</div>
									<div class="flex flex-col w-full items-start justify-start">
										<ul role="list" class="flex flex-col w-full list-disc text-slate-800 relative p-0 m-0 pl-5">
											<li v-for="(err) in Object.values(props.errors.editProfile)">
												<span class="flex flex-col font-motify font-semibold whitespace-pre-wrap text-[12px] leading-[18px] md:text-[14px] md:leading-[22px]">{{ err }}</span>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<form class="flex flex-col w-full relative space-y-[20px] flex-grow">
								<div class="flex flex-col md:flex-row w-full relative space-y-[20px] md:space-x-[30px] md:space-y-0">
									<div class="flex flex-col w-full relative m-0 p-0 md:w-6/12">
										<div class="flex flex-col w-full relative m-0 p-0">
											<div class="flex flex-col w-full m-0 p-0">
												<label class="flex flex-col font-motify font-medium w-full capitalize text-slate-950 text-[12px] leading-[18px] md:text-[14px] md:leading-[22px]" for="service_title">First name</label>
												<Input v-model="form.editProfile.first_name" :type="'text'" :maxlength="64" :id="'first_name'" :name="'First Name'" :customClass="'cursor-text'" :autocomplete="'off'"  />
											</div>
										</div>
									</div>
									<div class="flex flex-col w-full relative m-0 p-0 md:w-6/12">
										<div class="flex flex-col w-full relative m-0 p-0">
											<div class="flex flex-col w-full m-0 p-0">
												<label class="flex flex-col font-motify font-medium w-full capitalize text-slate-950 text-[12px] leading-[18px] md:text-[14px] md:leading-[22px]" for="last_name">Last name</label>
												<Input v-model="form.editProfile.last_name" :type="'text'" :maxlength="64" :id="'last_name'" :name="'Last Name'" :customClass="'cursor-text'" :autocomplete="'off'"  />
											</div>
										</div>
									</div>
								</div>
								<div class="flex flex-col md:flex-row w-full relative space-y-[20px] md:space-x-[30px] md:space-y-0">
									<div class="flex flex-col w-full relative m-0 p-0 md:w-6/12">
										<div class="flex flex-col w-full relative m-0 p-0">
											<div class="flex flex-col w-full m-0 p-0">
												<label class="flex flex-col font-motify font-medium w-full capitalize text-slate-950 text-[12px] leading-[18px] md:text-[14px] md:leading-[22px]" for="balance">Balance</label>
												<Input v-model="form.editProfile.balance" :type="'number'" :id="'balance'" :name="'Balance'" :customClass="'cursor-text'" :autocomplete="'off'"  />
											</div>
										</div>
									</div>
									<div class="flex flex-col w-full relative m-0 p-0 md:w-6/12">
										<div class="flex flex-col w-full relative m-0 p-0">
											<div class="flex flex-col w-full m-0 p-0">
												<label class="flex flex-col font-motify font-medium w-full capitalize text-slate-950 text-[12px] leading-[18px] md:text-[14px] md:leading-[22px]" for="email">Email address</label>
												<Input v-model="form.editProfile.email" :type="'email'" :maxlength="255" :id="'email'" :name="'Email Address'" :customClass="'cursor-text'" :autocomplete="'off'"  />
											</div>
										</div>
									</div>
								</div>
								<div class="flex flex-col w-full m-0 p-[10px]">
									<div class="flex flex-row space-x-2 items-start justify-start">
										<Checkbox v-bind:checked="(form.editProfile.admin !== false)" v-model="form.editProfile.admin" class="mt-[5px] cursor-pointer" id="administrator" />
										<div class="flex flex-col select-none items-center justify-center">
											<label class="flex flex-col select-none font-motify font-semibold w-full capitalize text-slate-950 cursor-pointer text-[12px] leading-[18px] md:text-[14px] md:leading-[22px]" for="administrator">Administrator</label>
										</div>
									</div>
									<div class="flex flex-col w-full p-0 mt-1">
										<span class="text-[12px] leading-[18px] text-theme-primary-foreground-clientarea-alt"><span class="font-semibold">Attention!</span> Checking this will grant user administrator privileges.</span>
									</div>
								</div>
								<div class="flex flex-col w-full m-0 p-0 flex-grow justify-end">
									<div>
										<Button type="'submit'" :disabled="proxy.forms.editProfile.pendingSubmit" :customClass="'w-auto text-center justify-center items-center motify-btn-sm bg-theme-secondary-500 text-white hover:bg-theme-secondary-700 hover:text-[#F5F5F5]'">
											<div class="flex flex-row w-full items-center justify-center space-x-2 leading-[16px] outline-0">
												<div class="flex flex-col"><svg xmlns="http://www.w3.org/2000/svg" role="img" class="flex flex-col select-none pointer-events-none" width="14px" height="14px" fill="currentColor" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"/><path d="M4 3h13l3.707 3.707a1 1 0 0 1 .293.707V20a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1zm8 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM5 5v4h10V5H5z"/></g></svg></div>
												<div class="flex flex-col">Save changes</div>
											</div>
										</Button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="flex flex-col flex-shrink flex-wrap flex-grow basis-0 w-full relative bg-white border border-[#D1D9E4] rounded-xl p-[24px] space-y-[20px] lg:w-6/12">
						<div class="flex flex-col w-full p-0 m-0">
							<div class="flex flex-col w-full p-0 m-0">
								<span class="flex flex-col font-medium whitespace-pre-wrap text-[18px] leading-[28px]">Authentication</span>
							</div>
							<div class="flex flex-col w-full p-0 m-0 mt-[5px]">
								<span class="text-[14px] leading-[22px] text-theme-primary-foreground-clientarea-alt">Use this form to update user&#x2019;s password.</span>
							</div>
						</div>
						<div class="flex flex-col w-full relative flex-grow">
							<div class="flex flex-col w-full mb-4 mt-2 p-0 relative transition-all ease-in-out duration-300" v-if="('authentication' in props.errors && Object.values(props.errors.authentication).length !== 0) && !proxy.forms.authentication.hideErrors">
								<div class="flex flex-col w-full bg-red-200 px-[30px] py-[15px] border border-red-400 rounded-sm">
									<div class="flex flex-col w-full items-start justify-start">
										<span class="flex flex-col font-motify font-semibold whitespace-pre-wrap text-slate-800 text-[12px] leading-[18px] md:text-[14px] md:leading-[22px]">The following error(s) needs to be corrected:</span>
									</div>
									<div class="flex flex-col w-full items-start justify-start">
										<ul role="list" class="flex flex-col w-full list-disc text-slate-800 relative p-0 m-0 pl-5">
											<li v-for="(err) in Object.values(props.errors.authentication)">
												<span class="flex flex-col font-motify font-semibold whitespace-pre-wrap text-[12px] leading-[18px] md:text-[14px] md:leading-[22px]">{{ err }}</span>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<form class="flex flex-col w-full relative space-y-[20px] flex-grow">
								<div class="flex flex-col w-[10px] max-w-[10px] m-0 p-0 absolute z-[-1394] invisible" aria-hidden="true" style="left: -99219px !important; top: 42.66vh !important">
									<label class="flex flex-col font-motify font-medium max-w-[10px] min-w-[10px] w-full capitalize text-slate-950 text-[12px] leading-[18px] md:text-[14px] md:leading-[22px]  absolute z-[-1394]" for="username" aria-hidden="true" style="left: -99219px !important; top: 42.66vh !important">Email</label>
									<input type="hidden" class="flex flex-col max-w-[10px] min-w-[10px] w-full absolute z-[-1394]" :value="props.data.email" autocomplete="username" aria-autocomplete="username" name="Username" id="username" aria-hidden="true" style="left: -99219px !important; top: 42.66vh !important" />
								</div>
								<div class="flex flex-col w-full relative m-0 p-0">
									<div class="flex flex-col w-full m-0 p-0">
										<label class="flex flex-col font-motify font-medium w-full capitalize text-slate-950 text-[12px] leading-[18px] md:text-[14px] md:leading-[22px]" for="password">Password</label>
										<Input v-model="form.authentication.password" :type="'password'" :id="'password'" :name="'Password'" :customClass="'cursor-text'" :autocomplete="'new-password'"  />
									</div>
								</div>
								<div class="flex flex-col w-full relative m-0 p-0">
									<div class="flex flex-col w-full m-0 p-0">
										<label class="flex flex-col font-motify font-medium w-full capitalize text-slate-950 text-[12px] leading-[18px] md:text-[14px] md:leading-[22px]" for="password_confirmation">Confirm password</label>
										<Input v-model="form.authentication.password_confirmation" :type="'password'" :id="'password_confirmation'" :name="'New Password'" :customClass="'cursor-text'" :autocomplete="'new-password'"  />
									</div>
								</div>
								<div class="flex flex-col w-full m-0 p-0 flex-grow justify-end">
									<div>
										<Button type="'submit'" :disabled="proxy.forms.authentication.pendingSubmit" :customClass="'w-auto text-center justify-center items-center motify-btn-sm bg-theme-secondary-500 text-white hover:bg-theme-secondary-700 hover:text-[#F5F5F5]'">
											<div class="flex flex-row w-full items-center justify-center space-x-2 leading-[16px] outline-0">
												<div class="flex flex-col"><svg xmlns="http://www.w3.org/2000/svg" role="img" class="flex flex-col select-none pointer-events-none" width="14px" height="14px" fill="currentColor" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"/><path d="M4 3h13l3.707 3.707a1 1 0 0 1 .293.707V20a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1zm8 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM5 5v4h10V5H5z"/></g></svg></div>
												<div class="flex flex-col">Update</div>
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
	import Checkbox from '../../../Components/Checkbox.vue';

	const props = defineProps({
		data: Object,
		errors: Object
	}),

	formatName = (name) => {
		var buf = name.charAt(0).toUpperCase() + name.slice(1).toLowerCase();
		console.log(buf);
		return buf;
	},

	page = usePage(),
	user = computed(() => page.props.user),

	form = useForm({
		editProfile: {
			first_name: props.data.first_name,
			last_name: props.data.last_name,
			email: props.data.email,
			balance: (parseFloat(props.data.balance) || 0).toFixed(2),
			admin: (props.data.roles.includes('Administrator') ? true : false)
		},
		authentication: {
			password: '',
			password_confirmation: ''
		}
	}),

	proxy = reactive({
		forms: {
			editProfile: {
				pendingSubmit: false,
				hideErrors: true
			},
			authentication: {
				pendingSubmit: false,
				hideErrors: true
			}
		}
	});

	onMounted(async() => {
		
	});
</script>