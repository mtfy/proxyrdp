<template>
	<ClientLayout :user="props.user" :activePage="0">
		<div class="flex flex-col w-full p-0 m-0">
			<span class="flex flex-col font-medium whitespace-pre-wrap text-[20px] leading-[24px] capitalize">Hello, {{ proxy.user.first_name }}!</span>
		</div>
		<div class="flex flex-col w-full p-0 m-0 mt-[8px]">
			<span class="flex flex-col text-[14px] leading-[22px] text-theme-primary-foreground-clientarea-alt">Welcome to your clientarea. Let&#x2019;s get started!</span>
		</div>
		<div class="flex flex-col w-full relative p-0 m-0 mt-[28px]">
			<div class="flex flex-col w-full relative">
				<div class="grid grid-cols-1 md:grid-cols-3 relative gap-2">
					<Link href="/clientarea/servers" class="flex flex-col group w-full py-[12px] px-[20px] rounded-[4px] relative transition-colors duration-300 bg-[#FFFFFF] hover:bg-[#F2F4F920] border-[1px] border-[#D1D9E4] hover:border-[#0A0A0A75]">
						<div class="flex flex-col w-full relative">
							<div class="flex flex-col w-full relative">
								<div class="flex flex-row w-full relative">
									<div class="flex flex-col w-9/12">
										<span class="flex flex-col transition-colors duration-300 font-motify leading-normal text-[24px] md:text-[36px] text-[#0A0A0A] group-hover:text-[#0A0A0A75]">0</span>
									</div>
									<div class="flex flex-col w-3/12 justify-center items-end select-none pointer-events-none">
										<svg xmlns="http://www.w3.org/2000/svg" role="img" class="inline-flex transition-colors duration-300 text-[#0A0A0A] group-hover:text-[#0A0A0A75] pointer-events-none select-none p-0 m-0" width="24px" height="24px" fill="currentColor" viewBox="0 0 16 16"><path d="M1.333 2.667C1.333 1.194 4.318 0 8 0s6.667 1.194 6.667 2.667V4c0 1.473-2.985 2.667-6.667 2.667S1.333 5.473 1.333 4V2.667z"></path><path d="M1.333 6.334v3C1.333 10.805 4.318 12 8 12s6.667-1.194 6.667-2.667V6.334a6.51 6.51 0 0 1-1.458.79C11.81 7.684 9.967 8 8 8c-1.966 0-3.809-.317-5.208-.876a6.508 6.508 0 0 1-1.458-.79z"></path><path d="M14.667 11.668a6.51 6.51 0 0 1-1.458.789c-1.4.56-3.242.876-5.21.876-1.966 0-3.809-.316-5.208-.876a6.51 6.51 0 0 1-1.458-.79v1.666C1.333 14.806 4.318 16 8 16s6.667-1.194 6.667-2.667v-1.665z"></path></svg>
									</div>
								</div>
							</div>
							<div class="flex flex-col w-full relative">
								<span class="flex flex-col transition-colors duration-300 font-motify leading-normal text-[16px] md:text-[20px] text-[#5A6372] group-hover:text-[#5A637290]">Servers</span>
							</div>
						</div>
					</Link>
					<Link href="/clientarea/proxies" class="flex flex-col group w-full py-[12px] px-[20px] rounded-[4px] relative transition-colors duration-300 bg-[#FFFFFF] hover:bg-[#F2F4F920] border-[1px] border-[#D1D9E4] hover:border-[#0A0A0A75]">
						<div class="flex flex-col w-full relative">
							<div class="flex flex-col w-full relative">
								<div class="flex flex-row w-full relative">
									<div class="flex flex-col w-9/12">
										<span class="flex flex-col transition-colors duration-300 font-motify leading-normal text-[24px] md:text-[36px] text-[#0A0A0A] group-hover:text-[#0A0A0A75]">0</span>
									</div>
									<div class="flex flex-col w-3/12 justify-center items-end select-none pointer-events-none">
										<svg xmlns="http://www.w3.org/2000/svg" role="img" class="inline-flex transition-colors duration-300 text-[#0A0A0A] group-hover:text-[#0A0A0A75] pointer-events-none select-none p-0 m-0" width="24px" height="24px" fill="currentColor" viewBox="0 0 24 24"><path d="M15.0127,9.3949l4.56982-4.56977L21,6.24261V2H16.75739l1.41088,1.41089L13.33405,8.24512A3.93757,3.93757,0,0,0,8.14288,10.9953H5.72009a2.00033,2.00033,0,1,0,.00507,2H8.14a3.94008,3.94008,0,0,0,5.20423,2.75647l4.83069,4.83069L16.75739,22H21V17.75732l-1.41089,1.41095-4.57043-4.57043a3.96651,3.96651,0,0,0,.84137-1.60254L18,13v2l3-3L18,9v2l-2.14288-.0047A3.96785,3.96785,0,0,0,15.0127,9.3949Z"></path></svg>
									</div>
								</div>
							</div>
							<div class="flex flex-col w-full relative">
								<span class="flex flex-col transition-colors duration-300 font-motify leading-normal text-[16px] md:text-[20px] text-[#5A6372] group-hover:text-[#5A637290]">Proxies</span>
							</div>
						</div>
					</Link>
					<Link href="/clientarea/invoices" class="flex flex-col group w-full py-[12px] px-[20px] rounded-[4px] relative transition-colors duration-300 bg-[#FFFFFF] hover:bg-[#F2F4F920] border-[1px] border-[#D1D9E4] hover:border-[#0A0A0A75]">
						<div class="flex flex-col w-full relative">
							<div class="flex flex-col w-full relative">
								<div class="flex flex-row w-full relative">
									<div class="flex flex-col w-9/12">
										<span class="flex flex-col transition-colors duration-300 font-motify leading-normal text-[24px] md:text-[36px] text-[#0A0A0A] group-hover:text-[#0A0A0A75]">0</span>
									</div>
									<div class="flex flex-col w-3/12 justify-center items-end select-none pointer-events-none">
										<svg xmlns="http://www.w3.org/2000/svg" role="img" class="inline-flex transition-colors duration-300 text-[#0A0A0A] group-hover:text-[#0A0A0A75] pointer-events-none select-none p-0 m-0" width="24px" height="24px" fill="currentColor" viewBox="0 0 384 512"><path d="M384 128h-128V0L384 128zM256 160H384v304c0 26.51-21.49 48-48 48h-288C21.49 512 0 490.5 0 464v-416C0 21.49 21.49 0 48 0H224l.0039 128C224 145.7 238.3 160 256 160zM64 88C64 92.38 67.63 96 72 96h80C156.4 96 160 92.38 160 88v-16C160 67.63 156.4 64 152 64h-80C67.63 64 64 67.63 64 72V88zM72 160h80C156.4 160 160 156.4 160 152v-16C160 131.6 156.4 128 152 128h-80C67.63 128 64 131.6 64 136v16C64 156.4 67.63 160 72 160zM197.5 316.8L191.1 315.2C168.3 308.2 168.8 304.1 169.6 300.5c1.375-7.812 16.59-9.719 30.27-7.625c5.594 .8438 11.73 2.812 17.59 4.844c10.39 3.594 21.83-1.938 25.45-12.34c3.625-10.44-1.891-21.84-12.33-25.47c-7.219-2.484-13.11-4.078-18.56-5.273V248c0-11.03-8.953-20-20-20s-20 8.969-20 20v5.992C149.6 258.8 133.8 272.8 130.2 293.7c-7.406 42.84 33.19 54.75 50.52 59.84l5.812 1.688c29.28 8.375 28.8 11.19 27.92 16.28c-1.375 7.812-16.59 9.75-30.31 7.625c-6.938-1.031-15.81-4.219-23.66-7.031l-4.469-1.625c-10.41-3.594-21.83 1.812-25.52 12.22c-3.672 10.41 1.781 21.84 12.2 25.53l4.266 1.5c7.758 2.789 16.38 5.59 25.06 7.512V424c0 11.03 8.953 20 20 20s20-8.969 20-20v-6.254c22.36-4.793 38.21-18.53 41.83-39.43C261.3 335 219.8 323.1 197.5 316.8z"/></svg>
									</div>
								</div>
							</div>
							<div class="flex flex-col w-full relative">
								<span class="flex flex-col transition-colors duration-300 font-motify leading-normal text-[16px] md:text-[20px] text-[#5A6372] group-hover:text-[#5A637290]">Invoices</span>
							</div>
						</div>
					</Link>
				</div>
			</div>
		</div>
	</ClientLayout>
</template>
<script setup>
	import Button from '../../Components/Button.vue';
	import ClientLayout from '../../Layouts/ClientLayout.vue';
	import { reactive, onMounted, nextTick } from 'vue';
	import { Link } from '@inertiajs/vue3';
	import Swal from 'sweetalert2/dist/sweetalert2.js'
	import 'sweetalert2/dist/sweetalert2.min.css';

	const props = defineProps({
		user: Object
	}),

	proxy = reactive({
		user		:	{
			guest		:	true,
			id			:	null,
			first_name	:	null,
			last_name	:	null,
			email		:	null
		}
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

	showLoginAlert = async() => {
		if (proxy.user.guest) {
			return;
		}

		if ('localStorage' in window && 'undefined' !== typeof window.localStorage && null !== window.localStorage) {
			var item = null;
			try {
				item = window.localStorage.getItem('motify_new_session');
			} catch (e) {
				item = null
			}

			if (null !== item) {
				try {
					window.localStorage.removeItem('motify_new_session');
				} catch (err) {}
				
				await Toast.fire({
					icon: 'success',
					title: 'Success',
					text: `Welcome back, ${proxy.user.first_name}!`
				});
			}
		}
	},
	
	cacheUserData = async() => {
		if ('user' in props && 'object' === typeof props.user && null !== props.user && Object.entries(props.user).length > 0) {
			proxy.user.guest = props.user.guest;
			proxy.user.id = props.user.id;
			proxy.user.first_name = props.user.first_name;
			proxy.user.last_name = props.user.last_name;
			proxy.user.email = props.user.email;
		}
	};

	onMounted(async() => {
		await cacheUserData().then(async() => {
			await nextTick(async() => {
				await showLoginAlert();
			});
		});
	});
</script>