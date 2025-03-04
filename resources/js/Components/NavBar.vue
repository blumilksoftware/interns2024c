<template>
  <nav class="bg-[#1E3A8A] p-4 text-white">
    <ul class="flex space-x-6 font-semibold">
      <li>
        <Link :href="route('dashboard')" class="hover:text-gray-300">Dashboard</Link>
      </li>
      <li>
        <Link :href="route('user.index')" class="hover:text-gray-300">Users</Link>
      </li>
      <li>
        <Link :href="route('user.create')" class="hover:text-gray-300">Create User</Link>
      </li>
    </ul>
  </nav>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>