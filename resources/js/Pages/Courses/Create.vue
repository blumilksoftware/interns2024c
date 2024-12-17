<template>
  <form @submit.prevent="submit">
    <label>Title:</label>
    <input v-model="form.title" class="border p-2 rounded" />
    <label>Description:</label>
    <textarea v-model="form.description" class="border p-2 rounded"></textarea>
    <label>Language:</label>
    <input v-model="form.language" class="border p-2 rounded" />
    <label>Skill Level:</label>
    <input v-model="form.skill_level" class="border p-2 rounded" />
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
  </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

const form = useForm({
  title: '',
  description: '',
  language: '',
  skill_level: '',
});

const submit = () => {
  form.post(route('courses.store'));
};
</script>
