<template>
	<MainLayout>
		<div class="bg-gradient-to-b from-theme-primary-500 to-theme-primary-600 flex flex-col w-full motify-full-height relative md:mt-[72px]">
			<div class="motify-container items-center relative w-full max-w-[100%] p-0 m-0">
				<div class="flex flex-col w-full justify-center items-center relative px-[10px] mx-auto mt-0 mb-[30px] max-w-[100%] lg:max-w-[500px] lg:mt-[40px] lg:mb-[100px]">
					<div class="flex flex-col w-full bg-theme-background-alt rounded-[4px] w-full m-0 p-0 relative p-[30px] mx-0 my-[30px]">
						<div class="flex flex-col w-full relative">
							<div class="flex flex-col w-full relative justify-center items-center mb-5">
								<div class="flex flex-row relative space-x-2 items-center justify-center">
									<div class="flex flex-col leading-5 select-none pointer-events-none">
										<svg xmlns="http://www.w3.org/2000/svg" role="img" class="inline-flex text-theme-primary-600 select-none pointer-events-none leading-5" width="24px" height="24px" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z" fill="currentColor"></path><path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" fill="currentColor"></path></svg>
									</div>
									<div class="flex flex-col">
										<h1 class="inline-flex text-theme-primary-600 font-motify font-bold whitespace-pre-wrap leading-5 text-[18px] md:text-[24px]">Sign In</h1>
									</div>
								</div>
							</div>
							<div class="flex flex-col w-full mb-4 mt-2 p-0 relative transition-all ease-in-out duration-300" v-if="(Object.values(props.errors).length !== 0) && !proxy.hideErrors">
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
							<form class="flex flex-col space-y-[20px] w-full relative" @submit.prevent="submit">
								<div class="flex flex-col w-full m-0 p-0">
									<label class="flex flex-col font-motify font-medium w-full capitalize text-slate-950 text-[12px] leading-[18px] md:text-[14px] md:leading-[22px]" for="email">Email</label>
									<Input v-model="form.email" :type="'email'" :placeholder="'Enter your email'" :maxlength="255" :autocomplete="'email'" :id="'email'" :required="true" />
								</div>
								<div class="flex flex-col w-full m-0 p-0">
									<label class="flex flex-col font-motify font-semibold w-full capitalize text-slate-950 text-[12px] leading-[18px] md:text-[14px] md:leading-[22px] mb-[4px]" for="password">Password</label>
									<Input v-model="form.password" :type="'password'" :placeholder="'Enter your password'" :autocomplete="'current-password'" :id="'password'" :required="true" />
								</div>
								<div class="flex flex-col w-full m-0 p-0">
									<div class="flex flex-row space-x-2 items-start justify-start">
										<Checkbox v-model="form.remember" class="mt-[5px] cursor-pointer" id="remember" />
										<div class="flex flex-col select-none items-center justify-center">
											<label class="flex flex-col select-none font-motify font-semibold w-full capitalize text-slate-950 cursor-pointer text-[12px] leading-[18px] md:text-[14px] md:leading-[22px]" for="remember">Remember me</label>
										</div>
									</div>
								</div>
								<div class="flex flex-col w-full m-0 p-0">
									<Button :type="'submit'" :custom-class="'rounded-[4px] bg-theme-secondary-500 text-white w-full capitalize text-center justify-center items-center text-[12px] md:text-[14px] hover:bg-theme-secondary-700 hover:text-[#F5F5F5]'">Sign in</Button>
								</div>
							</form>
							<div class="flex flex-col w-full justify-center items-center relative m-0 p-0 mt-[20px]">
								<div class="motify-auth-divider select-none pointer-events-none inline-flex m-0 p-0 relative justify-center items-center max-w-[240px] md:max-w-[200px] w-full">
									<span class="inline-flex select-none pointer-events-none items-center m-0 p-0 font-motify font-medium uppercase text-theme-primary-500 text-[12px] leading-[18px] md:text-[14px] md:leading-[22px]">Or</span>
								</div>
							</div>
							<div class="flex flex-col w-full justify-center items-center relative m-0 p-0 mt-[20px]">
								<div class="flex flex-col lg:flex-row w-full space-x-0 space-y-2 lg:space-y-0 lg:space-x-3 items-center justify-center relative m-0 p-0">
									<div class="flex flex-col w-full lg:w-auto justify-center items-center p-0 m-0">
										<Link href="/clientarea/register" class="flex flex-col w-full lg:w-auto justify-center items-center select-none cursor-pointer no-underline transition-all duration-300">
											<Button :type="'button'" :custom-class="'override:text-[13px] rounded-[4px] bg-theme-secondary-500 text-white w-full capitalize text-center font-medium justify-center items-center text-[12px] hover:bg-theme-secondary-700 hover:text-[#F5F5F5]'">
												<div class="flex flex-row w-full items-center justify-center space-x-2 leading-[20px]">
													<div class="flex flex-col"><svg xmlns="http://www.w3.org/2000/svg" role="img" class="flex flex-col select-none pointer-events-none" width="18px" height="18px" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><line x1="200" y1="136" x2="248" y2="136" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"/><line x1="224" y1="112" x2="224" y2="160" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"/><circle cx="108" cy="100" r="60" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"/><path d="M22.2,200a112,112,0,0,1,171.6,0" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"/></svg></div>
													<div class="flex flex-col">Register</div>
												</div>
											</Button>
										</Link>
									</div>
									<div class="flex flex-col w-full lg:w-auto justify-center items-center p-0 m-0">
										<Link href="/clientarea/login/recover" class="flex flex-col w-full lg:w-auto justify-center items-center select-none cursor-pointer no-underline transition-all duration-300">
											<Button :type="'button'" :custom-class="'override:text-[13px] rounded-[4px] bg-theme-secondary-500 text-white w-full capitalize text-center font-medium justify-center items-center hover:bg-theme-secondary-700 hover:text-[#F5F5F5]'">
												<div class="flex flex-row w-full items-center justify-center space-x-2 leading-[18px]">
													<div class="flex flex-col"><svg xmlns="http://www.w3.org/2000/svg" role="img" width="16px" height="16px" fill="currentColor" class="flex flex-col select-none pointer-events-none" viewBox="0 0 16 16"><path d="M11 1a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h5V3a3 3 0 0 1 6 0v4a.5.5 0 0 1-1 0V3a2 2 0 0 0-2-2zM3 8a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1H3z"/></svg></div>
													<div class="flex flex-col">Forgot password</div>
												</div>
											</Button>
										</Link>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</MainLayout>
</template>

<script setup>
	import { useForm, Link } from '@inertiajs/vue3';
	import { reactive } from 'vue'
	import MainLayout from '../../Layouts/MainLayout.vue';
	import Button from '../../Components/Button.vue';
	import Input from '../../Components/Input.vue';
	import Checkbox from '../../Components/Checkbox.vue';
	import Swal from 'sweetalert2/dist/sweetalert2.js'
	import 'sweetalert2/dist/sweetalert2.min.css';

	const props = defineProps({
		errors: Object,
		user: Object
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
		hideErrors: true
	}),
	form = useForm({
		email: '',
		password: '',
		remember: ''
	}),
	submit = () => {
		form.post(route('clientarea.login'), {
			onFinish: () => {
				form.reset('password')
			},
			onSuccess: () => {
				try {
					window.localStorage.setItem('motify_new_session', new Date().getTime().toString());
				} catch (err) {}
			},
			onError: (errors) => {
				proxy.hideErrors = false;
				Toast.fire({
					icon: 'error',
					title: 'Whoops!',
					text: `Sorry, but please check your entries and try again!`
				});
			}
		});
	};
</script>