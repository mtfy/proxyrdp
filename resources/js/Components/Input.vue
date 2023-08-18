<template>
	<div class="flex flex-col w-full m-0 p-0">
		<div class="flex flex-col relative sm:h-[3rem] z-[1] gap-[8px] items-center w-full py-0 px-[12px] outline-0 transition-all duration-300 border-[1px] border-[#0C0C0C0] rounded-[12px]" :class="(false !== proxy.focus) ? 'ring-2 ring-theme-primary-600 border-theme-primary-600' : ''">
			<input
				class="flex flex-col w-full text-[#0a0a0a] whitespace-nowrap text-ellipsis p-[12px] text-[12px] md:text-[14px] outline-0 transition-all duration-300 ring-0"
				@focusin="proxy.focus = true"
				@blur="proxy.focus = false"
				:class="('string' === typeof customClass && null !== customClass && '' !== customClass) ? customClass : ''"
				:type="type"
				:placeholder="(placeholder !== null) ? placeholder : null"
				:id="(id !== null) ? id : ''"
				:autocomplete="(autocomplete !== null) ? autocomplete : 'off'"
				:aria-autocomplete="(autocomplete !== null) ? autocomplete : 'off'"
				:maxlength="(maxlength !== null) ? maxlength : null"
				@input="$emit('update:modelValue', $event.target.value)"
				ref="input"
				:disabled="!!disabled"
				:aria-disabled="!!disabled"
				:readonly="!!readOnly"
				:aria-readonly="!!readOnly"
				:required="!!required"
				:aria-required="!!required"
				:value="modelValue"
				:name="name"
				:min="min"
				:max="max"
				:step="step"
			/>
		</div>
	</div>
</template>
<script setup>
	import { reactive, onMounted, ref, nextTick } from 'vue';

	const proxy = reactive({
		focus	:	false
	}),
	input = ref(null),

	fixCurrency = async() => {
		
	};

	defineEmits(['update:modelValue']);

	defineExpose({
		focus: () => input.value.focus()
	});

	defineProps({
		type: {
			type: String,
			default: 'text'
		},
		id: {
			type: String,
			default: null
		},
		name: {
			type: String,
			default: null
		},
		customClass: {
			type: String,
			default: null
		},
		autocomplete: {
			type: String,
			default: null
		},
		placeholder: {
			type: String,
			default: null
		},
		maxlength: {
			type: Number,
			default: null
		},
		disabled: {
			type: Boolean,
			default: null
		},
		readOnly: {
			type: Boolean,
			default: null
		},
		required: {
			type: Boolean,
			default: null
		},
		min: {
			type: Number,
			default: null
		},
		max: {
			type: Number,
			default: null
		},
		step: {
			type: Number,
			default: null
		},
		modelValue: {
			type: String,
			default: null
		}
	});

	onMounted(async() => {
		await nextTick().then(async() => {
			if (input.value.hasAttribute('autofocus')) {
				input.value.focus();
			}
		});
	});
</script>