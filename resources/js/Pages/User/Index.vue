<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
  users: Array,
});

const deleteUser = (id) => {
  if (confirm('Are you sure you want to delete this user?')) {
    usePage().props.$inertia.delete(route('users.destroy', id));
  }
};
</script>

<template>
  <AuthenticatedLayout>

    <div class="p-6 bg-white shadow-md rounded-lg">
      <h1 class="text-2xl mb-4">Users</h1>

      <Link :href="route('users.create')" class="btn btn-primary mb-12 px-4 py-2 bg-blue-500 text-white rounded">
        Add User
      </Link>

      <table class="table-auto w-full border-collapse mt-8">
        <thead>
        <tr class="bg-gray-200">
          <th class="px-4 py-2">Name</th>
          <th class="px-4 py-2">Email</th>
          <th class="px-4 py-2">Actions</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="user in users" :key="user.id" class="border-b">
          <td class="px-4 py-2">{{ user.name }}</td>
          <td class="px-4 py-2">{{ user.email }}</td>
          <td class="px-4 py-2">
            <Link :href="route('users.edit', user.id)" class="px-3 py-1 bg-blue-500 text-white rounded">
              Edit
            </Link>
            <button @click="deleteUser(user.id)" class="ml-2 px-3 py-1 bg-red-500 text-white rounded">
              Delete
            </button>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
  </AuthenticatedLayout>
</template>

<style scoped>
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
</style>