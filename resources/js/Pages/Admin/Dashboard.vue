<template>
	<ClientLayout :activePage="6">
		<div class="flex flex-col w-full p-0 m-0">
			<span class="flex flex-col font-medium whitespace-pre-wrap text-[20px] leading-[24px] capitalize">Welcome back, {{ user.first_name }}!</span>
		</div>
		<div class="flex flex-col w-full p-0 m-0 mt-[8px]">
			<span class="flex flex-col text-[14px] leading-[22px] text-theme-primary-foreground-clientarea-alt">Welcome to the administrative dashboard for ProxyRDP. Let&#x2019;s get started!</span>
		</div>
		<div class="flex flex-col w-full relative p-0 m-0 mt-[28px]">
			<div class="flex flex-col w-full relative">
				<div class="grid grid-cols-1 md:grid-cols-3 relative gap-3 md:gap-5">
					<div class="flex flex-col group select-none w-full py-[12px] px-[20px] rounded-[4px] relative transition-colors duration-300 bg-[#FFFFFF] hover:bg-[#F2F4F920] border-[1px] border-[#D1D9E4] group-hover:border-[#DDDDDD]">
						<div class="flex flex-col w-full relative">
							<div class="flex flex-col w-full relative">
								<div class="flex flex-row w-full relative">
									<div class="flex flex-col w-9/12">
										<span class="flex flex-col transition-colors duration-300 font-motify leading-normal text-[24px] md:text-[36px] text-[#0A0A0A] group-hover:text-[#0A0A0A75]">{{ numeric.format((parseInt(page.props.statistics.users) || 0)) }}</span>
									</div>
									<div class="flex flex-col w-3/12 justify-center items-end select-none pointer-events-none">
										<svg xmlns="http://www.w3.org/2000/svg" role="img" class="inline-flex transition-colors duration-300 text-indigo-400 group-hover:text-indigo-400/75 pointer-events-none select-none p-0 m-0" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><path d="M25.6,115.2A67.8,67.8,0,0,1,53,93.5a40,40,0,1,1,54,0,68.1,68.1,0,0,1,21,14.3,68.1,68.1,0,0,1,21-14.3,40,40,0,1,1,54,0,67.8,67.8,0,0,1,27.4,21.7,8,8,0,0,1-1.6,11.2,8.1,8.1,0,0,1-11.2-1.6,52,52,0,0,0-83.2,0h0l-.6.6h-.1l-.5.5-.3.2a.1.1,0,0,1-.1.1l-.3.2-.3.2-.5.3h-.2l-1.7.6h-3.3l-.8-.2h-.3l-.9-.4-.3-.2a4.7,4.7,0,0,1-.9-.6h-.1l-.3-.3h-.2c-.2-.2-.4-.3-.5-.5h-.1l-.6-.7a52,52,0,0,0-83.1.1A8,8,0,0,1,32,128a7.7,7.7,0,0,1-4.8-1.6A8,8,0,0,1,25.6,115.2ZM203,197.5a40,40,0,1,0-54,0,68.1,68.1,0,0,0-21,14.3,68.1,68.1,0,0,0-21-14.3,40,40,0,1,0-54,0,67.8,67.8,0,0,0-27.4,21.7A8,8,0,0,0,32,232H224a8,8,0,0,0,6.4-12.8A67.8,67.8,0,0,0,203,197.5Z"/></svg>
									</div>
								</div>
							</div>
							<div class="flex flex-col w-full relative">
								<span class="inline-flex select-none transition-colors tracking-tightest duration-300 font-motify leading-normal text-[16px] md:text-[20px] text-[#5A6372] group-hover:text-[#5A637290]">Users</span>
							</div>
						</div>
					</div>
					<div class="flex flex-col group select-none w-full py-[12px] px-[20px] rounded-[4px] relative transition-colors duration-300 bg-[#FFFFFF] hover:bg-[#F2F4F920] border-[1px] border-[#D1D9E4] group-hover:border-[#DDDDDD]">
						<div class="flex flex-col w-full relative">
							<div class="flex flex-col w-full relative">
								<div class="flex flex-row w-full relative">
									<div class="flex flex-col w-9/12">
										<span class="flex flex-col transition-colors duration-300 font-motify leading-normal text-[24px] md:text-[36px] text-[#0A0A0A] group-hover:text-[#0A0A0A75]">0</span>
									</div>
									<div class="flex flex-col w-3/12 justify-center items-end select-none pointer-events-none">
										<svg xmlns="http://www.w3.org/2000/svg" role="img" class="inline-flex transition-colors duration-300 text-amber-400 group-hover:text-amber-400/50 pointer-events-none select-none p-0 m-0" width="24px" height="24px" fill="currentColor" viewBox="0 0 24 24"><path d="M7,18c-1.1,0-1.99,0.9-1.99,2S5.9,22,7,22s2-0.9,2-2S8.1,18,7,18z M17,18c-1.1,0-1.99,0.9-1.99,2s0.89,2,1.99,2s2-0.9,2-2 S18.1,18,17,18z M8.1,13h7.45c0.75,0,1.41-0.41,1.75-1.03L21,4.96L19.25,4l-3.7,7H8.53L4.27,2H1v2h2l3.6,7.59l-1.35,2.44 C4.52,15.37,5.48,17,7,17h12v-2H7L8.1,13z M12,2l4,4l-4,4l-1.41-1.41L12.17,7L8,7l0-2l4.17,0l-1.59-1.59L12,2z"></path></svg>
									</div>
								</div>
							</div>
							<div class="flex flex-col w-full relative">
								<span class="inline-flex select-none transition-colors tracking-tightest duration-300 font-motify leading-normal text-[16px] md:text-[20px] text-[#5A6372] group-hover:text-[#5A637290]">Orders</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</ClientLayout>
</template>
<script setup>
	import ClientLayout from '../../Layouts/ClientLayout.vue';
	import { reactive, onMounted, computed } from 'vue';
	import { usePage } from '@inertiajs/vue3';

	const props = defineProps({}),

	page = usePage(),
	user = computed(() => page.props.user),

	locale = ('object' === typeof navigator && null !== navigator && 'language' in navigator && 'string' === typeof navigator.language) ? navigator.language : 'en-US',

	numeric = new Intl.NumberFormat(locale),

	proxy = reactive();

	onMounted(async() => {
		
	});
</script>