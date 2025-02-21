<template>
  <div>
    <h1 class="text-2xl mb-4">Create User</h1>

    <form @submit.prevent="createUser">
      <div class="mb-4">
        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
        <input type="text" v-model="user.name" id="name" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
      </div>

      <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" v-model="user.email" id="email" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
      </div>

      <div class="mb-4">
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input type="password" v-model="user.password" id="password" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
      </div>

      <div class="flex justify-end">
        <button type="submit" class="btn btn-primary mr-2">Create</button>
        <InertiaLink :href="route('users.index')" class="btn btn-secondary">Cancel</InertiaLink>
      </div>
    </form>
  </div>
</template>

<script>
import { InertiaLink } from '@inertiajs/inertia-vue3'

export default {
  props: {
  },
  components: {
    InertiaLink,
  },
  data() {
    return {
      user: {
        name: '',
        email: '',
        password: ''
      }
    };
  },
  methods: {
    createUser() {
      this.$inertia.post(route('users.store'), this.user);
    },
  },
};
</script>

<style scoped>
.btn {
  cursor: pointer;
  font-weight: bold;
  border: none;
  border-radius: 4px;
  padding: 10px 20px;
}
.btn-primary {
  background-color: #007bff;
  color: white;
}
.btn-secondary {
  background-color: #6c757d;
  color: white;
}
input[type="text"],
input[type="email"],
input[type="password"] {
  width: 100%;
  padding: 10px;
  margin-top: 5px;
  border: 1px solid #ccc;
  border-radius: 4px;
}
form {
  max-width: 600px;
  margin: 0 auto;
}
</style>