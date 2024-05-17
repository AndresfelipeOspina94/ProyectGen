<template>
    <div>
      <h1 class="text-2xl font-bold">Lista de Sprints</h1>
      <div class="mt-4">
        <table class="min-w-full bg-white">
          <thead>
            <tr>
              <th class="py-2">ID</th>
              <th class="py-2">Nombre</th>
              <th class="py-2">Proyecto</th>
              <th class="py-2">Fecha Inicio</th>
              <th class="py-2">Fecha Fin</th>
              <th class="py-2">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="sprint in sprints" :key="sprint.id">
              <td class="border px-4 py-2">{{ sprint.id }}</td>
              <td class="border px-4 py-2">{{ sprint.nombre }}</td>
              <td class="border px-4 py-2">{{ sprint.proyecto.nombre }}</td>
              <td class="border px-4 py-2">{{ sprint.fecha_inicio }}</td>
              <td class="border px-4 py-2">{{ sprint.fecha_fin }}</td>
              <td class="border px-4 py-2">
                <Link :href="route('sprints.edit', sprint.id)" class="text-blue-600">Editar</Link>
                <Link :href="route('sprints.show', sprint.id)" class="text-blue-600">Ver</Link>
                <button @click="deleteSprint(sprint.id)" class="text-red-600">Eliminar</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </template>
  
  <script>
  import { Link } from '@inertiajs/vue3'
  
  export default {
    props: {
      sprints: Array
    },
    components: {
      Link
    },
    methods: {
      deleteSprint(id) {
        if (confirm('¿Estás seguro de que quieres eliminar este sprint?')) {
          this.$inertia.delete(route('sprints.destroy', id));
        }
      }
    }
  }
  </script>