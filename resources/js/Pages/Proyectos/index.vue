<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import WarningButton from '@/Components/WarningButton.vue';
import DarkButton from '@/Components/DarkButton.vue';
import {ref} from 'vue';

const props = defineProps({
	proyectos: Array	
}); 

const form = useForm({nombre:'',descripcion:'', fecha_inicio: '',fecha_fin:'',estado: ''});
const v=ref({id:'', nombre:'',descripcion:'', fecha_inicio: '',fecha_fin:'',estado: '',Tarea: []});
const showModalView = ref(false);
const showModalForm = ref(false);
const showModalDel = ref(false);
const title = ref('');
const operation = ref(1);
const msj = ref('');
const classMsj = ref('hidden');

const openModalView =(proyecto) => {
	v.value.nombre = proyecto.nombre;
    v.value.descripcion = proyecto.descripcion;
    v.value.fecha_inicio = proyecto.fecha_inicio;
    v.value.fecha_fin = proyecto.fecha_fin;
    v.value.estado = proyecto.estado;
    v.value.Tareas = proyecto.Tarea || [];  // Asegúrate de que Tareas existe o usa un arreglo vacío
    showModalView.value = true;
}
const openModalForm =() => {	
	showModalForm.value = true;
}
const openModalDel =() => {
	showModalDel.value = true;
}
const closeModalView =() => {
	showModalView.value = false;
}
const closeModalForm =() => {
	showModalForm.value = false;
}
const closeModalDel =() => {
	showModalDel.value = false;
}

</script>

<template>
	<Head title="Proyecto" />
	
	<AuthenticatedLayout>
		<template #header>
			Proyectos
			<DarkButton>
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                   <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                </svg>
			</DarkButton>
		</template>
		
		<div class="w-full overflow-hidden rounded-lg border shadow-md">
			<div class="w-full overflow-x-auto bg-white">
			    <table class="w-full whitespace-no-wrap">
					<thead>
						<tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                      <th class="px-4 py-3">Nombre</th>
                      <th class="px-4 py-3">Descripcion</th>
                      <th class="px-4 py-3">Fecha Inicio</th>
                      <th class="px-4 py-3">Fecha Fin</th>
					  <th class="px-4 py-3">Estado</th>
					  <th class="px-4 py-3">Detail</th>
					  <th class="px-4 py-3">Edit</th>
					  <th class="px-4 py-3">Delete</th>
                        </tr>
					</thead>
					<tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
						<tr v-for="proyecto in proyectos" :key="proyecto.id">
                            <td class="px-4 py-3">{{ proyecto.nombre }}</td>
                            <td class="px-4 py-3">{{ proyecto.descripcion }}</td>
                            <td class="px-4 py-3">{{ proyecto.fecha_inicio }}</td>
                            <td class="px-4 py-3">{{ proyecto.fecha_fin }}</td>
                            <td class="px-4 py-3">{{ proyecto.estado }}</td>
                            <td class="px-4 py-3">
                                <SecondaryButton @click="openModalView(proyecto)">
									<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                         <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
								</SecondaryButton>
                            </td>
                            <td class="px-4 py-3">
                                <WarningButton @click="openModalForm(proyecto)">
									<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </WarningButton>
                            </td>
                            <td class="px-4 py-3">
                                <DangerButton @click="openModalDel(proyecto)">
									<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                         <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
								</DangerButton>
                            </td>
                        </tr>
					</tbody>
			    </table>
		    </div>
		</div>
		<Modal :show="showModalView" @close="closeModalView">
			<div class="p-6">
				<p>Nombre: <span class="text-lg font-medium text-gray-900">{{ v.nombre }}</span></p>
        <p>Descripción: <span class="text-lg font-medium text-gray-900">{{ v.descripcion }}</span></p>
        <p>Fecha de inicio: <span class="text-lg font-medium text-gray-900">{{ v.fecha_inicio }}</span></p>
        <p>Fecha de fin: <span class="text-lg font-medium text-gray-900">{{ v.fecha_fin }}</span></p>
        <p>Estado: <span class="text-lg font-medium text-gray-900">{{ v.estado }}</span></p>
        <p>Tareas:</p>
		<ol v-if="Array.isArray(v.Tareas) && v.Tareas.length">
    <li v-for="(tarea, index) in v.Tareas" :key="index" class="text-lg font-medium text-gray-900">
        {{ index + 1 }}) {{ tarea.nombre }} - {{ tarea.descripcion }}
    </li>
</ol>
<p v-else-if="v.Tareas === 'No hay tareas asociadas'">{{ v.Tareas }}</p>
<p v-else>No hay información de tareas disponible</p>

			</div>
			<div class="mt-6 flex justify-end">
				<SecondaryButton @click="closeModalView">Cancelar</SecondaryButton>
			</div>
		</Modal>

		<Modal :show="showModalForm" @close="closeModalForm">
			<div class="p-6">

			</div>
			<div class="mt-6 flex justify-end">
				<SecondaryButton @click="closeModalForm">Cancelar</SecondaryButton>
			</div>
		</Modal>

		<Modal :show="showModalDel" @close="closeModalDel">
			<div class="p-6">

			</div>
			<div class="mt-6 flex justify-end">
				<SecondaryButton @click="closeModalDel">Cancelar</SecondaryButton>
			</div>
		</Modal>
	</AuthenticatedLayout>
</template>
