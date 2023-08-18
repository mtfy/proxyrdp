<template>
	<div class="bg-theme-background-paper flex flex-col flex-wrap flex-grow w-full max-w-[100%] p-0 m-0 relative min-h-screen h-[100%]">
		<div class="flex flex-col w-full max-w-[100%] p-0 m-0 relative">
			<ClientHeader @sidebarButton="handleSidebar" :user="props.user" />
			<div class="motify-clientarea-full-height font-monsterrat flex flex-col p-0 m-0 max-w-[100%] w-full relative top-[56px] md:top-[72px]">
				<main class="flex flex-col max-w-[1440px] w-full my-0 mx-auto p-0 lg:flex-row">
					<div class="motify-clientarea-sidebar flex flex-col" :class="(!proxy.sidebar) ? '' : 'motify--expanded'">
						<div class="flex flex-col fixed w-full lg:w-[240px] lg:max-w-[240px]">
							<div class="flex flex-col fixed w-full lg:w-[240px] p-0 m-0 mt-[38px] xl:mt-[50px]">
								<nav class="flex flex-col w-full gap-y-[4px] motify-sidebar-full-height overflow-x-hidden overflow-y-auto p-[8px] pt-0 select-none">
									<Link href="/clientarea/" class="flex flex-row w-full items-center justify-start gap-[4px] font-medium no-underline py-[8px] px-[16px] whitespace-no-wrap font-motify transition-colors duration-100 leading-[24px] text-[14px] rounded-lg select-none" :class="( props.activePage === 0 ? 'text-[#0A0A0A] bg-[#D1D9E4]' : 'text-[#5A6372] bg-transparent hover:text-[#0A0A0A] hover:bg-[#D1D9E4]')">
										<div class="flex flex-col pointer-events-none select-none p-0 m-0"><svg xmlns="http://www.w3.org/2000/svg" role="img" class="inline-flex pointer-events-none select-none p-0 m-0" width="14px" height="14px" viewBox="0 0 24 24" fill="none"><path d="M2 13L11.293 3.70697C11.6835 3.31659 12.3165 3.31659 12.707 3.70697L22 13H20V21C20 21.5523 19.5523 22 19 22H14V15H10V22H5C4.44772 22 4 21.5523 4 21V13H2Z" fill="currentColor"/></svg></div>
										<div class="flex flex-col capitalize select-none">Dashboard</div>
									</Link>
									<Link href="/clientarea/order" class="flex flex-row w-full items-center justify-start gap-[4px] font-medium no-underline py-[8px] px-[16px] whitespace-no-wrap font-motify transition-colors duration-100 leading-[24px] text-[14px] rounded-lg" :class="( props.activePage === 1 ? 'text-[#0A0A0A] bg-[#D1D9E4]' : 'text-[#5A6372] bg-transparent hover:text-[#0A0A0A] hover:bg-[#D1D9E4]')">
										<div class="flex flex-col pointer-events-none select-none p-0 m-0"><svg xmlns="http://www.w3.org/2000/svg" role="img" class="inline-flex pointer-events-none select-none p-0 m-0" width="14px" height="14px" fill="currentColor" viewBox="0 0 16 16"><path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/></svg></div>
										<div class="flex flex-col capitalize select-none">Order</div>
									</Link>
									<Link href="/clientarea/invoices" class="flex flex-row w-full items-center justify-start gap-[4px] font-medium no-underline py-[8px] px-[16px] whitespace-no-wrap font-motify transition-colors duration-100 leading-[24px] text-[14px] rounded-lg" :class="( props.activePage === 5 ? 'text-[#0A0A0A] bg-[#D1D9E4]' : 'text-[#5A6372] bg-transparent hover:text-[#0A0A0A] hover:bg-[#D1D9E4]')">
										<div class="flex flex-col pointer-events-none select-none p-0 m-0"><svg xmlns="http://www.w3.org/2000/svg" role="img" class="inline-flex pointer-events-none select-none p-0 m-0" fill="currentColor" width="14px" height="14px" viewBox="0 0 384 512"><path d="M384 128h-128V0L384 128zM256 160H384v304c0 26.51-21.49 48-48 48h-288C21.49 512 0 490.5 0 464v-416C0 21.49 21.49 0 48 0H224l.0039 128C224 145.7 238.3 160 256 160zM64 88C64 92.38 67.63 96 72 96h80C156.4 96 160 92.38 160 88v-16C160 67.63 156.4 64 152 64h-80C67.63 64 64 67.63 64 72V88zM72 160h80C156.4 160 160 156.4 160 152v-16C160 131.6 156.4 128 152 128h-80C67.63 128 64 131.6 64 136v16C64 156.4 67.63 160 72 160zM197.5 316.8L191.1 315.2C168.3 308.2 168.8 304.1 169.6 300.5c1.375-7.812 16.59-9.719 30.27-7.625c5.594 .8438 11.73 2.812 17.59 4.844c10.39 3.594 21.83-1.938 25.45-12.34c3.625-10.44-1.891-21.84-12.33-25.47c-7.219-2.484-13.11-4.078-18.56-5.273V248c0-11.03-8.953-20-20-20s-20 8.969-20 20v5.992C149.6 258.8 133.8 272.8 130.2 293.7c-7.406 42.84 33.19 54.75 50.52 59.84l5.812 1.688c29.28 8.375 28.8 11.19 27.92 16.28c-1.375 7.812-16.59 9.75-30.31 7.625c-6.938-1.031-15.81-4.219-23.66-7.031l-4.469-1.625c-10.41-3.594-21.83 1.812-25.52 12.22c-3.672 10.41 1.781 21.84 12.2 25.53l4.266 1.5c7.758 2.789 16.38 5.59 25.06 7.512V424c0 11.03 8.953 20 20 20s20-8.969 20-20v-6.254c22.36-4.793 38.21-18.53 41.83-39.43C261.3 335 219.8 323.1 197.5 316.8z"/></svg></div>
										<div class="flex flex-col capitalize select-none">Invoices</div>
									</Link>
									<Link href="/clientarea/servers" class="flex flex-row w-full items-center justify-start gap-[4px] font-medium no-underline py-[8px] px-[16px] whitespace-no-wrap font-motify transition-colors duration-100 leading-[24px] text-[14px] rounded-lg" :class="( props.activePage === 2 ? 'text-[#0A0A0A] bg-[#D1D9E4]' : 'text-[#5A6372] bg-transparent hover:text-[#0A0A0A] hover:bg-[#D1D9E4]')">
										<div class="flex flex-col pointer-events-none select-none p-0 m-0"><svg xmlns="http://www.w3.org/2000/svg" role="img" class="inline-flex pointer-events-none select-none p-0 m-0" width="14px" height="14px" fill="currentColor" viewBox="0 0 16 16"><path d="M1.333 2.667C1.333 1.194 4.318 0 8 0s6.667 1.194 6.667 2.667V4c0 1.473-2.985 2.667-6.667 2.667S1.333 5.473 1.333 4V2.667z"/><path d="M1.333 6.334v3C1.333 10.805 4.318 12 8 12s6.667-1.194 6.667-2.667V6.334a6.51 6.51 0 0 1-1.458.79C11.81 7.684 9.967 8 8 8c-1.966 0-3.809-.317-5.208-.876a6.508 6.508 0 0 1-1.458-.79z"/><path d="M14.667 11.668a6.51 6.51 0 0 1-1.458.789c-1.4.56-3.242.876-5.21.876-1.966 0-3.809-.316-5.208-.876a6.51 6.51 0 0 1-1.458-.79v1.666C1.333 14.806 4.318 16 8 16s6.667-1.194 6.667-2.667v-1.665z"/></svg></div>
										<div class="flex flex-col capitalize select-none">My servers</div>
									</Link>
									<Link href="/clientarea/proxies" class="flex flex-row w-full items-center justify-start gap-[4px] font-medium no-underline py-[8px] px-[16px] whitespace-no-wrap font-motify transition-colors duration-100 leading-[24px] text-[14px] rounded-lg" :class="( props.activePage === 3 ? 'text-[#0A0A0A] bg-[#D1D9E4]' : 'text-[#5A6372] bg-transparent hover:text-[#0A0A0A] hover:bg-[#D1D9E4]')">
										<div class="flex flex-col pointer-events-none select-none p-0 m-0"><svg xmlns="http://www.w3.org/2000/svg" role="img" class="inline-flex pointer-events-none select-none p-0 m-0" width="14px" height="14px" fill="currentColor" viewBox="0 0 24 24"><path d="M15.0127,9.3949l4.56982-4.56977L21,6.24261V2H16.75739l1.41088,1.41089L13.33405,8.24512A3.93757,3.93757,0,0,0,8.14288,10.9953H5.72009a2.00033,2.00033,0,1,0,.00507,2H8.14a3.94008,3.94008,0,0,0,5.20423,2.75647l4.83069,4.83069L16.75739,22H21V17.75732l-1.41089,1.41095-4.57043-4.57043a3.96651,3.96651,0,0,0,.84137-1.60254L18,13v2l3-3L18,9v2l-2.14288-.0047A3.96785,3.96785,0,0,0,15.0127,9.3949Z"/></svg></div>
										<div class="flex flex-col capitalize select-none">My proxies</div>
									</Link>
									<Link href="/clientarea/wallet" class="flex flex-row w-full items-center justify-start gap-[4px] font-medium no-underline py-[8px] px-[16px] whitespace-no-wrap font-motify transition-colors duration-100 leading-[24px] text-[14px] rounded-lg" :class="( props.activePage === 6 ? 'text-[#0A0A0A] bg-[#D1D9E4]' : 'text-[#5A6372] bg-transparent hover:text-[#0A0A0A] hover:bg-[#D1D9E4]')">
										<div class="flex flex-col pointer-events-none select-none p-0 m-0"><svg xmlns="http://www.w3.org/2000/svg" role="img" class="inline-flex pointer-events-none select-none p-0 m-0" fill="currentColor" width="14px" height="14px" viewBox="0 0 24 24"><path d="M21 18v1c0 1.1-.9 2-2 2H5c-1.11 0-2-.9-2-2V5c0-1.1.89-2 2-2h14c1.1 0 2 .9 2 2v1h-9c-1.11 0-2 .9-2 2v8c0 1.1.89 2 2 2h9zm-9-2h10V8H12v8zm4-2.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"/></svg></div>
										<div class="flex flex-col capitalize select-none">Wallet</div>
									</Link>
									<Link href="/clientarea/account" class="flex flex-row w-full items-center justify-start gap-[4px] font-medium no-underline py-[8px] px-[16px] whitespace-no-wrap font-motify transition-colors duration-100 leading-[24px] text-[14px] rounded-lg" :class="( props.activePage === 4 ? 'text-[#0A0A0A] bg-[#D1D9E4]' : 'text-[#5A6372] bg-transparent hover:text-[#0A0A0A] hover:bg-[#D1D9E4]')">
										<div class="flex flex-col pointer-events-none select-none p-0 m-0"><svg xmlns="http://www.w3.org/2000/svg" role="img" class="inline-flex pointer-events-none select-none p-0 m-0" fill="currentColor" width="14px" height="14px" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"/><path d="M12 14v8H4a8 8 0 0 1 8-8zm0-1c-3.315 0-6-2.685-6-6s2.685-6 6-6 6 2.685 6 6-2.685 6-6 6zm2.595 5.812a3.51 3.51 0 0 1 0-1.623l-.992-.573 1-1.732.992.573A3.496 3.496 0 0 1 17 14.645V13.5h2v1.145c.532.158 1.012.44 1.405.812l.992-.573 1 1.732-.992.573a3.51 3.51 0 0 1 0 1.622l.992.573-1 1.732-.992-.573a3.496 3.496 0 0 1-1.405.812V22.5h-2v-1.145a3.496 3.496 0 0 1-1.405-.812l-.992.573-1-1.732.992-.572zM18 17a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/></g></svg></div>
										<div class="flex flex-col capitalize select-none">Account</div>
									</Link>
								</nav>
							</div>
						</div>
					</div>
					<div class="flex flex-col flex-grow flex-shrink basis-0 p-[16px] pt-[24px]">
						<article class="flex flex-col relative bg-white rounded-2xl">
							<div class="flex flex-col relative w-full m-0 p-[18px] md:p-[24px] pb-0">
								<slot />
							</div>
						</article>
					</div>
				</main>
			</div>
		</div>
	</div>
</template>

<script setup>
	import ClientHeader from '../Components/ClientHeader.vue';
	import { ref, onMounted, reactive } from 'vue';
	import { Link } from '@inertiajs/vue3';

	const props = defineProps({
		user: Object,
		activePage: Number
	}),

	proxy = reactive({
		sidebar: false
	}),
	
	sidebar = ref(null),

	handleSidebar = (hidden) => {
		proxy.sidebar = hidden;
	}

	onMounted(async() => {

	});
	
</script>