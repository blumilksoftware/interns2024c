<template>
  <div>
    <h1 class="text-2xl mb-4">Users</h1>
    <!-- Create User Link -->
    <InertiaLink :href="route('users.create')" class="btn btn-primary mb-4">Create User</InertiaLink>

    <table class="table-auto w-full border-collapse">
      <thead>
      <tr class="bg-gray-200">
        <th class="px-4 py-2">Name</th>
        <th class="px-4 py-2">Email</th>
        <th class="px-4 py-2">Actions</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="user in users" :key="user.id">
        <td class="px-4 py-2">{{ user.name }}</td>
        <td class="px-4 py-2">{{ user.email }}</td>
        <td class="px-4 py-2">
          <!-- Edit Button -->
          <InertiaLink :href="route('users.edit', user.id)" class="btn btn-warning text-white py-1 px-3 rounded">
            Edit
          </InertiaLink>
          <!-- Delete Button -->
          <button @click="deleteUser(user.id)" class="btn btn-danger text-white py-1 px-3 rounded ml-2">
            Delete
          </button>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import { InertiaLink } from '@inertiajs/inertia-vue3'

export default {
  props: {
    users: Array,
  },
  components: {
    InertiaLink,
  },
  methods: {
    deleteUser(id) {
      if (confirm('Are you sure you want to delete this user?')) {
        this.$inertia.delete(route('users.destroy', id));
      }
    },
  },
};
</script>

<style scoped>
/* TailwindCSS ile butonları ve tablonun görünümünü düzeltmek */
.table-auto {
  width: 100%;
  border: 1px solid #ddd;
}
th, td {
  border: 1px solid #ddd;
  text-align: left;
  padding: 8px;
}
tr:nth-child(even) {
  background-color: #f9f9f9;
}
.btn {
  cursor: pointer;
  font-weight: bold;
  border: none;
  border-radius: 4px;
}
.btn-primary {
  background-color: #007bff;
  color: white;
}
.btn-warning {
  background-color: #ffc107;
  color: white;
}
.btn-danger {
  background-color: #dc3545;
  color: white;
}
</style>
