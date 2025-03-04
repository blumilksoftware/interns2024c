<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
  courses: Object,
  filters: Object,
});

const filters = ref({
  skill_level: props.filters.skill_level || '',
  sort_by: props.filters.sort_by || 'id',
  order: props.filters.order || 'asc',
});

const applyFilters = () => {
  router.get(route('courses.index'), filters.value);
};

const editCourse = (courseId) => {
  router.visit(route('courses.edit', courseId));
};

const deleteCourse = (courseId) => {
  if (confirm('Are you sure you want to delete this course?')) {
    router.delete(route('courses.destroy', courseId));
  }
};
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Courses" />

    <div class="min-h-screen bg-gray-100 p-6">
      <h1 class="text-3xl font-extrabold text-center mb-6 text-gray-800">Courses</h1>

      <div class="p-4  rounded-lg shadow-md mb-6 flex flex-wrap items-center justify-center gap-3">
        <div class="flex gap-3">
          <select v-model="filters.skill_level" class="border-gray-300 rounded-md px-4 py-2 text-sm w-40">
            <option value="">All Levels</option>
            <option value="Beginner">Beginner</option>
            <option value="Intermediate">Intermediate</option>
            <option value="Advanced">Advanced</option>
          </select>

          <select v-model="filters.sort_by" class="border-gray-300 rounded-md px-4 py-2 text-sm w-40">
            <option value="id">Default</option>
            <option value="title">Title</option>
            <option value="created_at">Date</option>
          </select>

          <select v-model="filters.order" class="border-gray-300 rounded-md px-4 py-2 text-sm w-40">
            <option value="asc">Ascending</option>
            <option value="desc">Descending</option>
          </select>
        </div>

        <button @click="applyFilters" class="bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-semibold hover:bg-blue-700 transition">
          Apply
        </button>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        <div v-for="course in courses.data" :key="course.id" class="bg-white p-4 rounded-lg shadow-md h-auto flex flex-col justify-between">
          <div>
            <h2 class="text-xl font-bold text-gray-800 mb-2">{{ course.title }}</h2>
            <p class="text-gray-600 text-sm mb-2">{{ course.description }}</p>
            <p class="text-sm text-gray-500">Language: <span class="font-semibold">{{ course.language }}</span></p>
            <p class="text-sm text-gray-500">Skill Level: <span class="font-semibold">{{ course.skill_level }}</span></p>
          </div>

          <div class="mt-4 flex justify-between">
            <button @click="editCourse(course.id)" class="bg-blue-500 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-blue-600 transition">
              Edit
            </button>
            <button @click="deleteCourse(course.id)" class="bg-red-500 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-red-600 transition">
              Delete
            </button>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
