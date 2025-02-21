<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
  courses: Object,
  filters: Object,
});

// Filtreleme seçenekleri için ref tanımlamaları
const filters = ref({
  skill_level: props.filters.skill_level || '',
  sort_by: props.filters.sort_by || 'id',
  order: props.filters.order || 'asc',
});

// Filtreleri uygula butonu
const applyFilters = () => {
  router.get(route('courses.index'), filters.value);
};

// Kurs düzenleme yönlendirmesi
const editCourse = (courseId) => {
  router.visit(route('courses.edit', courseId));
};

// Kurs silme işlemi
const deleteCourse = (courseId) => {
  if (confirm('Are you sure you want to delete this course?')) {
    router.delete(route('courses.destroy', courseId));
  }
};
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Courses" />

    <div class="min-h-screen bg-gray-100 p-8">
      <!-- Başlık -->
      <h1 class="text-4xl font-bold text-center mb-8">Courses</h1>

      <!-- Filtreleme Seçenekleri -->
      <div class="bg-white p-6 rounded-lg shadow-lg mb-8 flex flex-col md:flex-row items-center justify-between gap-4">
        <div class="flex flex-col md:flex-row gap-4">
          <!-- Seviye Seçimi -->
          <div>
            <label for="skill_level" class="block text-sm font-medium text-gray-700">Skill Level</label>
            <select v-model="filters.skill_level" id="skill_level" class="border-gray-300 rounded-lg px-4 py-2">
              <option value="">All</option>
              <option value="Beginner">Beginner</option>
              <option value="Intermediate">Intermediate</option>
              <option value="Advanced">Advanced</option>
            </select>
          </div>

          <!-- Sıralama Seçimi -->
          <div>
            <label for="sort_by" class="block text-sm font-medium text-gray-700">Sort By</label>
            <select v-model="filters.sort_by" id="sort_by" class="border-gray-300 rounded-lg px-4 py-2">
              <option value="id">Default</option>
              <option value="title">Title</option>
              <option value="created_at">Date</option>
            </select>
          </div>

          <!-- Sıralama Yönü -->
          <div>
            <label for="order" class="block text-sm font-medium text-gray-700">Order</label>
            <select v-model="filters.order" id="order" class="border-gray-300 rounded-lg px-4 py-2">
              <option value="asc">Ascending</option>
              <option value="desc">Descending</option>
            </select>
          </div>
        </div>

        <!-- Filtre Uygula Butonu -->
        <button
            @click="applyFilters"
            class="bg-blue-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-blue-700 transition"
        >
          Apply
        </button>
      </div>

      <!-- Kurs Listesi -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div
            v-for="course in courses.data"
            :key="course.id"
            class="bg-white p-6 rounded-lg shadow-lg"
        >
          <h2 class="text-xl font-bold mb-2">{{ course.title }}</h2>
          <p class="text-gray-600 mb-2">{{ course.description }}</p>
          <p class="text-sm text-gray-500">Language: {{ course.language }}</p>
          <p class="text-sm text-gray-500">Skill Level: {{ course.skill_level }}</p>

          <div class="mt-4 flex justify-between">
            <button
                @click="editCourse(course.id)"
                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition"
            >
              Edit
            </button>
            <button
                @click="deleteCourse(course.id)"
                class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition"
            >
              Delete
            </button>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
