<template>
  <div>
    <h1 class="text-2xl font-bold mb-4">Courses</h1>
    <div v-for="course in courses" :key="course.id" class="mb-4 border p-4 rounded">
      <h2 class="text-xl">{{ course.title }}</h2>
      <p>{{ course.description }}</p>
      <p><strong>Language:</strong> {{ course.language }}</p>
      <p><strong>Skill Level:</strong> {{ course.skill_level }}</p>
      <p><strong>Teacher:</strong> {{ course.teacher.name }}</p>
    </div>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';

defineProps({ courses: Array });
</script>
