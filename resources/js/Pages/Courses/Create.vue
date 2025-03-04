<template>
  <AuthenticatedLayout>
    <div class="max-w-4xl mx-auto mt-10">
      <h1 class="text-2xl font-bold mb-6 text-center">Create New Course</h1>
      <form @submit.prevent="submit" class="bg-white p-6 rounded-lg shadow-md space-y-4">
        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Title</label>
            <input v-model="form.title" type="text" class="input-field" placeholder="Course Title" />
            <p v-if="form.errors.title" class="text-red-500 text-sm">{{ form.errors.title }}</p>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Language</label>
            <input v-model="form.language" type="text" class="input-field" placeholder="Language" />
            <p v-if="form.errors.language" class="text-red-500 text-sm">{{ form.errors.language }}</p>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Description</label>
            <textarea v-model="form.description" rows="4" class="input-field" placeholder="Course Description"></textarea>
            <p v-if="form.errors.description" class="text-red-500 text-sm">{{ form.errors.description }}</p>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Skill Level</label>
            <input v-model="form.skill_level" type="text" class="input-field" placeholder="Skill Level" />
            <p v-if="form.errors.skill_level" class="text-red-500 text-sm">{{ form.errors.skill_level }}</p>
          </div>
        </div>

        <div class="flex justify-end">
          <button type="submit" class="btn-primary">Save</button>
        </div>
      </form>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const form = useForm({
  title: '',
  description: '',
  language: '',
  skill_level: '',
});

const submit = () => form.post(route('courses.store'));
</script>

<style scoped>
.input-field {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.btn-primary {
  background-color: #4f46e5;
  color: white;
  padding: 10px 20px;
  border-radius: 5px;
  transition: 0.3s;
}

.btn-primary:hover {
  background-color: #4338ca;
}
</style>
