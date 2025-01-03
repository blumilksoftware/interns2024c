<template>
  <div class="container mx-auto p-6">
    <h1 class="text-4xl font-semibold text-center mb-8">Courses</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <div v-for="course in courses.data" :key="course.id" class="bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition duration-300 ease-in-out">
        <h2 class="text-xl font-semibold text-gray-800">{{ course.title }}</h2>
        <p class="text-gray-600 mb-4">{{ course.language }} - {{ course.skill_level }}</p>
        <div class="flex justify-between items-center">
          <button
              @click="editCourse(course.id)"
              class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
            Edit
          </button>
          <button
              @click="deleteCourse(course.id)"
              class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition duration-300">
            Delete
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { router } from '@inertiajs/vue3';

export default {
  props: {
    courses: Array,
  },
  methods: {
    editCourse(id) {
      router.get(route('courses.edit', id));
    },
    deleteCourse(id) {
      if (confirm('Are you sure you want to delete this course?')) {
        router.delete(route('courses.destroy', id));
      }
    },
  },
};
</script>

<style scoped>
</style>

