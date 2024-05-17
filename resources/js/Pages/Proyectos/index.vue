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
import { ref } from 'vue';
import InputGroup from '@/Components/InputGroup.vue';

const props = defineProps({
  proyectos: Array
});

const form = useForm({ nombre: '', descripcion: '', fecha_inicio: '', fecha_fin: '', estado: '' });
const v = ref({ id: '', nombre: '', descripcion: '', fecha_inicio: '', fecha_fin: '', estado: '', Tareas: [] });
const showModalView = ref(false);
const showModalForm = ref(false);
const showModalDel = ref(false);
const title = ref('');
const operation = ref(1);
const msj = ref('');
const classMsj = ref('hidden');

const openModalView = (proyecto) => {
  if (proyecto) {
    v.value.nombre = proyecto.nombre || '';
    v.value.descripcion = proyecto.descripcion || '';
    v.value.fecha_inicio = proyecto.fecha_inicio || '';
    v.value.fecha_fin = proyecto.fecha_fin || '';
    v.value.estado = proyecto.estado || '';
    v.value.Tareas = Array.isArray(proyecto.tareas) ? proyecto.tareas : [];
    showModalView.value = true;
  }
};

const openModalForm = (proyecto = { nombre: '', descripcion: '', fecha_inicio: '', fecha_fin: '', estado: '' }) => {
  form.nombre = proyecto.nombre;
  form.descripcion = proyecto.descripcion;
  form.fecha_inicio = proyecto.fecha_inicio;
  form.fecha_fin = proyecto.fecha_fin;
  form.estado = proyecto.estado;
  title.value = proyecto.id ? 'Editar Proyecto' : 'Crear Proyecto';
  operation.value = proyecto.id ? 2 : 1;
  showModalForm.value = true;
};

const openModalDel = (proyecto) => {
  v.value.id = proyecto.id;
  v.value.nombre = proyecto.nombre;
  showModalDel.value = true;
};

const closeModalView = () => {
  showModalView.value = false;
};

const closeModalForm = () => {
  showModalForm.value = false;
};

const closeModalDel = () => {
  showModalDel.value = false;
};

const saveProject = () => {
  if (operation.value === 1) {
    form.post(route('projects.store'), {
      onSuccess: () => closeModalForm(),
    });
  } else {
    form.put(route('projects.update', v.value.id), {
      onSuccess: () => closeModalForm(),
    });
  }
};

const deleteProject = () => {
  form.delete(route('projects.destroy', v.value.id), {
    onSuccess: () => closeModalDel(),
  });
};
</script>

<template>
  <Head title="Proyecto" />

  <AuthenticatedLayout>
    <template #header>
      Proyectos
      <DarkButton @click="openModalForm">
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
              <th class="px-4 py-3">Descripción</th>
              <th class="px-4 py-3">Fecha Inicio</th>
              <th class="px-4 py-3">Fecha Fin</th>
              <th class="px-4 py-3">Estado</th>
              <th class="px-4 py-3">Detalle</th>
              <th class="px-4 py-3">Editar</th>
              <th class="px-4 py-3">Eliminar</th>
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
                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.083a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0A48.108 48.108 0 0 0 12 5.25c-2.276 0-4.538.165-6.772.541m14.456 0-.168-1.21a2.25 2.25 0 0 0-2.24-1.962H6.724a2.25 2.25 0 0 0-2.24 1.962l-.168 1.21m14.456 0c-4.524-.683-9.388-.683-13.912 0" />
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
        <p>Nombre: <span class="text-lg font-medium text-gray-900">{{ v.value.nombre }}</span></p>
        <p>Descripción: <span class="text-lg font-medium text-gray-900">{{ v.value.descripcion }}</span></p>
        <p>Fecha de inicio: <span class="text-lg font-medium text-gray-900">{{ v.value.fecha_inicio }}</span></p>
        <p>Fecha de fin: <span class="text-lg font-medium text-gray-900">{{ v.value.fecha_fin }}</span></p>
        <p>Estado: <span class="text-lg font-medium text-gray-900">{{ v.value.estado }}</span></p>
        <p>Tareas:</p>
        <ol v-if="Array.isArray(v.value.Tareas) && v.value.Tareas.length">
          <li v-for="(tarea, index) in v.value.Tareas" :key="index" class="text-lg font-medium text-gray-900">
            {{ index + 1 }}) {{ tarea.nombre }} - {{ tarea.descripcion }}
          </li>
        </ol>
        <p v-else>No hay información de tareas disponible</p>
      </div>
      <div class="m-6 flex justify-end">
        <SecondaryButton @click="closeModalView">Cancelar</SecondaryButton>
      </div>
    </Modal>
    <Modal :show="showModalForm" @close="closeModalForm">
      <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900">{{ title }}</h2>
        <div class="mt-6 mb-6 space-y-6 max-w-xl">
          <InputGroup text="Nombre" :required="true" v-model="form.nombre">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>
          </InputGroup>
          <InputError class="mt-1" :message="form.errors.nombre" />

          <InputGroup text="Descripción" :required="true" v-model="form.descripcion">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
            </svg>
          </InputGroup>
          <InputError class="mt-1" :message="form.errors.descripcion" />

          <InputGroup text="Fecha de inicio" :required="true" v-model="form.fecha_inicio" type="date">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 7.5h16.5m-16.5 0A2.25 2.25 0 0 1 6 5.25h12a2.25 2.25 0 0 1 2.25 2.25m-16.5 0v9A2.25 2.25 0 0 0 6 18.75h12a2.25 2.25 0 0 0 2.25-2.25v-9m-2.25 0v9m-15-9h.008v9H3.75v-9Z" />
            </svg>
          </InputGroup>
          <InputError class="mt-1" :message="form.errors.fecha_inicio" />

          <InputGroup text="Fecha de fin" :required="true" v-model="form.fecha_fin" type="date">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 7.5h16.5m-16.5 0A2.25 2.25 0 0 1 6 5.25h12a2.25 2.25 0 0 1 2.25 2.25m-16.5 0v9A2.25 2.25 0 0 0 6 18.75h12a2.25 2.25 0 0 0 2.25-2.25v-9m-2.25 0v9m-15-9h.008v9H3.75v-9Z" />
            </svg>
          </InputGroup>
          <InputError class="mt-1" :message="form.errors.fecha_fin" />

          <InputGroup text="Estado" :required="true" v-model="form.estado">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75h15m-15 0L7.5 15.75m-3-3L7.5 9.75M19.5 12.75h-15m0 0L7.5 9.75m0 3L4.5 15.75" />
            </svg>
          </InputGroup>
          <InputError class="mt-1" :message="form.errors.estado" />
        </div>
        <div class="m-6 flex justify-end">
          <SecondaryButton @click="closeModalForm">Cancelar</SecondaryButton>
          <DarkButton @click="saveProject">Guardar</DarkButton>
        </div>
      </div>
    </Modal>

    <Modal :show="showModalDel" @close="closeModalDel">
      <div class="p-6">
        <p>¿Estás seguro de que deseas eliminar el proyecto <strong>{{ v.value.nombre }}</strong>?</p>
      </div>
      <div class="m-6 flex justify-end">
        <SecondaryButton @click="closeModalDel">Cancelar</SecondaryButton>
        <DangerButton @click="deleteProject">Eliminar</DangerButton>
      </div>
    </Modal>
  </AuthenticatedLayout>
</template>
