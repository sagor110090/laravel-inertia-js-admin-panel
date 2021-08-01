<template>
  <div class="flex-grow">
    <h1 class="mb-8 font-bold text-3xl">Contacts</h1>
    <div class="mb-6 flex justify-between items-center">
      <div class="flex items-center w-full max-w-md mr-4">
        <input v-model="search" type="text" placeholder="Search..." class="border-2 border-gray-300 bg-white h-10 px-5 pr-16 text-sm focus:outline-none mt-4 mb-4 rounded-none" @keyup="searchData" />
      </div>
      <inertia-link class="btn-indigo" :href="route('client.create')">
        <span>Create</span>
        <span class="hidden md:inline">Client</span>
      </inertia-link>
    </div>
    <div class="bg-white rounded-md shadow overflow-x-auto">
      <table class="table border w-full bg-white">
        <thead>
          <tr class="text-left font-bold">
            <th class="border px-6 pt-6 pb-4">ID</th>
            <th class="border px-6 pt-6 pb-4">Name</th>
            <th class="border px-6 pt-6 pb-4">Email</th>
            <th class="border px-6 pt-6 pb-4">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="client in clients.data" :key="client.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
            <td class="border p-3">{{ client.id }}</td>
            <td class="border p-3">{{ client.first_name }}</td>
            <td class="border p-3">{{ client.email }}</td>
            <td class="border p-3">
              <inertia-link :href="route('client.edit', client.id)"><i class="fa fa-edit text-indigo-400" /></inertia-link>
              <button @click="destroy(client.id)"><i class="fa fa-trash text-red-400" /></button>
            </td>
          </tr>
          <tr v-if="clients.data.length === 0">
            <td class="border-t px-6 py-4" colspan="4">No data found.</td>
          </tr>
        </tbody>
      </table>
    </div>
    <pagination class="mt-6" :links="clients.links" />
  </div>
</template>

<script>
import Layout from '@/Shared/Layout'
import Pagination from '@/Shared/Pagination'
import _ from 'lodash'
export default {
  components: {
    Pagination,
  },
  layout: Layout,
  props: {
    clients: Object,
  },
  data() {
    return {
      search: '',
    }
  },
  methods: {
    searchData: _.throttle(function () {
      this.$inertia.replace(this.route('client', { search: this.search }))
    }, 2000),
    destroy(id) {
      Swal.fire({
        title: 'Are you sure?',
        text: 'you want to delete this client.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
      }).then((result) => {
        if (result.isConfirmed) {
          this.$inertia.delete(this.route('client.destroy', id))
          Swal.fire('Deleted!', 'Your file has been deleted.', 'success')
        }
      })
    },
  },
}
</script>
