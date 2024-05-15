<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
	<Head title="Proyecto" />
	
	<AuthenticatedLayout>
		<template #header>
			Proyectos
		</template>
		
		<div class="p-4 bg-white rounded-lg shadow-xs">
			Pagina principal! Proyectos
		</div>
	</AuthenticatedLayout>
</template>
