<template>
	<ClientLayout :user="user" :activePage="4">
		<div class="flex flex-col w-full p-0 m-0">
			<span class="flex flex-col font-medium whitespace-pre-wrap text-[20px] leading-[24px] capitalize">My account</span>
		</div>
		<div class="flex flex-col w-full m-0 mt-[18px] xl:mt-[24px] p-0">
			<div class="flex flex-col w-full relative m-0 p-0 gap-x-0 gap-y-6">
				<div class="flex flex-col w-full relative bg-white border border-[#D1D9E4] rounded-xl p-[24px] space-y-[20px]">
					<div class="flex flex-col w-full p-0 m-0">
						<span class="flex flex-col font-medium whitespace-pre-wrap text-[18px] leading-[28px] capitalize">Change password</span>
					</div>
					<div class="flex flex-col w-full relative max-w-full lg:max-w-[50%]">
						<div class="flex flex-col w-full mb-4 mt-2 p-0 relative transition-all ease-in-out duration-300" v-if="('password' in errors && Object.values(props.errors).length !== 0) && !proxy.hideErrors.password">
							<div class="flex flex-col w-full bg-red-200 px-[30px] py-[15px] border border-red-400 rounded-sm">
								<div class="flex flex-col w-full items-start justify-start">
									<span class="flex flex-col font-motify font-semibold whitespace-pre-wrap text-slate-800 text-[12px] leading-[18px] md:text-[14px] md:leading-[22px]">The following error(s) needs to be corrected:</span>
								</div>
								<div class="flex flex-col w-full items-start justify-start">
									<ul role="list" class="flex flex-col w-full list-disc text-slate-800 relative p-0 m-0 pl-5">
										<li v-for="(err) in Object.values(props.errors.password)">
											<span class="flex flex-col font-motify font-semibold whitespace-pre-wrap text-[12px] leading-[18px] md:text-[14px] md:leading-[22px]">{{ err }}</span>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<form class="flex flex-col w-full relative space-y-[20px]" @submit.prevent="submit('password', 'clientarea.account.password')">
							<div class="flex flex-col w-full m-0 p-0">
								<label class="flex flex-col font-motify font-medium w-full capitalize text-slate-950 text-[12px] leading-[18px] md:text-[14px] md:leading-[22px]" for="current_password">Current password</label>
								<Input  @update:model-value="delete props.errors.curent_password" v-model="form.password.current_password" :type="'password'" :placeholder="'Enter your current password'" :autocomplete="'current-password'" :id="'current_password'" :required="true" />
							</div>
							<div class="flex flex-col w-full m-0 p-0">
								<label class="flex flex-col font-motify font-medium w-full capitalize text-slate-950 text-[12px] leading-[18px] md:text-[14px] md:leading-[22px]" for="password">New password</label>
								<Input @update:model-value="delete props.errors.password" v-model="form.password.password" :type="'password'" :placeholder="'Enter your new password'" :autocomplete="'new-password'" :id="'password'" :required="true" />
							</div>
							<div class="flex flex-col w-full m-0 p-0">
								<label class="flex flex-col font-motify font-medium w-full capitalize text-slate-950 text-[12px] leading-[18px] md:text-[14px] md:leading-[22px]" for="password_confirm">Confirm password</label>
								<Input @update:model-value="delete props.errors.password_confirmation" v-model="form.password.password_confirmation" :type="'password'" :placeholder="'Enter your new password again'" :autocomplete="'new-password'" :id="'password_confirmation'" :required="true" />
							</div>
							<div class="flex flex-col w-full m-0 p-0">
								<Button :type="'submit'" :custom-class="'w-full capitalize text-center justify-center items-center text-[12px] md:text-[14px] bg-theme-secondary-500 text-white hover:bg-theme-secondary-700 hover:text-[#F5F5F5]'">
									Save changes
								</Button>
							</div>
						</form>
					</div>
				</div>
				<div class="flex flex-col w-full relative bg-white border border-[#D1D9E4] rounded-xl p-[24px] space-y-[20px]">
					<div class="flex flex-col w-full p-0 m-0">
						<span class="flex flex-col font-medium whitespace-pre-wrap text-[18px] leading-[28px] capitalize">Change email address</span>
					</div>
					<div class="flex flex-col w-full relative max-w-full lg:max-w-[50%]">
						<div class="flex flex-col w-full mb-4 mt-2 p-0 relative transition-all ease-in-out duration-300" v-if="('email' in errors && Object.values(props.errors).length !== 0) && !proxy.hideErrors.email">
							<div class="flex flex-col w-full bg-red-200 px-[30px] py-[15px] border border-red-400 rounded-sm">
								<div class="flex flex-col w-full items-start justify-start">
									<span class="flex flex-col font-motify font-semibold whitespace-pre-wrap text-slate-800 text-[12px] leading-[18px] md:text-[14px] md:leading-[22px]">The following error(s) needs to be corrected:</span>
								</div>
								<div class="flex flex-col w-full items-start justify-start">
									<ul role="list" class="flex flex-col w-full list-disc text-slate-800 relative p-0 m-0 pl-5">
										<li v-for="(err) in Object.values(props.errors.email)">
											<span class="flex flex-col font-motify font-semibold whitespace-pre-wrap text-[12px] leading-[18px] md:text-[14px] md:leading-[22px]">{{ err }}</span>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<form class="flex flex-col w-full relative space-y-[20px]" @submit.prevent="submit('email', 'clientarea.account.email')">
							<div class="flex flex-col w-full m-0 p-0">
								<label class="flex flex-col font-motify font-medium w-full capitalize text-slate-950 text-[12px] leading-[18px] md:text-[14px] md:leading-[22px]" for="current_email">Current email address</label>
								<Input :type="'email'" :modelValue="user.email" :readOnly="true" :disabled="true" :id="current_email" :maxlength="255" :customClass="'cursor-text'"  />
							</div>
							<div class="flex flex-col w-full m-0 p-0">
								<label class="flex flex-col font-motify font-medium w-full capitalize text-slate-950 text-[12px] leading-[18px] md:text-[14px] md:leading-[22px]" for="email_address">New email address</label>
								<Input @update:model-value="delete props.errors.email_address" v-model="form.email.email_address" :type="'email'" :placeholder="'Enter your new email'" :autocomplete="'email'" :id="'email_address'" :maxlength="255" :required="true" />
							</div>
							<div class="flex flex-col w-full m-0 p-0">
								<label class="flex flex-col font-motify font-medium w-full capitalize text-slate-950 text-[12px] leading-[18px] md:text-[14px] md:leading-[22px]" for="current_password">Current password</label>
								<Input @update:model-value="delete props.errors.current_password" v-model="form.email.current_password" :type="'password'" :placeholder="'Enter your current password'" :autocomplete="'current-password'" :id="'current_password'" :required="true" />
							</div>
							<div class="flex flex-col w-full m-0 p-0 ">
								<Button :type="'submit'" :custom-class="'w-full capitalize text-center justify-center items-center text-[12px] md:text-[14px] bg-theme-secondary-500 text-white hover:bg-theme-secondary-700 hover:text-[#F5F5F5]'">
									Save changes
								</Button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</ClientLayout>
</template>
<script setup>
	import ClientLayout from '../../Layouts/ClientLayout.vue';
	import Input from '../../Components/Input.vue';
	import Button from '../../Components/Button.vue';
	import { reactive, computed, onMounted } from 'vue';
	import { useForm, usePage } from '@inertiajs/vue3';
	import Swal from 'sweetalert2/dist/sweetalert2.js'
	import 'sweetalert2/dist/sweetalert2.min.css';

	const props = defineProps({
		errors: Object,
		user: Object
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
		password: useForm({
			current_password: '',
			password: '',
			password_confirmation: ''
		}),
		email: useForm({
			current_password: '',
			email_address: '',
		})
	},

	proxy = reactive({
		hideErrors		:	{
			password	:	false,
			email		:	false
		}
	}),

	submit = (key, _route) => {

		form[key].post(route(_route), {
			onFinish: () => {
				switch (key) {
					case 'password':
						form[key].reset();
						break;

					case 'email':
						form[key].reset('current_password');
						break;
				}
			},
			onSuccess: () => {

				switch (key) {

					case 'password': {
						form[key].reset();

						Toast.fire({
							icon: 'success',
							title: 'Success',
							text: `Your password has been updated successfully!`
						});

						break;
					}

					case 'email': {
						form[key].reset('current_password');

						Toast.fire({
							icon: 'success',
							title: 'Success',
							text: `Your email address has been changed successfully!`
						});

						break;

					}
				}
			},
			onError: (errors) => {
				proxy.hideErrors[key] = false;
				Toast.fire({
					icon: 'error',
					title: 'Whoops!',
					text: `Sorry, but please check your entries and try again!`
				});
			},
		});
	};
</script>