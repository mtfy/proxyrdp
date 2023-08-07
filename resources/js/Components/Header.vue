<template>
	<header class="motify-header flex flex-col max-w-[100%] w-full bg-theme-primary-500 min-h-[56px] max-h-[56px] h-[100%] p-0 m-0 transition-all duration-300 ease-in-out fixed z-[10]" :class="proxy.scrollY > 56 ? 'motify-header-shadow' : ''" v-if="proxy.window.width < 1024">
		<div class="flex flex-row w-full m-0 px-[16px] py-0 max-h-[56px] min-h-[56px] h-[100%] relative justify-between">
			<div class="flex flex-col align-center justify-center p-0 m-0 relative">
				<div role="banner">
					<Link href="/" class="inline-flex align-center p-0 m-0 font-motify font-semibold tracking-wide uppercase text-xl leading-9 w-auto text-gray-50 transition-colors ease-in-out duration-300 hover:text-gray-300">
						ProxyRDP
					</Link>
				</div>
			</div>
			<div class="flex flex-col align-center justify-center p-0 m-0 relative">
				<button type="button" class="flex flex-col leading-[36px] min-h-[42px] max-h-[42px] h-[42px] max-w-[42px] w-[42px] items-center justify-center">
					<div class="flex flex-col items-center justify-center">
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0,0,256.00027,255.99979" width="28px" height="28px" fill-rule="nonzero"><g fill="#ffffff" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(5.12,5.12)"><path d="M5,8c-0.72127,-0.0102 -1.39216,0.36875 -1.75578,0.99175c-0.36361,0.623 -0.36361,1.39351 0,2.01651c0.36361,0.623 1.0345,1.00195 1.75578,0.99175h40c0.72127,0.0102 1.39216,-0.36875 1.75578,-0.99175c0.36361,-0.623 0.36361,-1.39351 0,-2.01651c-0.36361,-0.623 -1.0345,-1.00195 -1.75578,-0.99175zM5,23c-0.72127,-0.0102 -1.39216,0.36875 -1.75578,0.99175c-0.36361,0.623 -0.36361,1.39351 0,2.01651c0.36361,0.623 1.0345,1.00195 1.75578,0.99175h40c0.72127,0.0102 1.39216,-0.36875 1.75578,-0.99175c0.36361,-0.623 0.36361,-1.39351 0,-2.01651c-0.36361,-0.623 -1.0345,-1.00195 -1.75578,-0.99175zM5,38c-0.72127,-0.0102 -1.39216,0.36875 -1.75578,0.99175c-0.36361,0.623 -0.36361,1.39351 0,2.01651c0.36361,0.623 1.0345,1.00195 1.75578,0.99175h40c0.72127,0.0102 1.39216,-0.36875 1.75578,-0.99175c0.36361,-0.623 0.36361,-1.39351 0,-2.01651c-0.36361,-0.623 -1.0345,-1.00195 -1.75578,-0.99175z"></path></g></g></svg>
					</div>
				</button>
			</div>
		</div>
	</header>


	<header class="motify-header flex flex-col max-w-[100%] w-full bg-theme-primary-500 min-h-[72px] max-h-[72px] h-[100%] transition-all duration-300 ease-in-out p-0 m-0 fixed z-[10]" :class="proxy.scrollY > 72 ? 'motify-header-shadow' : ''" v-else>
		<div class="flex flex-row w-full m-0 py-[16px] px-[100px] max-h-[72px] min-h-[72px] h-[100%] relative justify-between">
			<div class="flex flex-col align-center justify-center w-8/12 p-0 m-0 relative">
				<div role="banner">
					<Link href="/" class="inline-flex align-center p-0 m-0 font-motify font-semibold tracking-wide uppercase text-xl leading-9 w-auto text-gray-50 transition-colors ease-in-out duration-300 hover:text-gray-300">
						ProxyRDP
					</Link>
				</div>
			</div>
			<div class="flex flex-col align-center justify-center w-8/12 p-0 m-0 relative">
				<nav class="flex flex-col w-full m-0 p-0">
					<ul class="flex flex-row space-x-10 w-full list-none font-motify">
						<li class="flex flex-col">
							<Link href="/" class="inline-flex align-center p-0 m-0 text-md font-bold text-gray-50 transition-colors ease-in-out duration-300 hover:text-gray-300">
								Home
							</Link>
						</li>
						<li class="flex flex-col">
							<Link href="/" class="inline-flex align-center p-0 m-0 text-md font-bold text-gray-50 transition-colors ease-in-out duration-300 hover:text-gray-300">
								Services
							</Link>
						</li>
						<li class="flex flex-col">
							<Link href="/" class="inline-flex align-center p-0 m-0 text-md font-bold text-gray-50 transition-colors ease-in-out duration-300 hover:text-gray-300">
								Contact
							</Link>
						</li>
					</ul>
				</nav>
			</div>
			<div class="flex flex-col items-end justify-center w-2/12 p-0 m-0 relative">
				<div class="flex flex-col items-end	w-full m-0 p-0 float-right">
					<ul class="flex flex-row space-x-10 w-full list-none font-motify items-center">
						<li class="flex flex-col">
							<Link href="/" class="inline-flex align-center p-0 m-0 text-md font-bold text-gray-50 transition-colors ease-in-out duration-300 hover:text-gray-300">
								Login
							</Link>
						</li>
						<li class="flex flex-col">
							<Link href="/" class="flex flex-col align-center p-0 m-0 capitalize transition-colors ease-in-out duration-300 hover:text-gray-300">
								<button
									class="flex flex-col whitespace-nowrap py-[13px] px-[24px] text-[16px] font-bold leading-[14px] rounded-2xl transition-all ease-in-out duration-300 bg-theme-highlight-500 text-theme-primary-500 hover:bg-theme-highlight-400 hover:text-theme-primary-600"
									type="button"
								>
									Sign Up
								</button>
							</Link>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</header>
</template>

<script setup>
	import isMobile from '../Helpers/MobileDetect';
	import { reactive, onMounted } from 'vue';
	import { Link } from '@inertiajs/vue3';

	const proxy = reactive({
		window		:	{
			height	:	0,
			width	:	0
		},
		scrollY		:	0
	}),

	handleResize = (event) => {
		if ('screen' in window && null !== window.screen && 'object' === typeof window.screen) {
			if ('width' in window.screen && null !== window.screen.width && 'number' === typeof window.screen.width) {
				proxy.window.width = window.screen.width;
			}

			if ('height' in window.screen && null !== window.screen.height && 'number' === typeof window.screen.height) {
				proxy.window.height = window.screen.height;
			}
		}
	},
	
	handleScroll = (event) => {
		if ('scrollY' in window && null !== window.scrollY && 'number' === typeof window.scrollY) {
			proxy.scrollY = window.scrollY;
		}
	};

	onMounted(() => {
		window.addEventListener('resize', handleResize);
		window.addEventListener('scroll', handleScroll);
		handleResize();
		handleScroll();
	});
</script>