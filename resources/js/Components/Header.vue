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
			<div class="flex flex-col items-center justify-center p-0 m-0 relative">
				<button type="button" class="flex flex-col leading-[36px] min-h-[42px] max-h-[42px] h-[42px] max-w-[42px] w-[42px] items-center justify-center" v-on:click="handleMobileMenu">
					<div class="flex flex-col items-center justify-center">
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" role="img" class="inline-flex select-none pointer-events-none text-white transition-all duration-300" viewBox="0,0,256.00027,255.99979" width="28px" height="28px" fill-rule="nonzero" v-if="false === proxy.mobileMenu"><g fill="currentColor" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(5.12,5.12)"><path d="M5,8c-0.72127,-0.0102 -1.39216,0.36875 -1.75578,0.99175c-0.36361,0.623 -0.36361,1.39351 0,2.01651c0.36361,0.623 1.0345,1.00195 1.75578,0.99175h40c0.72127,0.0102 1.39216,-0.36875 1.75578,-0.99175c0.36361,-0.623 0.36361,-1.39351 0,-2.01651c-0.36361,-0.623 -1.0345,-1.00195 -1.75578,-0.99175zM5,23c-0.72127,-0.0102 -1.39216,0.36875 -1.75578,0.99175c-0.36361,0.623 -0.36361,1.39351 0,2.01651c0.36361,0.623 1.0345,1.00195 1.75578,0.99175h40c0.72127,0.0102 1.39216,-0.36875 1.75578,-0.99175c0.36361,-0.623 0.36361,-1.39351 0,-2.01651c-0.36361,-0.623 -1.0345,-1.00195 -1.75578,-0.99175zM5,38c-0.72127,-0.0102 -1.39216,0.36875 -1.75578,0.99175c-0.36361,0.623 -0.36361,1.39351 0,2.01651c0.36361,0.623 1.0345,1.00195 1.75578,0.99175h40c0.72127,0.0102 1.39216,-0.36875 1.75578,-0.99175c0.36361,-0.623 0.36361,-1.39351 0,-2.01651c-0.36361,-0.623 -1.0345,-1.00195 -1.75578,-0.99175z"></path></g></g></svg>
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" role="img" class="inline-flex select-none pointer-events-none text-white transition-all duration-300" viewBox="0,0,256.00018,255.99963" width="28px" height="28px" fill-rule="nonzero" v-else><g fill="currentColor" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none"><g transform="scale(5.12,5.12)"><path d="M7.71875,6.28125l-1.4375,1.4375l17.28125,17.28125l-17.28125,17.28125l1.4375,1.4375l17.28125,-17.28125l17.28125,17.28125l1.4375,-1.4375l-17.28125,-17.28125l17.28125,-17.28125l-1.4375,-1.4375l-17.28125,17.28125z"></path></g></g></svg>
					</div>
				</button>
			</div>
		</div>
		<div class="flex flex-col w-full bg-theme-primary-500 absolute motify-mobile-menu-animation left-0 top-[100%]" :class="(proxy.mobileMenu !== false) ? 'max-h-[399px]' : 'max-h-[0px]'" :aria-hidden="false === proxy.mobileMenu">
			<ul role="list" class="flex flex-col list-none motify-mobile-menu-animation relative" :class="(proxy.mobileMenu !== false) ? 'max-h-[399px]' : 'max-h-[0px]'" :aria-hidden="false === proxy.mobileMenu">
				<li class="flex flex-col w-full min-h-[20px] relative">
					<Link href="/" class="flex flex-col w-full text-[18px] leading-[20px] align-center p-0 m-0 text-md text-gray-50 transition-colors ease-in-out duration-300 hover:text-gray-300 px-[20px] py-[12px]" :class="(!proxy.mobileMenu) ? 'invisible' : ''" :aria-hidden="false === proxy.mobileMenu">Home</Link>
				</li>
				<li class="flex flex-col w-full min-h-[20px] relative">
					<Link href="/" class="flex flex-col w-full text-[18px] leading-[20px] align-center p-0 m-0 text-md text-gray-50 transition-colors ease-in-out duration-300 hover:text-gray-300 px-[20px] py-[12px]" :class="(!proxy.mobileMenu) ? 'invisible' : ''" :aria-hidden="false === proxy.mobileMenu">Services</Link>
				</li>
				<li class="flex flex-col w-full min-h-[20px] relative">
					<Link href="/" class="flex flex-col w-full text-[18px] leading-[20px] align-center p-0 m-0 text-md text-gray-50 transition-colors ease-in-out duration-300 hover:text-gray-300 px-[20px] py-[12px]" :class="(!proxy.mobileMenu) ? 'invisible' : ''" :aria-hidden="false === proxy.mobileMenu">Contacts</Link>
				</li>
				<li class="flex flex-col w-full min-h-[20px] relative" v-if="user.guest">
					<Link href="/clientarea/login" class="flex flex-col w-full text-[18px] leading-[20px] align-center p-0 m-0 text-md text-gray-50 transition-colors ease-in-out duration-300 hover:text-gray-300 px-[20px] py-[12px]" :class="(!proxy.mobileMenu) ? 'invisible' : ''" :aria-hidden="false === proxy.mobileMenu">Login</Link>
				</li>
				<li class="flex flex-col w-full min-h-[20px] relative" v-if="user.guest">
					<Link href="/clientarea/register" class="flex flex-col w-full text-[18px] leading-[20px] align-center p-0 m-0 text-md text-gray-50 transition-colors ease-in-out duration-300 hover:text-gray-300 px-[20px] py-[12px] capitalize" :class="(!proxy.mobileMenu) ? 'invisible' : ''" :aria-hidden="false === proxy.mobileMenu">Sign up</Link>
				</li>
				<li class="flex flex-col w-full min-h-[20px] relative">
					<Link href="/clientarea/" class="flex flex-col w-full text-[18px] leading-[20px] align-center p-0 m-0 text-md text-gray-50 transition-colors ease-in-out duration-300 hover:text-gray-300 px-[20px] py-[12px]" :class="(!proxy.mobileMenu) ? 'invisible' : ''" :aria-hidden="false === proxy.mobileMenu">Clientarea</Link>
				</li>
				<li class="flex flex-col w-full min-h-[20px] relative">
					<Link href="/clientarea/account" class="flex flex-col w-full text-[18px] leading-[20px] align-center p-0 m-0 text-md text-gray-50 transition-colors ease-in-out duration-300 hover:text-gray-300 px-[20px] py-[12px]" :class="(!proxy.mobileMenu) ? 'invisible' : ''" :aria-hidden="false === proxy.mobileMenu">Settings</Link>
				</li>
				<li class="flex flex-col w-full min-h-[20px] relative">
					<Link href="/logout" class="flex flex-col w-full text-[18px] leading-[20px] align-center p-0 m-0 text-md text-gray-50 transition-colors ease-in-out duration-300 hover:text-gray-300 px-[20px] py-[12px] capitalize" :class="(!proxy.mobileMenu) ? 'invisible' : ''" :aria-hidden="false === proxy.mobileMenu">Sign out</Link>
				</li>
			</ul>
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
					<ul class="flex flex-row space-x-10 w-full list-none font-motify items-center" v-show="user.guest">
						<li class="flex flex-col">
							<Link href="/clientarea/login" class="inline-flex align-center p-0 m-0 text-md font-bold text-gray-50 transition-colors ease-in-out duration-300 hover:text-gray-300">
								Login
							</Link>
						</li>
						<li class="flex flex-col">
							<Link href="/clientarea/register" class="flex flex-col align-center p-0 m-0 capitalize transition-colors ease-in-out duration-300 hover:text-gray-300">
								<button
									class="flex flex-col whitespace-nowrap py-[13px] px-[24px] text-[16px] font-bold leading-[14px] rounded-2xl transition-all ease-in-out duration-300 bg-theme-highlight-500 text-theme-primary-500 hover:bg-theme-highlight-400 hover:text-theme-primary-600"
									type="button"
								>
									Sign Up
								</button>
							</Link>
						</li>
					</ul>
					<ul class="flex flex-row space-x-10 w-full list-none font-motify items-center" v-show="!user.guest">
						<li class="flex flex-col relative min-w-[160px]" ref="refUserMenu">
							<div class="flex flex-col w-full relative">
								<span class="inline-block w-full" aria-expanded="false" aria-haspopup="listbox" role="combobox">
									<div class="flex flex-col w-full min-h-[40px] max-h-[40px] h-[40px] relative rounded-[4px]">
										<button type="button" class="flex flex-col w-full cursor-pointer items-center justify-center h-[40px] min-w-[40px] w-full py-[8px] px-[12px] border-0 whitespace-no-wrap text-white bg-transparent rounded-[12px] font-motify transition-colors duration-100 outline-0 z-[7997] hover:bg-theme-primary-800/50" @click="proxy.userMenu.hidden = !proxy.userMenu.hidden">
											<div class="flex flex-row justify-center items-center relative whitespace-no-wrap space-x-[16px] space-y-0 mr-[8px]">
												<div class="flex flex-col p-0 m-0 select-none leading-[0px]">
													<div class="inline-block m-0 p-0 relative min-h-[24px] max-h-[24px] max-w-[24px] min-w-[24px] w-[24px] h-[24px] select-none">
														<span class="inline-block m-0 p-0 overflow-hidden min-h-[24px] max-h-[24px] max-w-[24px] min-w-[24px] w-[24px] h-[24px] select-none"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" role="img" class="text-white inline-flex select-none pointer-events-none w-full max-h-[24px] max-w-[100%]" fill="currentColor" width="24px" height="24px" viewBox="0 0 45.532 45.532" xml:space="preserve"><g><path d="M22.766,0.001C10.194,0.001,0,10.193,0,22.766s10.193,22.765,22.766,22.765c12.574,0,22.766-10.192,22.766-22.765S35.34,0.001,22.766,0.001z M22.766,6.808c4.16,0,7.531,3.372,7.531,7.53c0,4.159-3.371,7.53-7.531,7.53c-4.158,0-7.529-3.371-7.529-7.53C15.237,10.18,18.608,6.808,22.766,6.808z M22.761,39.579c-4.149,0-7.949-1.511-10.88-4.012c-0.714-0.609-1.126-1.502-1.126-2.439c0-4.217,3.413-7.592,7.631-7.592h8.762c4.219,0,7.619,3.375,7.619,7.592c0,0.938-0.41,1.829-1.125,2.438C30.712,38.068,26.911,39.579,22.761,39.579z"/></g></svg></span>
													</div>
												</div>
												<div class="flex flex-col p-0 m-0 justify-center items-center relative">
													<span class="flex flex-col capitalize w-full font-motify text-white leading-[18px] truncate text-[12px] md:leading-[22px] md:text-[14px]">{{ user.first_name }}&#160;{{ user.last_name }}</span>
												</div>
												<div class="flex flex-col p-0 m-0 justify-center items-center relative">
													<div class="inline-flex m-0 p-0 relative min-h-[24px] max-h-[24px] max-w-[24px] min-w-[24px] w-[24px] h-[24px] select-none">
														<svg aria-hidden="true" role="img" class="text-white inline-flex select-none pointer-events-none w-full max-h-[24px] max-w-[100%] px-0 py-[4px]" width="24px" height="24px" viewBox="0 0 16 16" fill="currentColor"><path d="M5 5.586 3.586 7 8 11.414 12.414 7 11 5.586l-3 3z"></path></svg>
													</div>
												</div>
											</div>
										</button>
									</div>
								</span>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</header>
	<div class="fixed max-w-[100%] w-full min-h-screen max-h-screen h-screen transition-all duration-300 z-[7996]" v-if="!proxy.userMenu.hidden" @click="proxy.userMenu.hidden = !proxy.userMenu.hidden">
		<div class="flex flex-col p-[4px] max-w-[220px] w-full rounded-[8px] bg-theme-primary-700 motify-listbox-shadow fixed max-h-screen z-[7998]" :style="`left: ${(proxy.userMenu.pos.x - 20)}px; top: 72px;`" aria-orientation="vertical" role="listbox">
			<div class="flex flex-col w-full bg-transparent justify-center cursor-pointer items-center gap-[8px] no-underline rounded-[8px] m-0 p-0" role="option">
				<Link  href="/clientarea/account" class="flex flex-row items-start justify-start cursor-pointer select-none gap-[8px] whitespace-pre-wrap p-[8px] w-full font-motify text-white transition-colors duration-300 leading-[18px] text-[12px] md:leading-[22px] md:text-[14px] hover:text-white/75">
					<div class="flex flex-col select-none pointer-events-none">
						<svg aria-hidden="true" role="img" class="flex flex-col select-none pointer-events-none w-full max-h-[24px] max-w-[100%] px-0 py-[2px]" width="24px" height="24px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><g><path fill="none" d="M0 0h24v24H0z"/><path d="M12 14v2a6 6 0 0 0-6 6H4a8 8 0 0 1 8-8zm0-1c-3.315 0-6-2.685-6-6s2.685-6 6-6 6 2.685 6 6-2.685 6-6 6zm0-2c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm2.595 7.812a3.51 3.51 0 0 1 0-1.623l-.992-.573 1-1.732.992.573A3.496 3.496 0 0 1 17 14.645V13.5h2v1.145c.532.158 1.012.44 1.405.812l.992-.573 1 1.732-.992.573a3.51 3.51 0 0 1 0 1.622l.992.573-1 1.732-.992-.573a3.496 3.496 0 0 1-1.405.812V22.5h-2v-1.145a3.496 3.496 0 0 1-1.405-.812l-.992.573-1-1.732.992-.572zM18 19.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/></g></svg>
					</div>
					<div class="flex flex-col">
						<span class="inline-flex p-0 m-0">Settings</span>
					</div>
				</Link>
			</div>
			<div class="flex flex-col w-full bg-transparent justify-center cursor-pointer items-center gap-[8px] no-underline rounded-[8px] m-0 p-0" role="option">
				<Link href="/clientarea/" class="flex flex-row items-start justify-start cursor-pointer select-none gap-[8px] whitespace-pre-wrap p-[8px] w-full font-motify text-white transition-colors duration-300 leading-[18px] text-[12px] md:leading-[22px] md:text-[14px] hover:text-white/75">
					<div class="flex flex-col select-none pointer-events-none">
						<svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" class="flex flex-col select-none pointer-events-none w-full max-h-[24px] max-w-[100%] p-0 m-0 py-[2px]" width="24px" height="24px" viewBox="0 0 512 512" fill="currentColor"><path d="M456.7,242.27l-26.08-4.2a8,8,0,0,1-6.6-6.82c-.5-3.2-1-6.41-1.7-9.51a8.08,8.08,0,0,1,3.9-8.62l23.09-12.82a8.05,8.05,0,0,0,3.9-9.92l-4-11a7.94,7.94,0,0,0-9.4-5l-25.89,5a8,8,0,0,1-8.59-4.11q-2.25-4.2-4.8-8.41a8.16,8.16,0,0,1,.7-9.52l17.29-19.94a8,8,0,0,0,.3-10.62l-7.49-9a7.88,7.88,0,0,0-10.5-1.51l-22.69,13.63a8,8,0,0,1-9.39-.9c-2.4-2.11-4.9-4.21-7.4-6.22a8,8,0,0,1-2.5-9.11l9.4-24.75A8,8,0,0,0,365,78.77l-10.2-5.91a8,8,0,0,0-10.39,2.21L327.77,95.91a7.15,7.15,0,0,1-8.5,2.5s-5.6-2.3-9.8-3.71A8,8,0,0,1,304,87l.4-26.45a8.07,8.07,0,0,0-6.6-8.42l-11.59-2a8.07,8.07,0,0,0-9.1,5.61l-8.6,25.05a8,8,0,0,1-7.79,5.41h-9.8a8.07,8.07,0,0,1-7.79-5.41l-8.6-25.05a8.07,8.07,0,0,0-9.1-5.61l-11.59,2a8.07,8.07,0,0,0-6.6,8.42l.4,26.45a8,8,0,0,1-5.49,7.71c-2.3.9-7.3,2.81-9.7,3.71-2.8,1-6.1.2-8.8-2.91L167.14,75.17A8,8,0,0,0,156.75,73l-10.2,5.91A7.94,7.94,0,0,0,143.25,89l9.4,24.75a8.06,8.06,0,0,1-2.5,9.11c-2.5,2-5,4.11-7.4,6.22a8,8,0,0,1-9.39.9L111,116.14a8,8,0,0,0-10.5,1.51l-7.49,9a8,8,0,0,0,.3,10.62l17.29,19.94a8,8,0,0,1,.7,9.52q-2.55,4-4.8,8.41a8.11,8.11,0,0,1-8.59,4.11l-25.89-5a8,8,0,0,0-9.4,5l-4,11a8.05,8.05,0,0,0,3.9,9.92L85.58,213a7.94,7.94,0,0,1,3.9,8.62c-.6,3.2-1.2,6.31-1.7,9.51a8.08,8.08,0,0,1-6.6,6.82l-26.08,4.2a8.09,8.09,0,0,0-7.1,7.92v11.72a7.86,7.86,0,0,0,7.1,7.92l26.08,4.2a8,8,0,0,1,6.6,6.82c.5,3.2,1,6.41,1.7,9.51a8.08,8.08,0,0,1-3.9,8.62L62.49,311.7a8.05,8.05,0,0,0-3.9,9.92l4,11a7.94,7.94,0,0,0,9.4,5l25.89-5a8,8,0,0,1,8.59,4.11q2.25,4.2,4.8,8.41a8.16,8.16,0,0,1-.7,9.52L93.28,374.62a8,8,0,0,0-.3,10.62l7.49,9a7.88,7.88,0,0,0,10.5,1.51l22.69-13.63a8,8,0,0,1,9.39.9c2.4,2.11,4.9,4.21,7.4,6.22a8,8,0,0,1,2.5,9.11l-9.4,24.75a8,8,0,0,0,3.3,10.12l10.2,5.91a8,8,0,0,0,10.39-2.21l16.79-20.64c2.1-2.6,5.5-3.7,8.2-2.6,3.4,1.4,5.7,2.2,9.9,3.61a8,8,0,0,1,5.49,7.71l-.4,26.45a8.07,8.07,0,0,0,6.6,8.42l11.59,2a8.07,8.07,0,0,0,9.1-5.61l8.6-25a8,8,0,0,1,7.79-5.41h9.8a8.07,8.07,0,0,1,7.79,5.41l8.6,25a8.07,8.07,0,0,0,9.1,5.61l11.59-2a8.07,8.07,0,0,0,6.6-8.42l-.4-26.45a8,8,0,0,1,5.49-7.71c4.2-1.41,7-2.51,9.6-3.51s5.8-1,8.3,2.1l17,20.94A8,8,0,0,0,355,439l10.2-5.91a7.93,7.93,0,0,0,3.3-10.12l-9.4-24.75a8.08,8.08,0,0,1,2.5-9.12c2.5-2,5-4.1,7.4-6.21a8,8,0,0,1,9.39-.9L401,395.66a8,8,0,0,0,10.5-1.51l7.49-9a8,8,0,0,0-.3-10.62l-17.29-19.94a8,8,0,0,1-.7-9.52q2.55-4.05,4.8-8.41a8.11,8.11,0,0,1,8.59-4.11l25.89,5a8,8,0,0,0,9.4-5l4-11a8.05,8.05,0,0,0-3.9-9.92l-23.09-12.82a7.94,7.94,0,0,1-3.9-8.62c.6-3.2,1.2-6.31,1.7-9.51a8.08,8.08,0,0,1,6.6-6.82l26.08-4.2a8.09,8.09,0,0,0,7.1-7.92V250A8.25,8.25,0,0,0,456.7,242.27ZM256,112A143.82,143.82,0,0,1,395.38,220.12,16,16,0,0,1,379.85,240l-105.24,0a16,16,0,0,1-13.91-8.09l-52.1-91.71a16,16,0,0,1,9.85-23.39A146.94,146.94,0,0,1,256,112ZM112,256a144,144,0,0,1,43.65-103.41,16,16,0,0,1,25.17,3.47L233.06,248a16,16,0,0,1,0,15.87l-52.67,91.7a16,16,0,0,1-25.18,3.36A143.94,143.94,0,0,1,112,256ZM256,400a146.9,146.9,0,0,1-38.19-4.95,16,16,0,0,1-9.76-23.44l52.58-91.55a16,16,0,0,1,13.88-8H379.9a16,16,0,0,1,15.52,19.88A143.84,143.84,0,0,1,256,400Z"/></svg>
					</div>
					<div class="flex flex-col">
						<span class="inline-flex p-0 m-0">Clientarea</span>
					</div>
				</Link>
			</div>
			<div class="flex flex-col w-full bg-transparent justify-center cursor-pointer items-center gap-[8px] no-underline rounded-[8px] m-0 p-0" role="option">
				<Link href="/logout" class="flex flex-row items-start justify-start cursor-pointer select-none gap-[8px] whitespace-pre-wrap p-[8px] w-full font-motify text-white transition-colors duration-300 leading-[18px] text-[12px] md:leading-[22px] md:text-[14px] hover:text-white/75">
					<div class="flex flex-col select-none pointer-events-none">
						<svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" class="flex flex-col select-none pointer-events-none w-full max-h-[24px] max-w-[100%] p-0 m-0 py-[2px]" width="24px" height="24px" viewBox="0 0 24 24" fill="none"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 3H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h8m4-9-4-4m4 4-4 4m4-4H9"/></svg>
					</div>
					<div class="flex flex-col">
						<span class="inline-flex p-0 m-0">Sign out</span>
					</div>
				</Link>
			</div>
		</div>
	</div>
</template>

<script setup>
	import { reactive, onMounted, ref, nextTick, computed } from 'vue';
	import { Link, usePage } from '@inertiajs/vue3';

	const page = usePage(),
	user = computed(() => page.props.user),

	refUserMenu = ref(null),

	proxy = reactive({
		window		:	{
			height	:	0,
			width	:	0
		},
		userMenu	:	{
			pos		:	{
				y	:	0,
				x	:	0
			},
			hidden	:	true
		},
		scrollY		:	0,
		mobileMenu	:	false
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
	},
	
	handleMobileMenu = () => {
		proxy.mobileMenu = !proxy.mobileMenu;
	},

	calculateUserMenuPosition = () => {
		var containerRect = null;

		try {
			containerRect = refUserMenu.value.getBoundingClientRect();
		} catch (err) {
			containerRect = null;
		}

		if (null !== containerRect) {
			proxy.userMenu.pos.x = Math.round(containerRect.x);
			proxy.userMenu.pos.y = Math.round(containerRect.y);
		}
	}

	onMounted(async() => {
		window.addEventListener('resize', handleResize);
		window.addEventListener('scroll', handleScroll);
		handleResize();
		handleScroll();
		await nextTick();
		calculateUserMenuPosition();
	});
</script>