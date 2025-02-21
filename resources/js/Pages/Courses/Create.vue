<template>
  <AuthenticatedLayout>
    <div class="max-w-4xl mx-auto mt-10">
      <h1 class="text-2xl font-bold mb-6 text-center">Create New Course</h1>
      <form @submit.prevent="submit" class="bg-white p-6 rounded-lg shadow-md space-y-4">
        <div class="grid grid-cols-2 gap-4">
          <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <input
                v-model="form.title"
                type="text"
                id="title"
                class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                placeholder="Course Title"
            />
          </div>

          <div>
            <label for="language" class="block text-sm font-medium text-gray-700">Language</label>
            <input
                v-model="form.language"
                type="text"
                id="language"
                class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                placeholder="Language"
            />
          </div>

          <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea
                v-model="form.description"
                id="description"
                rows="4"
                class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                placeholder="Course Description"
            ></textarea>
          </div>

          <div>
            <label for="skill_level" class="block text-sm font-medium text-gray-700">Skill Level</label>
            <input
                v-model="form.skill_level"
                type="text"
                id="skill_level"
                class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                placeholder="Skill Level"
            />
          </div>
        </div>

        <div class="flex justify-end">
          <button
              type="submit"
              class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500"
          >
            Save
          </button>
        </div>
      </form>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

const form = useForm({
  title: '',
  description: '',
  language: '',
  skill_level: '',
})

const submit = () => form.post(route('courses.store'))
</script>
