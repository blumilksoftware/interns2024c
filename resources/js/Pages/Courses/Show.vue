<template>
  <div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="max-w-2xl w-full p-8 bg-white shadow-xl rounded-lg">
      <h1 class="text-4xl font-bold text-gray-800 mb-6">{{ course.title }}</h1>

      <div class="mb-6">
        <p class="text-lg text-gray-700"><strong class="font-semibold">Description:</strong> {{ course.description }}</p>
        <p class="text-lg text-gray-700"><strong class="font-semibold">Language:</strong> {{ course.language }}</p>
        <p class="text-lg text-gray-700"><strong class="font-semibold">Skill Level:</strong> {{ course.skill_level }}</p>
      </div>

      <div class="flex space-x-6">
        <button
            @click="editCourse"
            class="w-full sm:w-auto px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
          Edit Course
        </button>

        <button
            @click="deleteCourse"
            class="w-full sm:w-auto px-6 py-3 bg-red-600 text-white font-semibold rounded-lg shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
          Delete Course
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import { router } from '@inertiajs/vue3'

export default {
  props: {
    course: Object,
  },
  methods: {
    editCourse() {
      router.get(route('courses.edit', this.course.id))
    },
    deleteCourse() {
      if (confirm('Are you sure you want to delete this course?')) {
        router.delete(route('courses.destroy', this.course.id))
      }
    },
  },
};
</script>

<style scoped>

</style>