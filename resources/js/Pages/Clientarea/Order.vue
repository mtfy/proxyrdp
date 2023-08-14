<template>
	<ClientLayout :user="props.user" :activePage="1">
		<div class="flex flex-col w-full p-0 m-0">
			<span class="flex flex-col font-medium whitespace-pre-wrap text-[20px] leading-[24px] capitalize">Order</span>
		</div>
		<div class="flex flex-col w-full relative bg-white border border-[#D1D9E4] rounded-xl p-[24px] m-0 mt-[20px] space-y-[20px]">
			<div class="flex flex-col w-full p-0 m-0">
				<span class="flex flex-col font-medium whitespace-pre-wrap text-[18px] leading-[28px] capitalize">Servers</span>
			</div>
			<div class="flex flex-col flex-grow flex-shrink flex-wrap basis-0 w-full font-motify leading-snug text-[14px] md:text-[16px] lg:flex-row">
				<div class="flex flex-col w-full lg:w-6/12">
					<div class="flex flex-col w-full justify-start items-start pb-[20px] lg:p-0 lg:pr-[20px]">
						<p class="whitespace-pre-wrap text-[16px] lg:text-[18px]">Customize server settings, sepcifications, and resources to align perfectly with your unique requirements. Scale up or down effortlessly as your needs evolve, ensuring seamless performance and resource allocation.</p>
					</div>
				</div>
				<div class="flex flex-col w-full lg:w-6/12">
					<form class="flex flex-col w-full p-0 m-0 space-y-[20px]">
						
						<div class="flex flex-col w-full">
							<label class="flex flex-row w-full space-x-2" for="cores">
								<div class="flex flex-col">Cores</div>
								<div class="flex flex-col font-semibold">{{ form.servers.cores }}</div>
							</label>
							<div class="flex flex-col w-full pt-[6px]">
								<div class="flex flex-col">
									<input
										type="range"
										class="ring-0 transition-all duration-300 cursor-pointer"
										min="2"
										max="12"
										aria-valuemin="2"
										aria-valuemax="12"
										step="2"
										v-model="form.servers.cores"
										id="cores"
										@input="async() => { await nextTick().then(async() => { await calcServerSubtotal() }) }"
										aria-required="true"
										required="true"
									/>
								</div>
							</div>
						</div>

						<div class="flex flex-col w-full">
							<label class="flex flex-row w-full space-x-2" for="ram">
								<div class="flex flex-col">RAM</div>
								<div class="flex flex-col font-semibold">{{ proxy.forms.servers.memory.values[form.servers.memory] }} GB</div>
							</label>
							<div class="flex flex-col w-full pt-[6px]">
								<div class="flex flex-col">
									<input
										type="range"
										class="ring-0 transition-all duration-300 cursor-pointer"
										min="1"
										max="10"
										aria-valuemin="1"
										aria-valuemax="10"
										step="1"
										v-model="form.servers.memory"
										id="ram"
										@input="async() => { await nextTick().then(async() => { await calcServerSubtotal() }) }"
										aria-required="true"
										required="true"
									/>
								</div>
							</div>
						</div>

						<div class="flex flex-col w-full">
							<label class="flex flex-row w-full space-x-2" for="storage">
								<div class="flex flex-col">SSD</div>
								<div class="flex flex-col font-semibold">{{ form.servers.storage }} GB</div>
							</label>
							<div class="flex flex-col w-full pt-[6px]">
								<div class="flex flex-col">
									<input
										type="range"
										class="ring-0 transition-all duration-300 cursor-pointer"
										min="50"
										max="500"
										aria-valuemin="50"
										aria-valuemax="500"
										step="50"
										v-model="form.servers.storage"
										id="storage"
										@input="async() => { await nextTick().then(async() => { await calcServerSubtotal() }) }"
										aria-required="true"
										required="true"
									/>
								</div>
							</div>
						</div>

						<div class="flex flex-col w-full">
							<label class="flex flex-row w-full space-x-2" for="ipv4">
								<div class="flex flex-col">Additional IPv4</div>
								<div class="flex flex-col font-semibold">{{ form.servers.ipv4 }}</div>
							</label>
							<div class="flex flex-col w-full pt-[6px]">
								<div class="flex flex-col">
									<input
										type="range"
										class="ring-0 transition-all duration-300 cursor-pointer"
										min="0"
										max="10"
										aria-valuemin="0"
										aria-valuemax="10"
										step="1"
										v-model="form.servers.ipv4"
										id="ipv4"
										@input="async() => { await nextTick().then(async() => { await calcServerSubtotal() }) }"
										aria-required="true"
										required="true"
									/>
								</div>
							</div>
						</div>

						<div class="flex flex-col w-full select-none pointer-events-none">
							<hr class="flex flex-col w-full border-[#D1D9E4] m-0 my-[12px]" />
						</div>
						<div class="flex flex-col flex-grow flex-shrink flex-wrap basis-0 m-0 p-0 w-full font-motify leading-snug text-[14px] md:text-[16px]">
							
						</div>
						<div class="flex flex-col flex-grow flex-shrink flex-wrap basis-0 m-0 p-0 w-full lg:flex-row">
							<div class="flex flex-col w-full items-center justify-center lg:w-6/12 lg:justify-center lg:items-end">
								<div class="flex flex-row w-full space-x-2">
									<div class="flex flex-col">Total</div>
									<div class="flex flex-col font-semibold">{{ parseFloat(proxy.subtotal.servers).toFixed(2) }}&#160;&#x20ac;</div>
								</div>
							</div>
							<div class="flex flex-col w-full items-center justify-center lg:w-6/12 lg:justify-center lg:items-end">
								<div class="w-full lg:w-auto">
									<Button :type="'submit'" :custom-class="'override:text-[14px] override:font-medium w-full lg:w-auto capitalize text-center justify-center items-center text-[12px] md:text-[14px] bg-theme-secondary-500 text-white hover:bg-theme-secondary-700 hover:text-[#F5F5F5]'">
										<div class="flex flex-row w-full items-center justify-center space-x-2 leading-[18px]">
											<div class="flex flex-col"><svg xmlns="http://www.w3.org/2000/svg" role="img" width="20px" height="20px" fill="currentColor" class="flex flex-col select-none pointer-events-none" viewBox="0 0 24 24"><path d="M7,18c-1.1,0-1.99,0.9-1.99,2S5.9,22,7,22s2-0.9,2-2S8.1,18,7,18z M17,18c-1.1,0-1.99,0.9-1.99,2s0.89,2,1.99,2s2-0.9,2-2 S18.1,18,17,18z M8.1,13h7.45c0.75,0,1.41-0.41,1.75-1.03L21,4.96L19.25,4l-3.7,7H8.53L4.27,2H1v2h2l3.6,7.59l-1.35,2.44 C4.52,15.37,5.48,17,7,17h12v-2H7L8.1,13z M12,2l4,4l-4,4l-1.41-1.41L12.17,7L8,7l0-2l4.17,0l-1.59-1.59L12,2z"/></svg></div>
											<div class="flex flex-col">Checkout</div>
										</div>
									</Button>
								</div>
							</div>
							
						</div>

					</form>
				</div>
			</div>
		</div>
	</ClientLayout>
</template>
<script setup>
	import ClientLayout from '../../Layouts/ClientLayout.vue';
	import { reactive, onMounted, nextTick } from 'vue';
	import { useForm } from '@inertiajs/vue3';
	import Button from '../../Components/Button.vue';

	const props = defineProps({
		user: Object
	}),

	proxy = reactive({
		user		:	{
			guest		:	true,
			id			:	null,
			first_name	:	null,
			last_name	:	null,
			email		:	null,
			created_at	:	null
		},
		subtotal		:	{
			servers		:	12.00
		},
		forms			:	{
			servers		:	{
				memory	:	{
					values	:	{
						'1'	:	'2',
						'2'	:	'4',
						'3' :	'6',
						'4'	:	'8',
						'5'	:	'10',
						'6' :	'12',
						'7'	:	'16',
						'8'	:	'20',
						'9'	:	'24',
						'10':	'32'
					}
				}
			}
		}
	}),

	form = {
		servers : useForm({
			cores : '2',
			memory: '1',
			storage: '50',
			ipv4: '0'
		})
	},

	

	calcServerSubtotal = async() => {
		window.console.log((parseInt(form.servers.memory) || 0))
		if ((parseInt(form.servers.memory) || 0) === 12) {
			proxy.forms.servers.memory.step = '4';
		} else {
			proxy.forms.servers.memory.step = '2';
		}

		let total = 0.00;
		
		const values = {
			cores: parseInt(form.servers.cores) || 0,
			memory: parseInt(proxy.forms.servers.memory.values[form.servers.memory]) || 0,
			storage: parseInt(form.servers.storage) || 0,
			ipv4: parseInt(form.servers.ipv4) || 0
		};
		
		switch (values.cores) {
			case 2:
				total += 5.5;
				break;

			case 4:
				total += 11;
				break;
			
			case 6:
				total += 17.5;
				break;

			case 8:
				total += 25;
				break;
			
			case 10:
				total += 32;
				break;
			
			case 12:
				total += 38.5;
				break;
		}

		switch (values.memory) {
			case 2:
				total += 3;
				break;

			case 4:
				total += 6;
				break;
			
			case 6:
				total += 9;
				break;

			case 8:
				total += 12;
				break;
			
			case 10:
				total += 15;
				break;
			
			case 12:
				total += 18;
				break;

			case 16:
				total += 18;
				break;

			case 20:
				total += 29.5;
				break;
			
			case 24:
				total += 35.5;
				break;

			case 32:
				total += 47.5;
				break;
		}

		switch (values.storage) {
			case 50:
				total += 3.5;
				break;
			
			case 100:
				total += 7;
				break;

			case 150:
				total += 11;
				break;

			case 200:
				total += 14.5;
				break;

			case 400:
				total += 29;
				break;

			case 500:
				total += 36;
				break;
		}

		total += (values.ipv4 * 2.00);
		
		proxy.subtotal.servers = parseFloat(total.toString());
	},
	
	cacheUserData = async() => {
		if ('user' in props && 'object' === typeof props.user && null !== props.user && Object.entries(props.user).length > 0) {
			proxy.user.guest = props.user.guest;
			proxy.user.id = props.user.id;
			proxy.user.first_name = props.user.first_name;
			proxy.user.last_name = props.user.last_name;
			proxy.user.email = props.user.email;
			proxy.user.created_at = props.user.created_at;
		}
	};

	onMounted(async() => {
		await cacheUserData();
	});
</script>