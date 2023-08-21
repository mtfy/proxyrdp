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
									<Link href="/clientarea/invoices" class="flex flex-row w-full items-center justify-start gap-[4px] font-medium no-underline py-[8px] px-[16px] whitespace-no-wrap font-motify transition-colors duration-100 leading-[24px] text-[14px] rounded-lg" :class="( props.activePage === 2 ? 'text-[#0A0A0A] bg-[#D1D9E4]' : 'text-[#5A6372] bg-transparent hover:text-[#0A0A0A] hover:bg-[#D1D9E4]')">
										<div class="flex flex-col pointer-events-none select-none p-0 m-0"><svg xmlns="http://www.w3.org/2000/svg" role="img" class="inline-flex pointer-events-none select-none p-0 m-0" fill="currentColor" width="14px" height="14px" viewBox="0 0 384 512"><path d="M384 128h-128V0L384 128zM256 160H384v304c0 26.51-21.49 48-48 48h-288C21.49 512 0 490.5 0 464v-416C0 21.49 21.49 0 48 0H224l.0039 128C224 145.7 238.3 160 256 160zM64 88C64 92.38 67.63 96 72 96h80C156.4 96 160 92.38 160 88v-16C160 67.63 156.4 64 152 64h-80C67.63 64 64 67.63 64 72V88zM72 160h80C156.4 160 160 156.4 160 152v-16C160 131.6 156.4 128 152 128h-80C67.63 128 64 131.6 64 136v16C64 156.4 67.63 160 72 160zM197.5 316.8L191.1 315.2C168.3 308.2 168.8 304.1 169.6 300.5c1.375-7.812 16.59-9.719 30.27-7.625c5.594 .8438 11.73 2.812 17.59 4.844c10.39 3.594 21.83-1.938 25.45-12.34c3.625-10.44-1.891-21.84-12.33-25.47c-7.219-2.484-13.11-4.078-18.56-5.273V248c0-11.03-8.953-20-20-20s-20 8.969-20 20v5.992C149.6 258.8 133.8 272.8 130.2 293.7c-7.406 42.84 33.19 54.75 50.52 59.84l5.812 1.688c29.28 8.375 28.8 11.19 27.92 16.28c-1.375 7.812-16.59 9.75-30.31 7.625c-6.938-1.031-15.81-4.219-23.66-7.031l-4.469-1.625c-10.41-3.594-21.83 1.812-25.52 12.22c-3.672 10.41 1.781 21.84 12.2 25.53l4.266 1.5c7.758 2.789 16.38 5.59 25.06 7.512V424c0 11.03 8.953 20 20 20s20-8.969 20-20v-6.254c22.36-4.793 38.21-18.53 41.83-39.43C261.3 335 219.8 323.1 197.5 316.8z"/></svg></div>
										<div class="flex flex-col capitalize select-none">Invoices</div>
									</Link>
									<Link href="/clientarea/services" class="flex flex-row w-full items-center justify-start gap-[4px] font-medium no-underline py-[8px] px-[16px] whitespace-no-wrap font-motify transition-colors duration-100 leading-[24px] text-[14px] rounded-lg" :class="( props.activePage === 3 ? 'text-[#0A0A0A] bg-[#D1D9E4]' : 'text-[#5A6372] bg-transparent hover:text-[#0A0A0A] hover:bg-[#D1D9E4]')">
										<div class="flex flex-col pointer-events-none select-none p-0 m-0"><svg xmlns="http://www.w3.org/2000/svg" role="img" class="inline-flex pointer-events-none select-none p-0 m-0" width="14px" height="14px" fill="currentColor" viewBox="0 0 24 24"><path d="M14.17,13.71l1.4-2.42c0.09-0.15,0.05-0.34-0.08-0.45l-1.48-1.16c0.03-0.22,0.05-0.45,0.05-0.68s-0.02-0.46-0.05-0.69 l1.48-1.16c0.13-0.11,0.17-0.3,0.08-0.45l-1.4-2.42c-0.09-0.15-0.27-0.21-0.43-0.15L12,4.83c-0.36-0.28-0.75-0.51-1.18-0.69 l-0.26-1.85C10.53,2.13,10.38,2,10.21,2h-2.8C7.24,2,7.09,2.13,7.06,2.3L6.8,4.15C6.38,4.33,5.98,4.56,5.62,4.84l-1.74-0.7 c-0.16-0.06-0.34,0-0.43,0.15l-1.4,2.42C1.96,6.86,2,7.05,2.13,7.16l1.48,1.16C3.58,8.54,3.56,8.77,3.56,9s0.02,0.46,0.05,0.69 l-1.48,1.16C2,10.96,1.96,11.15,2.05,11.3l1.4,2.42c0.09,0.15,0.27,0.21,0.43,0.15l1.74-0.7c0.36,0.28,0.75,0.51,1.18,0.69 l0.26,1.85C7.09,15.87,7.24,16,7.41,16h2.8c0.17,0,0.32-0.13,0.35-0.3l0.26-1.85c0.42-0.18,0.82-0.41,1.18-0.69l1.74,0.7 C13.9,13.92,14.08,13.86,14.17,13.71z M8.81,11c-1.1,0-2-0.9-2-2c0-1.1,0.9-2,2-2s2,0.9,2,2C10.81,10.1,9.91,11,8.81,11z"/><path d="M21.92,18.67l-0.96-0.74c0.02-0.14,0.04-0.29,0.04-0.44c0-0.15-0.01-0.3-0.04-0.44l0.95-0.74 c0.08-0.07,0.11-0.19,0.05-0.29l-0.9-1.55c-0.05-0.1-0.17-0.13-0.28-0.1l-1.11,0.45c-0.23-0.18-0.48-0.33-0.76-0.44l-0.17-1.18 C18.73,13.08,18.63,13,18.53,13h-1.79c-0.11,0-0.21,0.08-0.22,0.19l-0.17,1.18c-0.27,0.12-0.53,0.26-0.76,0.44l-1.11-0.45 c-0.1-0.04-0.22,0-0.28,0.1l-0.9,1.55c-0.05,0.1-0.04,0.22,0.05,0.29l0.95,0.74c-0.02,0.14-0.03,0.29-0.03,0.44 c0,0.15,0.01,0.3,0.03,0.44l-0.95,0.74c-0.08,0.07-0.11,0.19-0.05,0.29l0.9,1.55c0.05,0.1,0.17,0.13,0.28,0.1l1.11-0.45 c0.23,0.18,0.48,0.33,0.76,0.44l0.17,1.18c0.02,0.11,0.11,0.19,0.22,0.19h1.79c0.11,0,0.21-0.08,0.22-0.19l0.17-1.18 c0.27-0.12,0.53-0.26,0.75-0.44l1.12,0.45c0.1,0.04,0.22,0,0.28-0.1l0.9-1.55C22.03,18.86,22,18.74,21.92,18.67z M17.63,18.83 c-0.74,0-1.35-0.6-1.35-1.35s0.6-1.35,1.35-1.35s1.35,0.6,1.35,1.35S18.37,18.83,17.63,18.83z"/></svg></div>
										<div class="flex flex-col capitalize select-none">My services</div>
									</Link>
									<Link href="/clientarea/wallet" class="flex flex-row w-full items-center justify-start gap-[4px] font-medium no-underline py-[8px] px-[16px] whitespace-no-wrap font-motify transition-colors duration-100 leading-[24px] text-[14px] rounded-lg" :class="( props.activePage === 4 ? 'text-[#0A0A0A] bg-[#D1D9E4]' : 'text-[#5A6372] bg-transparent hover:text-[#0A0A0A] hover:bg-[#D1D9E4]')">
										<div class="flex flex-col pointer-events-none select-none p-0 m-0"><svg xmlns="http://www.w3.org/2000/svg" role="img" class="inline-flex pointer-events-none select-none p-0 m-0" fill="currentColor" width="14px" height="14px" viewBox="0 0 24 24"><path d="M21 18v1c0 1.1-.9 2-2 2H5c-1.11 0-2-.9-2-2V5c0-1.1.89-2 2-2h14c1.1 0 2 .9 2 2v1h-9c-1.11 0-2 .9-2 2v8c0 1.1.89 2 2 2h9zm-9-2h10V8H12v8zm4-2.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"/></svg></div>
										<div class="flex flex-col capitalize select-none">Wallet</div>
									</Link>
									<Link href="/clientarea/account" class="flex flex-row w-full items-center justify-start gap-[4px] font-medium no-underline py-[8px] px-[16px] whitespace-no-wrap font-motify transition-colors duration-100 leading-[24px] text-[14px] rounded-lg" :class="( props.activePage === 5 ? 'text-[#0A0A0A] bg-[#D1D9E4]' : 'text-[#5A6372] bg-transparent hover:text-[#0A0A0A] hover:bg-[#D1D9E4]')">
										<div class="flex flex-col pointer-events-none select-none p-0 m-0"><svg xmlns="http://www.w3.org/2000/svg" role="img" class="inline-flex pointer-events-none select-none p-0 m-0" fill="currentColor" width="14px" height="14px" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"/><path d="M12 14v8H4a8 8 0 0 1 8-8zm0-1c-3.315 0-6-2.685-6-6s2.685-6 6-6 6 2.685 6 6-2.685 6-6 6zm2.595 5.812a3.51 3.51 0 0 1 0-1.623l-.992-.573 1-1.732.992.573A3.496 3.496 0 0 1 17 14.645V13.5h2v1.145c.532.158 1.012.44 1.405.812l.992-.573 1 1.732-.992.573a3.51 3.51 0 0 1 0 1.622l.992.573-1 1.732-.992-.573a3.496 3.496 0 0 1-1.405.812V22.5h-2v-1.145a3.496 3.496 0 0 1-1.405-.812l-.992.573-1-1.732.992-.572zM18 17a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/></g></svg></div>
										<div class="flex flex-col capitalize select-none">Account</div>
									</Link>
									<Link href="/admin/dashboard" class="flex flex-row w-full items-center justify-start gap-[4px] font-medium no-underline py-[8px] px-[16px] whitespace-no-wrap font-motify transition-colors duration-100 leading-[24px] text-[14px] rounded-lg" :class="( props.activePage === 6 ? 'text-[#0A0A0A] bg-[#D1D9E4]' : 'text-[#5A6372] bg-transparent hover:text-[#0A0A0A] hover:bg-[#D1D9E4]')" v-if="proxy.admin">
										<div class="flex flex-col pointer-events-none select-none p-0 m-0"><svg xmlns="http://www.w3.org/2000/svg" role="img" class="inline-flex pointer-events-none select-none p-0 m-0" fill="currentColor" width="14px" height="14px" viewBox="0 0 24 24"><path d="M17,11c0.34,0,0.67,0.04,1,0.09V6.27L10.5,3L3,6.27v4.91c0,4.54,3.2,8.79,7.5,9.82c0.55-0.13,1.08-0.32,1.6-0.55 C11.41,19.47,11,18.28,11,17C11,13.69,13.69,11,17,11z"/><path d="M17,13c-2.21,0-4,1.79-4,4c0,2.21,1.79,4,4,4s4-1.79,4-4C21,14.79,19.21,13,17,13z M17,14.38c0.62,0,1.12,0.51,1.12,1.12 s-0.51,1.12-1.12,1.12s-1.12-0.51-1.12-1.12S16.38,14.38,17,14.38z M17,19.75c-0.93,0-1.74-0.46-2.24-1.17 c0.05-0.72,1.51-1.08,2.24-1.08s2.19,0.36,2.24,1.08C18.74,19.29,17.93,19.75,17,19.75z"/></svg></div>
										<div class="flex flex-col capitalize select-none">Administration</div>
									</Link>
									<Link href="/admin/users" class="flex flex-row w-full items-center justify-start gap-[4px] font-medium no-underline py-[8px] px-[16px] whitespace-no-wrap font-motify transition-colors duration-100 leading-[24px] text-[14px] rounded-lg" :class="( props.activePage === 7 ? 'text-[#0A0A0A] bg-[#D1D9E4]' : 'text-[#5A6372] bg-transparent hover:text-[#0A0A0A] hover:bg-[#D1D9E4]')" v-if="proxy.admin">
										<div class="flex flex-col pointer-events-none select-none p-0 m-0"><svg xmlns="http://www.w3.org/2000/svg" role="img" class="inline-flex pointer-events-none select-none p-0 m-0" fill="currentColor" width="14px" height="14px" viewBox="0 0 640 512"><path d="M512 160c44.18 0 80-35.82 80-80S556.2 0 512 0c-44.18 0-80 35.82-80 80S467.8 160 512 160zM128 160c44.18 0 80-35.82 80-80S172.2 0 128 0C83.82 0 48 35.82 48 80S83.82 160 128 160zM319.9 320c57.41 0 103.1-46.56 103.1-104c0-57.44-46.54-104-103.1-104c-57.41 0-103.1 46.56-103.1 104C215.9 273.4 262.5 320 319.9 320zM368 400c0-16.69 3.398-32.46 8.619-47.36C374.3 352.5 372.2 352 369.9 352H270.1C191.6 352 128 411.7 128 485.3C128 500.1 140.7 512 156.4 512h266.1C389.5 485.6 368 445.5 368 400zM183.9 216c0-5.449 .9824-10.63 1.609-15.91C174.6 194.1 162.6 192 149.9 192H88.08C39.44 192 0 233.8 0 285.3C0 295.6 7.887 304 17.62 304h199.5C196.7 280.2 183.9 249.7 183.9 216zM551.9 192h-61.84c-12.8 0-24.88 3.037-35.86 8.24C454.8 205.5 455.8 210.6 455.8 216c0 21.47-5.625 41.38-14.65 59.34C462.2 263.4 486.1 256 512 256c42.48 0 80.27 18.74 106.6 48h3.756C632.1 304 640 295.6 640 285.3C640 233.8 600.6 192 551.9 192zM618.1 366.7c-5.025-16.01-13.59-30.62-24.75-42.71c-1.674-1.861-4.467-2.326-6.699-1.023l-19.17 11.07c-8.096-6.887-17.4-12.28-27.45-15.82V295.1c0-2.514-1.861-4.746-4.281-5.213c-16.56-3.723-33.5-3.629-49.32 0C484.9 291.2 483.1 293.5 483.1 295.1v22.24c-10.05 3.537-19.36 8.932-27.45 15.82l-19.26-11.07c-2.139-1.303-4.932-.8379-6.697 1.023c-11.17 12.1-19.73 26.71-24.66 42.71c-.7441 2.512 .2793 5.117 2.42 6.326l19.17 11.17c-1.859 10.42-1.859 21.21 0 31.64l-19.17 11.17c-2.234 1.209-3.164 3.816-2.42 6.328c4.932 16.01 13.49 30.52 24.66 42.71c1.766 1.863 4.467 2.328 6.697 1.025l19.26-11.07c8.094 6.887 17.4 12.28 27.45 15.82v22.24c0 2.514 1.77 4.746 4.188 5.211c16.66 3.723 33.5 3.629 49.32 0c2.42-.4648 4.281-2.697 4.281-5.211v-22.24c10.05-3.535 19.36-8.932 27.45-15.82l19.17 11.07c2.141 1.303 5.025 .8379 6.699-1.025c11.17-12.1 19.73-26.7 24.75-42.71c.7441-2.512-.2773-5.119-2.512-6.328l-19.17-11.17c1.953-10.42 1.953-21.22 0-31.64l19.17-11.17C618.7 371.8 619.7 369.2 618.1 366.7zM512 432c-17.67 0-32-14.33-32-32c0-17.67 14.33-32 32-32s32 14.33 32 32C544 417.7 529.7 432 512 432z"/></svg></div>
										<div class="flex flex-col capitalize select-none">Users</div>
									</Link>
									<Link href="/admin/orders" class="flex flex-row w-full items-center justify-start gap-[4px] font-medium no-underline py-[8px] px-[16px] whitespace-no-wrap font-motify transition-colors duration-100 leading-[24px] text-[14px] rounded-lg" :class="( props.activePage === 8 ? 'text-[#0A0A0A] bg-[#D1D9E4]' : 'text-[#5A6372] bg-transparent hover:text-[#0A0A0A] hover:bg-[#D1D9E4]')" v-if="proxy.admin">
										<div class="flex flex-col pointer-events-none select-none p-0 m-0"><svg xmlns="http://www.w3.org/2000/svg" role="img" class="inline-flex pointer-events-none select-none p-0 m-0" fill="currentColor" width="14px" height="14px" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><path d="M216,40H40A16,16,0,0,0,24,56V208a7.9,7.9,0,0,0,3.8,6.8,8,8,0,0,0,7.8.4L64,200.9l28.4,14.3a8.3,8.3,0,0,0,7.2,0L128,200.9l28.4,14.3a8.5,8.5,0,0,0,7.2,0L192,200.9l28.4,14.3a8,8,0,0,0,7.8-.4A7.9,7.9,0,0,0,232,208V56A16,16,0,0,0,216,40ZM180,144H76a8,8,0,0,1,0-16H180a8,8,0,0,1,0,16Zm0-32H76a8,8,0,0,1,0-16H180a8,8,0,0,1,0,16Z"/></svg></div>
										<div class="flex flex-col capitalize select-none">Orders</div>
									</Link>
									<Link href="/admin/services" class="flex flex-row w-full items-center justify-start gap-[4px] font-medium no-underline py-[8px] px-[16px] whitespace-no-wrap font-motify transition-colors duration-100 leading-[24px] text-[14px] rounded-lg" :class="( props.activePage === 9 ? 'text-[#0A0A0A] bg-[#D1D9E4]' : 'text-[#5A6372] bg-transparent hover:text-[#0A0A0A] hover:bg-[#D1D9E4]')" v-if="proxy.admin">
										<div class="flex flex-col pointer-events-none select-none p-0 m-0"><svg xmlns="http://www.w3.org/2000/svg" role="img" class="inline-flex pointer-events-none select-none p-0 m-0" fill="currentColor" width="14px" height="14px" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"/><path d="M2 4h2v16H2V4zm4 0h2v16H6V4zm3 0h3v16H9V4zm4 0h2v16h-2V4zm3 0h2v16h-2V4zm3 0h3v16h-3V4z"/></g></svg></div>
										<div class="flex flex-col capitalize select-none">Services</div>
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
	import { ref, onMounted, reactive, computed, nextTick } from 'vue';
	import { Link, usePage } from '@inertiajs/vue3';

	const props = defineProps({
		activePage: Number
	}),

	page = usePage(),
	user = computed(() => page.props.user),

	proxy = reactive({
		sidebar		: false,
		admin		: false
	}),
	
	sidebar = ref(null),

	handleSidebar = (hidden) => {
		proxy.sidebar = hidden;
	}

	onMounted(async() => {
		await nextTick().then(async() => {
			proxy.admin = user.value.roles.includes('Administrator') ? true : false;
			window.console.log(user.value.roles);
		});
	});
	
</script>