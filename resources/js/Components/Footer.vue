<template>
	<footer class="bg-theme-primary-800 relative flex flex-col w-full flex-wrap p-0 m-0 py-[40px]">
		<div class="motify-container relative w-full max-w-[100%] p-0 m-0">
			<div class="flex flex-col w-full justify-center items-center md:items-start md:justify-start p-0 m-0 relative px-[16px] md:px-0">
				<div role="banner">
					<Link href="/" class="inline-flex align-center p-0 m-0 font-motify font-semibold tracking-wide uppercase w-auto text-gray-50 transition-colors ease-in-out duration-300 hover:text-gray-300 text-[24px] md:text-[28px] leading-[32px]">
						ProxyRDP
					</Link>
				</div>
			</div>
			<div class="flex flex-col w-full justify-start p-0 m-0 mt-1 relative">
				<div class="flex flex-row gap-x-5">
					<div class="flex flex-col">
						<p class="text-gray-100 p-0 m-0 font-motify text-sm">Copyright &#xa9; Motify, 2023.</p>
					</div>
				</div>
			</div>
		</div>
	</footer>
</template>

<script setup>
	import { Link } from '@inertiajs/vue3';
</script>