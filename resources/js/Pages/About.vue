<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
	<Head title="Tareas" />
	
	<AuthenticatedLayout>
		<template #header>
			Tareas
		</template>
		
		<div class="p-4 bg-white rounded-lg shadow-xs">
			Sample static text page
		</div>
	</AuthenticatedLayout>
</template>
