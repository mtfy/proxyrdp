<template>
	<ClientLayout :activePage="0">
		<div class="flex flex-col w-full p-0 m-0">
			<span class="flex flex-col font-medium whitespace-pre-wrap text-[20px] leading-[24px]">Hello, {{ formatName(user.username) }}!</span>
		</div>
		<div class="flex flex-col w-full p-0 m-0 mt-[8px]">
			<span class="flex flex-col text-[14px] leading-[22px] text-theme-primary-foreground-clientarea-alt">Welcome to your clientarea. Let&#x2019;s get started!</span>
		</div>
		<div class="flex flex-col w-full relative p-0 m-0 mt-[28px]">
			<div class="flex flex-col w-full relative">
				<div class="grid grid-cols-1 md:grid-cols-3 relative gap-2">
					<Link href="/clientarea/services" class="flex flex-col group w-full py-[12px] px-[20px] rounded-[4px] relative transition-colors duration-300 bg-[#FFFFFF] hover:bg-[#F2F4F920] border-[1px] border-[#D1D9E4] group-hover:border-[#DDDDDD]">
						<div class="flex flex-col w-full relative">
							<div class="flex flex-col w-full relative">
								<div class="flex flex-row w-full relative">
									<div class="flex flex-col w-9/12">
										<span class="flex flex-col transition-colors duration-300 font-motify leading-normal text-[24px] md:text-[36px] text-[#0A0A0A] group-hover:text-[#0A0A0A75]">{{ props.statistics.services }}</span>
									</div>
									<div class="flex flex-col w-3/12 justify-center items-end select-none pointer-events-none">
										<svg xmlns="http://www.w3.org/2000/svg" role="img" class="inline-flex transition-colors duration-300 text-[#0A0A0A] group-hover:text-[#0A0A0A75] pointer-events-none select-none p-0 m-0" width="24px" height="24px" fill="currentColor" viewBox="0 0 16 16"><path d="M1.333 2.667C1.333 1.194 4.318 0 8 0s6.667 1.194 6.667 2.667V4c0 1.473-2.985 2.667-6.667 2.667S1.333 5.473 1.333 4V2.667z"></path><path d="M1.333 6.334v3C1.333 10.805 4.318 12 8 12s6.667-1.194 6.667-2.667V6.334a6.51 6.51 0 0 1-1.458.79C11.81 7.684 9.967 8 8 8c-1.966 0-3.809-.317-5.208-.876a6.508 6.508 0 0 1-1.458-.79z"></path><path d="M14.667 11.668a6.51 6.51 0 0 1-1.458.789c-1.4.56-3.242.876-5.21.876-1.966 0-3.809-.316-5.208-.876a6.51 6.51 0 0 1-1.458-.79v1.666C1.333 14.806 4.318 16 8 16s6.667-1.194 6.667-2.667v-1.665z"></path></svg>
									</div>
								</div>
							</div>
							<div class="flex flex-col w-full relative">
								<span class="flex flex-col transition-colors duration-300 font-motify leading-normal text-[16px] md:text-[20px] text-[#5A6372] group-hover:text-[#5A637290]">Services</span>
							</div>
						</div>
					</Link>
					<Link href="/clientarea/wallet" class="flex flex-col group w-full py-[12px] px-[20px] rounded-[4px] relative transition-colors duration-300 bg-[#FFFFFF] hover:bg-[#F2F4F920] border-[1px] border-[#D1D9E4] group-hover:border-[#DDDDDD]">
						<div class="flex flex-col w-full relative">
							<div class="flex flex-col w-full relative">
								<div class="flex flex-row w-full relative">
									<div class="flex flex-col w-9/12">
										<span class="flex flex-row items-center transition-colors duration-300 font-motify leading-normal text-[24px] md:text-[36px] text-[#0A0A0A] group-hover:text-[#0A0A0A75]"><span class="flex flex-col items-center">{{ (parseFloat( user.balance ) || 0).toFixed(2) }}</span><span class="flex flex-col items-center tracking-normal text-[18px] md:text-[28px] font-inter">&#xa0;&#x20ac;</span></span>
									</div>
									<div class="flex flex-col w-3/12 justify-center items-end select-none pointer-events-none">
										<svg xmlns="http://www.w3.org/2000/svg" role="img" class="inline-flex transition-colors duration-300 text-[#0A0A0A] group-hover:text-[#0A0A0A75] pointer-events-none select-none p-0 m-0" width="24px" height="24px" fill="currentColor" viewBox="0 0 16 16"><path d="M5.5 9.511c.076.954.83 1.697 2.182 1.785V12h.6v-.709c1.4-.098 2.218-.846 2.218-1.932 0-.987-.626-1.496-1.745-1.76l-.473-.112V5.57c.6.068.982.396 1.074.85h1.052c-.076-.919-.864-1.638-2.126-1.716V4h-.6v.719c-1.195.117-2.01.836-2.01 1.853 0 .9.606 1.472 1.613 1.707l.397.098v2.034c-.615-.093-1.022-.43-1.114-.9H5.5zm2.177-2.166c-.59-.137-.91-.416-.91-.836 0-.47.345-.822.915-.925v1.76h-.005zm.692 1.193c.717.166 1.048.435 1.048.91 0 .542-.412.914-1.135.982V8.518l.087.02z"/><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="M8 13.5a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11zm0 .5A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"/></svg>
									</div>
								</div>
							</div>
							<div class="flex flex-col w-full relative">
								<span class="flex flex-col transition-colors duration-300 font-motify leading-normal text-[16px] md:text-[20px] text-[#5A6372] group-hover:text-[#5A637290]">Balance</span>
							</div>
						</div>
					</Link>
					<Link href="/clientarea/invoices" class="flex flex-col group w-full py-[12px] px-[20px] rounded-[4px] relative transition-colors duration-300 bg-[#FFFFFF] hover:bg-[#F2F4F920] border-[1px] border-[#D1D9E4] group-hover:border-[#DDDDDD]">
						<div class="flex flex-col w-full relative">
							<div class="flex flex-col w-full relative">
								<div class="flex flex-row w-full relative">
									<div class="flex flex-col w-9/12">
										<span class="flex flex-col transition-colors duration-300 font-motify leading-normal text-[24px] md:text-[36px] text-[#0A0A0A] group-hover:text-[#0A0A0A75]">{{ props.statistics.invoices }}</span>
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
		<div class="flex flex-col w-full relative bg-white border border-[#D1D9E4] rounded-xl p-[24px] m-0 mt-[20px] space-y-[20px]">
			<div class="flex flex-col w-full p-0 m-0">
				<span class="flex flex-col font-medium whitespace-pre-wrap text-[18px] leading-[28px] capitalize">Account overview</span>
			</div>
			<div class="flex flex-col w-full">
				<table class="table-auto text-left font-motify leading-loose text-[14px] md:text-[16px] lg:max-w-[50%]">
					<tbody>
						<tr>
							<th scope="col">ID</th>
							<td class="whitespace-no-wrap">{{ user.id }}</td>
						</tr>
						<tr>
							<th scope="col">Created</th>
							<td class="whitespace-no-wrap">{{ formatDate(user.created_at) }}</td>
						</tr>
						<tr>
							<th scope="col">Username</th>
							<td class="whitespace-no-wrap">{{ user.username }}</td>
						</tr>
						<tr>
							<th scope="col">Email</th>
							<td class="whitespace-no-wrap">{{ user.email }}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</ClientLayout>
</template>
<script setup>
	import ClientLayout from '../../Layouts/ClientLayout.vue';
	import { computed, onMounted } from 'vue';
	import { Link, usePage } from '@inertiajs/vue3';
	import moment from 'moment';

	const page = usePage(),
	user = computed(() => page.props.user),

	props = defineProps({
		statistics	:	Object
	}),

	formatName = (name) => {
		var buf = name.charAt(0).toUpperCase() + name.slice(1).toLowerCase();
		return buf;
	},

	formatDate = (date) => {
		var d = new Date(0);
		d.setUTCSeconds((parseInt(date) || 0));
		return moment(d.toISOString()).format('Do of MMM, YYYY');
	};

	onMounted(async() => {});
</script>