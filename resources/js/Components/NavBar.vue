<template>
  <nav class="bg-[#1E3A8A] p-4 text-white">
    <ul class="flex space-x-6 font-semibold">
      <li>
        <Link :href="route('dashboard')" class="hover:text-gray-300">Dashboard</Link>
      </li>
      <li>
        <Link :href="route('courses.index')" class="hover:text-gray-300">Courses</Link>
      </li>
      <li>
        <Link :href="route('courses.create')" class="hover:text-gray-300">Create Course</Link>
      </li>
    </ul>
  </nav>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>
